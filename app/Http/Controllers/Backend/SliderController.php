<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SliderStoreRequest;
use App\Http\Requests\Backend\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\upload_file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    use upload_file;
    public function index(SliderDataTable $sliderDataTable)
    {
        return $sliderDataTable->render('admin.sliders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreRequest $request)
    {
        $image = $this->uploadFile($request,'image');
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->type = $request->type;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->status = $request->status;
        $slider->image = $image;
        $slider->serial = $request->serial;
        $slider->save();
        Cache::forget('sliders');
        toastr('Data Saved Successfully','success');
        return to_route('admin.sliders.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id)
    {
        $slider = Slider::findOrFail($id);
        $image = $this->uploadFile($request,'image',$slider->image);
        $slider->title = $request->title;
        $slider->type = $request->type;
        $slider->starting_price = $request->starting_price;
        $slider->button_url = $request->button_url;
        $slider->status = $request->status;
        $slider->image = isset($image) ? $image : $slider->image;
        $slider->serial = $request->serial;
        $slider->save();

        toastr('Data Saved Successfully','success');
        return to_route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $this->removeFile($slider);
        $slider->delete();
        toastr('Data Saved Successfully','success');
        return to_route('admin.sliders.index');
    }
}
