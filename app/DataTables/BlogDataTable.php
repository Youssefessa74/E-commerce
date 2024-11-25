<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.blogs.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "
                <form action='" . route('admin.blogs.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                </form>
            ";

                return $edit . $delete;
            })
            ->addColumn('image', function ($query) {
                return '<img width="120px" src="' . asset($query->image) . '">';
            })
            ->addColumn('status', function ($query) {

                $checked = $query->status == 1 ? 'checked' : '';

                return '<div class="form-group">
                <label class="custom-switch mt-2">
                  <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" data-status="' . $query->status . '" class="custom-switch-input toggle_status">
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>';
            })
            ->addColumn('publish_date', function ($query) {
                return date('d M Y', strtotime($query->created_at));
            })
            ->addColumn('category', function ($query) {
                return $query->category->name;
            })
            ->rawColumns(['action', 'status', 'publish_date', 'category','image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('blog-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('title'),
            Column::make('category'),
            Column::make('status'),
            Column::make('publish_date'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Blog_' . date('YmdHis');
    }
}
