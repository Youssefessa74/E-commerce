<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $childCategoryDataTable)
    {
        return $childCategoryDataTable->render('admin.category.child_category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sub_categories =Subcategory::all();
        return view('admin.category.child_category.create',compact('categories','sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'category_id' => ['required','exists:categories,id'],
            'sub_category_id' => ['required','exists:subcategories,id'],
            'status' => ['required','boolean']
        ]);

        $child_category = new ChildCategory();
        $child_category->name = $request->name;
        $child_category->slug = Str::slug($request->name);
        $child_category->category_id = $request->category_id;
        $child_category->sub_category_id = $request->sub_category_id;
        $child_category->status = $request->status;
        $child_category->save();
        toastr('Data Saved Successfully');
        return to_route('admin.child-category.index');
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
        $categories = Category::all();
        $sub_categories = Subcategory::where('category_id', ChildCategory::findOrFail($id)->category_id)->get(); // Fetch only subcategories of current category
        $child_category = ChildCategory::findOrFail($id);
        return view('admin.category.child_category.edit', compact('child_category', 'sub_categories', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:subcategories,id'],
            'status' => ['required', 'boolean'],
        ]);

        $child_category = ChildCategory::findOrFail($id);
        $child_category->name = $request->name;
        $child_category->slug = Str::slug($request->name);
        $child_category->category_id = $request->category_id;
        $child_category->sub_category_id = $request->sub_category_id;
        $child_category->status = $request->status;
        $child_category->save();

        toastr('Data Updated Successfully');
        return to_route('admin.child-category.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child_category = ChildCategory::findOrFail($id);
        $child_category->delete();
        toastr('Data Updated Successfully');
        return to_route('admin.child-category.index');
    }

    public function GetSubCategories($category)  {
        $sub_category = Subcategory::where('category_id', $category)->pluck('name', 'id');
        return response()->json($sub_category);
    }

    function ChangeStatus(Request $request)  {
        $request->validate([
            'status' => ['required','boolean'],
        ]);

        $child_category = ChildCategory::findOrFail($request->id);
        $child_category->status = !$request->status;
        $child_category->save();
        return response(['status' => 'success'],200);
    }

}
