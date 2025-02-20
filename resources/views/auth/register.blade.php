@extends('frontend.layouts.master')
@section('title', 'Registration')
@push('css')
    <link href="{{asset('frontend/css/intlTelInput.min.css')}}" rel="stylesheet">
    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"--}}
    {{--          media="screen">--}}
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
    {{--this section for custom css only for this page--}}
    <link rel="stylesheet" href="{{asset('frontend/css/doctor-reg.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <style>
        select+.select2-container {
            z-index: 98;
            width: 100% !important;
        }
        .select2-container--default .color-preview {
            height: 12px;
            width: 12px;
            display: inline-block;
            margin-right: 5px;
            margin-top: 2px;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 45px!important;
        }
    </style>
    <style>
        .dc-registerformhold {
            background: #fff;
        }

        textarea, select, .dc-select select, .form-control, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
            color: #373737;
            outline: none;
            height: 40px;
            background: #fff;
            font-size: 14px;
            -webkit-box-shadow: none;
            box-shadow: none;
            line-height: 18px;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            border: 1px solid #dddddd;
            text-transform: inherit;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-family: 'Alatsi', sans-serif;
        }

        .dc-formregister .dc-registerformgroup .form-group {
            margin: 0;
            padding: 11px;
        }

        .dc-btn {
            min-width: 120px;
            padding: 0 10px;
            font: 400 16px/27px 'Alatsi', sans-serif;
            /*border-color:#9b8cc2;*/
        }
        .dc-joinforms {
            padding: 10px 74px;
        }
        @media (max-width:575px){
            .dc-joinforms{
                padding: 9px 0px;
            }
        }
        .required{
            color: red;
        }


        .modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}
    </style>
@endpush
@section('content')
    <!-- breadcrumbarea start -->
    <!-- breadcrumbarea End -->
    <main id="dc-main" class="dc-main dc-haslayout dc-innerbgcolor">
        <!--Register Form Start-->
        <div class="dc-haslayout dc-main-section">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                        <div class="dc-registerformhold">
                            <div class="dc-registerformmain">
                                <div class="dc-joinforms">
                                    <h3>@lang('website.Registration')</h3>
                                    @php
                                        //$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                                        //$uri_segments = explode('/', $uri_path);
                                        //$segment = $uri_segments[3];
                                    @endphp
                                    {{--                                    {{ Request::segment(3) }}--}}
                                    <input type="hidden" class="form-control" name="segment" id="segment" value="{{Request::segment(3)}}"/>

                                    <form class="dc-formtheme dc-formregister" method="POST" action="{{route('user.register')}}" enctype="multipart/form-data">
                                        <br>
                                    @csrf

                                        {{-- radio buttons for selecting buyer or seller --}}
                                        <h5>Choose a registration option(Buyer or Seller)</h5>
                                        <hr>

                                     

                                        <div class="row pb-2 mt-2" >
                                            @if(Request::segment(1) == 'work-order')
                                                <div class="col-4" style="font-size: 18px">
                                                    <input type="radio" name="user_type" data-index="0" id="buyer" value="buyer" class="shipping_method" @if(Request::segment(3) == 'buyer') checked @endif> @lang('website.Buyer')
                                                </div>
                                                <div class="col-4" style="font-size: 18px">
                                                    <input type="radio" name="user_type" data-index="0" id="seller" value="seller" class="shipping_method" @if(Request::segment(3) == 'seller') checked @endif> @lang('website.Manufacturer')
                                                </div>
                                            @else
                                                <div class="col-6">
                                                    <input type="radio" name="user_type" data-index="0" id="buyer" value="buyer" class="shipping_method" @if(Request::segment(3) == '') checked @endif> @lang('website.Buyer')
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio" name="user_type" data-index="0" id="seller" value="seller" class="shipping_method" @if(Request::segment(3) == 'employer') checked @endif> @lang('website.Seller/Employer')
                                                </div>
                                                {{-- <div class="col-4">
                                                    <input type="radio" name="user_type" data-index="0" id="employee" value="employee" class="shipping_method" @if(Request::segment(3) == 'employee') checked @endif> @lang('website.Job')

                                                </div> --}}
                                            @endif
                                        </div>
                                         {{-- radio buttons for selecting buyer or seller --}}
                                         <br>

                                         {{-- buyer options starts --}}
                                         {{-- <div class="row">
                                         <div class="col-md-6">
                                         <label for="buyer-type">Buyer Registration as:</label>
                                        
                                        </div>
                                        <div class="col-md-6">
                                           
                                            <select id="buyer-type" name="buyer-type" class="form-control">
                                               <option value="individual">Select Buyer Type</option>
                                              <option value="individual">Individual</option>
                                              <option value="company">Company</option>
                                              <option value="government">Government</option>
                                              <option value="institute">Institute</option>
                                            </select>
                                           </div>
                                       
                                        </div>
                                         <br> --}}
                                         {{-- buyer options ends --}}

                                    <!--  <label for="phone_number">Phone Number</label> -->
                                        <fieldset class="dc-registerformgroup">
                                            <div class="row">
                                                @php
                                                    $lang = app()->getLocale('locale');
                                                @endphp
                                                <div class="col-md-6 @if($lang !== 'en') d-none @endif">
                                                    <label for="name">@lang('website.Enter Full Name EN')
                                                        @if($lang == 'en')
                                                            <span class="required">*</span>
                                                        @else
                                                        (@lang('website.Optional'))
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        {{$lang == 'en' ? 'required' : '' }} />
                                                </div>
                                                <div class="col-md-6 @if($lang !== 'bn') d-none @endif">
                                                    <label for="name_bn">@lang('website.Enter Full Name BN')
                                                        @if($lang == 'bn')
                                                            <span class="required">*</span>
                                                        @else
                                                        (@lang('website.Optional'))
                                                        @endif
                                                    </label>
                                                    <input type="text" class="form-control" name="name_bn"
                                                           id="name_bn" {{$lang == 'bn' ? 'required' : '' }} />
                                                </div>

                                                <div class="col-md-6">
                                                    <div>
                                                        <label for="phone">@lang('website.Mobile Phone')<span class="required">*</span></label>
                                                    </div>
                                                    <input id="phone1" type="tel" class="phone_val" name="phone" placeholder="@lang('website.phone')" required>
                                                    <input id="countyCodePrefix1" type="hidden" name="countyCodePrefix" required>
                                                    <span id="valid-msg1" class="hide text-success">Valid</span>
                                                    <span id="error-msg1" class="hide text-danger">Invalid number</span>
                                                    <span id="error-msg2" class="hide text-danger">This Phone number already Exists </span>
                                                </div>
                                                <div class="col-md-4" id="email_1">
{{--                                                    <label for="email">@lang('website.Email')&nbsp;  (@lang('website.Optional'))  </label>--}}
                                                  <div id="emailLebel">
                                                      <label for="email">@lang('website.Email') (@lang('website.Optional'))  </label>
                                                  </div>
                                                    <input type="email" class="form-control" name="email" id="email"/>
                                                </div>
{{--                                                <div class="col-md-6 d-none" id="email_2">--}}
{{--                                                    <label for="email">@lang('website.Email')&nbsp;  (@lang('website.Required'))<span class="required">*</span>  </label>--}}
{{--                                                    <input type="email" class="form-control" name="email" id="email2" required />--}}
{{--                                                </div>--}}
                                                <div class="col-md-4">
                                                    <label for="whatsapp_number">@lang('website.WhatsApp Number')</label>
                                                    <input type="number" class="form-control" name="whatsapp_number" id="whatsapp_number"/>
                                                </div>

                                                <div class="col-md-4">
                                                    <label for="address">@lang('website.My Business Address')</label>
                                                    <input type="text" class="form-control" name="address" id="address"/>
                                                </div>
{{--                                                <div class="col-md-6 @if($lang !== 'bn') d-none @endif">--}}
{{--                                                    <label for="address_bn">@lang('website.My Business Address')&nbsp; </label>--}}
{{--                                                    <input type="text" class="form-control" name="address_bn" id="address_bn"/>--}}
{{--                                                </div>--}}
                                                <div class="col-md-6">
                                                    <label for="password">@lang('website.Password')&nbsp;<span class="required">*</span></label>
                                                    <div class="form-group input-group mb-3" style="padding: 0px;">
                                                        <input id="password-field1" type="password" minlength="8" class="form-control" name="password" placeholder="@lang('website.Must be minimum 8 digit')" required >
                                                        <span toggle="#password-field1" class="input-group-text toggle-password1" id="basic-addon2" title="@lang('website.Eye Open')"><i id="test1" class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="confirm_password">@lang('website.Confirm Password')&nbsp;<span class="required">*</span></label>
                                                    <div class="form-group input-group mb-3" style="padding: 0px;">
                                                        <input id="password-field2" type="password" minlength="8" class="form-control" name="confirm_password" required >
                                                        <span toggle="#password-field2" class="input-group-text toggle-password2" id="basic-addon2" title="@lang('website.Eye Open')"><i id="test2" class="fa fa-eye"></i></span>
                                                    </div>
                                                </div>

                                                <div id="buyer_categories" >
                                                    @include('frontend.includes.buyer_categories_html')
                                                </div>

