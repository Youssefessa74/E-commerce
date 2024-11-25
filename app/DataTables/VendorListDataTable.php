<?php

namespace App\DataTables;

use App\Models\Vendor;
use App\Models\VendorList;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorListDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('user_name',function($query){
            return $query->user->name;
        })
        ->addColumn('shop_email',function($query){
            return $query->email;
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
        ->rawColumns(['user_name','shop_email','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorlist-table')
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
            Column::make('user_name'),
            Column::make('shop_name'),
            Column::make('shop_email'),
            Column::make('status'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorList_' . date('YmdHis');
    }
}
