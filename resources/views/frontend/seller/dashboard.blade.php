@extends('frontend.layouts.master')
@section('title', 'Seller Dashboard')
@push('css')
@endpush
@section('content')
    <div class="full-row" style="margin-top: -30px;">
        <div class="container">
            <div class="row">
                @include('frontend.seller.seller_breadcrumb')
                @include('frontend.seller.seller_sidebar')
                <div class="col-lg-9 col-sm-9">
                    <div class="row">
                        <div class="col-12">
                            <div id="slider" style="width:1200px; margin:0 auto;margin-bottom: 0px;">
                                <!-- Slide 1-->
                                @foreach(sliders() as $slider)
                                    <div class="ls-slide" data-ls="duration:5000; transition2d:4; kenburnsscale:1.2;">
                                        <img width="1920" height="1080" src="{{asset('uploads/sliders/'.$slider->image)}}" class="ls-l" alt="" style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; mix-blend-mode:normal; width:100%;" data-ls="showinfo:1; durationin:2000; easingin:easeOutExpo; scalexin:1.5; scaleyin:1.5; position:fixed;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if($featured_products->count() > 0)
                    <div class="full-row" style="background-color: white; padding: 20px 0;">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-head d-flex justify-content-between align-items-center pb-20">
                                        <h4 class="font-700 text-secondary mb-0 down-line">@lang('website.Buyer Requested Featured') <span style="color: #609B35">@lang('website.Products')</span></h3>
                                        <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                                            <ul class="nav nav-pills wc-tabs" id="pills-tab-three" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pills-makeup-one-tab" data-bs-toggle="pill" href="#pills-makeup-one" role="tab" aria-controls="pills-makeup-one" aria-selected="true">@lang('website.View All')</a>
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
                    {{-- <div class="row" style="padding: 30px 0;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bg-white border-light border-start">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="section-head d-flex align-items-center p-20 border border-light border-start-0">
                                                    <h4 class="font-500 text-dark mb-0 mr-auto">@lang('website.Buyer Requested Featured') <span style="color: #609B35">@lang('website.Products')</span></h4>
                                                    <a href="{{route('seller.view-all-featured-product')}}" class="btn-link higlight-font transation-this">@lang('website.View All')</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="row g-3 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 e-image-bg-light e-hover-image-zoom e-btn-set-four cart-slide-left">
                                        {{-- <div class="row e-bg-white e-hover-shadow-one e-border-one" style="min-height: 358px!important;"> --}}
                                            @if($featured_products)
                                                @foreach($featured_products as $product)
                                                    {{productsComponent($product)}}
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($products->count() > 0)
                    {{-- <div class="row" style="padding: 30px 0;">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="bg-white border-light border-start">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="section-head d-flex align-items-center p-20 border border-light border-start-0">
                                                    <h4 class="font-500 text-dark mb-0 mr-auto">@lang('website.Buyer Requested Recent') <span style="color: #609B35">@lang('website.Products')</span></h4>
                                                    <a href="{{route('seller.view-all-recent-product')}}" class="btn-link higlight-font transation-this">@lang('website.View All')</a>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="full-row" style="background-color: white; padding: 20px 0;">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="section-head d-flex justify-content-between align-items-center pb-20">
                                                            <h4 class="font-700 text-secondary mb-0 down-line">@lang('website.Buyer Requested Recent')</h3>
                                                            <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                                                                <ul class="nav nav-pills wc-tabs" id="pills-tab-three" role="tablist">
                                                                    <li class="nav-item" role="presentation">
                                                                        <a class="nav-link active" id="pills-makeup-one-tab" data-bs-toggle="pill" href="#pills-makeup-one" role="tab" aria-controls="pills-makeup-one" aria-selected="true">@lang('website.View All')</a>
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
                                        {{-- <div class="row e-bg-white e-hover-shadow-one e-border-one" style="min-height: 358px!important;"> --}}
                                            @if($products)
                                                @foreach($products as $product)
                                                    {{productsComponent($product)}}
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

@endpush

