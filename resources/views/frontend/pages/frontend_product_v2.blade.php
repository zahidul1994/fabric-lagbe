@extends('frontend.layouts.master')
@section('title', 'Frontend Product')
@push('css')
{{--    <link rel="stylesheet" href="{{asset('frontend/assets/css/category/cosmetic-store.css')}}">--}}
    <style>
        .row_st{
            margin-top: -30px;
        }
        .slider_st{
            width:1200px; margin:0 auto;margin-bottom: 0px; height: 200px !important;
        }
        .s_img{
            top:50%;
            left:50%;
            text-align:initial;
            font-weight:400;
            font-style:normal;
            text-decoration:none;
            mix-blend-mode:normal;
            width:100%;
        }
        .p_row{
            padding: 30px 0;
        }
        .p_component{
            min-height: 358px!important;
        }
    </style>
@endpush
@section('content')
    <!-- breadcrumb -->
    <div class="full-row " style="background-color: white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-3">
                </div>
                <div class="col-lg-12">
                    <div class="full-row bg-light p-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div id="slider" style=" width:1200px; margin:0 auto;margin-bottom: 0px; height: 200px !important;">
                                        <!-- Slide 1-->
                                        @foreach(sliders() as $slider)
                                            <div class="ls-slide" data-ls="duration:5000; transition2d:4; kenburnsscale:1.2;">
                                                <img width="1920" height="1080" src="{{asset('uploads/sliders/'.$slider->image)}}" class="ls-l" style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; mix-blend-mode:normal; width:100%;" alt="" data-ls="showinfo:1; durationin:2000; easingin:easeOutExpo; scalexin:1.5; scaleyin:1.5; position:fixed;">
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="full-row" style="background-color: white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-head d-flex justify-content-between align-items-center pb-20">
                        <h3 class="font-700 text-secondary mb-0 down-line">Hot Products</h3>
                        <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                            <ul class="nav nav-pills wc-tabs" id="pills-tab-three" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active"   href="{{url('products')}}" >All Products</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="woocommerce-tabs wc-tabs-wrapper mt-0">
                    <div class="tab-content" id="pills-tabContent-three">
                        <div class="tab-pane fade show active woocommerce-Tabs-panel woocommerce-Tabs-panel--description" id="pills-makeup-one" role="tabpanel" aria-labelledby="pills-makeup-one-tab">
                            <div class="row g-3 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 e-image-bg-light e-hover-image-zoom e-btn-set-four cart-slide-left">
                                @foreach($featuredProducts as $product)
                                    <div class="col">
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
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="{{route('frontend-product-details',$product->slug)}}">{{$product->name}}</a></h3>
                                                    <div class="product-price">
                                                        <div class="price">
                                                            <ins>
                                                                @if(currency()->code == 'BDT')
                                                                    {{getNumberWithCurrencyByBnEn($product->unit_vat_price)}}
                                                                @else
                                                                    {{getNumberWithCurrencyByBnEn($product->unit_vat_price)}}
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
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="full-row" style="background-color: white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-head d-flex justify-content-between align-items-center pb-20">
                        <h3 class="font-700 text-secondary mb-0 down-line">Recent Products</h3>
                        <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                            <ul class="nav nav-pills wc-tabs" id="pills-tab-three" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active"   href="{{url('products')}}" >All Products</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="woocommerce-tabs wc-tabs-wrapper mt-0">
                    <div class="tab-content" id="pills-tabContent-three">
                        <div class="tab-pane fade show active woocommerce-Tabs-panel woocommerce-Tabs-panel--description" id="pills-makeup-one" role="tabpanel" aria-labelledby="pills-makeup-one-tab">
                            <div class="row g-3 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 e-image-bg-light e-hover-image-zoom e-btn-set-four cart-slide-left">
                                @foreach($recentProducts as $product)
                                    <div class="col">
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
                                                <div class="product-info">
                                                    <h3 class="product-title"><a href="{{route('frontend-product-details',$product->slug)}}">{{$product->name}}</a></h3>
                                                    <div class="product-price">
                                                        <div class="price">
                                                            <ins>
                                                                @if(currency()->code == 'BDT')
                                                                    {{getNumberWithCurrencyByBnEn($product->unit_vat_price)}}
                                                                @else
                                                                    {{getNumberWithCurrencyByBnEn($product->unit_vat_price)}}
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
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush

