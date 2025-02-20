@extends('frontend.layouts.master')
@section('title', 'Product Details')

@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/x-zoom/css/xzoom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bid-option.css') }}">
    <style>
        .padding_bottom {
            padding-bottom: 20px;
        }

        .img_size {
            height: 800px;
            width: 900;
        }

        .fp_top {
            margin-top: 20px;
        }

        .border_st {
            border: 1px solid #dddddd;
        }

        .currency_bdt {
            display: {{ currency()->code == 'BDT' ? 'block' : 'none' }}
        }

        .currency_usd {
            display: {{ currency()->code == 'USD' ? 'block' : 'none' }}
        }

        .font_20 {
            font-size: 20px !important;
        }

        .font_14 {
            font-size: 14px !important;
        }

        . {
            margin-top: 30px;
        }

        .m_t_10 {
            margin-top: -10px;
        }

        .m_top_30 {
            margin-top: 30px;
        }

        .text-bold {
            font-weight: bold;
        }

        .rounded-img {
    border-radius: 10px; /* Adjust the radius to control the roundness of corners */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Add a shadow effect */
}
        


        @media (max-width:700px) {
            .xzoom-gallery3 {
                width: 80px;
            }

            
        }


        @media (max-width: 768px) {
    .img_size {
        max-height: 300px; /* Adjust the height as per your requirements */
        width : 350px;
        height: 240px; 
    }
}



        
    </style>
@endpush

