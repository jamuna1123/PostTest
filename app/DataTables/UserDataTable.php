<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                // Edit Button
                $editBtn = '<a href="'.route('users.edit', $row->id).'" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>';

                // View Button
                $viewBtn = '<a href="'.route('users.show', $row->id).'" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>';
                //for the password button
                $passwordBtn = '<a href="'.route('password', $row->id).'" class="btn btn-secondary btn-sm">
                   <i class="fas fa-lock"></i>
                </a>';
                // Delete Button (only visible if authenticated user is not the current user)
                $deleteBtn = '';
                if (auth()->check() && auth()->id() !== $row->id) {
                    $deleteBtn = '<a href="javascript:void(0);" onclick="handleDelete('.$row->id.')" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </a>
                  <form id="deletePostForm-'.$row->id.'" action="'.route('users.destroy', $row->id).'" method="POST" style="display: none;">
                    '.csrf_field().method_field('DELETE').'
                  </form>';
                }

                // Combine all buttons
                return $viewBtn.' '.$editBtn.' '.$passwordBtn.' '.$deleteBtn;
            })
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox"  name="selected_rows[]" value="'.$row->id.'">';
            })
            ->addColumn('image', function ($row) {
                // Display image with a small thumbnail
                if ($row->image) {
                    return '<a href="'.asset('storage/images/resized/800px_' . basename($row->image)).'" data-fancybox="gallery" data-caption="'.$row->title.'">
                            <img src="'.asset('storage/images/resized/100px_' . basename($row->image)).'" alt="'.$row->title.'" style="width: 100px; height:auto">
                        </a>';
                }

                return 'No image available';
            })
          // Assuming this is inside the DataTables column definitions
            ->addColumn('status', function ($row) {
                // If the authenticated user is the same as the current row, display status as plain text
                if (auth()->check() && auth()->id() === $row->id) {
                    return '<span style="color: #fff; background-color: '.($row->status ? '#28a745' : '#dc3545').'" class="badge '.($row->status ? 'badge-success' : 'badge-danger').'">'
        .($row->status ? 'Active' : 'Inactive').
       '</span>';

                }

                // Otherwise, display the toggle switch
                $checked = $row->status ? 'checked' : '';

                return '<div class="form-check form-switch">
        <input class="form-check-input status-toggle" type="checkbox" data-id="'.$row->id.'" '.$checked.'>
        <label class="form-check-label" for="statusLabel'.$row->id.'">'.
                    '</label>
    </div>';

            })

            ->rawColumns(['checkbox', 'action', 'status', 'image']) // Mark columns as raw HTML
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1);
        // The buttons have been removed
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
            Column::make('checkbox')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->title('<input type="checkbox" id="select-all">')
                ->width(30),
            Column::make('name'),

            // Instead of category.title, use the manually added category_title
            Column::make('email'),
            Column::make('image'),
            Column::make('phone'),
            Column::make('status')
                ->exportable(false)
                ->printable(false),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_'.date('YmdHis');
    }
}
