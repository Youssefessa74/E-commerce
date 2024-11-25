
@extends('admin.layout.master')
@section('title')
  Home Page Settings
@endsection
@section('content')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Home Page Settings</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                              <h4>All Settings</h4>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <div class="col-4">
                                  <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Popular Categories</a>
                                    <a class="list-group-item list-group-item-action" id="list-product-slider-section-one-list" data-toggle="list" href="#list-product-slider-section-one" role="tab">Product Slider Section one</a>
                                    <a class="list-group-item list-group-item-action" id="list-product-slider-section-two-list" data-toggle="list" href="#list-product-slider-section-two" role="tab">Product Slider Section two</a>
                                    <a class="list-group-item list-group-item-action" id="list-product-slider-section-three-list" data-toggle="list" href="#list-product-slider-section-three" role="tab">Product Slider Section three</a>

                                  </div>
                                </div>
                                <div class="col-8">
                                  <div class="tab-content" id="nav-tabContent">
                                   @include('admin.home-page-setting.popular-category-section')
                                   @include('admin.home-page-setting.product-slider-section-one')
                                   @include('admin.home-page-setting.product-slider-section-two')
                                   @include('admin.home-page-setting.product-slider-section-three')
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