@section('content')
    <div class="full-row bg-white">
        <div class="container">
            <div class="padding_bottom">
                <h5 class="d-inline">@lang('website.Category'): <a class="" href="#">
                        {{ allCategoryPrint($detailedProduct) }} </a></h5>
            </div>
            <div class="row single-product-wrapper">
                <div class="col-12 col-md-6 col-lg-7">
                    <div class="xzoom-container">
                        <img class="img-fluid xzoom3 img_size rounded-img" src="{{ url($detailedProduct->thumbnail_img) }}"
                            xoriginal="{{ url($detailedProduct->thumbnail_img) }}" />
                        <div class="xzoom-thumbs">
                            @if (count($photos) > 0)
                                @foreach ($photos as $key2 => $photo)
                                    <a href="{{ url($photo) }}">
                                        <img class="xzoom-gallery3 rounded-img" width="80" height="80" src="{{ url($photo) }}"
                                            @if ($key2 == 0) xpreview="{{ url($photo) }}" @endif
                                            title="">
                                    </a>
                                @endforeach
                            @endif
                        </div>

                    </div>
                   
                    <hr>
                    <div>
                        Product Video
                        <br>
                        @if ($detailedProduct->video)
                            <video width="320" height="240" controls>
                                <source src="{{ url($detailedProduct->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <small class="text-secondary">No video found!</small>
                        @endif
                    </div>
                </div>



                <div class="col-12 col-md-6 col-lg-5">
                    <div class="summary entry-summary">
                        <div class="summary-inner">

                            <h1 class="product_title entry-title">{{ getNameByBnEn($detailedProduct) }}</h1>


                            @if ($detailedProduct->category_id == 9 && $detailedProduct->sizingProduct)
                                {{ sizingProductDetails($detailedProduct) }}
                            @elseif($detailedProduct->category_id == 7 && $detailedProduct->dyingProduct)
                                {{ dyingProductDetails($detailedProduct) }}
                            @else
                                <div>
                                    @lang('website.Quantity'):
                                    <span class="stock-availability in-stock text-success font-500">
                                        <strong class="">{{ getNumberToBangla($detailedProduct->quantity) }}
                                            {{ getNameByBnEn($detailedProduct->unit) }}</strong>
                                    </span>
                                </div>

                                <div class="">
                                    @lang('website.Unit Price'):
                                    <span>
                                        <span class="text-danger text-bold font-500">
                                            @if (currency()->code == 'BDT')
                                                <strong
                                                    class="text-danger">{{ getNumberWithCurrencyByBnEn($detailedProduct->unit_vat_price) }}</strong>
                                            @else
                                                <strong
                                                    class="text-danger">{{ getNumberWithCurrencyByBnEn($detailedProduct->unit_vat_price) }}</strong>
                                            @endif
                                        </span>
                                    </span>
                                </div>
                                <div class="">
                                    @lang('website.Total Price'):
                                    <span>
                                        <span class="text-danger text-bold font-500">
                                            @if (currency()->code == 'BDT')
                                                <strong
                                                    class="text-danger">{{ getNumberWithCurrencyByBnEn($detailedProduct->expected_price) }}</strong>
                                            @else
                                                <strong
                                                    class="text-danger">{{ getNumberWithCurrencyByBnEn($detailedProduct->expected_price) }}</strong>
                                            @endif
                                        </span>
                                    </span>
                                </div>


                            @endif
                            {{-- @if ($detailedProduct->user_type == 'seller')
                                <div class="mt-2">
                                    <button class="btn text-white" style="background: #0084ff"
                                        onclick="addToCart('{{ $detailedProduct->id }}', 0 )"><i
                                            class="fa fa-shopping-cart"></i> Retail purchase</button>
                                   
                                
                                        <span> <button class="btn text-white" style="background: #0084ff"
                                          id="wholesale"><i
                                                class="fa fa-gavel"></i> Wholesale Bid</button>

                                        </span>
                                        
                                    
                                    
                                </div>
                                
                            @endif --}}
                        </div>



                        @if ($detailedProduct->var_price_qty)
                            @php
                                $jsonData = json_decode($detailedProduct->var_price_qty, true);
                                ['var_price' => $var_price, 'var_quantity' => $var_quantity] = $jsonData;
                                
                            @endphp
                            <table class="table table-bordered">

                                <tbody>
                                    <h5>Price according to Quantity</h5>
                                    <tr>

                                        <td>Quantity</td>
                                        @foreach ($var_quantity as $q)
                                            <td>{{ $q }}</td>
                                        @endforeach


                                    </tr>
                                    <tr>

                                        <td>Price</td>
                                        @foreach ($var_price as $p)
                                            <td>{{ $p }}</td>
                                        @endforeach
                                    </tr>

                                </tbody>
                            </table>


                        @endif

                        <h5 class="my-3">Price Validity : <span
                                style="color: black">{{ getDateConvertByBnEn($detailedProduct->price_validity) }}</span>
                        </h5>

                    </div>
                    <div id="bid_options" class="mb-2">
                        <div class="bid-container">
                            <h4 style="margin-top: 20px">@lang('website.Choose a Bid Option')</h4>
                            <div class="plans">
                                <label class="plan basic-plan" for="full_bid">
                                    <input type="radio" name="bid_type" id="full_bid" />
                                    <div class="plan-content">
                                        <img loading="lazy"
                                            src="https://raw.githubusercontent.com/ismailvtl/ismailvtl.github.io/master/images/life-saver-img.svg"
                                            alt="" />
                                        <div class="plan-details">
                                            {{-- <span>@lang('website.Full Bid') <br> সম্পূর্ণ বিড</span> --}}
                                            <span>Wholesale Bid Price<br>পাইকারি মূল্যে বিড</span>
                                            <p>@lang('website.Place bid against full quantity') <br>পাইকারি মূল্যে পণ্য ক্রয়ের জন্য বিড করুন</p>
                                        </div>
                                    </div>
                                </label>

                                <label class="plan complete-plan" for="partial_bid">
                                    <input type="radio" id="partial_bid" name="bid_type" />
                                    <div class="plan-content">
                                        <img loading="lazy"
                                            src="https://raw.githubusercontent.com/ismailvtl/ismailvtl.github.io/master/images/potted-plant-img.svg"
                                            alt="" />
                                        <div class="plan-details">
                                            {{-- <span>@lang('website.Partial Bid') <br>আংশিক বিড </span> --}}
                                            <span>Retail Bid Price  &nbsp &nbsp &nbsp<br>খুচরা মূল্যে বিড &nbsp &nbsp &nbsp &nbsp</span>
                                            <p>@lang('website.Place bid against partial quantity') <br>খুচরা মূল্যে পণ্য ক্রয়ের জন্য বিড করুন</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>


                    </div>
                    <form action="{{ route('product-bid.store') }}" method="POST" class="fp_top">
                        @csrf

                        <input type="hidden" name="product_id" id="product_id" value="{{ $detailedProduct->id }}">
                        <div id="full_bid_form">

                        </div>
                        <div id="partial_bid_form">

                        </div>

                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="staticBackdropLabel">@lang('website.Are you sure?')
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <p>@lang('website.Are you sure you want to Place the following bid?')</p>
                                        </div>
                                        <div>
                                            <p><span class="text-black ">@lang('website.Name'):</span>
                                                {{ getNameByBnEn($detailedProduct->user) }}<br>
                                                <span
                                                    class="text-black ">@lang('website.Total Amount'):</span>{{ getNumberWithCurrencyByBnEn($detailedProduct->expected_price) }}
                                                <br>
                                                <span class="text-black ">@lang('website.Product Name'):</span>
                                                {{ getNameByBnEn($detailedProduct) }}
                                            </p>
                                        </div>
                                        @php
                                            $popUp = \App\Model\PopUp::where('type', 'bid_submit')->first();
                                        @endphp
                                        <div class="currency_bdt">
                                            <div class="font_20">
                                                {!! $popUp->description_bn !!}

                                            </div>
                                            <div class="font_14">
                                                {!! $popUp->description !!}

                                            </div>
                                        </div>
                                        <div class="currency_usd">
                                            <div class="font_20">
                                                {!! $popUp->description !!}

                                            </div>
                                            <div class="font_14">
                                                {!! $popUp->description_bn !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">@lang('website.Close')</button>

                                        <button type="submit" class="btn btn-success">@lang('website.Submit Bid')</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="row m_top_30">
                        @php
                            $reviews = \App\Model\Review::where('receiver_user_id', $detailedProduct->user_id)->get();
                        @endphp
                        <div class="col-12">
                            <div class="section-head border-bottom">
                                <div class="woocommerce-tabs wc-tabs-wrapper ps-0">
                                    <ul class="nav nav-pills wc-tabs" id="pills-tab-one" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active font_20 text-bold" id="pills-description-one-tab"
                                                data-bs-toggle="pill" href="#pills-description-one" role="tab"
                                                aria-controls="pills-description-one"
                                                aria-selected="true">@lang('website.Description')</a>
                                        </li>

                                        <li class="nav-item m_l_20" role="presentation">
                                            <a class="nav-link font_20" id="pills-reviews-one-tab" data-bs-toggle="pill"
                                                href="#pills-reviews-one" role="tab"
                                                aria-controls="pills-reviews-one" aria-selected="true">
                                                @lang('website.Reviews')({{ $reviews->count() }})</a>
                                        </li>
                                        <li>
                                            <div class="woocommerce-product-rating">
                                                <div class="fancy-star-rating">
                                                    <div class="rating-wrap">
                                                        <div class="star-rating star-rating-sm mt-1">
                                                            {{ renderStarRating($detailedProduct->rating) }}
                                                        </div>
                                                    </div>
                                                    <div class="rating-counts-wrap">
                                                        <a href="#reviews" class="bigbazar-rating-review-link"
                                                            rel="nofollow"> <span
                                                                class="rating-counts">({{ $detailedProduct->rating > 0 ? getNumberToBangla($detailedProduct->rating) : getNumberToBangla(0) }}
                                                                of {{ getNumberToBangla(5) }})</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>

                            <div class="woocommerce-tabs wc-tabs-wrapper ps-0 mt-0">
                                <div class="tab-content" id="pills-tabContent-one">
                                    <div class="tab-pane fade show active woocommerce-Tabs-panel woocommerce-Tabs-panel--description"
                                        id="pills-description-one" role="tabpanel"
                                        aria-labelledby="pills-description-one-tab">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                @if ($detailedProduct->category_id == 1)
                                                    <div class="col-lg-12">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>

                                                                    <td scope="col">Fabric greige</td>
                                                                    <td scope="col">Finished width</td>
                                                                    <td scope="col">Composition</td>
                                                                    <td scope="col">Construction</td>
                                                                    <td scope="col">Color name</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ $detailedProduct->fabric_greige }}</td>
                                                                    <td>{{ $detailedProduct->finished_width }}</td>
                                                                    <td>{{ $detailedProduct->composition }}</td>
                                                                    <td>{{ $detailedProduct->construction }}</td>
                                                                    <td>{{ $detailedProduct->color_name }}</td>

                                                                </tr>

                                                            </tbody>


                                                        </table>
                                                    </div>
                                                @endif
                                                <p class="text-justify" style="font-size: 18px;">
                                                    @if (app()->getLocale('locale') == 'en')
                                                        {!! @$detailedProduct->description !!}
                                                    @else
                                                        {!! @$detailedProduct->description_bn !!}
                                                    @endif
                                                </p>
                                            </div>






                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-reviews-one" role="tabpanel"
                                        aria-labelledby="pills-reviews-one-tab">
                                        <div class="row">
                                            <div class="col-8">
                                                <div id="comments">
                                                    <h5 class="woocommerce-Reviews-title my-3">
                                                        ({{ getNumberToBangla($reviews->count()) }}) @lang('website.Reviews')
                                                    </h5>
                                                    <ol class="commentlist">

                                                        @foreach ($reviews as $review)
                                                            <li>
                                                                <div class="comment_container">
                                                                  
                                                                    <div class="comment-text">
                                                                        <div class="star-rating" role="img"
                                                                            aria-label="Rated 5 out of 5">
                                                                            <i class="flaticon-star-1"></i>
                                                                            <i class="flaticon-star-1"></i>
                                                                            <i class="flaticon-star-1"></i>
                                                                            <i class="flaticon-star-1"></i>
                                                                            <i class="flaticon-star-1"></i>
                                                                        </div>
                                                                        <p class="meta">
                                                                            <strong
                                                                                class="woocommerce-review__author">{{ getNameByBnEn($review->sender) }}
                                                                            </strong>
                                                                            <span class="woocommerce-review__dash">–</span>
                                                                            <span
                                                                                class="woocommerce-review__published-date">{{ getDateConvertByBnEn($review->created_at) }}</span>
                                                                        </p>
                                                                        <div class="description m_t_10">
                                                                            <p>{!! $review->comment !!}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>


                    @if ($detailedProduct->user_type == 'seller')
                        <div class="mt-2">
                            {{-- <button title="For Small amount and single products click here" class="btn text-white cartShow" style="background: #0c9e30"
                                        onclick="addToCart('{{ $detailedProduct->id }}', 0 )"><i
                                            class="fa fa-shopping-cart"></i> Retail purchase
                                            
                                        </button> --}}


                            {{-- <span> <button  title="For Bulk amount  click here" class="btn text-white" style="background: #0c9e30"
                                          id="wholesale"><i
                                                class="fa fa-gavel"></i> Wholesale Bid</button>

                                        </span> --}}



                        </div>

                        <div id="full_bid_form">

                        </div>
                    @endif
                    <div class="row no-gutters mt-4">
                        <div class="col-1">
                            <div class="product-description-label mt-2">@lang('website.Share'):</div>
                        </div>
                        <div class="col-11">
                            <div id="share"></div>
                        </div>
                    </div>

                    <div class="bigbazar-wc-message"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="{{ asset('frontend/assets/x-zoom/dist/xzoom.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/x-zoom/setup.js') }}"></script>
    <script>
        $(document).ready(function() {

        });


        //     $('#wholesale').click(function(){
        //         $('#full_bid_form').html(`            <div class="mt-3">
    //                                     <div class="row">
    //                                         <div class="col-3">
    //                                             <h5>@lang('website.Bid Price') (@lang('website.Unit')) (@lang('website.' . currency()->code)):</h5>
    //                                         </div>
    //                                         <input type="hidden" name="bid_type" value="full">
    //                                         <div class="col-md-6 col-9">
    //                                             <div class="form-group d-inline">
    //                                                 <input type="hidden" class="form-control" name="qty" id="qty" value="{{ $detailedProduct->quantity }}">
    //                                                 <input type="number" class="form-control border_st" name="bid_price" id="bid_price" min="0" step="0.00001" placeholder="({{ currency_symbol() }}) @lang('website.Enter Your Bid Amount by Unit Price')" onkeyup="get_bid_price(this)" required>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                     <div class="row">
    //                                         <div class="col-3">
    //                                             <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currency()->code)):</h5>
    //                                         </div>
    //                                         <div class="col-md-6 col-9">
    //                                             <div class="form-group d-inline">
    //                                                 <input type="number" class="form-control bg-gray-light" name="" id="bid_total_price" min="0" step="0.00001" placeholder="0" readonly required>
    //                                             </div>
    //                                         </div>
    //                                     </div>

    //                                     <div class="row">
    //                                         <div class="col-3">
    //                                             <h5>@lang('website.Bid Price') (@lang('website.Unit')) (@lang('website.' . currencyAlt())):</h5>
    //                                         </div>
    //                                         <div class="col-md-6 col-9">
    //                                             <div class="form-group d-inline">
    //                                                 <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_unit_price" min="0" step="0.00001" placeholder="0" readonly required>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                     <div class="row">
    //                                         <div class="col-3">
    //                                             <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currencyAlt())):</h5>
    //                                         </div>
    //                                         <div class="col-md-6 col-9">
    //                                             <div class="form-group d-inline">
    //                                                 <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_total_price" min="0" step="0.00001" placeholder="0" readonly required>
    //                                             </div>
    //                                         </div>
    //                                     </div>
    //                                     <div class="row">
    //                                         <div class="col-3">&nbsp;</div>
    //                                         <div class="col-6">
    //                                             <div class="form-group d-inline pb-2 mb-2">
    //                                                 <div>&nbsp;</div>
    //                                                 <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="get_bidPrice()" data-bs-target="#staticBackdrop">
    //                                                     @lang('website.Bid for Trade')
    //                 </button>
    //             </div>
    //         </div>
    //     </div>
    // </div>`);
        //     })

        $(function() {
            $("input[name='bid_type']").click(function() {
                if ($("#full_bid").is(":checked")) {
                    $('#partial_bid_form').html('');
                    $('#full_bid_form').html(`            <div class="mt-3">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Unit')) (@lang('website.' . currency()->code)):</h5>
                                            </div>
                                            <input type="hidden" name="bid_type" value="full">
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="hidden" class="form-control" name="qty" id="qty" value="{{ $detailedProduct->quantity }}">
                                                    <input type="number" class="form-control border_st" name="bid_price" id="bid_price" min="0" step="0.00001" placeholder="({{ currency_symbol() }}) @lang('website.Enter Your Bid Amount by Unit Price')" onkeyup="get_bid_price_full_bid(this)" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currency()->code)):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="" id="bid_total_price" min="0" step="0.00001" placeholder="0" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Unit')) (@lang('website.' . currencyAlt())):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_unit_price" min="0" step="0.00001" placeholder="0" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currencyAlt())):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_total_price" min="0" step="0.00001" placeholder="0" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">&nbsp;</div>
                                            <div class="col-6">
                                                <div class="form-group d-inline pb-2 mb-2">
                                                    <div>&nbsp;</div>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="get_bidPrice()" data-bs-target="#staticBackdrop">
                                                        @lang('website.Bid for Trade')
                    </button>
                </div>
            </div>
        </div>
    </div>`);
                }
                if ($("#partial_bid").is(":checked")) {
                    $('#full_bid_form').html('');
                    $('#partial_bid_form').html(`            <div class="mt-3">
                                        <div class="row mb-2">
                                            <div class="col-3">
                                                <h5>@lang('website.Quantity'):</h5>
                                            </div>
                                               <input type="hidden" name="bid_type" value="partial">
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control border_st" name="qty" max="{{ $detailedProduct->quantity }}" id="qty" placeholder="@lang('website.Enter your Quantity')" onkeyup="get_bid_price(this)">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currency()->code)):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="bid_price" id="partial_bid_total_price" min="0" step="0.00001" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Unit')) (@lang('website.' . currencyAlt())):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_unit_price" min="0" step="0.00001" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>@lang('website.Bid Price') (@lang('website.Total')) (@lang('website.' . currencyAlt())):</h5>
                                            </div>
                                            <div class="col-md-6 col-9">
                                                <div class="form-group d-inline">
                                                    <input type="number" class="form-control bg-gray-light" name="" id="bid_convert_total_price" min="0" step="0.00001" placeholder="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">&nbsp;</div>
                                            <div class="col-6">
                                                <div class="form-group d-inline pb-2 mb-2">
                                                    <div>&nbsp;</div>
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" onclick="get_bidPrice()" data-bs-target="#staticBackdrop">
                                                        @lang('website.Bid for Trade')
                    </button>
                </div>
            </div>
        </div>
    </div>`);
                }
            });
        });

        function get_bidPrice() {
            var bid_price = $('#bid_price').val();
            $('#bidPrice').val(bid_price);
        }

        function get_bid_price(el) {
            // for variable price
            let variablePriceQtyData = JSON.parse(@json($detailedProduct->var_price_qty))

            // if (variablePriceQtyData) {
            //     console.log(variablePriceQtyData)
            //     var qty = el.value;

            //     const {
            //         var_price,
            //         var_quantity
            //     } = variablePriceQtyData
            //     // Find the range that the input falls into
            //     let rangeIndex = -1;
            //     for (let i = 0; i < var_quantity.length; i++) {
            //         if (+qty <= var_quantity[i]) {
            //             rangeIndex = i;
            //             break;
            //         }
            //     }

            //     // If the input is higher than all quantities, use the last price
            //     if (rangeIndex === -1) {
            //         rangeIndex = var_quantity.length - 1;
            //     }

            //     var bid_price = var_price[rangeIndex];
            //     // const total = qty * var_quantity[rangeIndex];


            // }

            // for variable price ends
            // else {
                var bid_price = el.value;
                var qty = $('#qty').val();
                var unit_price = "{{$detailedProduct->unit_vat_price}}"
            // }

            console.log(qty)
            console.log(unit_price)
            $.post('{{ route('bid.price.convert') }}', {
                    _token: '{{ csrf_token() }}',
                    bid_price: bid_price,
                    qty: qty,
                    unit_price : unit_price
                },
                function(data) {
                    $('#bid_total_price').val(data.bid_total_price);
                    $('#partial_bid_total_price').val(data.partial_bid_total_price);
                    $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                    $('#bid_convert_total_price').val(data.bid_convert_total_price);
                });
        }

        //     if ($('.cart-view').has('.cart-popup')) {
        //     $('.has-cart-data').on('click', function(e) {
        //         e.preventDefault();
        //         if ($(this).parent('.cart-view').hasClass('show')) {
        //             $(this).parent('.cart-view').removeClass('show');
        //         } else {
        //             $(this).parent('.cart-view').addClass('show');
        //         }
        //         e.stopPropagation();
        //     });
        //     $(document).on('click', function(e) {
        //         var container = $('.cart-popup');
        //         if (!container.is(e.target) && container.has(e.target).length === 0) {
        //             if ($('.cart-view').hasClass('show')) {
        //                 $('.cart-view').removeClass('show');
        //             }
        //         }
        //     });
        // }
        function get_bid_price_full_bid(el) {


            var bid_price = el.value;
            var qty = $('#qty').val();



            $.post('{{ route('bid.price.convert') }}', {
                    _token: '{{ csrf_token() }}',
                    bid_price: bid_price,
                    qty: qty
                },
                function(data) {
                    $('#bid_total_price').val(data.bid_total_price);
                    $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                    $('#bid_convert_total_price').val(data.bid_convert_total_price);
                });
        }
    </script>
@endpush
