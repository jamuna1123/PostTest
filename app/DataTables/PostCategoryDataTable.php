<?php

namespace App\DataTables;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostCategoryDataTable extends DataTable
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
                $editBtn = '<a href="'.route('post-category.edit', $row->id).'" class="btn btn-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>';

                // View Button
                $viewBtn = '<a href="'.route('post-category.show', $row->id).'" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>';

                // Delete Button
                $deleteBtn = '<a href="javascript:void(0);" onclick="postcategoryDelete('.$row->id.')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                        <form id="deletePostcategoryForm-'.$row->id.'" action="'.route('post-category.destroy', $row->id).'" method="POST" style="display: none;">
                            '.csrf_field().method_field('DELETE').'
                        </form>';

                // Combine all buttons
                return $viewBtn.' '.$editBtn.' '.$deleteBtn;
            })
            ->addColumn('category_image', function ($row) {
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

            ->rawColumns(['action', 'status', 'category_image']) // Mark columns as raw HTML
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PostCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('postcategory-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
        // ->buttons([
        //     Button::make('excel'),
        //     Button::make('csv'),
        //     Button::make('pdf'),
        //     Button::make('print'),
        //     Button::make('reset'),
        //     Button::make('reload'),

        // ])
        // ;
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

            Column::make('title') // Use the actual database field 'title' here
                ->title('Category Name'),

            Column::make('category_image')
                ->title('Category Image'),

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
        return 'PostCategory_'.date('YmdHis');
    }
}
