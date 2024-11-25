<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $categoryDataTable)
    {
        return $categoryDataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'icon' => ['required'],
            'status' =>['boolean','required']
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->icon = $request->icon;
        $category->status = $request->status;
        $category->save();
        toastr("Data Saved Successfully");
        return to_route('admin.category.index');
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
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'max:255'],
            'icon' => ['required'],
            'status' => ['boolean','required']
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update the category fields
        $category->name = $request->name;
        $category->slug = Str::slug($request->name); // Generate slug from the name
        $category->icon = $request->icon;
        $category->status = $request->status;

        // Save the updated category
        $category->save();

        toastr("Data Updated Successfully");
        return to_route('admin.category.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check if there are any subcategories
        $sub_category_count = Subcategory::where('category_id', $category->id)->count();

        if ($sub_category_count > 0) {
            // Flash an error message if subcategories exist
            toastr()->error('This category has subcategories. Please delete the subcategories first.');
            return redirect()->back(); // Redirect back to the previous page
        }

        // If no subcategories, proceed to delete the category
        $category->delete();
        toastr()->success('Category Deleted Successfully');

        return to_route('admin.category.index');
    }


    function ChangeStatus(Request $request) {
        $request->validate([
            'status' => ['required','boolean'],
        ]);
        $category = Category::findOrFail($request->id);
        $category->status = !$request->status ;
        $category->save();
        return response(['status' => 'success'],200);

    }

}
