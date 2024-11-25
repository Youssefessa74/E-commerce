@extends('frontend.layout.master')
@section('title')
    Blogs
@endsection
@section('content')
  <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <h4>our latest blogs</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">blogs</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        BLOGS PAGE START
    ==============================-->
    <section id="wsus__blogs">
        <div class="container">
            @if (request()->has('search'))
            <h5>Results For : {{ request()->search }}</h5>
            @elseif(request()->has('category'))
            <h5>Results For : {{ request()->category }}</h5>
            @endif
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-xl-4 col-sm-6 col-lg-4 col-xxl-3">
                    <div class="wsus__single_blog wsus__single_blog_2">
                        <a class="wsus__blog_img" href="{{ route('blog.details',$blog->slug) }}">
                            <img src="{{asset($blog->image)}}" alt="blog" class="img-fluid w-100">
                        </a>
                        <div class="wsus__blog_text">
                            <a class="blog_top red" href="#">{{ $blog->category->name }}</a>
                            <div class="wsus__blog_text_center">
                                <a href="{{ route('blog.details',$blog->slug) }}">{{ limitText($blog->title,25) }}</a>
                                <p class="date">{{ date('d M Y',strtotime($blog->created_at)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($blogs->hasPages())
            {{ $blogs->links('frontend.layout.custom-pagination') }}
            @endif
        </div>
    </section>
    <!--============================
        BLOGS PAGE END
    ==============================-->

@endsection
