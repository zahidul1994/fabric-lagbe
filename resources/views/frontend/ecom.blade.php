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

        .imgfooter {
            width: 100%;
            height: auto;
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

            .six-carousel {
                display: none;
                /* hide the six-carousel at smaller screen sizes */
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


        @media only screen and (max-width:300px) {
            .our_story {
                display: none;
            }

            .span_details {
                display: none;
            }

            /* .card_height {
                        height: 186px;
                    } */

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


        .flex-item {
            width: 20%;
            padding: 10px;
        }

        .carousel-item img {
            height: 750px;
            /* set the desired height */
            object-fit: fill;
            /* scale the image while preserving aspect ratio */
            width: 100%;
            /* set the width to fill the container */
            max-width: 100%;
            /* set the maximum width to the container's width */
        }

        .responsive {
            width: 50px;
            height: auto;
            margin: 20px 20px;

        }

        .signInButton {

            background-color: #498f4c;
            border: none;
            color: black;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 20px 20px;
            cursor: pointer;
            border-radius: 16px;
        }


        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .buttonss {
            display: inline-block;
            margin: 4px 2px;
            background-color: #ffffff;
            font-size: 14px;
            padding-left: 32px;
            padding-right: 32px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            color: rgb(0, 0, 0);
            text-decoration: none;
            cursor: pointer;
            -moz-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .button:hover {
            transition-duration: 0.4s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
            background-color: white;
            color: black;
        }

        .search-container {
            position: relative;
            display: inline-block;
            margin: 4px 2px;
            height: 50px;
            width: 50px;
            vertical-align: bottom;
        }

        .mglass {
            display: inline-block;
            pointer-events: none;
            -webkit-transform: rotate(-45deg) scale(2.5);
            -moz-transform: rotate(-45deg) scale(2.5);
            -o-transform: rotate(-45deg) scale(2.5);
            -ms-transform: rotate(-45deg) scale(2.5);
            margin: 0px 10px;
        }

        .searchbutton {
            position: absolute;
            font-size: 25px;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .search:focus+.searchbutton {
            transition-duration: 0.6s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
            background-color: rgb(255, 255, 255);
            color: black;

        }

        .search {
            position: absolute;
            right: 49px;
            /* Button width-1px (Not 50px/100% because that will sometimes show a 1px line between the search box and button) */
            background-color: rgb(182, 177, 177);
            border-radius: 25px;
            outline: none;
            border: 1px;
            padding: 0;
            width: 0;
            height: 100%;
            z-index: 10;
            transition-duration: 0.4s;
            -moz-transition-duration: 0.4s;
            -webkit-transition-duration: 0.4s;
            -o-transition-duration: 0.4s;
        }

        .search:focus {
            width: 363px;
            /* Bar width+1px */
            padding: 0 16px 0 0;
        }

        .expandright {
            left: auto;
            right: 49px;
            /* Button width-1px */
        }

        .expandright:focus {
            padding: 0 0 0 16px;
        }

        .testshadow {
            /* box-shadow: rgba(0, 0, 0, 0.4) 0px 5px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset; */
            box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.5);
            transition: box-shadow 0.3s ease-in-out;
            width: 300px;
            height: 100px;
        }

        .testshadow:hover {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        }

        .div_cat {
            width: 50%;
            text-align: left;
            margin: 0;
            padding: 0;

        }

        p {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
            display: none;


        }


        /* card for news */

        .card-container {
            display: flex;
            justify-content: space-between;
            max-width: 1400px;
            margin: 20px auto;
        }

        .card {
            width: 350px;
            /* Increased the width to 250 pixels */
            border: 1px solid #ccc;
            border-radius: 28px !important;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

   

        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .card-content {
            padding: 10px;
        }

        .card-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        /* cards for news ends */


        /* products style */
        .productCard {
    display: flex;
    align-items: center;
    padding: 20px;
    border-radius: 20px; /* Increased card border radius */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s, box-shadow 0.3s;
}

.productCard:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
}

.productCard-image {
    width: 80px; /* Increased image size */
    height: 80px; /* Increased image size */
    border-radius: 10px; /* Increased image border radius */
    margin-right: 20px;
}

.productCard-title {
    margin: 0;
    font-size: 1.5rem;
}

  
        /* products style ends  */
 
        /* map and image style starts */
        .mapimage
        {
           
            border: 1px solid #ccc;
            border-radius: 28px !important;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }
        /* map and image style ends */
    </style>
@endpush

@section('content')









    <div class="container text-center">
        <h1>Products</h1>
    </div>



    {{-- products starts --}}
  



    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('products.category', 'fabrics-UzVmS') }}" class="productCard"> <!-- Add href link here -->
                    <img src="{{ asset('uploads/icons/fab.jpeg') }}" alt="Product 1" class="productCard-image">
                    <h1 class="productCard-title">Fabric</h1>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('products.category', 'handloom-products-WwGiT') }}" class="productCard"> <!-- Add href link here -->
                    <img src="{{ asset('uploads/icons/handmade.jpeg') }}" alt="Product 2" class="productCard-image">
                    <h1 class="productCard-title">Handmade</h1>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('suggestion.search', 'yarn') }}" class="productCard"> <!-- Add href link here -->
                    <img src="{{ asset('uploads/icons/yarn-ball.png') }}" alt="Product 3" class="productCard-image">
                    <h1 class="productCard-title">Yarn</h1>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('products.category', 'readymade-garments') }}" class="productCard"> <!-- Add href link here -->
                    <img src="{{ asset('uploads/icons/rmg.png') }}" alt="Product 4" class="productCard-image">
                    <h1 class="productCard-title">RMG</h1>
                </a>
            </div>
        </div>
    </div>

    {{-- products ends --}}

    






    <div class="full-row bg-light pt-0 pb-0">
        {{-- <div class="container"> --}}
        <div class="row">
            <div class="col-12 ">


                {{-- <h4 class="font-large text-dark mb-2"> @lang('website.Advertisements')</h4> --}}
                <div class="container text-center">
                    <h1>Advertise with us</h1>
                </div>

            </div>
        </div>
        <div class="col-12 web_view_carousel">
            <div
                class="owl-carousel four-carousel dot-disable nav-arrow-middle-show owl-mx-20 e-title-dark e-title-hover-primary    short-info p-30">
                @foreach (advertisements() as $advertisement)
                    <div class="item">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="product type-product">
                                    <div class="product-wrapper">
                                        <div class="product-image">
                                            <a href="{{ $advertisement->link }}" target="_blank"><img
                                                    src="{{ asset($advertisement->image) }}" alt="Advertisement image"
                                                    width="228" height="227"></a>
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
                                                    src="{{ asset($advertisement->image) }}" alt="Advertisement image"
                                                    width="228" height="227"></a>
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








    {{-- section for news cards --}}

    <div class="container text-center">
        <h2>Everybody has got something to say about us</h2>
    </div>
    <div class="card-container">
        <div class="card">
            <img src="{{ asset('uploads/news2.jpg') }}" alt="Image 1">
            <div class="card-content">
                <div class="card-title">The Daily Star</div>
                <a href="https://www.thedailystar.net/business/news/robis-r-ventures-30-contest-ends-high-note-3264861" class="card-description"><h6>Read More</h6></a>
            </div>
        </div>
       
        <div class="card">
            <img src="{{  asset('uploads/news1.avif') }}" alt="Image 2">
            <div class="card-content">
                <div class="card-title">Daily Observer</div>
                <a href="https://www.observerbd.com/news.php?id=424590" class="card-description"><h6>Read More</h6></a>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('uploads/news3.jpg') }}" alt="Image 3">
            <div class="card-content">
                <div class="card-title">The Independent</div>
                <a href="https://theindependentbd.com/post/272109" class="card-description"><h6>Read More</h6></a>
            </div>
        </div>

        <div class="card">
            <img src="{{ asset('uploads/news4.jpg') }}" alt="Image 4">
            <div class="card-content">
                <div class="card-title">The Daily Ittefaq</div>
                <a href="https://www.ittefaq.com.bd/610579/%E0%A6%8F%E0%A6%95-%E0%A6%95%E0%A7%8D%E0%A6%B2%E0%A6%BF%E0%A6%95%E0%A7%87%E0%A6%87-%E0%A6%AE%E0%A6%BF%E0%A6%B2%E0%A6%AC%E0%A7%87-%E0%A6%AA%E0%A7%87%E0%A6%BE%E0%A6%B6%E0%A6%BE%E0%A6%95-%E0%A6%93-%E0%A6%AC%E0%A6%B8%E0%A7%8D%E0%A6%A4%E0%A7%8D%E0%A6%B0-%E0%A6%96%E0%A6%BE%E0%A6%A4%E0%A7%87%E0%A6%B0-%E0%A6%B8%E0%A6%AC%E0%A6%95%E0%A6%BF%E0%A6%9B%E0%A7%81" class="card-description"><h6>Read More</h6></a>
            </div>
        </div>
    </div>

    {{-- section for news cards ends --}}





    {{-- section for map --}}


    <div class="container text-center">
        <h2>Areas with most handloom weavers working with fabric lagbe</h2>
    </div>
    <div class="container">

        <div class="row">


            <div class="col-md-6">
                <img src="{{ asset('uploads/bdmap.png') }}" alt="">
            </div>


            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="{{ asset('uploads/map1.jpg') }}" class="mapimage" alt="" width="300" height="500">
            </div>
            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('uploads/map2.jpg') }}" class="mapimage"  alt="" width="300" height="250">
                <img src="{{ asset('uploads/map3.jpg') }}"  class="mapimage" alt="" width="300" height="250"
                    style="margin-top: 20px;">
            </div>
        </div>
    </div>
    </div>

    {{-- section for map ends --}}

    <div class="imgfooter">
        <img src="{{ asset('uploads/appfooter1.jpg') }}" alt="">
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
