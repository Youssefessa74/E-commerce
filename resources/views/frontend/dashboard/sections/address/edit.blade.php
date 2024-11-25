@extends('frontend.dashboard.layout.master')
@section('title')
    {{ Auth::user()->name }} | Address
@endsection
@section('content')
    <!--=============================
                DASHBOARD START
              ==============================-->
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('frontend.dashboard.layout.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fal fa-gift-card"></i>Edit address</h3>
            <div class="wsus__dashboard_add wsus__add_address">
              <form action="{{ route('address.update',$userAddress->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="row">
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>name <b>*</b></label>
                      <input type="text" placeholder="Name" value="{{ $userAddress->name }}" name="name">
                    </div>
                    @if ($errors->has('name'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('name') }}</p>
                    </div>
                    @endif
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>email</label>
                      <input type="email" placeholder="Email" value="{{ $userAddress->email }}" name="email">
                    </div>
                    @if ($errors->has('email'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('email') }}</p>
                    </div>
                    @endif
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>phone <b>*</b></label>
                      <input type="text" placeholder="Phone" value="{{ $userAddress->phone }}" name="phone">
                    </div>
                    @if ($errors->has('phone'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('phone') }}</p>
                    </div>
                    @endif
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>countery <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <select class="select_2" name="country">
                          <option>Country</option>
                          @foreach (config('settings.country_list') as $item)
                          <option @selected($userAddress->country == $item) value="{{ $item }}">{{ $item }}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('country'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('country') }}</p>
                      </div>
                      @endif
                    </div>
                  </div>

                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>city <b>*</b></label>
                      <div class="wsus__topbar_select">
                        <input type="text" placeholder="City" value="{{ $userAddress->city }}" name="city">
                      </div>
                      @if ($errors->has('city'))
                      <div>
                          <p style="color: red;">
                              {{ $errors->first('city') }}</p>
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>zip code <b>*</b></label>
                      <input type="text" placeholder="Zip Code" value="{{ $userAddress->zip }}" name="zip">
                    </div>
                    @if ($errors->has('zip'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('zip') }}</p>
                    </div>
                    @endif
                  </div>
                  <div class="col-xl-6 col-md-6">
                    <div class="wsus__add_address_single">
                      <label>Address <b>*</b></label>
                      <input type="text" placeholder="Address" value="{{ $userAddress->address }}" name="address">
                    </div>
                    @if ($errors->has('address'))
                    <div>
                        <p style="color: red;">
                            {{ $errors->first('address') }}</p>
                    </div>
                    @endif
                  </div>

                  <div class="col-xl-6">
                    <button type="submit" class="common_btn">update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endsection
