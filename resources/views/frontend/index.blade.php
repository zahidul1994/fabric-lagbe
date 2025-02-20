@extends('frontend.layouts.master')
@section('title', 'Fabric Lagbe | Readymade garments factory in Bangladesh')


@push('css')
    <style>
        .mobile_view_carousel {
            display: none;
        }

        h1 {
            font-size: 24px;
        }

        .ready_made {
            font-size: 36px;
        }

        .text-black {
            color: black !important;
        }

        h1 h2 h3 {
            color: black !important;

        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            display: none;


        }

        .slider_st {
            width: 1200px;
            margin: 0 auto;
            margin-bottom: 0px;
            height: 150px !important;
        }

        .s_img {
            top: 50%;
            left: 50%;
            text-align: initial;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            mix-blend-mode: normal;
            width: 100%;
        }

        .sell_card {
            max-width: 18rem;
            color: #e70909;
            font-size: 24px;
        }

        .buy_card {
            max-width: 18rem;
            color: green;
            font-size: 24px;
        }

        .job_card {
            max-width: 18rem;
            color: purple;
            font-size: 24px;
        }

        .work_order_card {
            max-width: 18rem;
            color: #16CCF1;
            font-size: 16px;
        }

        @media only screen and (max-width: 700px) {
            .our_story {
                display: none;
            }

            .span_details {
                display: none;
            }

            .card_height {
                height: 186px;
            }

            .mobile_view_carousel {
                display: flex;
            }

            .web_view_carousel {
                display: none;
            }

            .div_cat {
                width: 50%;
                text-align: left;
                margin: 0;
                padding: 0;

            }

       

            .four-carousel {
                display: block;
                /* show the four-carousel at smaller screen sizes */
            }

            .four-carousel .item {
                width: 85%;
                /* set the width of each item to 25% for the four-carousel */
            }

            p {
                font-size: 14px;
                line-height: 1.0;
                margin-bottom: 0;
                padding-bottom: 0;
            }




        }

        /* @media screen and (max-width: 768px) {
    .responsive-image {
        width: auto; 
        height: 100px;
    }
} */
    



        @media only screen and (max-width:300px) {
            .our_story {
                display: none;
            }

            .span_details {
                display: none;
            }

            .card_height {
                height: 186px;
            }

            .mobile_view_carousel {
                display: flex;
            }

            .web_view_carousel {
                display: none;
            }

            .div_cat {


                width: 50%;
                text-align: left;



            }


            p {
                font-size: 12px;
                line-height: 1.0;

                margin-bottom: 0;
                padding-bottom: 0;
            }
        }

        .testshadow {
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 5px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
            box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.5);
  transition: box-shadow 0.3s ease-in-out;
        }
        .testshadow:hover {
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
}
    </style>
@endpush

