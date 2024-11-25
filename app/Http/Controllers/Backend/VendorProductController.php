<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductStoreReqeust;
use App\Http\Requests\Backend\ProductUpdateRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Subcategory;
use App\Services\ProductService;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    use upload_file;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
{
    $products = Product::where('vendor_id',Auth::user()->vendor->id)->paginate(10); // Or use pagination or a query builder
    return view('vendor.products.index', compact('products'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $brands = Brand::all();
        $categories = Category::all();
        return view('vendor.products.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreReqeust $request)
    {
        $this->productService->storeProduct($request);
        toastr("Data Saved Successfully");
        return to_route('vendor.products.index');
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
        return view('vendor.products.edit',compact('brands','categories','product','subCategories','childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $this->productService->updateProduct($request,$id);
        toastr("Data Saved Successfully");
        return to_route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->destroyProduct($id);
        toastr("Data Saved Successfully");
        return to_route('vendor.products.index');
    }

    public function GetSubCategories($category)  {
        $sub_category = Subcategory::where('category_id', $category)->pluck('name', 'id');
        return response()->json($sub_category);
    }

    function GetChildCategories($sub_category)  {
        $data = ChildCategory::where('sub_category_id',$sub_category)->pluck('name','id');
        return response()->json($data);
    }

    function ProductChangeStatus(Request $request) {
        $product = Product::findOrFail($request->id);
        $product->status = !$request->status;
        $product->save();
        return response()->json(['status'=>'success'],200);
     }

     function ProductReviews(){
        $reviews = ProductReview::where('vendor_id',auth()->user()->id)->paginate(10);
        return view('vendor.reviews',compact('reviews'));
    }
}
