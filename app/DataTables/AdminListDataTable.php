<?php

namespace App\DataTables;

use App\Models\AdminList;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminListDataTable extends DataTable
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
            if($query->email != 'admin@gmail.com'){
                $delete = "
                <form action='" . route('admin.admin.list.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                    " . csrf_field() . "
                    " . method_field('DELETE') . "
                    <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                </form>
            ";

                return $delete;
            }
        })
            ->addColumn('status', function ($query) {
                if($query->email != 'admin@gmail.com'){
                    $checked = $query->status == 'active' ? 'checked' : '';
                    return '<div class="form-group">
                        <label class="custom-switch mt-2">
                          <input type="checkbox" ' . $checked . ' name="custom-switch-checkbox" data-id="' . $query->id . '" data-status="' . $query->status . '" class="custom-switch-input toggle_status">
                          <span class="custom-switch-indicator"></span>
                        </label>
                      </div>';
                }
            })
            ->rawColumns(['status','action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->where('role','admin')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('adminlist-table')
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
            Column::make('email'),
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
        return 'AdminList_' . date('YmdHis');
    }
}
