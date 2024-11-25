<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\PendingOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DroppedOffDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('order_status', function ($query) {
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge bg-warning'>pending</span>";
                        break;
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info'>processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info'>dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info'>shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary'>out for delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-success'>delivered</span>";
                        break;
                    case 'canceled':
                        return "<span class='badge bg-danger'>canceled</span>";
                        break;
                    default:
                        # code...
                        break;
                }
            })
            ->addColumn('date', function ($query) {
                return date('Y-m-d', strtotime($query->created_at));
            })
            ->addColumn('payment_status', function ($query) {
                if ($query->payment_status === 0) {
                    return '<span class="badge badge-warning">PENDING</span>';
                } else {
                    return '<span class="badge badge-success">PAID</span>';
                }
            })
            ->addColumn('amount', function ($query) {
                return $query->currency_icon . $query->amount;
            })
            ->addColumn('action', function ($query) {
                $see = "<a href='" . route('admin.orders.show', $query->id) . "' class='btn btn-primary'><i class='fas fa-eye'></i></a>";
                $delete = "
                    <form action='" . route('admin.orders.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                        <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                    </form>
                ";
                $statusBtn = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-warning mr-2'><i class='fas fa-truck'></i></a>";
                return $statusBtn . $see . $delete;
            })->rawColumns(['customer', 'order_status', 'date', 'action', 'amount', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('order_status','dropped_off')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pendingorder-table')
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
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('date'),
            Column::make('product_qty'),
            Column::make('amount'),
            Column::make('order_status'),
            Column::make('payment_status'),
            Column::make('payment_method'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingOrder_' . date('YmdHis');
    }
}
