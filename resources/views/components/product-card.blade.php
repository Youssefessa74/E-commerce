<div class="col-xl-3 col-sm-6 col-lg-4 {{ @$key }}">
    <div class="wsus__product_item">
        <span class="wsus__new">{{ getProductType($product->product_type) }}</span>
        @if (checkDiscount($product))
            <span class="wsus__minus">-
                {{ discountPercentage($product->price, $product->offer_price) }}%</span>
        @else
        @endif
        <a class="wsus__pro_link" href="{{ route('show.product.details', $product->slug) }}">
            <img src="{{ asset($product->thumb_image) }}" alt="product"
                class="img-fluid w-100 img_1" />
            <img src="
        @if (isset($product->gallery[0]->image)) {{ $product->gallery[0]->image }}
          @else
          {{ $product->thumb_image }} @endif
        "
                alt="product" class="img-fluid w-100 img_2" />
        </a>
        <ul class="wsus__single_pro_icon">
            <li><a  class="show_modal" data-productID="{{ $product->id }}" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="far fa-eye"></i></a>
            </li>
            @auth
                <li><a class="add_to_wishlist" data-id="{{ $product->id }}"><i
                            class="far fa-heart"></i></a></li>
            @endauth
            <li><a href="#"><i class="far fa-random"></i></a>
        </ul>

        <div class="wsus__product_details">
            <a class="wsus__category" href="#">{{ $product->category->name }}</a>

            <p class="wsus__pro_rating">
                @for ($i = 0; $i <= 5; $i++)
                @if ($i <= $product->reviews_avg_rating)
                <i class="fas fa-star"></i>
                @else
                <i class="far fa-star"></i>
                @endif
                @endfor
                <span>({{$product->product_reviews_count }} review)</span>
            </p>
            <a class="wsus__pro_name" href="#">{{ limitText($product->name,52) }}</a>
            @if (checkDiscount($product))
                <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->offer_price }}
                    <del>{{ $settings->currency_icon }}{{ $product->price }}</del>
                </p>
            @else
                <p class="wsus__price">{{ $settings->currency_icon }}{{ $product->price }}</del></p>
            @endif
            <form class="shopping_cart_form">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input name="qty" type="hidden" value="1" min="1">
                @foreach ($product->variants as $variant)
                    <select class="d-none" name="variants_items[]">
                        <option selected disabled>Choose</option>
                        @foreach ($variant->items as $item)
                            <option @selected($item->is_default == 1) value="{{ $item->id }}">
                                {{ $item->name }} $({{ $item->price }})
                            </option>
                        @endforeach
                    </select>
                @endforeach
                <button type="submit" class="add_cart">add to cart</button>
            </form>
        </div>
    </div>
</div>
