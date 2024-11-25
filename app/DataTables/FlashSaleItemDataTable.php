<?php

namespace App\DataTables;

use App\Models\FlashSaleItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleItemDataTable extends DataTable
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
            $delete = "
                <form action='" . route('admin.flash.sale.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                </form>
            ";

            return $delete ;
        })
        ->addColumn('status', function ($query) {

            $checked = $query->status == 1 ? 'checked' : '';

            return '<div class="form-group">
                        <label class="custom-switch mt-2">
                          <input type="checkbox" '.$checked.' name="custom-switch-checkbox" data-id="'.$query->id.'" data-status="'.$query->status.'" class="custom-switch-input toggle_status">
                          <span class="custom-switch-indicator"></span>
                        </label>
                      </div>';
        })
        ->addColumn('show_at_home', function ($query) {
            $checked = $query->show_at_home == 1 ? 'checked' : '';

            return '<div class="form-group">
                        <label class="custom-switch mt-2">
                          <input type="checkbox" '.$checked.' name="custom-switch-checkbox" data-id="'.$query->id.'" data-show_at_home="'.$query->show_at_home.'" class="custom-switch-input toggle_show_at_home">
                          <span class="custom-switch-indicator"></span>
                        </label>
                      </div>';
        })
        ->addColumn('product', function($query) {
            return '<a href="'. route('admin.products.edit', $query->product->id) .'">'.$query->product->name.'</a>';
        })
        ->rawColumns(['action','status','show_at_home','product'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSaleItem $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('flashsaleitem-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('product'),
            Column::make('status'),
            Column::make('show_at_home'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'FlashSaleItem_' . date('YmdHis');
    }
}
