<!DOCTYPE html>
<html lang="en">


<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Meta Tag -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PT6WBCZ');
    </script>
    <!-- End Google Tag Manager -->
    @php
        $current_url = URL::current();
        $metaSetting = \App\Model\MetaSetting::first();
    @endphp
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @if (Request::is('/') == $current_url)
        <meta name="meta_description" content="{{ $metaSetting->meta_description }}" />
        <meta name="meta_title" content="{{ $metaSetting->meta_title }}" />
    @else
        @yield('meta')
    @endif
    @include('meta::manager')
    {{--    <meta name="description" content="Fabric Lagbe"> --}}

    <meta name="author" content="root">
    <meta name="facebook-domain-verification" content="sikvqdu3mfyj4olpzfcnwhfy0i2yqn" />
    {{--    <!-- Meta Pixel Code --> --}}
    {{--    <script> --}}
    {{--        !function(f,b,e,v,n,t,s) --}}
    {{--        {if(f.fbq)return;n=f.fbq=function(){n.callMethod? --}}
    {{--            n.callMethod.apply(n,arguments):n.queue.push(arguments)}; --}}
    {{--            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0'; --}}
    {{--            n.queue=[];t=b.createElement(e);t.async=!0; --}}
    {{--            t.src=v;s=b.getElementsByTagName(e)[0]; --}}
    {{--            s.parentNode.insertBefore(t,s)}(window, document,'script', --}}
    {{--            'https://connect.facebook.net/en_US/fbevents.js'); --}}
    {{--        fbq('init', '1327467540999457'); --}}
    {{--        fbq('track', 'PageView'); --}}
    {{--    </script> --}}
    {{--    <noscript><img height="1" width="1" style="display:none" --}}
    {{--                   src="https://www.facebook.com/tr?id=1327467540999457&ev=PageView&noscript=1" --}}
    {{--        /></noscript> --}}
    {{--    <!-- End Meta Pixel Code --> --}}

    {{--    <meta name="google-site-verification" content="rk6r5yrpWZVvBqMviK1IAD-k11zvT1Bkr5BysTKu7ZQ" /> --}}
    <meta name="google-site-verification" content="8NBn3c7C3mqTa5MQCWxRV65EzyUzaxgpHn8ZgtqRRKA" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-EM38NY3CC3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-EM38NY3CC3');
    </script>




    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/favicon-fabric.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!--  CSS Style -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/webfonts/flaticon/flaticon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/layerslider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/template.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/category/women-fashion.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/dist/css/custom-style.min.css') }}">
    {{--    <link rel="stylesheet" href="{{asset('backend/dist/css/custome-style.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('backend/dist/css/spectrum.min.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/jssocials.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jssocials-theme-flat.min.css') }}">
    {{-- toastr css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    @stack('css')
</head>


<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PT6WBCZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="page_wrapper" class="bg-light no-print">

        <!--==================== Header Section Start ====================-->
        @if (\Request::is('ecom'))
            @include('frontend.includes.header_ecom');
        @else
            @include('frontend.includes.header_v3');
        @endif


        {{-- @include('frontend.includes.header_v2') --}}
        <!--==================== Header Section End ====================-->
        @yield('content')
        <!--==================== Footer Section Start ====================-->
        @include('frontend.includes.footer')
        <!--==================== Footer Section End ====================-->
        <input type="hidden" name="lang" id="lang" value="{{ app()->getLocale('locale') }}">
    </div>


    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="https://kit.fontawesome.com/0ff7ca8038.js" crossorigin="anonymous"></script>
    <!-- Include Scripts -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/greensock.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jssocials.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <!-- Initializing the slider -->
    <script>
        $(document).ready(function() {
            $('#slider').layerSlider({
                sliderVersion: '6.0.0',
                type: 'responsive',
                responsiveUnder: 0,
                layersContainer: 1200,
                hideUnder: 0,
                hideOver: 100000,
                skin: 'v6',
                globalBGColor: '#ffffff',
                navStartStop: false,
                skinsPath: 'assets/skins/',
                // height: 479
                height: 350
            });
        });




        $('#currency-change').change(function() {

            //alert();
            //e.preventDefault();
            var $this = $(this);
            //var currency_code = $this.data('currency');
            var currency_code = $this.val();
            //alert(currency_code);
            $.post('{{ route('currency.change') }}', {
                _token: '{{ csrf_token() }}',
                currency_code: currency_code
            }, function(data) {
                location.reload();
            });

        });

        function currency_changed(el) {
            var currency_code = el.value;
            //alert(currency_code);
            $.post('{{ route('currency.change') }}', {
                _token: '{{ csrf_token() }}',
                currency_code: currency_code
            }, function(data) {
                location.reload();
            });
        }


        function myFunction1(lang_id) {
            jQuery(function($) {
                jQuery.ajax({
                    beforeSend: function(xhr) { // Add this line
                        xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                    },
                    url: '{{ URL::to('/change_language') }}',
                    type: "POST",
                    data: {
                        "id": lang_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(res) {
                        window.location.reload();
                    },
                });
            });
        }


        function ShowHidePaymentWith() {
            //alert();
            if ($("#PayManually").is(":checked")) {
                $("#div_pay_manually").show();
                $("#div_description").show();
                $('input[name=payment_type][id=Cash]').prop('checked', true);

                $("#div_pay_online").hide();
            } else {
                $("#div_pay_manually").hide();
                $("#div_description").hide();
                $('input[name=payment_type]:checked').prop('checked', false);
                $('input[name=payment_type][id=Cash]').prop('checked', false);

                $("#div_pay_online").show();
                $('input[name=payment_type][id=SSLCommerz]').prop('checked', true);
            }

        }

        function ShowHidePaymentType() {
            if ($("#Check").is(":checked")) {
                $("#div_check_number").show();
            } else {
                $("#div_check_number").hide();
            }
        }


        //add to cart
        function addToCart(productId, variant) {
            //alert(variant)
            $('.cart-popup').empty();
            $.post('{{ route('product.add.cart') }}', {
                _token: '{{ csrf_token() }}',
                product_id: productId,
            }, function(data) {
                //  console.log(data);
                if (data) {
                    $('.cart-popup').html(data);
                    toastr.success('Item has been added to cart');
                    var countValue = $('#cartCount').val();
                    $('.cartCountTotal').text(countValue);
                    //document.getElementsByClassName("cartCountTotal").innerHTML = data;
                    console.log(countValue)
                } else {
                    toastr.error('allready added');
                }

            });
        }


        //add to cart show
             if ($('.cart-view').has('.cart-popup')) {
        $('.cartShow').on('click', function(e) {
            e.preventDefault();
            if ($('.cart-view').hasClass('show')) {
                $('.cart-view').removeClass('show');
            } else {
                $('.cart-view').addClass('show');
            }
            e.stopPropagation();
        });
        $(document).on('click', function(e) {
            var container = $('.cart-popup');
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('.cart-view').hasClass('show')) {
                    $('.cart-view').removeClass('show');
                }
            }
        });
    }
    
     
    

        function updateCartQuantity(id) {
            qty = parseFloat($("#quantity_" + id).val());

            $.post('{{ route('product.add.cartindecren') }}', {
                _token: '{{ csrf_token() }}',
                product_id: id,
                quantity: qty,
            }, function(data) {
                if (data) {

                    $('.cart-popup').html(data);
                    var countValue = $('#cartCount').val();
                    $('.cartCountTotal').text(countValue);
                }
            });
        }
        $(document).on('click', '#incrementBtn', function() {
            $id = $(this).attr('pid');
            min = 1
            var oldValue = parseFloat($("#quantity_" + $id).val());

            $("#quantity_" + $id).val(parseFloat(oldValue + 1));
            updateCartQuantity($id);
        });
        $(document).on('click', '#decrementBtn', function() {
            $id = $(this).attr('pid');
            min = 1
            var oldValue = parseFloat($("#quantity_" + $id).val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {

                var newVal = oldValue - 1;

            }
            $("#quantity_" + $id).val(parseFloat(newVal));
            updateCartQuantity($id);
        });
    </script>

    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error', {
                    closeButton: true,
                    progressBar: true
                });
            @endforeach
        @endif
        function showFrontendAlert(type, message) {
            if (type == 'danger') {
                type = 'error';
            }
            messageTextView.setTextSize(25);
            swal({
                position: 'top-end',
                type: type,
                title: message,
                showConfirmButton: false,
                timer: 6000,

            });

        }
        

        function searchSubmit(el) {
            var category = el.value;
            var q = $('.search_value').val();
            let url = "{{ route('category.search') }}?q=" + q + "&category=" + category;
            window.location = url;
        }

        $(document).ready(function() {
            $('#share').jsSocials({
                showLabel: false,
                showCount: false,
                shares: ["email", "twitter", "facebook", "linkedin", "whatsapp", 'messenger'],

            });
            // getVariantPrice();

        });
    </script>
    @stack('js')

    {{-- {{ Emotality\TawkTo\TawkTo::widgetCode('https://tawk.to/chat/630da1ac54f06e12d891ac93/1gbmjv2u4') }} --}}



</body>


</html>
