<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomePageSetting;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomePageSettingController extends Controller
{
    function index()
    {
        $categories = Category::where('status', 1)->get();
        $popular_category_settings = HomePageSetting::where('key', 'popular_category_settings')->first();
        $product_slider_section_one = HomePageSetting::where('key', 'product-slider-section-one')->first();
        $product_slider_section_two = HomePageSetting::where('key', 'product-slider-section-two')->first();
        $product_slider_section_three = HomePageSetting::where('key', 'product-slider-section-three')->first();
        return view('admin.home-page-setting.index', compact('categories', 'popular_category_settings', 'product_slider_section_one', 'product_slider_section_two','product_slider_section_three'));
    }

    function GetSubCategory(Request $request)
    {
        $subCategory = Subcategory::where('category_id', $request->category)->get();
        return response(['status' => 'success', 'subCategories' => $subCategory], 200);
    }

    function PopularCategorySection(Request $request)
    {
        $data = [
            [
                'category' => $request->cat_one,
                'sub_category' => $request->sub_cat_one,
                'child_category' => $request->child_cat_one,
            ],
            [
                'category' => $request->cat_two,
                'sub_category' => $request->sub_cat_two,
                'child_category' => $request->child_cat_two,
            ],
            [
                'category' => $request->cat_three,
                'sub_category' => $request->sub_cat_three,
                'child_category' => $request->child_cat_three,
            ],
            [
                'category' => $request->cat_four,
                'sub_category' => $request->sub_cat_four,
                'child_category' => $request->child_cat_four,
            ],
        ];
        HomePageSetting::updateOrCreate(
            ['key' => 'popular_category_settings'],
            ['value' => json_encode($data)],
        );
        toastr('Data Updated Successfully');
        return redirect()->back();
    }

    function ProductSliderSectionOne(Request $request)
    {
        $request->validate(
            [
                'cat_one' => ['required'],

            ],
            [
                'cat_one.required' =>'Category Field is Required',
            ]
        );
        $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];
        HomePageSetting::updateOrCreate(
            ['key' => 'product-slider-section-one'],
            ['value' => json_encode($data)],
        );
        toastr('Data Updated Successfully');
        return redirect()->back();
    }

    function ProductSliderSectionTwo(Request $request)
    {
        $request->validate(
            [
                'cat_one' => ['required'],

            ],
            [
                'cat_one.required' =>'Category Field is Required',
            ]
        );
        $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];
        HomePageSetting::updateOrCreate(
            ['key' => 'product-slider-section-two'],
            ['value' => json_encode($data)],
        );
        toastr('Data Updated Successfully');
        return redirect()->back();
    }

    function ProductSliderSectionThree(Request $request)
    {
        $request->validate(
            [
                'cat_one' => ['required'],
                'cat_two' => ['required']

            ],
            [
                'cat_one.required' =>'Category Field is Required',
                'cat_two.required' =>'Category Field is Required'

            ]
        );
        $data = [
            'category' => $request->cat_one,
            'sub_category' => $request->sub_cat_one,
            'child_category' => $request->child_cat_one,
        ];
        HomePageSetting::updateOrCreate(
            ['key' => 'product-slider-section-three'],
            ['value' => json_encode($data)],
        );
        toastr('Data Updated Successfully');
        return redirect()->back();
    }
}
