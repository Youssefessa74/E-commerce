
<section id="wsus__single_banner" class="wsus__single_banner_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                @if ($homepage_secion_banner_two->banner_one->banner_one_status == 1)
                <div class="wsus__single_banner_content">
                    <a href="{{$homepage_secion_banner_two->banner_one->banner_one_url}}">
                        <img class="img-fluid" src="{{asset($homepage_secion_banner_two->banner_one->banner_one_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
            <div class="col-xl-6 col-lg-6">
                @if ($homepage_secion_banner_two->banner_two->banner_two_status == 1)
                <div class="wsus__single_banner_content">
                    <a href="{{$homepage_secion_banner_two->banner_two->banner_two_url}}">
                        <img class="img-fluid" src="{{asset($homepage_secion_banner_two->banner_two->banner_two_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