@section('content')
{{-- <div class="full-row bg-light p-0">
    
        <div class="row">
            <div class="col-12">
                <div id="slider" class="" style="   width:1200px;margin:0 auto;margin-bottom: 0px;height: 150px !important;">
                    @foreach(sliders() as $slider)
                        <div class="ls-slide" data-ls="duration:5000; transition2d:4; kenburnsscale:1.2;" >
                            <img width="1920" height="100" src="{{asset('uploads/sliders/'.$slider->image)}}" class="ls-l " style="top:50%; left:50%; text-align:initial; font-weight:400; font-style:normal; text-decoration:none; mix-blend-mode:normal; width:100%;" alt="" data-ls="showinfo:1; durationin:2000; easingin:easeOutExpo; scalexin:1.5; scaleyin:1.5; position:fixed;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
</div> --}}



    {{-- new category with search --}}
    <div class="full-row bg-light pt-30 pb-0 ">
        {{-- <div class="container"> --}}
            {{-- <h3 class="font-large text-dark mb-0 ">@lang('website.WHY FABRIC LAGBE ?')</h3> --}}

            <div class="row row-cols-lg-2 row-cols-sm-2 row-cols-2 gy-3 gx-0 g-lg-0">

                <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('products.category', 'fabrics-UzVmS') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/fab.jpeg') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h1><b>Fabrics</b><br>ফ্যাব্রিক </h1>

                                        </span>

                                    </div>
                                    <p>Buy & sell all kind of fabrics form local mills,trades and international market
                                        <!--&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                    </p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('products.category', 'readymade-garments') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/rmg.png') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h1><b>RMG</b><br>তৈরি পোশাক</h1>

                                        </span>

                                    </div>
                                    <p>Order and buy garments form Bangladeshi factories,shops and whole sellers
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--                                                &nbsp;&nbsp;&nbsp;-->
                                        <!--                                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>-->

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('suggestion.search', 'yarn') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/yarn-ball.png') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h1><b>Yarn</b><br> সুতা</h1>

                                        </span>

                                    </div>

                                    <p>Sale & purchase yarn form local spinning mills indentor, trades and
                                        international market
                                        <!--    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('products.category', 'handloom-products-WwGiT') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/handmade.jpeg') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h1><b>HandMade Products</b><br> তাঁতপণ্য</h1>

                                        </span>

                                    </div>

                                    <p>Find the supplier of handmade products from local,
                                        international market
                                        <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a title="" data-placement="top" data-toggle="tooltip"
                            href="{{ route('suggestion.search', 'yarn') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/cotton.png') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h1><b>Fibre</b></h1>

                                        </span>

                                    </div>
                                    <br>
                                    <p>Purchase,import all kind of fibre from vendors and suppliers from local
                                        and international market.

                                    </p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div> --}}
                {{-- <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a title="" data-placement="top" data-toggle="tooltip"
                            href="{{ route('products.category', 'stock-lots-waste-60YLY') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/clothes.png') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h5><b>Stock lot, Waste & Scrap
                                                </b></h5>

                                        </span>

                                    </div>
                                    <p>Sell & buy extra textile & RMG Products,waste and scraped materials

                                    </p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div> --}}
                {{-- <div class="div_cat  col p-2 testshadow">
                    <div class=" p-40 d-flex flex-column text-left ">
                        <a title="" data-placement="top" data-toggle="tooltip"
                            href="{{ route('products.category', 'chemical-h4QeH') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/oil.jpeg') }}" width="50" height="50">
                                    </div>

                                    <div class="col-sm-8">
                                        <span style="color:black">
                                            <h5><b>Chemical & Oil</b></h5>

                                        </span>

                                    </div>
                                    <p>Authentic supplier and buyer of dyeing chemical, food chemicals and other
                                        chemicals</p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div> --}}
                {{-- <div class="div_cat  col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">

                        <a title="" data-placement="top" data-toggle="tooltip"
                            href="{{ route('products.category', 'machines') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/machine.png') }}" width="50"
                                            height="50">
                                    </div>

                                    <div class="col-sm-6">
                                        <span style="color:black">
                                            <h5><b>Machine & Spare Parts</b></h5>
                                        </span>

                                    </div>
                                    <p>Find the global Suppliers of garments,
                                        sizing,warping,dyeing,
                                        washing & printing
                                        machine</p>

                                </div>
                            </div>
                        </a>

                    </div>
                </div> --}}
            </div>
        {{-- </div> --}}
    </div>
    {{-- new category with search --}}




    {{-- rmg and textile services --}}

    {{-- <div class="full-row bg-light pt-30 pb-0"> --}}
        {{-- <div class="container"> --}}
            {{-- <h3 class="font-large text-dark mb-0">@lang('website.WHY FABRIC LAGBE ?')</h3> --}}
            {{-- <h3 class="font-large text-dark mb-0 testshadow"><b> RMG and Textile Products Process and Service</b></h3> --}}
            {{-- <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-2 gy-3 gx-0 g-lg-0">


                <div class="div_cat col p-2 testshadow">


                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('work-order.registration') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/check-list.png') }}" width="70"
                                            height="70">
                                    </div>

                                    <div class="col-sm-8">
                                        <h1><b>Post Order Requirements</b></h1>

                                        </span>
                                    </div>
                                    <p>For order places of RMG products,Weaving looms,Washing plant,Dying Process,Sizing
                                        Process& job work.

                                    </p>
                                </div>
                                <br>
                            </div>
                        </a>
                    </div>
                </div>









                <div class="div_cat col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('job.registration') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/job-search.png') }}" width="70"
                                            height="70">
                                    </div>

                                    <div class="col-sm-8">
                                        <h1><b>Job</b></h1>

                                        </span>
                                    </div>
                                    <p>Find the qualified employee for the factory/office and get the job favorite
                                        industries/company

                                    </p>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>

                <div class="div_cat col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('products.category', 'dyeing-process-vPBHp') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/inkjet.png') }}" width="60"
                                            height="70">
                                    </div>

                                    <div class="col-sm-8">
                                        <h5><b> Dyeing,Printing Process & Washing plant</b></h5>

                                        </span>
                                    </div>
                                    <p>Order Provide & Received of Yarn,
                                        Woven & Knit Fabrics,Dyeing,Printing,
                                        Garments Products,
                                        Finished,Packaging Services
                                    </p>
                                </div>


                            </div>
                        </a>
                    </div>
                </div>

                <div class="div_cat col p-2 testshadow">
                    <div class="p-40 d-flex flex-column text-left ">
                        <a href="{{ route('products.category', 'sizing-HM5Bh') }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ asset('uploads/icons/thread.png') }}" width="50"
                                            height="70">
                                    </div>

                                    <div class="col-sm-8">
                                        <h1><b> Sizing the Yarn</b></h1>

                                        </span>
                                    </div>
                                    <p>For placing order and receiving all kinds of Yarn Sizing Process
                                    </p>
                                </div>

                            </div>
                        </a>
                    </div>
                </div>
            </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}

    {{-- rmg and textile services --}}

<br><br>

    <div class="full-row bg-light pt-0 pb-0">
        {{-- <div class="container"> --}}
            <div class="row">
                <div class="col-12 testshadow">
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <h4 class="font-large text-dark mb-2"> @lang('website.Advertisements')</h4> --}}
                            <h4 class="font-large text-dark mb-2"><b> Advertisement With Us</b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-12 web_view_carousel">
                    <div
                        class="owl-carousel four-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary e-image-bg-light  bg-white short-info p-30">
                        @foreach (advertisements() as $advertisement)
                            <div class="item">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="product type-product">
                                            <div class="product-wrapper">
                                                <div class="product-image">
                                                    <a href="{{ $advertisement->link }}" target="_blank"><img
                                                            src="{{ asset($advertisement->image) }}"
                                                            alt="Advertisement image" width="228" height="227"></a>
                                                </div>
                                                <div class="product-info text-center">
                                                    <h6 class="product-title"><a href="{{ $advertisement->link }}"
                                                            target="_blank">{{ getAddressByBnEn($advertisement) }}</a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 mobile_view_carousel">
                    <div
                        class="owl-carousel auto-single-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary e-image-bg-light e-image-pill bg-white short-info p-30">
                        @foreach (advertisements() as $advertisement)
                            <div class="item">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="product type-product">
                                            <div class="product-wrapper">
                                                <div class="product-image">
                                                    <a href="{{ $advertisement->link }}"><img
                                                            src="{{ asset($advertisement->image) }}"
                                                            alt="Advertisement image" width="228" height="227"></a>
                                                </div>
                                                <div class="product-info text-center">
                                                    <h6 class="product-title"><a
                                                            href="{{ $advertisement->link }}">{{ $advertisement->title }}</a>
                                                    </h6>
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
        {{-- </div> --}}
    </div>

    <div class="full-row bg-light pt-40 pb-0">
        {{-- <div class="container"> --}}
            <div class="row">
                <div class="col-12 testshadow">
                    <div class="d-flex justify-content-between align-items-center mb-10">
                        <div class="d-flex justify-content-between align-items-center ">
                            {{-- <h4 class="font-large text-dark mb-0">@lang('website.Our Products')</h4> --}}
                            <h4 class="font-large text-dark mb-0"> <b>Hot Seller Products</b> </h4>
                            {{-- <span class="font-500 font-fifteen ms-3 span_details">@lang('website.We have Colorful fabric, Yarn , Cotton, Full garments, Textile machinery and Accessories')</span> --}}

                        </div>
                        <a href="{{ route('our-products') }}"
                            class="btn-link higlight-font text-general hover-text-primary transation-this">@lang('website.View All Products')</a>
                    </div>
                </div>
                <div class="col-12 web_view_carousel">
                        <div
                            class="owl-carousel six-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary e-image-bg-light  border border-light bg-white short-info p-30">
                            @foreach (homeCategories() as $homeCategory)
                                <div class="item">
                                    <div class="row row-cols-1">
                                        <div class="col">
                                            <div class="product type-product">
                                                <div class="product-wrapper">
                                                    <div class="product-image">
                                                        <a
                                                            href="{{ route('our-products-by-category', $homeCategory->category->slug) }}"><img
                                                                src="{{ asset('uploads/categories/' . $homeCategory->category->icon) }}"
                                                                alt="Product image"></a>
                                                    </div>
                                                    <div class="product-info text-center">
                                                        <h6 class="product-title"><a
                                                                href="{{ route('our-products-by-category', $homeCategory->category->slug) }}">{{ getNameByBnEn($homeCategory->category) }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
                <div class="col-12 mobile_view_carousel">
                    <div
                        class="owl-carousel two-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary e-image-bg-light e-image-pill border border-light bg-white short-info p-30">
                        @foreach (homeCategories() as $homeCategory)
                            <div class="item">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="product type-product">
                                            <div class="product-wrapper">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('our-products-by-category', $homeCategory->category->slug) }}"><img
                                                            src="{{ asset('uploads/categories/' . $homeCategory->category->icon) }}"
                                                            alt="Product image" width="100" height="100"></a>
                                                </div>
                                                <div class="product-info text-center">
                                                    <h6 class="product-title"><a
                                                            href="{{ route('our-products-by-category', $homeCategory->category->slug) }}">{{ $homeCategory->category->name }}</a>
                                                    </h6>
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
        {{-- </div> --}}
    </div>


    <div class="full-row bg-light pt-30 pb-0" id="clients_says">
        {{-- <div class="container"> --}}
            <h3 class="font-large text-dark mb-0"><b> What our Clients Say</b></h3>
            <div class="col-12 web_view_carousel">
                <div
                    class="owl-carousel two-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary e-image-bg-light  bg-white short-info p-30">

                    <!--<div class="item">-->
                    <!--    <div class="row row-cols-1">-->
                    <!--        <div class="col">-->
                    <!--            <div class="product type-product">-->
                    <!--                <div class="product-wrapper">-->


                    <!--                    <iframe-->
                    <!--                        src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FFabriclagbe%2Fvideos%2F5855949077803286%2F&show_text=false&width=560&t=0"-->
                    <!--                        width="560" height="314" style="border:none;overflow:hidden"-->
                    <!--                        scrolling="no" frameborder="0" allowfullscreen="true"-->
                    <!--                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"-->
                    <!--                        allowFullScreen="true"></iframe>-->
                    <!--                    <div class="product-info text-center">-->
                    <!--                        <h6 class="product-title"><a href="" target="_blank"></a>User Review-->
                    <!--                        </h6>-->
                    <!--                    </div>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->


                    <div class="item">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="product type-product">
                                    <div class="product-wrapper">
                                        <iframe width="560" height="314"
                                            src="https://www.youtube.com/embed/1PSdccUgWX8"
                                            title="customer testimonial of fabric lagbe mobile app at Head office."
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                        <div class="product-info text-center">
                                            <h6 class="product-title"><a href="" target="_blank"></a>User Review
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="item">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="product type-product">
                                    <div class="product-wrapper">
                                        <iframe width="560" height="314"
                                            src="https://www.youtube.com/embed/E-TdIooxhIM"
                                            title="R-Ventures 3.0 এর সেম-ফইনাল পিচি ারফমযান্সে “েবরিক লাগব লমিটেড”"
                                            frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                        <div class="product-info text-center">
                                            <h6 class="product-title"><a href="" target="_blank"></a>User Review
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="item">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="product type-product">
                                    <div class="product-wrapper">
                                        <iframe width="560" height="314"
                                            src="https://www.youtube.com/embed/YHBLOYKmarE"
                                            title="Customer testimonial- Narsingdi" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            allowfullscreen></iframe>
                                        <div class="product-info text-center">
                                            <h6 class="product-title"><a href="" target="_blank"></a>User review
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        {{-- </div> --}}


    </div>






    <div class="full-row bg-light">
        {{-- <div class="container"> --}}
            <div class="row">
                <div class="col-12">
                    <div class="section-head d-flex justify-content-between align-items-center mb-20">
                        {{-- <h2 class="text-dark mb-0">@lang('website.Our Priority Buyers')</h2> --}}
                        <h2 class="text-dark mb-0">Some of Our Partners</h2>
                    </div>
                </div>
                <div class="col-12 web_view_carousel">
                    <div
                        class="owl-carousel six-carousel nav-arrow-middle-show dot-disable px-30 py-20 owl-mx-one border border-light bg-white">
                        @foreach ($priority_buyers as $priority_buyer)
                            <div class="item bg-white">
                                <a href="#"></a><img src="{{ url($priority_buyer->image) }}" alt=""
                                    width="257" height="157" class="responsive-image">
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-12 mobile_view_carousel">
                    <div
                        class="owl-carousel two-carousel nav-arrow-middle-show dot-disable px-30 py-20 owl-mx-one border border-light bg-white">
                        @foreach ($priority_buyers as $priority_buyer)
                            <div class="item bg-white">
                                <a href="#"></a><img src="{{ url($priority_buyer->image) }}" alt=""
                                    width="257" height="157" class="responsive-image">
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        {{-- </div> --}}
    </div>

   
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#content').hide();
        });

        function getContent() {
            $('#content_button').hide();
            $('#content').show();
        }
        $('#content_button_less').on('click', function() {
            showLess();
        })

        function showLess() {
            $('#content_button').show();
            $('#content').hide(null);
        }
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endpush
