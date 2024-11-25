<?php

namespace App\DataTables;

use App\Models\WithDrawRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WithDrawRequestDataTable extends DataTable
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
            $show = "<a href='" . route('admin.with-draw-requests.show', $query->id) . "' class='btn btn-primary'><i class='fas fa-eye'></i></a>";
            return $show;
            })
            ->addColumn('vendor',function($query){
                return $query->vendor->shop_name;
            })
            ->filterColumn('vendor',function($query,$keyword){
                $query->whereHas('vendor',function($subQuery) use ($keyword){
                    $subQuery->where('shop_name','like','%'.$keyword.'%');
                });
            })
            ->addColumn('total_amount',function($query){
                return CurrencyIcon().$query->total_amount;
            })
            ->addColumn('withdraw_amount',function($query){
                return CurrencyIcon().$query->withdraw_amount;
            })
            ->addColumn('withdraw_charge',function($query){
                return CurrencyIcon().$query->withdraw_charge;
            })
            ->addColumn('date',function($query){
                return date('d M Y',strtotime($query->created_at));
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 'paid') {
                    return '<span class="badge badge-success">Paid</span>';
                } else {
                    return '<span class="badge badge-danger">Pending</span>';
                }
            })
            ->rawColumns(['action','withdraw_charge','withdraw_amount','total_amount','status','date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(WithDrawRequest $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('withdrawrequest-table')
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
            Column::make('vendor'),
            Column::make('method'),
            Column::make('total_amount'),
            Column::make('withdraw_amount'),
            Column::make('withdraw_charge'),
            Column::make('status'),
            Column::make('date'),
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
        return 'WithDrawRequest_' . date('YmdHis');
    }
}