{{--                                                <div id="gender" class="col-md-6">--}}
{{--                                                    <label for="gender">@lang('website.Gender')&nbsp; (@lang('website.Optional'))</label>--}}
{{--                                                    <div style="font-size: 16px">--}}
{{--                                                        <select class="form-control" name="gender" style="font-size: 16px" >--}}
{{--                                                            <option>@lang('website.Select')</option>--}}
{{--                                                            <option value="Male">@lang('website.Male')</option>--}}
{{--                                                            <option value="Female">@lang('website.Female')</option>--}}
{{--                                                            <option value="Neutral">@lang('website.Neutral')</option>--}}
{{--                                                            <option value="Common">@lang('website.Common')</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}

                                                <div class="form-group">
                                                    <label class="control-label ml-3">@lang('website.National ID Image') (@lang('website.Front')) <small class="text-danger">(jpg,jpeg,png file only)</small></label>
                                                    <div class="ml-3 mr-3">
                                                        <div class="row" id="nid_front"></div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label ml-3">@lang('website.National ID Image') (@lang('website.Back')) <small class="text-danger">(jpg,jpeg,png file only)</small></label>
                                                    <div class="ml-3 mr-3">
                                                        <div class="row" id="nid_back"></div>

                                                    </div>
                                                </div>
                                               <div class="col-md-12 mb-2">
                                                  <label>@lang('website.Referral Code') (@lang('website.Optional'))<span class="small" style="color: green;">(@lang("website.Enter your friend's referral code"))</span></label>
                                                   <input class="form-control form_height" type="number" name="referred_by" placeholder="@lang('website.Referral Code (Optional)')">
                                               </div>
                                            </div>

                                          
                                            <div id="seller_form">

                                            </div>
                                            <div id="employee_form">

                                            </div>


                                        

                                        
                                            <div class="form-group text-center">
                                                <button class="dc-btn" type="button" value="Sign-up" style="min-height: 44px;margin-bottom: 10px;" data-bs-toggle="modal"  data-bs-target="#staticBackdrop">@lang('website.Submit')</button>
                                            </div>
                                        </fieldset>
                                               {{-- modal for terms and conditions --}}
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
                                                               <h5>Please read and accept following terms and conditions</h5>
                                                           </div>
                                                           <div>
                                                           
                                                           </div>
                                                           @php
                                                               $popUp = \App\Model\PopUp::where('type', 'bid_submit')->first();
                                                           @endphp
                                                           <div class="currency_bdt">
                                                               <div class="font_20">
                                                                <h1>Terms & Conditions</h1>

                                                                <p>Fabric Lagbe is a digital flatform. Head Office at TA-98/1 AZAD PLAZA, (4th floor) Gulshan Badda Link Road, Dhaka-1212, Bangladesh. Fabric lagbe has formed directly or through its subsidiaries partnership agreements with privileged groups of textile factory owners, agencies, PRODUCTS/GOODS(Fabrics, Readymade garments ,Yarn,Cotton,Textile Machinaries,Spares parts) retailer, buyer, merchandiser, buying house, trader, indentor, supplier, wholesaler, and other related entities (here in after referred to as “Partner(s)”) so as to constitute a national and international network. The company developed, “Fabric Lagbe”, mobile/web based online platform, (here in after referred to as “Application”), and accordingly developed a website namely https://www.fabricslagbe.com. Application is available on iOS, Android operating systems as well as desktop/laptop computers, smartphones and tablets. This allows the Application Users (here in after referred to as “User”) to book a PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machinaries, Spares parts) (here in after referred to as “PRODUCT”) for providing services of goods of the User from FACTORY OWNER TO END USER (Customer) within Bangladesh and International and accordingly the Partner(s) shall manage a fabrics as per the request and requirement of the User. The PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machinaries, Spares parts) shall be conducted by Owners (here in after referred to as “owner”) who shall be affiliated to a Partner. The Bit accepted or booking of fabrics by the User buyer or customer or via the Application shall be referred to as an “Order”. The service to be provided to the User under these general terms and conditions is here in after referred to as “Service” and the Service will be provided by way of the Application through which a business relationship will be created between the User (buyer or customer) and Partner(s)
                                                                    Fabric Lagbe হল ডিজিটাল ফ্ল্যাটফর্ম। হেড অফিস অবস্থিত TA-98/1 আজাদ প্লাজা, (৫ম তলা) গুলশান বাড্ডা লিংক রোড, ঢাকা-1212, বাংলাদেশ। Fabric Lagbe টেক্সটাইল কারখানার মালিক, এজেন্সি, পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) খুচরা বিক্রেতা, ক্রেতা, মার্চেন্ডাইজার, বায়িং হাউস, ব্যবসায়ীদের বিশেষ সুবিধাপ্রাপ্ত গোষ্ঠীর সাথে সরাসরি বা তার সহযোগী অংশীদারিত্ব চুক্তি গঠন করেছে। একটি জাতীয় এবং আন্তর্জাতিক নেটওয়ার্ক গঠন করার জন্য ইন্ডেন্টর, সরবরাহকারী, পাইকার এবং অন্যান্য সম্পর্কিত সত্ত্বা (এর পরে "অংশীদারগন)" হিসাবে উল্লেখ করা হয়েছে)। কোম্পানি, Fabric Lagbe, ব্র্যান্ডের অধীনে, "ফেব্রিক্স লাগবে", একটি মোবাইল/ওয়েব ভিত্তিক অনলাইন প্ল্যাটফর্ম তৈরি করেছে, (এরপরে "অ্যাপ্লিকেশন" হিসাবে উল্লেখ করা হয়েছে), এবং সেই অনুযায়ী https://www.fabricslagbe.com নামে একটি ওয়েবসাইট তৈরি করেছে৷ অ্যাপ্লিকেশনটি iOS, Android অপারেটিং সিস্টেমের পাশাপাশি ডেস্কটপ/ল্যাপটপ কম্পিউটার, স্মার্টফোন এবং ট্যাবলেটগুলিতে উপলব্ধ। এটি অ্যাপ্লিকেশন ব্যবহারকারীদের (এরপরে "ব্যবহারকারী" হিসাবে উল্লেখ করা হয়েছে) পণ্যের পরিষেবা প্রদানের জন্য একটি পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) বুক করার অনুমতি দেয় (এর পরে "প্রোডাক্ট" হিসাবে উল্লেখ করা হয়) বাংলাদেশ এবং আন্তর্জাতিকের মধ্যে কারখানার মালিক থেকে শেষ ব্যবহারকারী (গ্রাহক) এবং সেই অনুযায়ী অংশীদারগন ব্যবহারকারীর অনুরোধ এবং প্রয়োজনীয়তা অনুযায়ী একটি কাপড় পরিচালনা করবেন। পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) মালিকদের দ্বারা পরিচালিত হবে (এখানে "মালিক" হিসাবে উল্লেখ করা হয়েছে) যারা একজন অংশীদারের সাথে অনুমোদিত হবে৷ ব্যবহারকারী ক্রেতা বা গ্রাহক দ্বারা বা অ্যাপ্লিকেশনের মাধ্যমে কাপড়ের বিড গৃহীত বা বুকিং একটি "অর্ডার" হিসাবে উল্লেখ করা হবে। এই সাধারণ শর্তাবলীর অধীনে ব্যবহারকারীকে যে পরিষেবা প্রদান করা হবে তা পরবর্তীতে "পরিষেবা" হিসাবে উল্লেখ করা হয়েছে এবং পরিষেবাটি অ্যাপ্লিকেশনের মাধ্যমে সরবরাহ করা হবে যার মাধ্যমে ব্যবহারকারী (ক্রেতা বা গ্রাহক) এবং এর মধ্যে অংশীদারদের একটি ব্যবসায়িক সম্পর্ক তৈরি হবে ।
                                                                    ARTICLE 1 – PURPOSE OF CONTRACT   The Service: অনুচ্ছেদ 1 - পরিষেবার চুক্তির উদ্দেশ্য:
                                                                    By virtue of this contract Fabric Lagbe shall enable the User to communicate with the Partner(s) in order to undertake the PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machineries, Spares parts) for the service of goods. Fabric Lagbe shall provide the User (Buyer or customer) with an online platform to place Orders. Once the Order is placed, the Partner(s) shall manage the PRODUCTS/GOODS(Fabrics, Readymade garments, Yarn, Cotton, Textile Machineries, Spares parts ) as per the Order placed by the User through the Partner(s)’ own account and responsibility.
                                                                    1.1	এই চুক্তির ভিত্তিতে Fabric Lagbe ব্যবহারকারীকে পণ্য পরিষেবার জন্য পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) অংশীদারদের সাথে যোগাযোগ করাতে সক্ষম ৷ Fabric Lagbe ব্যবহারকারীকে (ক্রেতা বা গ্রাহক) অর্ডার দেওয়ার জন্য একটি ডিজিটাল প্ল্যাটফর্ম প্রদান করবে। অর্ডার দেওয়া হয়ে গেলে, অংশীদাররা নিজের অ্যাকাউন্টের মাধ্যমে ব্যবহারকারীর দেওয়া অর্ডার অনুযায়ী পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) দায়িত্ব পরিচালনা করবেন।  
                                                                    The service provided by Fabric Lagbe through the Application shall link the User with the Partner(s) and Fabric Lagbe does not have any responsibility with respect to the quality of PRODUCT such PRODUCTS/GOODS(Fabrics,Readymadegarments,Yarn,Cotton,Textile Machineries, Spares parts) width, construction, composition, color, weight, Quantity, Warranty, Guaranty, commitment ,communication ,testing failed, delivery problem, payment terms, illegal goods transport with goods, Govt Tax ,VAT& others fees or anything related with the goods that’s PRODUCTS/GOODS(Fabrics, Readymade garments ,Yarn, Cotton, Textile Machineries, Spares parts ).
                                                                    1.2	অ্যাপ্লিকেশানের মাধ্যমে Fabric Lagbe দ্বারা প্রদত্ত পরিষেবাটি ব্যবহারকারীকে অংশীদারদের সাথে সংযুক্ত করবে এবং Fabric Lagbe-এই ক্ষেত্রে কোন দায়বদ্ধতা নেই পণ্যের মানের সাথে সম্পর্কিত পণ্যের (ফ্যাব্রিকস, রেডিমেড গার্মেন্টস, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) প্রস্থ , কন্সট্রাক্শন কম্পোজিশন, রঙ, ওজন, পরিমাণ, ওয়্যারেন্টি, গ্যারান্টি, প্রতিশ্রুতি, যোগাযোগ, পরীক্ষা ব্যর্থ, ডেলিভারী সমস্যা, অর্থপ্রদানের শর্তাবলী, পণ্যের সাথে অবৈধ পণ্য পরিবহন, সরকারী ট্যাক্স, ভ্যাট এবং অন্যান্য ফি বা পণ্যের সাথে সম্পর্কিত যে কোনও পণ্য যেমন(কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ)ইত্যাদি ।
                                                                    The Application shall allow the User (buyer or customer) to make a request for an order or booking by way of advance booking, Confirmation or contact regardless of the PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machineries, Spares parts) pick-up & delivery address, payment, quality and others negations of the User in Bangladesh and international within the Partners’ network and according to the level of goods that has been selected by the User Own Responsibility.
                                                                    
                                                                    1.3	অ্যাপ্লিকেশনটি ব্যবহারকারীকে (ক্রেতা বা গ্রাহক)  পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) নির্বিশেষে অগ্রিম বুকিং, নিশ্চিতকরণ বা যোগাযোগের মাধ্যমে একটি অর্ডার বা বুকিংয়ের জন্য অনুরোধ করার অনুমতি দেবে ) পিক-আপ এবং ডেলিভারির ঠিকানা, পেমেন্ট, গুণমান এবং অন্যান্য অংশীদারদের নেটওয়ার্কের মধ্যে বাংলাদেশ এবং আন্তর্জাতিক ব্যবহারকারীর নেতিবাচকতা এবং ব্যবহারকারীর নিজস্ব দায়বদ্ধতা দ্বারা নির্বাচিত পণ্যের স্তর অনুযায়ী পরিচালনা করবেন।
                                                                    The Order requires the prior creation of a User Account (FabricLagbe account) which is accessible through free installation of the Application by the User through downloading the application or visiting the website of https://www.fabriclagbe.com and Google play store & IOS store.
                                                                    1.4	ব্যবহারকারীকে অর্ডারটির জন্য একটি (FabricLagbe অ্যাকাউন্ট) তৈরির আগে প্রয়োজন যা ব্যবহারকারীর দ্বারা অ্যাপ্লিকেশনটি ডাউনলোড করার মাধ্যমে বা https://www.fabriclagbe.com ওয়েবসাইট  দেখার মাধ্যমে এবং গুগল প্লে স্টোর ও আইওএসের স্টোর  বিনামূল্যে  অ্যাপ্লিকেশন ইনস্টল করার মাধ্যমে।
                                                                    ARTICLE 2 – BENEFICIARIES OF ACQUIRED RIGHTS অনুচ্ছেদ 2 - অর্জিত অধিকারের সুবিধাভোগী
                                                                    2.1 Authorized person: The User (buyer or customer)
                                                                    2.1 অনুমোদিত ব্যক্তি: ব্যবহারকারী (ক্রেতা বা গ্রাহক)
                                                                    2.1.1 The use of the Application is strictly personal. The use by any person other than the User shall be the sole responsibility of the User.
                                                                    2.1.1 অ্যাপ্লিকেশন ব্যবহার সম্পূর্ন ব্যক্তিগত। ব্যবহারকারী ব্যতীত অন্য কোন ব্যক্তির দ্বারা ব্যবহার হবে ব্যবহারকারীর একমাত্র দায়িত্ব হবে।
                                                                    2.1.2. The benefits of this Agreement shall under no circumstance be marketed, sold or distributed in any way or at any cost, by the User to any third party whatsoever.
                                                                    2.1.2। এই চুক্তির সুবিধাগুলি কোনো অবস্থাতেই ব্যবহারকারীর দ্বারা কোনো তৃতীয় পক্ষের কাছে কোনো উপায়ে বা কোনো মূল্যে বাজারজাত, বিক্রি বা বিতরণ করা যাবে না।
                                                                    2.1.3. Fabric Lagbe along with the Partner(s) shall have access to the User’s full information as a result of the use of the Application by the User and details provided by the User while opening an account with Fabric Lagbe.
                                                                    2.1.3। Fabric Lagbe -এর সাথে অংশীদারদের ব্যবহারকারীর অ্যাপ্লিকেশন ব্যবহারের ফলে ব্যবহারকারীর সম্পূর্ণ তথ্য এবং Fabric Lagbe -এর সাথে একটি অ্যাকাউন্ট খোলার সময় ব্যবহারকারীর দ্বারা প্রদত্ত বিবরণে অ্যাক্সেস থাকবে৷
                                                                    2.1.4. Any update of personal details must be carried out by the User directly within the Application.
                                                                    2.1.4। ব্যক্তিগত বিবরণের যেকোনো আপডেট অবশ্যই ব্যবহারকারীকে সরাসরি অ্যাপ্লিকেশনের মধ্যেই করতে হবে।
                                                                    2.2 Other users The User may occasionally allow any person of his choice to benefit from the Fabric Lagbe services. In that case, the User must specify the name of the recipient at the time of them receiving the Service. The User shall be solely liable for any misconduct or fraud committed by the aforementioned recipient.
                                                                    2.2 অন্যান্য ব্যবহারকারী মাঝে মাঝে তার পছন্দের যেকোন ব্যক্তিকে Fabric Lagbe পরিষেবাগুলি থেকে উপকৃত হওয়ার অনুমতি দিতে পারে। সেক্ষেত্রে, ব্যবহারকারীকে পরিষেবাটি পাওয়ার সময় প্রাপকের নাম উল্লেখ করতে হবে। পূর্বোক্ত প্রাপকের দ্বারা সংঘটিত কোনো অসদাচরণ বা প্রতারণার জন্য ব্যবহারকারীকে সম্পূর্ণরূপে দায়ী করতে হবে।
                                                                    ARTICLE 3 – ACCESS TO SERVICE – TERMS FOR CREATION OF FABRIC LAGBE ACCOUNT – ACCEPTANCE OF GENERAL TERMS AND RATES
                                                                    অনুচ্ছেদ 3 - পরিষেবাতে অ্যাক্সেস - Fabric Lagbe অ্যাকাউন্ট তৈরির শর্তাবলী - সাধারণ শর্তাবলী এবং হারের স্বীকৃতি 
                                                                    3.1. Access to Service Access to the Service via the Application is available at all times unless the occurrence of any error or situation which is beyond the control of Fabric Lagbe. The procedures for access to the Service may be modified by Fabric Lagbe, who will inform the User as soon as possible by e-mail, phone or by any other means as may deem fit including push messaging as well as publishing the modifications on the website, https://www.fabriclagbe.com.
                                                                    3.1 অ্যাপ্লিকেশানের মাধ্যমে পরিষেবাতে অ্যাক্সেস সর্বদা উপলব্ধ থাকে যদি না কোনও ত্রুটি বা পরিস্থিতি ঘটে যা Fabric Lagbe -এর নিয়ন্ত্রণের বাইরে। পরিষেবাতে অ্যাক্সেসের পদ্ধতিগুলি Fabric Lagbe দ্বারা পরিবর্তিত হতে পারে, যারা ব্যবহারকারীকে যত তাড়াতাড়ি সম্ভব ই-মেইল, ফোন বা অন্য যে কোনও উপায়ে পুশ মেসেজিং এবং ওয়েবসাইটে https://www.fabriclagbe.com  পরিবর্তনগুলি প্রকাশ সহ উপযুক্ত বলে মনে করবে বলে জানাবে।
                                                                    3.2. Creation of Fabric Lagbe account when creating an account, the User shall be communicated by way of his/ her given phone number. Buyer shall provide his / her phone number & User (sellers) product (TIN/C+ VAT) and click ’Continue’ button in the Application. Thereafter User will receive a verification code by way of a sms to his provided number. User shall enter the code in order to be authenticated. Every time user tries to login, a randomly generated verification code will be sent to his / her number. The User shall completely ensure the privacy of their own account and will, at all times, be solely responsible for the use of their details and codes provided. Login details may be modified by the User. At the time of the creation of the initial account the User shall choose, his/ her arrangements for connection, disconnection and security of their account as well as the payment process via his/her credit card, debit card, or online payment like PayPal and others or through bank account or L/C or individual bkash/rocket/ucash or similar account. The terms of payment are set out in Articles 6-1 of these general terms and conditions.
                                                                    3.2। একটি  Fabric Lagbe অ্যাকাউন্ট তৈরি করার সময়, ব্যবহারকারীকে তার প্রদত্ত ফোন নম্বরের মাধ্যমে যোগাযোগ করা হবে। ক্রেতাকে তার ফোন নম্বর এবং ব্যবহারকারী (বিক্রেতাদের) পণ্য (টিন/সি+ ভ্যাট) প্রদান করতে হবে এবং অ্যাপ্লিকেশনে ‘চালিয়ে যান’ বোতামে ক্লিক করতে হবে । তারপর ব্যবহারকারী তার প্রদত্ত নম্বরে একটি এসএমএসের মাধ্যমে একটি যাচাইকরণ কোড পাবেন। ব্যবহারকারীকে প্রমাণীকরণের জন্য কোড লিখতে হবে। প্রতিবার ব্যবহারকারী লগইন করার চেষ্টা করলে, একটি এলোমেলোভাবে তৈরি করা যাচাইকরণ কোড তার নম্বরে পাঠানো হবে। ব্যবহারকারী সম্পূর্ণরূপে তাদের নিজস্ব অ্যাকাউন্টের গোপনীয়তা নিশ্চিত করবে এবং সর্বদা তাদের প্রদত্ত বিবরণ এবং কোড ব্যবহারের জন্য সম্পূর্ণরূপে দায়ী থাকবে। লগইন বিশদ ব্যবহারকারী দ্বারা সংশোধন করা যেতে পারে. প্রাথমিক অ্যাকাউন্ট তৈরির সময় ব্যবহারকারী বেছে নেবে, তার অ্যাকাউন্টের সংযোগ, সংযোগ বিচ্ছিন্ন এবং নিরাপত্তার জন্য তার ব্যবস্থার পাশাপাশি তার ক্রেডিট কার্ড, ডেবিট কার্ড, বা পেপ্যালের মতো অনলাইন পেমেন্টের মাধ্যমে অর্থপ্রদানের প্রক্রিয়া। অন্যদের  ব্যাংক অ্যাকাউন্ট বা L/C বা ব্যক্তিগত বিকাশ/রকেট/ucash বা অনুরূপ অ্যাকাউন্টের মাধ্যমে অর্থপ্রদানের শর্তাবলী এই সাধারণ শর্তাবলীর 6-1 অনুচ্ছেদে সেট করা আছে।
                                                                    3.3. Acceptance of general terms and rates. The User, having read these terms and conditions, must then accept the same by clicking the “Continue” (Opt in) button on the Application. The terms and conditions are available in the Application and on the website at www.fabriclagbe.com. Thereafter the User’s account in the Application will be validated and thus created and the User can then order PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machineries, Spares parts) via the Application. When the User places an Order for goods that shall automatically imply the acceptance of the Partner’s terms and conditions as well. The User, therefore, acknowledges and confirms of being aware of the terms and conditions of the Partner(s) while opening their own Fabric Lagbe account and thereby accepts it without any reservation, prior to requesting any Order for Goods.
                                                                    3.3 সাধারণ শর্তাবলী এবং হার গ্রহণ। ব্যবহারকারীকে, এই শর্তাবলী পড়ার পরে, আবেদনের "চালিয়ে যান" (অপ্ট ইন) বোতামে ক্লিক করে অবশ্যই এটি গ্রহণ করতে হবে। শর্তাবলী অ্যাপ্লিকেশনটিতে এবং www.fabriclagbe.com-এ ওয়েবসাইটে উপলব্ধ। তারপরে অ্যাপ্লিকেশনটিতে ব্যবহারকারীর অ্যাকাউন্টটি যাচাই করা হবে এবং এইভাবে তৈরি করা হবে এবং ব্যবহারকারী অ্যাপ্লিকেশনটির মাধ্যমে পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) অর্ডার করতে পারবেন। যখন ব্যবহারকারী পণ্যের জন্য একটি অর্ডার দেয় যা স্বয়ংক্রিয়ভাবে অংশীদারের শর্তাবলীর গ্রহণযোগ্যতাকে বোঝায়। ব্যবহারকারী তাই তাদের নিজস্ব Fabric Lagbe অ্যাকাউন্ট খোলার সময় অংশীদারদের শর্তাবলী সম্পর্কে অবগত থাকার বিষয়টি স্বীকার করে এবং নিশ্চিত করে এর ফলে পণ্যের জন্য কোনও অর্ডারের অনুরোধ করার আগে কোনও সংরক্ষণ ছাড়াই এটি গ্রহণ করে৷
                                                                     ARTICLE 4 – BENEFITS OF FLL অনুচ্ছেদ 4 - Fabric Lagbe এর সুবিধা
                                                                    The User can, via the Application, make Orders for Goods with Partner(s). Fabric Lagbe merely acts as an intermediary and connects the User with Partner(s). User can either make an offer for cost of the product /goods from the factory location to the desired destination of the User or can accept the Partner’s offer of cost for the Goods/products. Accordingly the Partner(s) can either accept the User’s offer of cost for the goods /products or can enter a negotiation with the User regarding the cost for the Goods/products. However, at times when the Application requires up gradation, the Partner(s) and Users may have the option to serve in different manner. The User cannot hold Fabric Lagbe responsible for any kind of disagreements regarding the cost of Goods/products between the User and the Partner(s).
                                                                    ব্যবহারকারী, অ্যাপ্লিকেশনের মাধ্যমে, অংশীদারদের সাথে পণ্যের জন্য অর্ডার করতে পারে৷ Fabric Lagbe শুধুমাত্র একটি মধ্যস্থতাকারী হিসাবে কাজ করে এবং ব্যবহারকারীকে অংশীদারদের সাথে সংযুক্ত করে৷ ব্যবহারকারী হয় কারখানার অবস্থান থেকে ব্যবহারকারীর পছন্দসই গন্তব্যে পণ্যের মূল্যের জন্য একটি অফার দিতে পারেন অথবা পণ্যের জন্য অংশীদারের খরচের প্রস্তাব গ্রহণ করতে পারেন। তদনুসারে অংশীদাররা হয় পণ্যের জন্য ব্যবহারকারীর মূল্যের প্রস্তাব গ্রহণ করতে পারে অথবা পণ্যের মূল্যের বিষয়ে ব্যবহারকারীর সাথে আলোচনায় প্রবেশ করতে পারে। যাইহোক, যখন অ্যাপ্লিকেশনের জন্য আপগ্রেডেশনের প্রয়োজন হয়, তখন অংশীদারগন এবং ব্যবহারকারীদের বিভিন্ন উপায়ে পরিবেশন করার বিকল্প থাকতে পারে। ব্যবহারকারী এবং অংশীদারদের মধ্যে পণ্যের মূল্য সংক্রান্ত কোনো ধরনের মতবিরোধের জন্য ব্যবহারকারী Fabric Lagbe -কে দায়ী করতে পারে না।
                                                                    4.1. Information provided by the User prior to every Order The User shall clearly and precisely mention the goods/products details description , the desired quality ,testing parameter ,payment method ,price confirmation ,delivery cost ,delivery time, type of vehicle required, pickup date including time and the PRODUCTS/GOODS(Fabrics, Readymade garments ,Yarn, Cotton, Textile Machineries, Spares parts ) quantity ,goods value amount that he has agreed to pay or the expected cost as appeared from the Application. In light of this information, the User may, if desired, request or make an Order for the goods/products.
                                                                    4.1 প্রতিটি অর্ডারের আগে ব্যবহারকারীর দ্বারা প্রদত্ত তথ্য ব্যবহারকারীকে পণ্যের বিশদ বিবরণ, পছন্দসই  গুণমান, পরীক্ষার পরামিতি, অর্থপ্রদানের পদ্ধতি, মূল্য নিশ্চিতকরণ, ডেলিভারি খরচ, ডেলিভারির সময়, প্রয়োজনীয় গাড়ির ধরন, পিকআপের তারিখ সহ স্পষ্টভাবে এবং সুনির্দিষ্টভাবে উল্লেখ করতে হবে। সময় এবং পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) পরিমাণ, পণ্যের মূল্যের পরিমাণ যা তিনি দিতে সম্মত হয়েছেন বা আবেদন থেকে প্রদর্শিত প্রত্যাশিত মূল্য। এই তথ্যের আলোকে, ব্যবহারকারী চাইলে, পণ্যের জন্য অনুরোধ বা অর্ডার দিতে পারে।
                                                                    4.2. Acceptance of General Terms and conditions The Order requires the prior acceptance by the User of these general terms and conditions.
                                                                    4.2। সাধারণ নিয়ম ও শর্তাবলীর গ্রহণযোগ্যতা অর্ডারের জন্য ব্যবহারকারীর পূর্বে সম্মতি প্রয়োজন। 
                                                                    4.3. Order The User shall clearly state in their Application the characteristics of the desired goods /products : which shall include advance and instant booking, place, date and time of pick-up of the PRODUCTS/GOODS (Fabrics, Readymade garments ,Yarn, Cotton, Textile Machineries, Spares parts), destination, chosen package and, where appropriate, vehicle or specific services desired. Thereafter the Order will be validated (place, date and time of pick-up) in the Application and an acknowledgement of receipt confirming the Order shall be provided electronically to the User.
                                                                    The stated goods/products are estimated goods/products and shall not in any way hold Fabric Lagbe or the Partner liable. In certain situations, such as Quality fault, payment dues ,delay delivery ,quantity ,weight and others and also certain situations like strikes, weather conditions or traffic or any other event which is beyond the control of Fabric Lagbe and the Partner(s). Fabric Lagbe and the Partner(s) reserve the right to limit the number of Orders at certain periods or may not accept any Order.
                                                                    The User shall note that the Partners may refuse to deliver the goods of the User in the goods/products due to the state of goods if it may result in violation of traffic rules, or create a danger to the security of Driver or vehicle, or the goods are illegal or the goods may result in violation of the applicable laws of Bangladesh.
                                                                    4.3 অর্ডারের ক্ষেত্রে ব্যবহারকারীকে তাদের অ্যাপ্লিকেশনে পছন্দসই পণ্যের বৈশিষ্ট্যগুলি স্পষ্টভাবে উল্লেখ করতে হবে: যার মধ্যে অগ্রিম এবং তাত্ক্ষণিক বুকিং, স্থান, পণ্য সংগ্রহের তারিখ এবং সময় অন্তর্ভুক্ত থাকবে (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ), গন্তব্য, নির্বাচিত প্যাকেজ এবং যেখানে উপযুক্ত, যানবাহন বা নির্দিষ্ট পরিষেবাগুলি কাঙ্ক্ষিত। তারপরে আবেদনপত্রে অর্ডারটি যাচাই করা হবে (স্থান, তারিখ এবং সময়) এবং অর্ডারটি নিশ্চিত করে প্রাপ্তির একটি স্বীকৃতি ব্যবহারকারীকে অনলাইনের মাধ্যমে প্রদান করা হবে।
                                                                    উল্লিখিত পণ্যটি আনুমানিক পণ্য এবং কোনোভাবেই Fabric Lagbe বা অংশীদারকে দায়ী করা যাবে না। নির্দিষ্ট পরিস্থিতিতে, যেমন গুণগত ত্রুটি, অর্থপ্রদানের বকেয়া, বিলম্ব বিতরণ, পরিমাণ, ওজন এবং অন্যান্য কিছু নির্দিষ্ট পরিস্থিতিতে যেমন ধর্মঘট, আবহাওয়া পরিস্থিতি বা ট্র্যাফিক বা অন্য কোনো ইভেন্ট যা Fabric Lagbe এবং অংশীদারদের নিয়ন্ত্রণের বাইরে। Fabric Lagbe এবং অংশীদাররা নির্দিষ্ট সময়ে অর্ডারের সংখ্যা সীমিত করার অধিকার সংরক্ষণ করে বা কোনো অর্ডার গ্রহণ নাও করতে পারে।
                                                                    ব্যবহারকারী অবশ্যই মনে রাখবেন যে অংশীদাররা পণ্যের অবস্থার কারণে ব্যবহারকারীর পণ্য সরবরাহ করতে অস্বীকার করতে পারে যদি এটি নিয়ম লঙ্ঘন করতে পারে,  ড্রাইভার বা গাড়ির নিরাপত্তার জন্য বিপদ সৃষ্টি করতে পারে, বা পণ্য অবৈধ বা পণ্য বাংলাদেশের প্রযোজ্য আইন লঙ্ঘন হতে পারে।
                                                                    4.4 GOODS/PRODUCTS by advance booking Advance booking for GOODS/PRODUCTS can be made by the User by making a reservation on the Application 1-4days days prior to the available of goods/products.
                                                                    4.4 পণ্য অগ্রিম বুকিং দ্বারা পণ্য/পণ্যের জন্য অগ্রিম বুকিং ব্যবহারকারী পণ্য উপলব্ধী হওয়ার 1-4 দিন আগে অ্যাপ্লিকেশনটিতে একটি রিজার্ভেশন করে করতে পারেন।
                                                                    4.5. Delivery and pick-up time The User or his/her designated personnel shall be present at the goods/products pickup location, after an Order has been placed by the User. The Partners will not wait for more than 1-4 days if the User does not show up and the delivery the goods /products within the stipulated time. Some of the Partner(s) have established maximum waiting times for the User at the delivery time and beyond this waiting period the Partner reserves the right to cancel the order. Under circumstances where the User cancels the Order or unavailable at the received within the stipulated time, the Partner(s) shall be entitled to charge the User 20% of the cost imposed for the goods/products.
                                                                    4.5 ব্যবহারকারীর দ্বারা অর্ডার দেওয়ার পরে, ডেলিভারি এবং পিক-আপের সময় ব্যবহারকারী বা তার মনোনীত কর্মীদের পণ্য ডেলিভারি,পিকআপ অবস্থানে উপস্থিত থাকতে হবে । ব্যবহারকারী নির্ধারিত সময়ের মধ্যে পণ্য ডেলিভারি না করলে অংশীদাররা 1-4 দিনের বেশি অপেক্ষা করবে না। কিছু অংশীদাররা ডেলিভারির সময় ব্যবহারকারীর জন্য সর্বোচ্চ অপেক্ষার সময় নির্ধারণ করেছে এবং এই অপেক্ষার সময়সীমার পরেও অংশীদার অর্ডারটি বাতিল করার অধিকার সংরক্ষণ করে। এমন পরিস্থিতিতে যেখানে ব্যবহারকারী অর্ডারটি বাতিল করে বা নির্ধারিত সময়ের মধ্যে প্রাপ্তিতে বিলম্ব হয়, অংশীদারগন পণ্য/পণ্যের জন্য আরোপিত খরচের 20% ব্যবহারকারীর কাছ থেকে চার্জ করার অধিকারী রাখবে।
                                                                    4.6. Cancellation or modification of the Order Once the User is tagged with the Partner, they can mutually decide on any modification they want to do. The User can cancel the order at free of cost mentioning any valid and justifiable reason. Frequent cancellation without any reasonable grounds may cause the User account to be put on hold and any service shall be refused until further clarification provided by the User. Provided Fabric Lagbe is satisfied with the reason provided by the User, the User account shall be reinstated and in this regard Fabric Lagbe decision shall be final.
                                                                    4.6। অর্ডার বাতিল বা পরিবর্তন একবার ব্যবহারকারীকে অংশীদারের সাথে ট্যাগ করা হলে, তারা পারস্পরিকভাবে সিদ্ধান্ত নিতে পারে যে তারা কোন পরিবর্তন করতে চায়। ব্যবহারকারী যেকোনো বৈধ এবং যুক্তিসঙ্গত কারণ উল্লেখ করে বিনামূল্যে অর্ডারটি বাতিল করতে পারেন। কোনো যুক্তিসঙ্গত কারণ ছাড়াই ঘন ঘন বাতিল করার ফলে ব্যবহারকারীর অ্যাকাউন্ট হোল্ডে রাখা হতে পারে এবং ব্যবহারকারীর দ্বারা প্রদত্ত আরও স্পষ্টীকরণ না হওয়া পর্যন্ত কোনো পরিষেবা প্রত্যাখ্যান করা হবে। যদি Fabric Lagbe ব্যবহারকারীর দ্বারা প্রদত্ত কারণের সাথে সন্তুষ্ট হয় তবে ব্যবহারকারীর অ্যাকাউন্টটি পুনঃস্থাপন করা হবে এবং এই বিষয়ে Fabric Lagbe -এর সিদ্ধান্ত চূড়ান্ত হবে৷
                                                                    ARTICLE 5 – FINANCIAL CONDITIONS OF SERVICE 
                                                                    অনুচ্ছেদ 5 - পরিষেবার আর্থিক শর্তাবলী
                                                                    5.1 The installation and use of the Application is free of cost for the User.
                                                                    5.1 অ্যাপ্লিকেশনটির ইনস্টলেশন এবং ব্যবহার ব্যবহারকারীর জন্য বিনামূল্যে।
                                                                    5.2 The installation is free for the Partner. Fabric Lagbe, at its discretion, may charge certain amount from the Partner(s) for the use the Application, which could be pre-paid for the Goods/products provided to User. The charges for goods/products service rendered to User shall be updated or varied from time to time between and by Fabric Lagbe and the Partner.
                                                                    5.2 অংশীদারের জন্য ইনস্টলেশন বিনামূল্যে। Fabric Lagbe, তার বিবেচনার ভিত্তিতে, অ্যাপ্লিকেশন ব্যবহারের জন্য অংশীদারদের থেকে নির্দিষ্ট পরিমাণ চার্জ নিতে পারে, যা ব্যবহারকারীকে প্রদত্ত পণ্য/পণ্যের জন্য প্রি-পেইড করা যেতে পারে। ব্যবহারকারীকে প্রদত্ত পণ্য পরিষেবার চার্জ Fabric Lagbe এবং অংশীদারের মধ্যে সময়ে সময়ে আপডেট বা পরিবর্তিত হতে হবে।
                                                                    5.3. Fabric Lagbe may charge the Users for any Goods/products cost if required. The payment for the services cost shall be paid to the Partner(s) or Fabric Lagbe as agreed upon by Fabric Lagbe and the Partner(s).
                                                                    5.3। প্রয়োজনে Fabric Lagbe যেকোন পণ্য মূল্যের জন্য ব্যবহারকারীদের কাছ থেকে চার্জ করতে পারে। Fabric Lagbe এবং অংশীদারদের দ্বারা সম্মতি অনুসারে সিরিয়াস খরচের জন্য অর্থ প্রদান অংশীদারগন বা Fabric Lagbe কে প্রদান করা হবে৷
                                                                    5.4 Fabric Lagbe may issue promotional codes for promotional purposes only and these are to be used against GOODS/PRODUCTS services from the applicable Partner’s PRODUCTS/GOODS (Fabrics, Readymade garments, Yarn, Cotton, Textile Machineries, Spares parts) only. Promotional codes have no cash value and cannot be exchanged for money or credit. Partners are expressly prohibited from selling promotional codes for their Goods/products services anywhere.
                                                                    5.4 Fabric Lagbe শুধুমাত্র প্রচারমূলক উদ্দেশ্যে প্রচারমূলক কোড জারি করতে পারে এবং এগুলি শুধুমাত্র প্রযোজ্য অংশীদারের পণ্য (কাপড়, তৈরি পোশাক, সুতা, তুলা, টেক্সটাইল মেশিনারি, খুচরা যন্ত্রাংশ) থেকে পণ্য পরিষেবার বিরুদ্ধে ব্যবহার করার জন্য। প্রচারমূলক কোডের কোন নগদ মূল্য নেই এবং অর্থ বা ক্রেডিট বিনিময় করা যাবে না। অংশীদাররা তাদের পণ্য পরিষেবার জন্য প্রচারমূলক কোডগুলি কোথাও বিক্রি করা থেকে স্পষ্টভাবে নিষিদ্ধ।
                                                                    ARTICLE 6 – INVOICING 
                                                                    The User shall collect all the required documents from the partners as required by the law while order making and delivery time of goods. Fabric Lagbe may provide invoice to the User for the service rendered. The User shall also keep a track of all records. Therefore, any billing or taxation between the User and Partner(s) shall not be binding upon Fabric Lagbe.
                                                                    আর্টিকেল 6 – ইনভয়েসিং 
                                                                    পণ্য অর্ডার করার সময় এবং ডেলিভারি করার সময় ব্যবহারকারী আইন অনুসারে অংশীদারদের কাছ থেকে প্রয়োজনীয় সমস্ত নথি সংগ্রহ করবে। Fabric Lagbe প্রদত্ত পরিষেবার জন্য ব্যবহারকারীকে চালান প্রদান করতে পারে। ব্যবহারকারীকে সব রেকর্ডের একটি ট্র্যাক রাখতে হবে. অতএব, ব্যবহারকারী এবং অংশীদারদের মধ্যে কোনো বিলিং বা ট্যাক্সেশন Fabric Lagbe -এর উপর বাধ্যতামূলক হবে না৷
                                                                    6.1 Terms of Payment the payment for the GOODS/product and its related or incidental charges shall be mutually agreed upon between the User and Partner(s). The payment for the goods/products and its related or incidental charges can be made before or after the delivery of goods. The User shall clearly mention the period within which payment will be made and this will be subject to the approval by the Partner(s) Fabric Lagbe shall not be liable for the terms of payment between the User and Partner(s).
                                                                    6.1 অর্থপ্রদানের শর্তাবলী পণ্য/পণ্যের জন্য অর্থপ্রদান এবং এর সাথে সম্পর্কিত বা আনুষঙ্গিক চার্জগুলি ব্যবহারকারী এবং অংশীদারদের মধ্যে পারস্পরিকভাবে সম্মত হবে৷ পণ্য/পণ্যের জন্য অর্থপ্রদান এবং এর সাথে সম্পর্কিত বা আনুষঙ্গিক চার্জগুলি পণ্য সরবরাহের আগে বা পরে করা যেতে পারে। ব্যবহারকারী স্পষ্টভাবে উল্লেখ করবে যে সময়ের মধ্যে অর্থপ্রদান করা হবে এবং এটি অংশীদারদের দ্বারা অনুমোদনের সাপেক্ষে হবে Fabric Lagbe ব্যবহারকারী এবং অংশীদারদের মধ্যে অর্থপ্রদানের শর্তাবলীর জন্য দায়ী থাকবে না৷
                                                                    6.2 Failure to pay in cases where the payment for the goods/products and its related or incidental charges are not made by the User, the Partner(s) shall file a complaint in this regard to Fabric Lagbe. If the User fails to provide a valid and justifiable reason, it would cause an immediate suspension of the User’s account until the payment is made Moreover, failure to make the aforementioned payment after been notified shall entitle the Partner to take legal action(s) against the User.
                                                                    6.2 যে ক্ষেত্রে পণ্য/পণ্যের জন্য অর্থপ্রদান এবং এর সাথে সম্পর্কিত বা আনুষঙ্গিক চার্জ ব্যবহারকারীর দ্বারা করা হয় না সেক্ষেত্রে অর্থপ্রদানে ব্যর্থ হলে অংশীদাররা এই বিষয়ে Fabric Lagbe -এর কাছে অভিযোগ দায়ের করবেন। ব্যবহারকারী যদি একটি বৈধ এবং ন্যায়সঙ্গত কারণ প্রদান করতে ব্যর্থ হয়, তাহলে অর্থপ্রদান না করা পর্যন্ত এটি ব্যবহারকারীর অ্যাকাউন্ট অবিলম্বে স্থগিত করে দেবে, অধিকন্তু বিজ্ঞাপিত হওয়ার পরে উল্লিখিত অর্থপ্রদান করতে ব্যর্থ হলে অংশীদারের বিরুদ্ধে আইনি ব্যবস্থা নেওয়ার অধিকারী হবে ব্যবহারকারী।
                                                                    ARTICLE 7 – OBLIGATIONS OF THE USER AND OF FABRIC LAGBE
                                                                    অনুচ্ছেদ 7 - ব্যবহারকারীর এবং Fabric Lagbe -এর বাধ্যবাধকতা
                                                                    7.1 User’s Obligations the User under this contract shall be legally and financially responsible for all requests for all GOODS/PRODUCTS under this contract. The User shall ensure the security of the login details and in case if any doubt arises as to committal of any fraud with respect to his/her login details, the User shall immediately file an Application to change the login details.
                                                                    7.1 ব্যবহারকারীর বাধ্যবাধকতা এই চুক্তির অধীনে ব্যবহারকারী এই চুক্তির অধীনে সমস্ত পণ্য/পণ্যের জন্য সমস্ত অনুরোধের জন্য আইনগত এবং আর্থিকভাবে দায়ী থাকবে৷ ব্যবহারকারী লগইন বিশদগুলির নিরাপত্তা নিশ্চিত করবে এবং যদি তার লগইন বিশদ সম্পর্কিত কোনও প্রতারণার বিষয়ে কোনও সন্দেহ দেখা দেয় তবে ব্যবহারকারী অবিলম্বে লগইন বিশদ পরিবর্তনের জন্য একটি আবেদন দায়ের করবেন।
                                                                    7.2 Fabric Lagbe Obligations Fabric Lagbe responsibility is limited to manage for a Partner who will in turn manage and send the goods /products to the User at the stated address of the User. Thus, Fabric Lagbe shall make its best efforts to meet the demand of the User as soon as possible. The execution of the GOODS/PRDUCTS service is the sole responsibility of the Partner. Fabric Lagbe cannot be held responsible in case of unavailability of the Goods/products or any inaction by the Partner(s). In case of delay or non-performance by the Partner, Fabric Lagbe shall not be held responsible. Similarly, Fabric Lagbe will not be held responsible for no execution of the goods/products service in cases of force majeure or in cases where such non-performance is linked to a situation beyond the control of Fabric Lagbe or in case of any error with respect to computer and / or telecommunications networks (Internet, mobile phones,) Government rolls, introduction, obligation or in case of strike, demonstration, weather, serious traffic accident disrupting the regular flow of traffic to unusually large degrees. Fabric Lagbe is also not responsible for:
                                                                    (i) Losses and/or damage caused by any breach of the Partner(s).
                                                                    (ii) The actions or inactions of any Partners.
                                                                    (iii) The actions or inactions of other Users.
                                                                    (iv) Indirect losses which mean losses and/or damage where Fabric Lagbe and User could not have reasonably anticipated that type of loss and/or damage arising at the time the relevant goods/services services provided to the User.
                                                                    7.2 Fabric Lagbe -এর বাধ্যবাধকতা Fabric Lagbe -এর দায়িত্ব একজন অংশীদারের জন্য পরিচালনা করার জন্য সীমিত যে ব্যবহারকারীর উল্লেখিত ঠিকানায় ব্যবহারকারীর কাছে পণ্য/পণ্যগুলি পরিচালনা করবে এবং পাঠাবে৷ এইভাবে, Fabric Lagbe যত তাড়াতাড়ি সম্ভব ব্যবহারকারীর চাহিদা মেটাতে সর্বাত্মক প্রচেষ্টা চালাবে। GOODS/PRDUCTS পরিষেবা সম্পাদন করা অংশীদারের একমাত্র দায়িত্ব৷ পণ্য/পণ্যের অনুপলব্ধতা বা অংশীদার(দের) দ্বারা কোনো নিষ্ক্রিয়তার ক্ষেত্রে Fabric Lagbe কে দায়ী করা যাবে না। অংশীদার দ্বারা বিলম্ব বা অ-পারফরম্যান্সের ক্ষেত্রে, Fabric Lagbe দায়ী থাকবে না। একইভাবে, এনটিআইএল-কে বলপ্রয়োগের ক্ষেত্রে পণ্য পরিষেবার কোনো সঞ্চালনের জন্য দায়ী করা হবে না বা যেখানে এই ধরনের অ-পারফরম্যান্স এনটিআইএল-এর নিয়ন্ত্রণের বাইরের পরিস্থিতির সাথে যুক্ত বা কম্পিউটারের ক্ষেত্রে কোনো ত্রুটির ক্ষেত্রে। এবং/অথবা টেলিকমিউনিকেশন নেটওয়ার্ক (ইন্টারনেট, মোবাইল ফোন) সরকারের রোল, ভূমিকা, বাধ্যবাধকতা বা ধর্মঘট, বিক্ষোভ, আবহাওয়া, গুরুতর ট্রাফিক দুর্ঘটনার ক্ষেত্রে ট্রাফিকের নিয়মিত প্রবাহকে অস্বাভাবিকভাবে বড় মাত্রায় ব্যাহত করে। Fabric Lagbe এর জন্যও দায়ী নয়:
                                                                    (i) অংশীদারদের লঙ্ঘনের কারণে ক্ষতি 
                                                                    (ii) কোনো অংশীদারের কর্ম বা নিষ্ক্রিয়তা।
                                                                    (iii) অন্যান্য ব্যবহারকারীদের কর্ম বা নিষ্ক্রিয়তা।
                                                                    (iv) পরোক্ষ ক্ষতি যার অর্থ যেখানে Fabric Lagbe এবং ব্যবহারকারী যুক্তিসঙ্গতভাবে অনুমান করতে পারেনি যে ব্যবহারকারীকে দেওয়া প্রাসঙ্গিক পণ্য পরিষেবাগুলির সময়ে ক্ষতি হতে পারে।
                                                                    ARTICLE 8 – TERMINATION OF SERVICE Fabric Lagbe
                                                                    অনুচ্ছেদ 8 - Fabric Lagbe পরিষেবার সমাপ্তি
                                                                    shall be entitled to terminate the User’s registration without notice to the User in case of any non-compliance or failure to comply with any terms and conditions arising out of this contract including; in the event of failure to comply with articles 2 and 3 as stated above, inappropriate behavior by the User with the Partner(s) or the Partners deligate , in the case of two successive cancellations of Orders, the Order motive found to be illegal or where criminal charges can be brought against the User or in any other cases where Fabric Lagbe considers appropriate to terminate the User’s registration. The contract shall cease to exist in the event of failure of the Service or of the Application or if the User does not accept a new version of the General Terms and Conditions and / or 1.1 (changing general terms and conditions).
                                                                    কোন অ-সম্মতি বা এই চুক্তির ফলে উদ্ভূত কোন শর্তাবলী মেনে চলতে ব্যর্থতার ক্ষেত্রে ব্যবহারকারীকে নোটিশ ছাড়াই ব্যবহারকারীর নিবন্ধন বন্ধ করার অধিকারী হবে; উপরে উল্লিখিত অনুচ্ছেদ 2 এবং 3 মেনে চলতে ব্যর্থ হওয়ার ক্ষেত্রে, অংশীদার বা অংশীদারদের প্রতিনিধিদের সাথে ব্যবহারকারীর অনুপযুক্ত আচরণ, দুটি পরপর আদেশ বাতিলের ক্ষেত্রে, আদেশের উদ্দেশ্যটি অবৈধ বা যেখানে ব্যবহারকারীর বিরুদ্ধে ফৌজদারি অভিযোগ আনা যেতে পারে বা অন্য কোনো ক্ষেত্রে যেখানে Fabric Lagbe ব্যবহারকারীর নিবন্ধন বন্ধ করা উপযুক্ত বলে মনে করে। পরিষেবা বা অ্যাপ্লিকেশনের ব্যর্থতার ক্ষেত্রে বা ব্যবহারকারী সাধারণ শর্তাবলী এবং / অথবা 1.1 (সাধারণ শর্তাবলী পরিবর্তন) এর একটি নতুন সংস্করণ গ্রহণ না করলে চুক্তিটির অস্তিত্ব বন্ধ হয়ে যাবে।
                                                                     ARTICLE 9 – PRIVACY AND DATA PROTECTION ACT
                                                                    অনুচ্ছেদ 9 - গোপনীয়তা এবং ডেটা সুরক্ষা আইন
                                                                    The information of the User obtained by Fabric Lagbe is subject to data processing intended for the implementation of the Service. This information is required in order to process requests for Goods/products service and for records. Security measures preserving confidentiality shall be implemented by Fabric Lagbe. The User accepts without any reservation that Fabric Lagbe and the Partner reserve the right to retain , all information relating to requests received, the identification data of the User and all completed Goods/products (including phone number, name and address, email address, details of the product, quality, Quantity, payment ,delivery ,test requirement and Transport) and Fabric Lagbe may use personal data to contact the User by email, sms, push notification, or any other means concerning commercial offers or regarding any matter related to the service that may be of interest or as required. Fabric Lagbe newsletters/promotions/offers that will be sent to the User will include an unsubscribe link which may assist the User to withdraw from the list. When contacting for any request, the User shall mention their name and mobile phone number and enclose a copy of their ID: by -mail: by post: by telephone
                                                                    Fabric Lagbe দ্বারা প্রাপ্ত ব্যবহারকারীর তথ্য পরিষেবার বাস্তবায়নের উদ্দেশ্যে ডেটা প্রসেসিং সাপেক্ষে। পণ্য পরিষেবা এবং রেকর্ডের জন্য অনুরোধগুলি প্রক্রিয়া করার জন্য এই তথ্যটি প্রয়োজন। গোপনীয়তা রক্ষাকারী নিরাপত্তা ব্যবস্থা Fabric Lagbe দ্বারা প্রয়োগ করা হবে। ব্যবহারকারী কোন রিজার্ভেশন ছাড়াই স্বীকার করে যে Fabric Lagbe এবং অংশীদার প্রাপ্ত অনুরোধ সম্পর্কিত সমস্ত তথ্য, ব্যবহারকারীর সনাক্তকরণ ডেটা এবং সমস্ত সম্পূর্ণ পণ্য (ফোন নম্বর, নাম এবং ঠিকানা, ইমেল ঠিকানা, বিশদ বিবরণ সহ) ধরে রাখার অধিকার সংরক্ষণ করে পণ্য, গুণমান, পরিমাণ, অর্থপ্রদান, ডেলিভারি, পরীক্ষার প্রয়োজনীয়তা এবং পরিবহন) এবং এনটিআইএল ব্যবহারকারীর সাথে ইমেল, এসএমএস, পুশ নোটিফিকেশন বা বাণিজ্যিক অফার বা পরিষেবার সাথে সম্পর্কিত যে কোনও বিষয়ে অন্য কোনও মাধ্যমে যোগাযোগ করতে ব্যক্তিগত ডেটা ব্যবহার করতে পারে আগ্রহ বা প্রয়োজন হিসাবে হতে পারে। Fabric Lagbe নিউজলেটার/প্রচার/অফার যা ব্যবহারকারীকে পাঠানো হবে তাতে একটি আনসাবস্ক্রাইব লিঙ্ক থাকবে যা ব্যবহারকারীকে তালিকা থেকে প্রত্যাহার করতে সহায়তা করতে পারে। কোনো অনুরোধের জন্য যোগাযোগ করার সময়, ব্যবহারকারীকে তাদের নাম এবং মোবাইল ফোন নম্বর উল্লেখ করতে হবে এবং তাদের আইডির একটি অনুলিপি সংযুক্ত করতে হবে: -মেইলে: ডাকযোগে, টেলিফোনে
                                                                    ARTICLE 10 – SPECIFIC PROVISIONS FOR THE LINKING BY THE SMARTPHONE/TABLET/WEB-BASED APPLICATION
                                                                    আর্টিকেল 10 - স্মার্টফোন/ট্যাবলেট/ওয়েব-ভিত্তিক অ্যাপ্লিকেশন দ্বারা লিঙ্ক করার জন্য নির্দিষ্ট বিধান
                                                                    10.1 Cookie the User agrees that Fabric Lagbe may be required to implement “cookies” with a view to identify the User during the period when the User is active on the website. This cookie shall remain active unless the User has not left the website.
                                                                    10.1 কুকি ব্যবহারকারী সম্মত হন যে Fabric Lagbe -কে "কুকিজ" প্রয়োগ করার প্রয়োজন হতে পারে যাতে ব্যবহারকারী ওয়েবসাইটটিতে সক্রিয় থাকাকালীন সময়ে ব্যবহারকারীকে সনাক্ত করতে পারে। এই কুকি সক্রিয় থাকবে যদি না ব্যবহারকারী ওয়েবসাইটটি ছেড়ে না যায়।
                                                                    10.2 Service Availability The online order service is available at all times and throughout the year. Unless there is any operating constraints or any kind of technical error or any situation beyond the control of Fabric Lagbe.
                                                                    10.2 পরিষেবার প্রাপ্যতা অনলাইন অর্ডার পরিষেবা সব সময়ে এবং সারা বছর পাওয়া যায়। যদি না কোনো অপারেটিং সীমাবদ্ধতা বা কোনো ধরনের প্রযুক্তিগত ত্রুটি বা Fabric Lagbe -এর নিয়ন্ত্রণের বাইরে কোনো পরিস্থিতি না থাকে।
                                                                    10.3 Intellectual Property (IP) Fabric Lagbe is entitled to all the IP rights of the Applications including graphics, pictures, logos, databases, programs, tools at all times. All other elements not belonging to Fabric Lagbe continue to remain the property of its Partner(s) (including logos provided by Partner(s) and published on the site and in the Application.) Any modification or use of brands, illustrations, images, logos, databases, programs tools with respect to the Applications for any reason and on any medium whatsoever without Fabric Lagbe’s prior written consent is strictly prohibited.
                                                                    10.3 ইন্টেলেকচুয়াল প্রপার্টি (IP) Fabric Lagbe সব সময়ে গ্রাফিক্স, ছবি, লোগো, ডাটাবেস, প্রোগ্রাম, টুলস সহ অ্যাপ্লিকেশনগুলির সমস্ত আইটি অধিকারের অধিকারী৷ অন্যান্য সমস্ত উপাদান যা Fabric Lagbe -এর অন্তর্গত নয় তার অংশীদার(গুলি) এর সম্পত্তি হিসাবে রয়ে যায় (অংশীদার(গুলি) দ্বারা প্রদত্ত লোগো সহ এবং সাইটে এবং অ্যাপ্লিকেশনে প্রকাশিত।) ব্র্যান্ড, চিত্র, ছবি, লোগোগুলির কোনও পরিবর্তন বা ব্যবহার , এনটিআইএল-এর পূর্ব লিখিত সম্মতি ব্যতীত যেকোন কারণে এবং যেকোন মাধ্যমে অ্যাপ্লিকেশনের ক্ষেত্রে ডেটাবেস, প্রোগ্রাম টুল কঠোরভাবে নিষিদ্ধ।
                                                                    ARTICLE 11– PERFORMANCE RATINGS 
                                                                    আর্টিকেল 11- পারফরমেন্স রেটিং
                                                                    There will be a rating system in the application for the User whereby they can rate and comment on Partner(s) in accordance to their services provided, behavior, payment and any other pertinent factor. There shall be privileges for better ratings from time to time as introduced by Fabric Lagbe. Similarly, the Partner can rate and comment on User’s on factors related with the service.
                                                                    ব্যবহারকারীর জন্য অ্যাপ্লিকেশনটিতে একটি রেটিং সিস্টেম থাকবে যার মাধ্যমে তারা তাদের প্রদত্ত পরিষেবা, আচরণ, অর্থপ্রদান এবং অন্য কোনও প্রাসঙ্গিক কারণ অনুসারে অংশীদারদের রেট দিতে এবং মন্তব্য করতে পারে। Fabric Lagbe দ্বারা প্রবর্তিত সময়ে সময়ে ভাল রেটিং এর জন্য বিশেষাধিকার থাকবে। একইভাবে, অংশীদার পরিষেবার সাথে সম্পর্কিত বিষয়গুলিতে ব্যবহারকারীদের রেট দিতে এবং মন্তব্য করতে পারে।
                                                                    ARTICLE 12 – CHANGES TO THE GENERAL CONDITIONS FLL
                                                                    অনুচ্ছেদ 12 - Fabric Lagbe সাধারণ অবস্থার পরিবর্তন
                                                                    Reserves the right to modify at any time the terms and conditions contained herein with a notice to the User…. Thereafter a new Order shall be placed by the User with the acceptance of the new terms and conditions as set by Fabric Lagbe. The general conditions are those in effect at the date of use of the Service.
                                                                    ব্যবহারকারীকে একটি নোটিশ সহ এখানে থাকা শর্তাবলী যে কোনো সময় পরিবর্তন করার অধিকার সংরক্ষণ করে... তারপরে Fabric Lagbe দ্বারা সেট করা নতুন শর্তাদি মেনে নিয়ে ব্যবহারকারীর দ্বারা একটি নতুন অর্ডার দেওয়া হবে৷ সাধারণ শর্তগুলি হল পরিষেবা ব্যবহারের তারিখে কার্যকরী৷
                                                                    ARTICLE 13 – ELECTION OF RESIDENCE, APPLICABLE LAW AND JURISDICTION
                                                                    অনুচ্ছেদ 13 - বসবাসের নির্বাচন, প্রযোজ্য আইন এবং এখতিয়ার
                                                                    The User selects his address as indicated in his Fabric Lagbe account and Fabric Lagbe selects its headquarters’ address as mentioned above for notifying each other regarding any matter arising out of this contract. In case any of the parties changes their address, it shall notify the other party by registered letter with acknowledgment of receipt or by other electronic means within the next ONE AND HALF month following the change of address in order to be enforceable against the co-signing party. Only the laws of Bangladesh are applicable to the general terms and conditions contained herein. If the parties fail to reach an amicable agreement within 45 days relating to any matter arising out the general terms and conditions contained herein, the dispute shall be referred to arbitration in accordance the Arbitration Act 2001. The venue and seat for the arbitration shall take place at Dhaka, Bangladesh to be conducted by sole arbitrator to be mutually selected by the User and Fabric Lagbe. In case the User refuses to settle the matter through Arbitration or by any means available, Fabric Lagbe shall be entitled to initiate court proceedings against the User. 
                                                                    ব্যবহারকারী তার Fabric Lagbe অ্যাকাউন্টে নির্দেশিত তার ঠিকানা নির্বাচন করে এবং এই চুক্তি থেকে উদ্ভূত যে কোনও বিষয়ে একে অপরকে অবহিত করার জন্য উপরে উল্লিখিত হিসাবে Fabric Lagbe তার সদর দফতরের ঠিকানা নির্বাচন করে। যদি কোন পক্ষ তাদের ঠিকানা পরিবর্তন করে, তাহলে এটি অন্য পক্ষকে প্রাপ্তির স্বীকৃতি সহ নিবন্ধিত চিঠির মাধ্যমে বা ঠিকানা পরিবর্তনের পরের দেড় মাসের মধ্যে অন্য ইলেকট্রনিক উপায়ে অবহিত করবে যাতে সহ-স্বাক্ষর করার বিরুদ্ধে কার্যকর হতে পারে। পার্টি এখানে উল্লেখিত সাধারণ শর্তাবলীর ক্ষেত্রে শুধুমাত্র বাংলাদেশের আইন প্রযোজ্য। যদি দলগুলি এখানে অন্তর্ভুক্ত সাধারণ শর্তাদি থেকে উদ্ভূত কোন বিষয়ে 45 দিনের মধ্যে একটি বন্ধুত্বপূর্ণ চুক্তিতে পৌঁছাতে ব্যর্থ হয়, তবে বিরোধটি সালিসি আইন 2001 অনুসারে সালিসিতে পাঠানো হবে৷ সালিশির স্থান এবং আসন হবে৷ ঢাকা, বাংলাদেশ-এ ব্যবহারকারী এবং এফ এল এল দ্বারা পারস্পরিকভাবে নির্বাচিত একমাত্র সালিস দ্বারা পরিচালিত হবে। যদি ব্যবহারকারী সালিসের মাধ্যমে বা উপলব্ধ কোনো উপায়ে বিষয়টি নিষ্পত্তি করতে অস্বীকার করেন, Fabric Lagbe ব্যবহারকারীর বিরুদ্ধে আদালতের কার্যক্রম শুরু করার অধিকারী হবে।
                                                                    ARTICLE 14 - According to the rules of Bangladesh government, the seller has to bear the VAT and tax on the goods sold through Fabric Lagbe apps. If the seller does not pay VAT and tax on the goods sold as per the rules of Bangladesh Government, the app will not take the liability.
                                                                    আর্টিকেল 14 - বাংলাদেশ সরকারের নিয়ম অনুযায়ী, বিক্রেতাকে ফ্যাব্রিক লাগবে অ্যাপের মাধ্যমে বিক্রি করা পণ্যের উপর ভ্যাট এবং ট্যাক্স বহন করতে হবে। বাংলাদেশ সরকারের নিয়মানুযায়ী বিক্রয়কৃত পণ্যের উপর বিক্রেতা ভ্যাট ও কর পরিশোধ না করলে অ্যাপটি দায় নেবে না।
                                                                    Article 15 - Legal Disputes: 13.
                                                                    13. 1.Legal issues: If anyone have anything issues related FLL services, relation, comments, or others any dissatisfaction issues firstly users have to complain to the FLL head office as shown website email address and within 7 working days will try to solve the issues .Before complain or request to FLL user complain to any government legal department will not be consider the complaint and FLL will not liable for this complain. 
                                                                    15.1:
                                                                    If a dispute arises between you and Fabric Lagbe authority, our goal is to provide you with a neutral and cost effective means of resolving the dispute quickly. Accordingly, you and 'Fabric Lagbe ' agree that we will resolve any claim or controversy at law or equity that arises out of this agreement or our services in accordance with one of the subsections below or as we and you otherwise agree in writing. Before resorting to these alternatives, we strongly encourage you to first contact us directly to seek a resolution. We will consider reasonable requests to resolve the dispute through alternative dispute resolution procedures, such as arbitration, as alternatives to litigation.
                                                                    APPLICABLE LAW AND JURISDICTION: These Terms and Conditions shall be interpreted and governed by the laws in force in Bangladesh. Subject to the Arbitration section below, each party hereby agrees to submit to the jurisdiction of the courts of Dhaka.
                                                                    ARBITRATION: Any controversy, claim or dispute arising out of or relating to these Terms and Conditions will be referred to and finally settled by private and confidential binding arbitration before a single arbitrator held in Dhaka, Bangladesh. The arbitrator shall be a person who is legally trained and who has experience in the information technology field in Dhaka and is independent of either party. Notwithstanding the foregoing, the Site reserves the right to pursue the protection of intellectual property rights and confidential information through injunctive or other equitable relief through the courts.
                                                                    </p>
                                                        
                                                                   {{-- {!! $popUp->description_bn !!} --}}
                   
                                                               </div>
                                                               <div class="font_14">
                                                                   {{-- {!! $popUp->description !!} --}}
                                                                   <h1>Privacy Policy</h1>

                                                                   <p>Privacy Policy


                                                                    Welcome to FABRICLAGBE.COM, a site managed and operated to provide complete solution to your purchasing requirements of Textile fabrics and also extended support to textile related items including dyeing materials.  Under the banner, we also associate ourselves to meet your any kind of requirement that may fall under Textile category. As our valued business counterparts, we respect and commit to maintain your privacy and want to protect your personal information pertaining to the business deal.To  have the fullest understanding, please read minutely, this “PRIVACY POLICY “.
                                                                    
                                                                    
                                                                    1) This Privacy Policy clarifies how we gather, utilize and (under specific conditions) uncover your own data.This Privacy Policy additionally clarifies the means we have taken to secure your own data. At long last, this Privacy Policy clarifies your alternatives with respect to the accumulation, utilization and divulgence of your own data. By going to the site specifically or through another site, you acknowledge the practices depicted in this Policy. We priorities maintaining confidentiality of your business and other Information that we are obliged to inasmuch as, security involves trust and your protection is essential to us.  We should, along these lines, just utilize your name and other data which are pertinent, in the way set out in this Privacy Policy. We will just gather data fundamental for us to do as such and is significant to our dealings with you. We will just keep your data for whatever length of time we are either required to by law or as is pertinent for the reasons for which it was gathered. You can visit the Site and peruse without providing individual information. Amid your visit to the site, you stay mysterious and at no time, would we be able to identify you, unless you leave a record on the site in whatever manner that might enable us to be accessible to your identity.
                                                                    2) What kind of information do we collect?
                                                                    We may gather different types of pertinent data in the event that you look to submit a request for an item with us on the site. We gather, store and process your information for handling your desired purchase on the site and any probable claims, you may make later on, and for your better communication with us.                                                           We may gather individual information/data including those not restricted to, your title, name, sex, date of birth, email address, postal address, address of convenient communication, phone numbers, mobile numbers, fax number and other required information etc. We will utilize the data you give to empower us to process your requests and will give you the information /data offered through our site and and also those ( we may lawfully part with) you  might ask for. Further, we will utilize the data you furnish to us, confirm and do monetary exchanges in connection with the deal  you make,  review the downloading of information from our site, enrich the design and/or substance of the pages of our site and modify them for the clients,  distinguish the guests on our site,  do look into on our clients' socio economics,  send you data you would find  valuable or which you have asked for from us, including data about our items and  management, so far as you have not protested our reaching there to. Subject to getting your consent, we may get in touch with you by email or any other convenient communication mode, for your points of interests. In the event you do not prefer interchanges from us, you may.  We may pass your name and deliver on to an outsider keeping in mind the end goal to make conveyance of the item to you (for instance to our messenger or provider). You should just submit to us the site data which is precise and not misleading and you should stay up with the latest and advise us of changes. Your real request points of interest that might be put away with us yet for security reasons can't be recovered specifically by us. Nonetheless, you may get to this data by signing into your record on the Site. Here you can see the points of interest of your requests that have been finished. You embrace to treat the individual access information privately and not make it accessible to unapproved outsiders. We can't accept any risk for abuse of passwords. We may utilize your own data for assessment and statistical surveying. Your points of interest are mysterious and might be utilized for factual purposes. We may send you other data about us, the Site, our different sites, our items, deals advancements, our bulletins, anything identifying with different organizations in our gathering or our business accomplices. In case you would incline towards not  getting any  extra data as point by point in this section (or any piece of it) please tap the 'withdraw' connect in any email that we send to you. Within 7 working days of receipt of your direction we will stop to send you data as asked. If your guideline is indistinct we will get in touch with you for clarification. We may assist to anonymize information about clients of the site by and large and utilize it for different purposes, including learning the general area of the clients and use of specific parts of the site or a connection contained in an email to those enlisted to get them, and providing that anonymized information to outsiders, for example, distributers. Notwithstanding, that anonymized information won't be fit for distinguishing you by and by.
                                                                    
                                                                    
                                                                    3) How does Fabriclagbe.com utilize your information?                                                    Data about our clients is an essential piece of our business, and we are not in the matter of parting it with others. We share client data just as depicted beneath and with backups FABRICLAGBE.COM, controls. .
                                                                    4) Partnered Businesses We Do Not Control:                                                            We work intimately with associated organizations. Now and again, for example, Marketplace merchants, these organizations work stores at FABRICLAGBE.COM or pitch offerings to you at FABRICLAGBE.COM. In different cases, we work stores, give administrations, or offer product offerings mutually with these organizations. You can tell when an outsider is engaged with your exchanges, and we share client data identified with those engaged outsiders.
                                                                    5) Outsider Service Providers: We utilize different organizations and people to perform works for our benefit. Illustrations incorporate satisfying requests, conveying bundles, sending postal mail and email, expelling dreary data from client records, investigating information, giving promoting help, giving list items and connections (counting paid postings and connections), handling Visa installments, and giving client benefit.
                                                                    
                                                                    
                                                                    6) Limited time Offers: Sometimes we send offers to choose gatherings of FABRICLAGBE.COM clients in the interest of different organizations. When we do this, we don't give that business your name and address.
                                                                    7) Business Transfers: As we keep on developing our business, we may offer or purchase stores, auxiliaries, or specialty units. In such exchanges, client data for the most part is one of the exchanged business resources, yet stays subject to the guarantees made in any prior Privacy Notice (unless, obviously, the client assents generally). Additionally, in the improbable occasion that FABRICLAGBE.COM, or generously the greater part of its advantages is gained, client data will obviously be one of the exchanged resources.
                                                                    8) Ensuring of FABRICLAGBE.COM  and Others:                                                       We discharge account and other individual data when we trust discharge is fitting to consent to the law; uphold or apply our Conditions of Use and different assertions; or ensure the rights, property, or wellbeing of FABRICLAGBE.COM, our clients, or others. This incorporates trading data with different organizations and associations for extortion assurance and credit hazard decrease. Clearly, be that as it may, this does exclude offering, leasing, sharing, or generally revealing actually identifiable data from clients for business purposes infringing upon the duties put forward in this Privacy policy.
                                                                    With Your Consent:  Other than as set out above, you will get to see when data about you may go to outsiders, and you will have a chance to pick not to share the data.
                                                                    
                                                                    Legal Disputes: 13.
                                                                    13. 1.Legal issues: If anyone have anything issues related FLL services, relation, comments, or others any dissatisfaction issues firstly users have to complain to the FLL head office as shown website email address and within 7 working days will try to solve the issues .Before complain or request to FLL user complain to any government legal department will not be consider the complaint and FLL will not liable for this complain. 
                                                                    13.2:
                                                                    If a dispute arises between you and Fabric Lagbe authority, our goal is to provide you with a neutral and cost effective means of resolving the dispute quickly. Accordingly, you and 'Fabric Lagbe ' agree that we will resolve any claim or controversy at law or equity that arises out of this agreement or our services in accordance with one of the subsections below or as we and you otherwise agree in writing. Before resorting to these alternatives, we strongly encourage you to first contact us directly to seek a resolution. We will consider reasonable requests to resolve the dispute through alternative dispute resolution procedures, such as arbitration, as alternatives to litigation.
                                                                    APPLICABLE LAW AND JURISDICTION: These Terms and Conditions shall be interpreted and governed by the laws in force in Bangladesh. Subject to the Arbitration section below, each party hereby agrees to submit to the jurisdiction of the courts of Dhaka.
                                                                    ARBITRATION: Any controversy, claim or dispute arising out of or relating to these Terms and Conditions will be referred to and finally settled by private and confidential binding arbitration before a single arbitrator held in Dhaka, Bangladesh. The arbitrator shall be a person who is legally trained and who has experience in the information technology field in Dhaka and is independent of either party. Notwithstanding the foregoing, the Site reserves the right to pursue the protection of intellectual property rights and confidential information through injunctive or other equitable relief through the courts.
                                                                    
                                                                    </p>
                   
                                                               </div>
                                                           </div>
                                                          
                                                       </div>
                                                       <div class="modal-footer">

                                                        <input type="checkbox" id="agreeCheckbox"> I agree to the terms and conditions
                                                           
                   
                                                        <button type="submit" class="btn btn-success" id="registerBtn" disabled>Register</button>
                                                           <button type="button" class="btn btn-success"
                                                               data-bs-dismiss="modal">@lang('website.Close')</button>
                   
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                               {{-- modal for terms and conditions --}}
                                    </form>
                                    <div class="dc-registerformfooter text-center">
                                        <span>@lang('website.Already Have an Account?') <a href="{{route('login')}}">@lang('website.Login Now')</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




