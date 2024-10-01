<?php

namespace App\DataTables;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
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
                $editBtn = '<a href="'.route('post.edit', $row->id).'" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>';

                // View Button
                $viewBtn = '<a href="'.route('post.show', $row->id).'" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>';

                // Delete Button
                $deleteBtn = '<a href="javascript:void(0);" onclick="handleDelete('.$row->id.')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="deletePostForm-'.$row->id.'" action="'.route('post.destroy', $row->id).'" method="POST" style="display: none;">
                            '.csrf_field().method_field('DELETE').'
                        </form>';

                // Combine all buttons
                return $viewBtn.' '.$editBtn.' '.$deleteBtn;
            })
            ->addColumn('image', function ($row) {
                // Display image with a small thumbnail
                if ($row->image) {
                    return '<a href="'.asset('storage/'.$row->image).'" data-fancybox="gallery" data-caption="'.$row->title.'">
                            <img src="'.asset('storage/images/resized/'.basename($row->image)).'" alt="'.$row->title.'" style="height: 50px;">
                        </a>';
                }

                return 'No image available';
            })
            ->addColumn('status', function ($row) {
                $checked = $row->status ? 'checked' : '';

                return '<div class="form-check form-switch">
                <input class="form-check-input status-toggle" type="checkbox" data-id="'.$row->id.'" '.$checked.'>
                <label class="form-check-label" for="statusLabel'.$row->id.'">'.
                              '</label>
            </div>';
            })
                // Add the category title as a separate column
            ->addColumn('post_title', function ($row) {
                return $row->title;
            })
     // Add the category title as a separate column
            ->addColumn('category_title', function ($row) {
                return $row->category ? $row->category->title : 'No category';
            })
            ->rawColumns(['action', 'status', 'image', 'post_title', 'category_title']) // Mark columns as raw HTML
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Post $model): QueryBuilder
    {
        // Join the post_categories table to get the category name
        return $model->newQuery()->with('category');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('post-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1)
            ->selectStyleSingle();

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150),

            Column::make('title'),

            Column::make('category_title')
                ->title('Category'),

            Column::make('image')
                ->width(150),

            Column::make('status')
                ->exportable(false)
                ->printable(false)
                ->width(50),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Post_'.date('YmdHis');
    }
}
