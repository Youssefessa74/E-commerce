<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    use upload_file;
    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $brandDataTable)
    {
        return $brandDataTable->render('admin.brands.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['image','max:1000','required'],
            'name' => ['required','max:255'],
            'is_featured' => ['required','boolean'],
            'status' => ['required','boolean']
        ]);
        $brand = new Brand();
         $logo = $this->uploadFile($request,'logo');
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->logo = $logo;
        $brand->save();

        toastr('Data Saved Successfully');
        return to_route('admin.brands.index');

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
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'logo' => ['image', 'max:1000', 'nullable'], // Make logo optional
            'name' => ['required', 'max:255'],
            'is_featured' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ]);

        // Find the existing Brand by ID
        $brand = Brand::findOrFail($id);
        $logo = $this->uploadFile($request,'logo',$brand->logo);

        // Update fields
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->is_featured = $request->is_featured;
        $brand->status = $request->status;
        $brand->logo = isset($logo) ? $logo : $brand->logo;
        $brand->save();

        toastr('Data Updated Successfully');
        return to_route('admin.brands.index');
    }


    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $sub_category = Brand::findOrFail($request->id);
        $sub_category->status = !$request->status ;
        $sub_category->save();
        return response(['status' => 'success'],200);

    }
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $this->removeFile($brand->logo);
        $product = Product::where('brand_id',$brand->id)->get();
        if($product->count() > 0){
            toastr('You Can not Delete This brand unless you deleted the products that belongs to it','error');
            return to_route('admin.brands.index');
        }
        $brand->delete();
        toastr('Data Updated Successfully');
        return to_route('admin.brands.index');
    }
}