@endsection
@push('js')
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        
        $(document).ready(function () {

            $('#gender').hide();
            $('.demo-select2').select2();

            var segment = $('#segment').val();
            // alert(segment);
            if(segment == 'employee'){

                $('#seller_form').html('');
                $('#gender').show();
                $('#buyer_selected_category').hide();
                $('#buyer_categories').html('');

            }else if(segment == 'employer' || segment == 'seller2'){
                $('#employee_form').html('');
                $('#gender').hide();
                $('#buyer_selected_category').hide();
                $('#buyer_categories').html(null);
                var user_type = $('#seller').val();
                $.post('{{ route('get_seller_form') }}',{_token:'{{ csrf_token() }}', user_type:user_type}, function(data){
                    $('#seller_form').html(data);
                    $('#category_area').hide()
                    var email = $("#email").val();
                    //console.log(email);
                    $('#company_email').val(email);
                    var phone = $("#phone1").val();
                    //console.log(phone);
                    $('#company_phone').val(phone);

                    var countyCodePrefix1 = $(".flag-container").find('.selected-dial-code').html();
                    if(countyCodePrefix1 != '+880'){
                        alert(countyCodePrefix1);
                        $("#division_area").hide();
                        $("#district_area").hide();
                        $("#email_1").addClass('d-none');
                        $("#email_2").removeClass('d-none');
                    }else{
                        $("#division_area").show();
                        $("#district_area").show();
                    }
                });
            }
        });


        // for checkbox of terms and condisions
        $(document).ready(function() {
        // Get references to the checkbox and register button
        var $checkbox = $('#agreeCheckbox');
        var $registerBtn = $('#registerBtn');

        // Add a click event listener to the checkbox
        $checkbox.on('click', function() {
            // If the checkbox is checked, enable the "Register" button
            if ($checkbox.prop('checked')) {
                $registerBtn.prop('disabled', false);
            } else {
                // Otherwise, disable the "Register" button
                $registerBtn.prop('disabled', true);
            }
        });
    });
    // for checkbox of terms and condisions ends

        $(function () {
            $("input[name='user_type']").click(function () {
                if ($("#buyer").is(":checked")) {
                    location.reload();
                    $('#seller_form').html(null);
                    $('#employee_form').html('');
                    // $('#buyer_selected_category').show();
                    $('#gender').hide();
                    $('#seller_categories').html(null);
                    $('#buyer_categories').html('');
                    $('#buyer_categories').html(`@include('frontend.includes.buyer_categories_html')`);

                } else if($("#seller").is(":checked"))  {
                    $('#employee_form').html('');
                    $('#gender').hide();
                    // $('#buyer_selected_category').hide();
                    $('#buyer_categories').html(null);


                    var user_type = $('#seller').val();
                    $.post('{{ route('get_seller_form') }}',{_token:'{{ csrf_token() }}', user_type:user_type}, function(data){
                        $('#seller_form').html(data);
                        var email = $("#email").val();
                        //console.log(email);
                        $('#company_email').val(email);
                        var phone = $("#phone1").val();
                        //console.log(phone);
                        $('#company_phone').val(phone);

                        var countyCodePrefix1 = $(".flag-container").find('.selected-dial-code').html();
                        if(countyCodePrefix1 != '+880'){
                            alert(countyCodePrefix1);
                            $("#division_area").hide();
                            $("#district_area").hide();
                            $("#email_1").addClass('d-none');
                            $("#email_2").removeClass('d-none');
                        }else{
                            $("#division_area").show();
                            $("#district_area").show();
                        }
                    });
                }else if($("#employee").is(":checked")) {
                    $('#seller_form').html('');
                    $('#gender').show();
                    $('#buyer_selected_category').hide();
                    $('#buyer_categories').html(null);
                    var user_type = $('#employee').val();
                    $.post('{{ route('get_employee_form') }}',{_token:'{{ csrf_token() }}', user_type:user_type}, function(data){
                        $('#employee_form').html(data);
                    });

                }else{
                    console.log('others');
                }
            });
        });
    </script>

    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    {{--this section for custom js, only for this page--}}
    <script>
        var telInput = $("#phone"),
            errorMsg = $("#error-msg"),
            validMsg = $("#valid-msg");

        // initialise plugin
        telInput.intlTelInput({

            allowExtensions: true,
            formatOnDisplay: true,
            autoFormat: true,
            autoHideDialCode: true,
            autoPlaceholder: true,
            defaultCountry: "auto",
            ipinfoToken: "yolo",

            nationalMode: false,
            numberType: "MOBILE",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            preferredCountries: ['bn', 'sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
            preventInvalidNumbers: true,
            separateDialCode: true,
            initialCountry: "auto",

            geoIpLookup: function (callback) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    console.log(resp);
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    //console.log(countryCode);
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
        });
        var reset = function () {
            telInput.removeClass("error");
            errorMsg.addClass("hide");
            validMsg.addClass("hide");
        };

        // on blur: validate
        telInput.blur(function () {
            var countyCodePrefix = $(".flag-container").find('.selected-dial-code').html();
            $("#countyCodePrefix").val(countyCodePrefix);
            // console.log(countyCodePrefix);
            //console.log(telInput)
            var phone = $("#phone1").val();
            console.log(phone);

            reset();
            if ($.trim(telInput.val())) {
                if (telInput.intlTelInput("isValidNumber")) {
                    validMsg.removeClass("hide");
                } else {
                    telInput.addClass("error");
                    errorMsg.removeClass("hide");
                }
            }
        });

        // on keyup / change flag: reset
        telInput.on("keyup change", reset);



        //For register


        var telInput1 = $("#phone1"),
            errorMsg1 = $("#error-msg1"),
            errorMsg2 = $("#error-msg2"),
            validMsg1 = $("#valid-msg1");

        telInput1.intlTelInput({

            allowExtensions: true,
            formatOnDisplay: true,
            autoFormat: true,
            autoHideDialCode: true,
            autoPlaceholder: true,
            defaultCountry: "auto",
            ipinfoToken: "yolo",

            nationalMode: false,
            numberType: "MOBILE",

            preferredCountries: ['bn', 'sa', 'ae', 'qa', 'om', 'bh', 'kw', 'ma'],
            preventInvalidNumbers: true,
            separateDialCode: true,
            initialCountry: "auto",

            geoIpLookup: function (callback) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    console.log(resp);
                    var countryCode = (resp && resp.country) ? resp.country : "";

                    callback(countryCode);


                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"

        });

        var reset = function () {
            telInput1.removeClass("error");
            errorMsg1.addClass("hide");
            validMsg1.addClass("hide");
        };

        // telInput1.click(function () {
        //     alert('hiiigiif')
        //     var countyCodePrefix1 = $(".flag-container").find('.selected-dial-code').html();
        //     if(countyCodePrefix1 != '+880') {
        //         $("#email_1").addClass('d-none');
        //         $("#email_2").removeClass('d-none');
        //     }
        // });
        telInput1.blur(function () {
            var countyCodePrefix1 = $(".flag-container").find('.selected-dial-code').html();
            console.log(countyCodePrefix1)
            if(countyCodePrefix1 != '+880'){
                // alert(countyCodePrefix1);
                $("#division_area").hide();
                $("#district_area").hide();
                $("#email").prop('required',true);
                $("#emailLebel").html("<label>@lang('website.Email')&nbsp;  (@lang('website.Required')) <span class='required'>*</span> </label>");

            }else{
                $("#division_area").show();
                $("#district_area").show();
                $("#emailLebel").html("<label>@lang('website.Email')&nbsp;  (@lang('website.Optional')) </label>");
                $("#email").prop('required',false);

            }
            var phone_val = $('.phone_val').val();
            console.log(phone_val);
            $.post('{{ route('check_user_phone') }}',{_token:'{{ csrf_token() }}', phone_val:phone_val}, function(data){
                // console.log(data);
                if(data == 1){
                    toastr.warning('This phone number already exist!');
                }
            });

            $("#countyCodePrefix1").val(countyCodePrefix1);

            reset();
            if ($.trim(telInput1.val())) {
                if (telInput1.intlTelInput("isValidNumber")) {
                    validMsg1.removeClass("hide");
                } else {
                    telInput1.addClass("error");
                    errorMsg1.removeClass("hide");
                }
            }
        });


        telInput1.on("keyup change", reset);

        $(".toggle-password1").click(function() {
            $('#test1').toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".toggle-password2").click(function() {
            $('#test2').toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $("#nid_front").spartanMultiImagePicker({
            fieldName: 'nid_front',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '5000000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 500kb');
            },
            onAddRow:function(index){
                var altData = '<input type="text" placeholder="" name="nid[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $("#nid_back").spartanMultiImagePicker({
            fieldName: 'nid_back',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '5000000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 500kb');
            },

            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
    </script>
    <script>
        $("#buyer_category_2").hide()
        $("#buyer_category_3").hide()
        $("#buyer_category_4").hide()
        $("#buyer_category_5").hide()
        $("#buyer_category_6").hide()
        $("#buyer_category_7").hide()
        $("#buyer_category_8").hide()
        $("#buyer_category_9").hide()
        $("#buyer_category_10").hide()
        // Get BN EN Name
        function getNameBnEn($name,$name_bn){
            var lang = $('#lang').val();
            var curr_lang = '';
            if(lang === 'en'){
                curr_lang = $name;
            }else{
                curr_lang = $name_bn ? $name_bn : $name;
            }
            return curr_lang;
        }
        // $(document).ready(function () {

        $('#category_id').on('change', function () {

            $("#buyer_category_2").show()
            $("#buyer_category_3").hide()
            $("#buyer_category_4").hide()
            $("#buyer_category_5").hide()
            $("#buyer_category_6").hide()
            $("#buyer_category_7").hide()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_2();

        });
        $('#sub_category_id').on('change', function () {
            $("#buyer_category_3").show()
            $("#buyer_category_4").hide()
            $("#buyer_category_5").hide()
            $("#buyer_category_6").hide()
            $("#buyer_category_7").hide()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_3();

        });
        $('#sub_sub_category_id').on('change', function () {
            $("#buyer_category_4").show()
            $("#buyer_category_5").hide()
            $("#buyer_category_6").hide()
            $("#buyer_category_7").hide()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_4();

        });
        $('#sub_sub_child_category_id').on('change', function () {
            $("#buyer_category_5").show()
            $("#buyer_category_6").hide()
            $("#buyer_category_7").hide()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_5();
        });
        $('#sub_sub_child_child_category_id').on('change', function () {

            $("#buyer_category_6").show()
            $("#buyer_category_7").hide()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_6();
        });
        $('#category_six_id').on('change', function () {
            $("#buyer_category_7").show()
            $("#buyer_category_8").hide()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_7();
        });
        $('#category_seven_id').on('change', function () {
            $("#buyer_category_8").show()
            $("#buyer_category_9").hide()
            $("#buyer_category_10").hide()
            get_category_8();
        });
        $('#category_eight_id').on('change', function () {
            $("#buyer_category_9").show()
            $("#buyer_category_10").hide()
            get_category_9();
        });
        $('#category_nine_id').on('change', function () {
            $("#buyer_category_10").show()
            get_category_10();
        });
        function get_category_2() {
            var category_id = $('#category_id').val();

            $.post('{{ route('products.get_subcategories_by_category') }}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                if(data.length > 0){
                    $('#sub_category_id').html(null);
                    $('#sub_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_2").hide()
                }
                get_category_3();
            });
        }
        function get_category_3() {
            var sub_category_id = $('#sub_category_id').val();
            $.post('{{ route('products.get_subsubcategories_by_subcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_category_id: sub_category_id
            }, function (data) {
                if(data.length > 0) {
                    $('#sub_sub_category_id').html(null);
                    $('#sub_sub_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_3").hide()
                }
                get_category_4();
            });
        }
        function get_category_4() {
            var sub_sub_category_id = $('#sub_sub_category_id').val();

            $.post('{{ route('products.get_subsubchildcategories_by_subsubcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_category_id: sub_sub_category_id
            }, function (data) {

                if(data.length > 0) {
                    $('#sub_sub_child_category_id').html(null);
                    $('#sub_sub_child_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_child_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_4").hide()
                }
                get_category_5();

            });
        }
        function get_category_5() {
            var sub_sub_child_category_id = $('#sub_sub_child_category_id').val();
            $.post('{{ route('products.get_subsubchildchildcategories_by_subsubchildcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_child_category_id: sub_sub_child_category_id
            }, function (data) {
                if(data.length > 0) {
                    $('#sub_sub_child_child_category_id').html(null);
                    $('#sub_sub_child_child_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_child_child_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_5").hide()
                }
                get_category_6();

            });
        }
        function get_category_6() {
            var sub_sub_child_child_category_id = $('#sub_sub_child_child_category_id').val();
            $.post('{{ route('products.get_category_six') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_child_child_category_id: sub_sub_child_child_category_id
            }, function (data) {
                //console.log(data)
                if(data.length > 0) {
                    $('#category_six_id').html(null);
                    $('#category_six_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_six_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_6").hide()
                }
                get_category_7();

            });
        }
        function get_category_7() {
            var category_six_id = $('#category_six_id').val();
            $.post('{{ route('products.get_category_seven') }}', {
                _token: '{{ csrf_token() }}',
                category_six_id: category_six_id
            }, function (data) {
                //console.log(data)
                if(data.length > 0) {
                    $('#category_seven_id').html(null);
                    $('#category_seven_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_seven_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_7").hide()
                }
                get_category_8();
            });
        }
        function get_category_8() {
            var category_seven_id = $('#category_seven_id').val();
            $.post('{{ route('products.get_category_eight') }}', {
                _token: '{{ csrf_token() }}',
                category_seven_id: category_seven_id
            }, function (data) {
                if(data.length > 0) {
                    $('#category_eight_id').html(null);
                    $('#category_eight_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_eight_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_8").hide()
                }
                get_category_9()
            });
        }
        function get_category_9() {
            var category_eight_id = $('#category_eight_id').val();
            $.post('{{ route('products.get_category_nine') }}', {
                _token: '{{ csrf_token() }}',
                category_eight_id: category_eight_id
            }, function (data) {
                if(data.length > 0) {
                    $('#category_nine_id').html(null);
                    $('#category_nine_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_nine_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_9").hide()
                }
                get_category_10()
            });
        }
        function get_category_10() {
            var category_nine_id = $('#category_nine_id').val();
            $.post('{{ route('products.get_category_ten') }}', {
                _token: '{{ csrf_token() }}',
                category_nine_id: category_nine_id
            }, function (data) {
                if(data.length > 0) {
                    $('#category_ten_id').html(null);
                    $('#category_ten_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_ten_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $('.demo-select2').select2();
                }else{
                    $("#buyer_category_10").hide()
                }

            });
        }
        // })
    </script>
@endpush