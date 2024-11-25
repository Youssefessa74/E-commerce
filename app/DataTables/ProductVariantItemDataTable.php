<?php

namespace App\DataTables;

use App\Models\ProductVariantItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductVariantItemDataTable extends DataTable
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
            $edit = "<a href='" . route('admin.variant-item.edit',$query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
            $delete = "
                        <form action='" . route('admin.variant-item.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                            " . csrf_field() . "
                            " . method_field('DELETE') . "
                            <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                        </form>
                    ";

             return $edit.$delete;
        })
        ->addColumn('product_variant', function ($query) {
          return $query->ProductVariant->name;
        })
        ->addColumn('status', function ($query) {
            if ($query->status === 1) {
                return '<span class="badge badge-success">Active</span>';
            } else {
                return '<span class="badge badge-danger">InActive</span>';
            }
        })
        ->addColumn('is_default', function ($query) {
            if ($query->is_default === 1) {
                return '<span class="badge badge-success">Yes</span>';
            } else {
                return '<span class="badge badge-danger">No</span>';
            }
        })
        ->rawColumns(['action','status','is_default','product_variant'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariantItem $model): QueryBuilder
    {
        return $model->where('product_variant_id',request()->variant)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productvariantitem-table')
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
            Column::make('name'),
            Column::make('product_variant'),
            Column::make('price'),
            Column::make('status'),
            Column::make('is_default'),
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
        return 'ProductVariantItem_' . date('YmdHis');
    }
}
