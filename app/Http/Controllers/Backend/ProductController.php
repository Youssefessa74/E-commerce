<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductStoreReqeust;
use App\Http\Requests\Backend\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\ProductService;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use upload_file;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    function GetChildCategories($sub_category)  {
        $data = ChildCategory::where('sub_category_id',$sub_category)->pluck('name','id');
        return response()->json($data);
    }
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreReqeust $request)
    {
      $this->productService->storeProduct($request);
      toastr("Data Saved Successfully");
      return to_route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $brands = Brand::all();
        $categories = Category::all();
        $subCategories = Subcategory::where('category_id',$product->category_id)->get();
        $childCategories=ChildCategory::where('sub_category_id',$product->sub_category_id)->get();
        return view('admin.products.edit',compact('brands','categories','product','subCategories','childCategories'));
    }


    public function update(ProductUpdateRequest $request, string $id)
    {
        $this->productService->updateProduct($request,$id);
        toastr("Data Saved Successfully");
        return to_route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->destroyProduct($id);
        
        return to_route('admin.products.index');
    }

    function GetProductStatus(Request $request)  {
     $product =  Product::findOrFail($request->id);
     $product->status = !$request->status;
     $product->save();
     return response()->json(['status'=>'success'],200);
    }

}
