@php
    $productSliderSectionOne = json_decode($product_slider_section_one->value);
    $lastKey = [];
    foreach ($productSliderSectionOne as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }
    if (array_keys($lastKey)[0] == 'category') {
        $category = App\Models\Category::find($lastKey['category']);
        $products = App\Models\Product::where('category_id', $category->id)
            ->withAvg('productReviews', 'rating')
            ->withCount('productReviews')
            ->with(['productReviews', 'category', 'variants.items'])
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $category = App\Models\Subcategory::find($lastKey['sub_category']);
        $products = App\Models\Product::where('sub_category_id', $category->id)
            ->withAvg('productReviews', 'rating')
            ->withCount('productReviews')
            ->with(['productReviews', 'category', 'variants.items'])
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    } else {
        $category = App\Models\ChildCategory::find($lastKey['child_category']);
        $products = App\Models\Product::where('child_category_id', $category->id)
            ->withAvg('productReviews', 'rating')
            ->withCount('productReviews')
            ->with(['productReviews', 'category', 'variants.items'])
            ->orderBy('id', 'DESC')
            ->take(12)
            ->get();
    }

@endphp
<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $category->name }}</h3>
                    <a class="see_btn" href="#">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @foreach ($products as $product)
              <x-product-card :product="$product"/>
            @endforeach
        </div>
    </div>
</section>

