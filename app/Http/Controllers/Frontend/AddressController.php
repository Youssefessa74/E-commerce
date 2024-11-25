<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAddresses = UserAddress::where('user_id', auth()->user()->id)->get();
        return view('frontend.dashboard.sections.address.index', compact('userAddresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.dashboard.sections.address.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = new UserAddress();
        $address->user_id = $request->user_id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->address = $request->address;
        $address->save();

        toastr('Created Successfully!', 'success', 'Success');
         return redirect()->route('address.index');
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
        $userAddress = UserAddress::findOrFail($id);
        return view('frontend.dashboard.sections.address.edit', compact('userAddress'));
    }

    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        toastr('Deleted Successfully!', 'success', 'Success');
        return redirect()->back();
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'phone' => ['required', 'max:200'],
            'country' => ['required', 'max:200'],
            'city' => ['required', 'max:200'],
            'zip' => ['required', 'max:200'],
            'address' => ['required'],
        ]);

        $address = UserAddress::findOrFail($id);
        $address->user_id = $request->user_id;
        $address->name = $request->name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->country = $request->country;
        $address->city = $request->city;
        $address->zip = $request->zip;
        $address->address = $request->address;
        $address->save();

        toastr('Updated Successfully!', 'success', 'Success');

        return redirect()->route('address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
}
