<?php

namespace App\DataTables;

use App\Models\GeneralSetting;
use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShippingRuleDataTable extends DataTable
{
    protected $currencyIcon = '';

   public function __construct() {
        $icon = GeneralSetting::first();
        $this->currencyIcon =$icon->currency_icon;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $edit = "<a href='" . route('admin.shipping-rule.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "
            <form action='" . route('admin.shipping-rule.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                " . csrf_field() . "
                " . method_field('DELETE') . "
                <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
            </form>
        ";

                return $edit . $delete;
            })
            ->addColumn('min_cost',function($query){
                if($query->type == 'min_cost'){
                    return $this->currencyIcon.$query->min_cost;
                }else{
                    return $this->currencyIcon . 0;

                }
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
            ->addColumn('cost',function($query){
                return $this->currencyIcon . $query->cost ;
            })
            ->addColumn('type', function ($query) {
                if ($query->type === 'flat_cost') {
                    return '<span class="badge badge-info">Flat Cost</span>';
                } else {
                    return '<span class="badge badge-primary">Min Cost</span>';
                }
            })
            ->rawColumns(['action', 'status','type','min_cost','cost'])->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ShippingRule $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('shippingrule-table')
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
            Column::make('type'),
            Column::make('cost'),
            Column::make('min_cost'),
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
        return 'ShippingRule_' . date('YmdHis');
    }
}
