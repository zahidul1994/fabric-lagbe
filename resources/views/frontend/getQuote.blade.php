@extends('frontend.layouts.master')
@section('title', 'Product Create')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/product-page.css') }}">
    <style>
        .form-group {
            margin-top: 10px;
        }

        .radio_bdt {
            float: left;
            width: 15%;
        }

        .radio_usd {
            float: right;
            width: 15%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row m_t_30">
        <div class="container">
            <div class="row">

                <div class="col-lg-9">
                    <form class="woocommerce-form-login" action="{{ route('buyer.my-request.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-4">
                                        <h3 class="card-title float-left">
                                            @lang('website.Product Requests')
                                        </h3>
                                    </div>
                                    <input type="hidden" name="lang" id="lang"
                                        value="{{ app()->getLocale('locale') }}">
                                    <div class="radio_bdt">
                                        <input type="radio" name="payment_with" value="BDT" id="bdt"
                                            class="CurrencyChange" onchange="currency_changed(this)"
                                            @if (currency()->code == 'BDT') checked @endif>
                                        <label for="bdt">@lang('website.BDT')</label>
                                    </div>

                                    <div class="radio_usd">
                                        <input type="radio" name="payment_with" value="USD" id="usd"
                                            class="CurrencyChange" onchange="currency_changed(this)"
                                            @if (currency()->code == 'USD') checked @endif>
                                        <label for="usd">@lang('website.USD')</label>
                                    </div>
                                </div>
                            </div>
                            @php
                                $lang = app()->getLocale('locale');
                            @endphp
                            <div class="card-body">
                                <div class="row m-2">
                                    <div class="col-md-10">
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span class="m_l_10">@lang('website.Product Information') <span
                                                    class="required">*</span></span></h4>
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 @if ($lang !== 'en') d-none @endif">
                                                <label for="name"> Product Name <span class="required">*</span></label>
                                                <input type="text" class="form-control " name="name" id="name"
                                                    placeholder="@lang('website.Enter Product Type English')">
                                                <input type="hidden" id="slug" name="slug" class="form-control">
                                            </div>
                                            <div
                                                class="form-group col-md-12 @if ($lang !== 'bn') d-none @endif">
                                                <label for="name_bn"> @lang('website.Product Type Bangla')</label>
                                                <input type="text" class="form-control " name="name_bn" id="name_bn"
                                                    placeholder="@lang('website.Enter Product Type Bangla')">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">@lang('website.Select Category') <span
                                                    class="required">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control demo-select2"
                                                required>
                                                <option selected disabled>@lang('website.Select Product')</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ getNameByBnEn($category) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_two">
                                            <select name="sub_category_id" id="sub_category_id"
                                                class="form-control demo-select2">
                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_three">
                                            <select name="sub_sub_category_id" id="sub_sub_category_id"
                                                class="form-control demo-select2">
                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_four">
                                            <select name="sub_sub_child_category_id" id="sub_sub_child_category_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_five">
                                            <select name="sub_sub_child_child_category_id"
                                                id="sub_sub_child_child_category_id" class="form-control demo-select2">

                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_six">
                                            <select name="category_six_id" id="category_six_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_seven">
                                            <select name="category_seven_id" id="category_seven_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>

                                        <div class="form-group mt-2" id="category_eight">
                                            <select name="category_eight_id" id="category_eight_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_nine">
                                            <select name="category_nine_id" id="category_nine_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_ten">
                                            <select name="category_ten_id" id="category_ten_id"
                                                class="form-control demo-select2">

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-10 p_t_20">
                                        <!-- general form elements -->
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span class="m_l_10">@lang('website.Product Image') <span
                                                    class="required">*</span></span></h4>
                                        <div class="form-group row">
                                            <label class="control-label ml-3 col-12">@lang('website.Gallery Images') <span
                                                    class="required">*</span> <small class="text-danger">(Size: 290 *
                                                    300px)</small></label>
                                            <div class="ml-3 mr-3 col-md-9">
                                                <div class="row" id="photos"></div>
                                                <div class="row" id="photos_alt"></div>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="https://tinypng.com/" target="_blank"
                                                    class="btn btn-primary resize"><i class="fa fa-edit"></i></a>
                                                @lang('website.Resize')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10 p_t_20">
                                        <!-- general form elements -->

                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span class="m_l_10">@lang('website.Product Price Details') <span
                                                    class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label for="quantity">@lang('website.Quantity') <span
                                                    class="required">*</span></label>
                                            <input type="text" class="form-control price_summation" min="1"
                                                name="quantity" id="quantity" value=""
                                                placeholder="@lang('website.Quantity must be greater than 0')" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit_id">@lang('website.Unit') <span
                                                    class="required">*</span></label>
                                            <select name="unit_id" id="unit_id" class="form-control demo-select2"
                                                required>
                                                @foreach ($units as $unit)
                                                    <option value="{{ $unit->id }}">{{ getNameByBnEn($unit) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Currency (Active)')</label>
                                                    <input type="text" class="form-control bg-gray-light"
                                                        value="{{ currency()->code == 'BDT' ? 'BDT(৳)' : 'USD($)' }}"
                                                        required="" readonly>
                                                    <input type="hidden" name="currency_id" id="currency_id"
                                                        class="form-control" value="{{ currency()->id }}" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price') <span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001" placeholder="0"
                                                        name="unit_price" id="unit_price"
                                                        class="form-control price_summation" onkeyup="get_bid_price(this)"
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price') <span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001"
                                                        name="expected_price" class="form-control bg-gray-light"
                                                        id="expected_price" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Converted Currency')</label>
                                                    <input type="text" class="form-control bg-gray-light"
                                                        value="{{ currency()->code == 'BDT' ? 'USD($)' : 'BDT(৳)' }}"
                                                        required="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price')</label>
                                                    <input type="number" class="form-control bg-gray-light"
                                                        name="" id="bid_convert_unit_price" min="0"
                                                        step="0.00001" placeholder="" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price')</label>
                                                    <input type="number" class="form-control bg-gray-light"
                                                        name="" id="bid_convert_total_price" min="0"
                                                        step="0.00001" placeholder="" readonly required>
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="made_in">@lang('website.Made In')</label>
                                                <select name="made_in" id="made_in" class="form-control demo-select2"
                                                    required>
                                                    <option>Select</option>
                                                    @foreach (\App\Model\Countries::all() as $country_of_origin)
                                                        <option value="{{ $country_of_origin->country_name }}">
                                                            {{ $country_of_origin->country_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="form-group @if ($lang !== 'en') d-none @endif">
                                            <label for="description">@lang('website.Product Description English')<span
                                                    class="required">*</span></label>
                                            <textarea name="description" id="description" class="form-control bg-gray-light" required></textarea>
                                        </div>
                                        <div class="form-group @if ($lang !== 'bn') d-none @endif">
                                            <label for="description_bn">@lang('website.Product Description Bangla')<span
                                                    class="required">*</span></label>
                                            <textarea name="description_bn" id="description_bn" class="form-control bg-gray-light"></textarea>
                                        </div>
                                        <h2 class="mt-4">Submit as a Guest</h2>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input class="form-control bg-gray-light" type="text" id="name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control bg-gray-light" type="email" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company">Company Name</label>
                                            <input class="form-control bg-gray-light" type="text" id="company" name="company">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input class="form-control bg-gray-light" type="tel" id="phone" name="phone" required>
                                        </div>

                                        <p>Already have an account? <a href="#">Sign In</a></p>

                                       


                                    </div>


                                </div>
                            </div>
                        </div>
                        <button type="button" class="woocommerce-form-login__submit btn btn-primary rounded-0"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop2">@lang('website.Submit')</button>

                            
                            <h2>RFQ Information Table</h2>

                            <table>
                                <thead>
                                    <tr>
                                        <th>What is GAQ?</th>
                                        <th>When to post an GAQ?</th>
                                        <th>What happens after GAQ is posted?</th>
                                        <th>How long does it take to receive a response?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Get A Quotation (GAQ) in Fabric Lagbe is a system where users are able to submit their inquiry to receive verified manufacturers quotations and have Fabric Lagbe assist in finding the best production partner.</td>
                                        <td>Buyer can post GAQ every time they need to source and/or manufacture Yarn, Fabric, Knit Fabric, apparel, raw materials and accessories. GAQ can be posted while requesting price or customization on any designs from Fabric Lagbe or a buyer can submit any query that needs to be sourced or manufactured.</td>
                                        <td>After a user submits a GAQ, Fabric Lagbe algorithm look into the verified database of suppliers and matches it with the right partner. All matched suppliers can quote an offer to the query and a Key Account manager from Fabric Lagbe is always there to help the buyer in selecting the best offer.</td>
                                        <td>Typically within 48 hours after the GAQ is published, quotations starts coming. A user is notified in each steps of the action and assured to find the best fit supplier with Fabric Lagbe  Key Account Manager assistance.</td>
                                    </tr>
                                </tbody>
                            </table>

                        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="staticBackdropLabel">@lang('website.Are you sure?')
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                            $popUp = \App\Model\PopUp::where('type', 'buyer_product_entry')->first();
                                        @endphp
                                        <div style="display: {{ currency()->code == 'BDT' ? 'block' : 'none' }}">
                                            <div style="font-size: 20px">

                                                {!! $popUp->description_bn !!}
                                            </div>
                                            <div style="font-size: 14px">
                                                {!! $popUp->description !!}
                                            </div>
                                        </div>
                                        <div style="display: {{ currency()->code == 'USD' ? 'block' : 'none' }}">
                                            <div style="font-size: 20px">
                                                {!! $popUp->description !!}
                                            </div>
                                            <div style="font-size: 14px">
                                                {!! $popUp->description_bn !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success"
                                            data-bs-dismiss="modal">@lang('website.Close')</button>
                                        <button type="submit" class="btn btn-success">@lang('website.Submit')</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
    <script src="{{ asset('backend/dist/js/spartan-multi-image-picker-min.js') }}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('description');
        CKEDITOR.replace('description_bn');

        $(document).ready(function() {
            $("#category_two").hide()
            $("#category_three").hide()
            $("#category_four").hide()
            $("#category_five").hide()
            $("#category_six").hide()
            $("#category_seven").hide()
            $("#category_eight").hide()
            $("#category_nine").hide()
            $("#category_ten").hide()

            // Get BN EN Name
            function getNameBnEn($name, $name_bn) {
                var lang = $('#lang').val();
                var curr_lang = '';
                if (lang === 'en') {
                    curr_lang = $name;
                } else {
                    curr_lang = $name_bn ? $name_bn : $name;
                }
                return curr_lang;
            }

            get_subcategories();
            //title to slug make
            $("#name").keyup(function() {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{ URL('/buyer/products/slug') }}/" + name,
                    method: "get",
                    success: function(data) {
                        //console.log(data.response)
                        $('#slug').val(data.response);
                    }
                });
            })

            $(".price_summation").keyup(function() {
                var quantity = $("#quantity").val();
                var unit_price = $("#unit_price").val();
                if (quantity > 0 && unit_price > 0) {
                    var expected_price = parseFloat(quantity) * parseFloat(unit_price);
                    $('#expected_price').val(expected_price);

                    $.post('{{ route('bid.price.convert') }}', {
                            _token: '{{ csrf_token() }}',
                            bid_price: unit_price,
                            qty: quantity
                        },
                        function(data) {
                            // location.reload();
                            console.log(data);
                            $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                            $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        });
                } else {
                    $('#expected_price').val('');
                    $('#bid_convert_unit_price').val('');
                    $('#bid_convert_total_price').val('');
                }
            })

            function get_subcategories() {
                var category_id = $('#category_id').val();
                //console.log(category_id)
                $.post('{{ route('products.get_subcategories_by_category') }}', {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id
                }, function(data) {
                    if (data.length > 0) {
                        $('#sub_category_id').html(null);
                        $('#sub_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        //console.log(data)
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                            //$('.demo-select2').select2();
                        }
                    } else {
                        $("#category_two").hide()
                    }
                    get_subsubcategories();
                });
            }

            function get_subsubcategories() {
                var sub_category_id = $('#sub_category_id').val();
                console.log(sub_category_id)
                $.post('{{ route('products.get_subsubcategories_by_subcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_category_id: sub_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_category_id').html(null);
                        $('#sub_sub_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_three").hide()
                    }
                    get_sub_sub_child_categories();
                });
            }

            function get_sub_sub_child_categories() {
                var sub_sub_category_id = $('#sub_sub_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildcategories_by_subsubcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_category_id: sub_sub_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_child_category_id').html(null);
                        $('#sub_sub_child_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_child_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_four").hide()
                    }
                    get_sub_sub_child_child_categories();

                });
            }

            function get_sub_sub_child_child_categories() {
                var sub_sub_child_category_id = $('#sub_sub_child_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildchildcategories_by_subsubchildcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_category_id: sub_sub_child_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#sub_sub_child_child_category_id').html(null);
                        $('#sub_sub_child_child_category_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#sub_sub_child_child_category_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_five").hide()
                    }
                    get_category_six();

                });
            }

            function get_category_six() {
                var sub_sub_child_child_category_id = $('#sub_sub_child_child_category_id').val();
                console.log(sub_sub_child_child_category_id)
                $.post('{{ route('products.get_category_six') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_child_category_id: sub_sub_child_child_category_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_six_id').html(null);
                        $('#category_six_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_six_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_six").hide()
                    }
                    get_category_seven();

                });
            }

            function get_category_seven() {
                var category_six_id = $('#category_six_id').val();
                console.log(category_six_id)
                $.post('{{ route('products.get_category_seven') }}', {
                    _token: '{{ csrf_token() }}',
                    category_six_id: category_six_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_seven_id').html(null);
                        $('#category_seven_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_seven_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_seven").hide()
                    }
                    get_category_eight();
                });
            }

            function get_category_eight() {
                var category_seven_id = $('#category_seven_id').val();
                console.log(category_seven_id)
                $.post('{{ route('products.get_category_eight') }}', {
                    _token: '{{ csrf_token() }}',
                    category_seven_id: category_seven_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_eight_id').html(null);
                        $('#category_eight_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_eight_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_eight").hide()
                    }
                    get_category_nine()
                });
            }

            function get_category_nine() {
                var category_eight_id = $('#category_eight_id').val();
                console.log(category_eight_id)
                $.post('{{ route('products.get_category_nine') }}', {
                    _token: '{{ csrf_token() }}',
                    category_eight_id: category_eight_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_nine_id').html(null);
                        $('#category_nine_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_nine_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_nine").hide()
                    }
                    get_category_ten()
                });
            }

            function get_category_ten() {
                var category_nine_id = $('#category_nine_id').val();
                console.log(category_eight_id)
                $.post('{{ route('products.get_category_ten') }}', {
                    _token: '{{ csrf_token() }}',
                    category_nine_id: category_nine_id
                }, function(data) {
                    //console.log(data)
                    if (data.length > 0) {
                        $('#category_ten_id').html(null);
                        $('#category_ten_id').append($('<option>', {
                            value: null,
                            text: 'Select Product'
                        }));
                        for (var i = 0; i < data.length; i++) {
                            $('#category_ten_id').append($('<option>', {
                                value: data[i].id,
                                text: getNameBnEn(data[i].name, data[i].name_bn)
                            }));
                        }
                        $('.demo-select2').select2();
                    } else {
                        $("#category_ten").hide()
                    }

                });
            }

            $('#category_id').on('change', function() {
                var category_id = $('#category_id').val();
                // if(category_id == 4){
                //     toastr.warning( 'For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     // alert('For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     $('#category_id').val('');
                //     $("#category_two").hide()
                //     return false;
                // }
                if (category_id == 7) {
                    window.location.href = '{{ route('buyer.dying-product.create') }}';
                }
                if (category_id == 9) {
                    window.location.href = '{{ route('buyer.sizing-product.create') }}';
                }

                $("#category_two").show()
                $("#category_three").hide()
                $("#category_four").hide()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_subcategories();

            });
            $('#sub_category_id').on('change', function() {
                $("#category_three").show()
                $("#category_four").hide()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_subsubcategories();
            });
            $('#sub_sub_category_id').on('change', function() {
                $("#category_four").show()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_categories();
            });
            $('#sub_sub_child_category_id').on('change', function() {
                $("#category_five").show()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_child_categories();
            });
            $('#sub_sub_child_child_category_id').on('change', function() {
                $("#category_six").show()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_six();
            });
            $('#category_six_id').on('change', function() {
                $("#category_seven").show()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_seven();
            });
            $('#category_seven_id').on('change', function() {
                $("#category_eight").show()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_eight();
            });
            $('#category_eight_id').on('change', function() {
                $("#category_nine").show()
                $("#category_ten").hide()
                get_category_nine();
            });
            $('#category_nine_id').on('change', function() {
                $("#category_ten").show()
                get_category_ten();
            });

            $("#thumbnail_img").spartanMultiImagePicker({
                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '100000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function(index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function(index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 100kb');
                },
                onAddRow: function(index) {
                    var altData =
                        '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow: function(index) {
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });

            $("#photos").spartanMultiImagePicker({
                fieldName: 'photos[]',
                maxCount: 10,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '150000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function(index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function(index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 150kb');
                },
                onAddRow: function(index) {
                    var altData =
                        '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow: function(index) {
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });
        });

        function get_bid_price(el) {
            var bid_price = el.value;
            var qty = $('#quantity').val();
            if (qty == '') {
                alert('Quantity must be greater than 0')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                return false;
            }
            console.log(bid_price)
            if (qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}', {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty
                    },
                    function(data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                    });
            } else {
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
            }
        }
    </script>
@endpush
