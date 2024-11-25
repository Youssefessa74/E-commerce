<?php

namespace App\DataTables;

use App\Models\PendingSellerProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingSellerProductDataTable extends DataTable
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
                $edit = "<a href='" . route('admin.products.edit', $query->id) . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "
                    <form action='" . route('admin.products.destroy', $query->id) . "' method='POST' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                        " . csrf_field() . "
                        " . method_field('DELETE') . "
                        <button type='submit' class='btn btn-danger ml-2'><i class='fas fa-trash'></i></button>
                    </form>
                ";
                $moreBtn= '<div class="dropdown d-inline">
                      <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-cog"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item has-icon" href="'.route('admin.gallery.index',['product'=>$query->id]).'"><i class="far fa-heart"></i>Gallery</a>
                        <a class="dropdown-item has-icon" href="'.route('admin.variant.index',['product'=>$query->id]).'"><i class="far fa-file"></i>Variants</a>
                      </div>
                    </div>';

                return $moreBtn . $edit . $delete ;
            })->addColumn('thumb_image', function ($query) {
                return '<img width="70px" src="' . asset($query->thumb_image) . '">';
            })
            ->addColumn('vendor', function ($query) {
                return $query->vendor->shop_name;
            })
            ->addColumn('approve', function ($query) {
                $selected = $query->approve == 1 ? 'Approve' : 'Pending';
                $options = '
                    <select class="form-control approve_status" data-id="' . $query->id . '">
                        <option value="1"' . ($query->approve == 1 ? ' selected' : '') . '>Approve</option>
                        <option value="0"' . ($query->approve == 0 ? ' selected' : '') . '>Pending</option>
                    </select>';
                return $options;
            })
            ->addColumn('product_type', function ($query) {
                switch ($query->product_type) {
                    case 'new_arrival':
                        return '<span class="badge badge-success">New Arrival</span>';
                        break;

                    case 'featured_product':
                        return '<span class="badge badge-warning">Featured Product</span>';
                        break;

                    case 'top_product':
                        return '<span class="badge badge-info">Top Product</span>';
                        break;

                    case 'best_product':
                        return '<span class="badge badge-danger">Best Product</span>';
                        break;

                    default:
                        return '<span class="badge badge-danger">No thing</span>';
                        break;
                }
            })
            ->addColumn('status', function ($query) {
                if($query->status == 1){
                    $button = '<div class="form-group">
                            <label class="custom-switch mt-2">
                              <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" data-status="'.$query->status.'" class="custom-switch-input toggle_status">
                              <span class="custom-switch-indicator"></span>
                            </label>
                          </div>' ;
                           }else{
                            $button = '<div class="form-group">
                            <label class="custom-switch mt-2">
                              <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" data-status="'.$query->status.'" class="custom-switch-input toggle_status">
                              <span class="custom-switch-indicator"></span>
                            </label>
                          </div>' ;
                           }
                    return $button ;
            })
            ->rawColumns(['thumb_image', 'product_type','action','status','vendor','approve'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id','!=',Auth::user()->vendor->id)->where('is_approved',0)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pendingsellerproduct-table')
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
            Column::make('thumb_image'),
            Column::make('vendor'),
            Column::make('name'),
            Column::make('price'),
            Column::make('product_type'),
            Column::make('status'),
            Column::make('approve'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(210)
                ->addClass('text-center'),


        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingSellerProduct_' . date('YmdHis');
    }
}
