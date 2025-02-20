<div class="col-lg-4 col-md-4 col-sm-6 col-6 mb-2" style="margin-top: 10px; ">
    <div class="product type-product">
        <div class="product-wrapper">
            <div class="product-image">
                <a href="{{route('frontend-product-details',$product->slug)}}" class="woocommerce-LoopProduct-link"><img src="{{url($product->thumbnail_img)}}" alt="Product Image" width="230" height="230"></a>
                <div class="hover-area">
                    <div class="cart-button">
                        <a href="#" class="button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Cart" aria-label="Add to Cart" onclick="addToCart('{{$product->id}}', 0 )">Add to Cart</a>
                    </div>
                    <div class="wishlist-button">
                        <a class="add_to_wishlist" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                    </div>
                    {{-- <div class="compare-button">
                        <a class="compare button" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                    </div> --}}
                </div>
            </div>
            <div class="product-info" style="padding: 10px;">
                <h3 class="product-title"><a href="{{route('frontend-product-details',$product->slug)}}">{{$product->name}}</a></h3>
                <div class="product-price">
                    <div class="price">
                        <ins>
                            @if(currency()->code == 'BDT')
                                {{getNumberWithCurrencyByBnEn($product->unit_price)}}
                            @else
                                {{getNumberWithCurrencyByBnEn($product->unit_price)}}
                            @endif
                            <span style="color: black; ">(Per {{getNameByBnEn($product->unit)}})</span>
                        </ins>

                    </div>
                </div>
                <div class="shipping-feed-back">
                    <div class="star-rating">
                        <div class="rating-wrap">
                            <a href="#"><span> {{ renderStarRating($product->rating) }}</span></a>
                        </div>
                        <div class="rating-counts-wrap">
                            <a href="#">({{$product->rating > 0 ? getNumberToBangla($product->rating) : getNumberToBangla(0)}} of {{getNumberToBangla(5)}})</a>
                        </div>
                    </div>
                    <div class="sold-items">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

