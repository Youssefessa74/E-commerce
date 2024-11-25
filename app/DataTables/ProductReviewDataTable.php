<?php

namespace App\DataTables;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductReviewDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('status', function ($query) {
            $checked = $query->status == 1 ? 'checked' : '';
            return '<div class="form-group">
                <label class="custom-switch mt-2">
                  <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" data-status="' . $query->status . '" class="custom-switch-input toggle_status">
                  <span class="custom-switch-indicator"></span>
                </label>
              </div>';
        })

            ->addColumn('user',function($query){
                return $query->user->email;
            })
            ->rawColumns(['user','status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductReview $model): QueryBuilder
    {
        return $model->where('product_id',request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productreview-table')
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
            Column::make('rating'),
            Column::make('user'),
            Column::make('status'),
            Column::make('review')
            ->width(300),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductReview_' . date('YmdHis');
    }
}
