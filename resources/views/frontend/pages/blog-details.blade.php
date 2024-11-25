@extends('frontend.layout.master')
@section('title')
    Blog Details
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
                        <h4>blog dtails</h4>
                        <ul>
                            <li><a href="#">blog</a></li>
                            <li><a href="#">blog details</a></li>
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
        BLOGS DETAILS START
    ==============================-->
    <section id="wsus__blog_details">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="wsus__main_blog">
                        <div class="wsus__main_blog_img">
                            <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <p class="wsus__main_blog_header">
                            <span><i class="fas fa-user-tie"></i> by {{ $blog->user->name }}</span>
                            <span><i class="fal fa-calendar-alt"></i>{{ date('d M Y',strtotime($blog->created_at)) }}</span>

                        </p>
                        <div class="wsus__description_area">
                            <h1>{{$blog->title}}</h1>
                           <p>{{ $blog->description }}</p>


                        </div>
                        <div class="wsus__share_blog">
                            <p>share:</p>
                            <ul>
                                <li><a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"><i class="fab fa-facebook-f"></i></a></li>

                                <li><a class="twitter" href="https://twitter.com/share?url={{url()->current()}}&text={{$blog->title}}"><i class="fab fa-twitter"></i></a></li>

                                <li><a class="linkedin" href="https://www.linkedin.com/shareArticle?url={{url()->current()}}&title={{$blog->title}}&summary={{limitText($blog->description, 50)}}"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                        <div class="wsus__related_post">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h5>related post</h5>
                                </div>
                            </div>
                            <div class="row blog_det_slider">
                                @foreach ($moreBlogs as $item)
                                <div class="col-xl-3">
                                    <div class="wsus__single_blog wsus__single_blog_2">
                                        <a class="wsus__blog_img" href="#">
                                            <img src="{{ asset($item->image) }}" alt="blog" class="img-fluid w-100">
                                        </a>
                                        <div class="wsus__blog_text">
                                            <a class="blog_top red" href="#">{{ $item->category->name }}</a>
                                            <div class="wsus__blog_text_center">
                                                <a href="{{ route('blog.details',$item->slug) }}">{{ limitText($item->title,25) }}</a>
                                                <p class="date">{{ date('d M Y',strtotime($blog->created_at)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="wsus__comment_area">
                            <h4>comment <span>{{ count($blogComments) }}</span></h4>
                            @foreach ($blogComments as $comment)
                            <div class="wsus__main_comment">
                                <div class="wsus__comment_img">
                                    <img src="{{ asset($comment->user->image) }}" alt="user" class="img-fluid w-100">
                                </div>
                                <div class="wsus__comment_text replay">
                                    <h6>{{ $comment->user->name }} <span>{{ date('d M Y',strtotime($comment->created_at)) }}</span></h6>
                                    <p>{{ $comment->comment }}</p>

                                    <div class="accordion accordion-flush" id="accordionFlushExample3">
                                        <div class="accordion-item">
                                            <div id="flush-collapsetwo3" class="accordion-collapse collapse"
                                                aria-labelledby="flush-collapsetwo"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form>
                                                        <div class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1"
                                                                placeholder="Your Text"></textarea>
                                                        </div>
                                                        <button type="submit" class="common_btn">submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @if ($blogComments->hasPages())
                            {{ $blogComments->links('frontend.layout.custom-pagination') }}
                            @endif
                        </div>
                        <div class="wsus__post_comment">
                            @if (auth()->check())
                            <h4>post a comment</h4>
                            <form action="{{ route('blog.comment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="wsus__single_com">
                                            <textarea rows="5" name="comment" placeholder="Your Comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="common_btn" type="submit">post comment</button>
                            </form>
                            @else
                            <p>please <a href="{{ route('login') }}">login</a> to can post a comment</p>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        <div class="wsus__blog_search">
                            <h4>search</h4>
                            <form action="{{ route('blogs') }}" method="GET">
                                <input type="text" placeholder="Search" name="search">
                                <button type="submit" class="common_btn"><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="wsus__blog_category">
                            <h4>Categories</h4>
                            <ul>
                                @foreach ($categories as $category)
                                <li><a href="{{ route('blogs',['category'=>$category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="wsus__blog_post">
                            <h4>Recent Blogs</h4>
                            @foreach ($recentBlogs as $blog)
                            <div class="wsus__blog_post_single">
                                <a href="{{ route('blog.details',$blog->slug) }}" class="wsus__blog_post_img">
                                    <img src="{{ asset($blog->image) }}" alt="blog" class="imgofluid w-100">
                                </a>
                                <div class="wsus__blog_post_text">
                                    <a href="{{ route('blog.details',$blog->slug) }}">{{ $blog->title }}</a>
                                    <p> <span>{{ date('d M Y',strtotime($blog->created_at)) }}</span> {{ count($blog->comments) }} Comment </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="wsus__popular_tag">
                            <h4>popular tags</h4>
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Style</a></li>
                                <li><a href="#">Travel</a></li>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Hobbies</a></li>
                                <li><a href="#">Shopping</a></li>
                                <li><a href="#">Photography</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BLOGS DETAILS END
    ==============================-->

@endsection

@push('scripts')
    <!-- Include jQuery UI CSS and JS (add in <head> or before the script) -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $("input[name='search']").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('blog.suggestions') }}",
                    data: { query: request.term },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1 // Minimum characters before showing suggestions
        });
    });
</script>

@endpush
