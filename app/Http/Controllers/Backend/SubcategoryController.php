<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SubcategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubcategoryDataTable $subcategoryDataTable)
    {
        return $subcategoryDataTable->render('admin.category.sub_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'status' => ['boolean', 'required'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $sub_category = new Subcategory();
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->status = $request->status;
        $sub_category->category_id = $request->category_id;
        $sub_category->save();
        toastr("Data Saved Successfully");
        return to_route('admin.sub-category.index');
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
        $sub_category = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.category.sub_category.edit',compact('sub_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'unique:subcategories,name,' . $id // Correct way to use unique validation for an update
            ],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $sub_category =  Subcategory::findOrFail($id);
        $sub_category->name = $request->name;
        $sub_category->slug = Str::slug($request->name);
        $sub_category->category_id = $request->category_id;
        $sub_category->save();

        toastr("Data Saved Successfully");
        return to_route('admin.sub-category.index');
    }


    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        // Find the subcategory by ID or fail
        $sub_category = Subcategory::findOrFail($id);
        $child_category = ChildCategory::where('sub_category_id',$sub_category->id)->count();
        if($child_category > 0){
             // Flash an error message if subcategories exist
             toastr()->error('This sub category has child categories. Please delete the child categories first.');
             return redirect()->back(); // Redirect back to the previous page
        }
        // Delete the subcategory
        $sub_category->delete();

        // Optionally use toastr for user feedback
        toastr("Data Deleted Successfully");

        // Redirect back to the index route
        return to_route('admin.sub-category.index');
    }

    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $sub_category = Subcategory::findOrFail($request->id);
        $sub_category->status = !$request->status ;
        $sub_category->save();
        return response(['status' => 'success'],200);

    }
}
