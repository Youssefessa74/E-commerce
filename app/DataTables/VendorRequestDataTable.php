<?php

namespace App\DataTables;

use App\Models\Vendor;
use App\Models\VendorRequest;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorRequestDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('user_name', function ($query) {
                return $query->user ? $query->user->name : 'N/A'; // Display 'N/A' or another fallback if user is null
            })

            ->addColumn('shop_email', function ($query) {
                return $query->email;
            })
            ->addColumn('status', function ($query) {
                if ($query->status === 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Pending</span>';
                }
            })
            ->addColumn('action', function ($query) {
                $show = "<a href='" . route('admin.vendor.request.show', $query->id) . "' class='btn btn-primary'><i class='fas fa-eye'></i></a>";
                return $show;
            })
            ->setRowId('id')
            ->rawColumns(['user_name', 'status', 'action']);
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
            ->setTableId('vendorrequest-table')
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
        return 'VendorRequest_' . date('YmdHis');
    }
}
