<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                $edit = "<a href='" . route('admin.brands.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "
        <form action='" . route('admin.brands.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
            " . csrf_field() . "
            " . method_field('DELETE') . "
            <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
        </form>
    ";

                return $edit . $delete;
            })
            ->addColumn('logo', function ($query) {
                return '<img width="100px" src="' . asset($query->logo) . '">';
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">InActive</span>';
                }
            })
            ->addColumn('is_featured', function ($query) {
                if ($query->is_featured === 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">InActive</span>';
                }
            })
            ->rawColumns(['action', 'logo', 'status','is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
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
            Column::make('logo'),
            Column::make('name'),
            Column::make('is_featured'),
            Column::make('status'),
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
        return 'Brand_' . date('YmdHis');
    }
}
