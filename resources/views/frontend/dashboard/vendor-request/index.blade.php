@extends('frontend.dashboard.layout.master')
@section('title')
    {{ Auth::user()->name }} | Orders
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
                        <h3><i class="far fa-user"></i> Vendor Request</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                {!! @$content->content !!}
                            </div>
                        </div>
                        <br>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <form action="{{ route('vendor.request.create') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="file" name="shop_image" placeholder="Shop Banner Image">
                                    </div>
                                    @if ($errors->has('shop_image'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('shop_image') }}</p>
                                        </div>
                                    @endif

                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_name" placeholder="Shop Name">
                                    </div>
                                    @if ($errors->has('shop_name'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('shop_name') }}</p>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="text" name="shop_email" placeholder="Shop Email">
                                            </div>
                                            @if ($errors->has('shop_email'))
                                                <div>
                                                    <p style="color: red;">{{ $errors->first('shop_email') }}</p>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-user-tie" aria-hidden="true"></i>
                                                <input type="text" name="shop_phone" placeholder="Shop Phone">
                                            </div>
                                        </div>
                                        @if ($errors->has('shop_phone'))
                                            <div>
                                                <p style="color: red;">{{ $errors->first('shop_phone') }}</p>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="wsus__dash_pro_single">
                                        <i class="fas fa-user-tie" aria-hidden="true"></i>
                                        <input type="text" name="shop_address" placeholder="Shop Address">
                                    </div>
                                    @if ($errors->has('shop_address'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('shop_address') }}</p>
                                        </div>
                                    @endif


                                    <div class="wsus__dash_pro_single">
                                        <textarea name="about" placeholder="About You"></textarea>
                                    </div>
                                    @if ($errors->has('about'))
                                        <div>
                                            <p style="color: red;">{{ $errors->first('about') }}</p>
                                        </div>
                                    @endif

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=============================
                        DASHBOARD END
                    ==============================-->
@endsection

@push('scripts')
@endpush
