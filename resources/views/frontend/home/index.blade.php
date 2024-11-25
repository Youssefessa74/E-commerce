@extends('frontend.layout.master')
@section('title')
Home Page
@endsection
@section('content')



    <!--============================
        BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner_part_2')
    <!--============================
        BANNER PART 2 END
    ==============================-->


    <!--============================
        FLASH SELL START
    ==============================-->
    @include('frontend.home.sections.flash_sale')
    <!--============================
        FLASH SELL END
    ==============================-->


    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    @include('frontend.home.sections.monthly_top_product')
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    @include('frontend.home.sections.brand_slider')
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    @include('frontend.home.sections.single_banner')
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    @include('frontend.home.sections.hot_deals')
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.electronic_part_1')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    @include('frontend.home.sections.electronic_part_2')
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
    @include('frontend.home.sections.large_banner')
    <!--============================
        LARGE BANNER  END
    ==============================-->


    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    {{-- @include('frontend.home.sections.weekly_best_item') --}}
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->


    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.home_services')
    <!--============================
        HOME SERVICES END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.home_blogs')
    <!--============================
        HOME BLOGS END
    ==============================-->


@endsection
