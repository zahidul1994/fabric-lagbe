@extends('frontend.layouts.master')
@section("title","Production Capability Create")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <style>
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
        .required{
            color: red;
        }
    </style>

@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row" style="margin-top: -30px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-3">
                    <h3 class="mb-2 text-secondary">@lang('website.Manufacturer Production Capability')</h3>
                </div>
                @include('frontend.seller.work_order_sidebar')
                <div class="col-lg-9">
                    <form class="woocommerce-form-login" action="{{route('seller.work-order-products.update',$workOrderProduct->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title float-left">
                                            @lang('website.Create Factory Production Capacity')
                                        </h4>
                                    </div>
                                    <div style="float: left;width: 15%;">
                                        <input type="radio" name="payment_with" value="BDT" id="bdt" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'BDT') checked @endif>
                                        <label for="bdt">@lang('website.BDT')</label>
                                    </div>

                                    <div style="float: right;width: 15%;">
                                        <input type="radio" name="payment_with" value="USD" id="usd" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'USD') checked @endif>
                                        <label for="usd">@lang('website.USD')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row m-2">
                                    <div class="col-md-10">
                                        <div class="form-group" >
                                            <label for="wish_to_work">Wish To Work / যে ধরণের কাজ নিতে চাই<span class="required">*</span></label>
                                            <select name="wish_to_work" id="wish_to_work" class="form-control demo-select2" required>
                                                <option>@lang('website.Select')</option>
                                                <option value="Export / রপ্তানি" {{$workOrderProduct->wish_to_work == 'Export / রপ্তানি' ? 'selected':''}}>Export / রপ্তানি</option>
                                                <option value="Local / লোকাল" {{$workOrderProduct->wish_to_work == 'Local / লোকাল' ? 'selected':''}}>Local / লোকাল</option>
                                                <option value="Customize / কাস্টমাইজ" {{$workOrderProduct->wish_to_work == 'Customize / কাস্টমাইজ' ? 'selected':''}}>Customize / কাস্টমাইজ</option>
                                            </select>
                                        </div>

                                        <div class="form-group mt-2">
                                            <label for="types_of_industry">Types of Industry/ কারখানার ধরণ:<span class="required">*</span></label>
                                            <select name="types_of_industry" id="types_of_industry" class="form-control demo-select2">
                                                <option>@lang('website.Select')</option>
                                                <option value="Readymade garments/ তৈরি পোশাক" {{$workOrderProduct->types_of_industry == 'Readymade garments/ তৈরি পোশাক' ? 'selected':''}}>Readymade garments/ তৈরি পোশাক</option>
                                                <option value="Textile Industry Woven  / টেক্সটাইল ইন্ডাস্ট্রি" {{$workOrderProduct->types_of_industry == 'Textile Industry Woven  / টেক্সটাইল ইন্ডাস্ট্রি' ? 'selected':''}}>Textile Industry Woven  / টেক্সটাইল ইন্ডাস্ট্রি</option>
                                                <option value="Textile Industry knit / টেক্সটাইল ইন্ডাস্ট্রি বোনা" {{$workOrderProduct->types_of_industry == 'Textile Industry knit / টেক্সটাইল ইন্ডাস্ট্রি বোনা' ? 'selected':''}}>Textile Industry knit / টেক্সটাইল ইন্ডাস্ট্রি বোনা</option>
                                                <option value="Spinning Industries /  স্পিনিং কারখানা" {{$workOrderProduct->types_of_industry == 'Spinning Industries /  স্পিনিং কারখানা' ? 'selected':''}}>Spinning Industries /  স্পিনিং কারখানা</option>
                                                <option value="Jute Industries / জুট  কারখানা" {{$workOrderProduct->types_of_industry == 'Jute Industries / জুট  কারখানা' ? 'selected':''}}>Jute Industries / জুট  কারখানা</option>
                                                <option value="PP bag factory / পিপি ব্যাগ কারখানা" {{$workOrderProduct->types_of_industry == 'PP bag factory / পিপি ব্যাগ কারখানা' ? 'selected':''}}>PP bag factory / পিপি ব্যাগ কারখানা</option>
                                                <option value="Bag manufacturer/ ব্যাগ প্রস্তুতকারক" {{$workOrderProduct->types_of_industry == 'Bag manufacturer/ ব্যাগ প্রস্তুতকারক' ? 'selected':''}}>Bag manufacturer/ ব্যাগ প্রস্তুতকারক</option>
                                                <option value="Textile process industries/ টেক্সটাইল প্রক্রিয়া শিল্প" {{$workOrderProduct->types_of_industry == 'Textile process industries/ টেক্সটাইল প্রক্রিয়া শিল্প' ? 'selected':''}}>Textile process industries/ টেক্সটাইল প্রক্রিয়া শিল্প</option>
                                                <option value="Trims and Accessories / ট্রিমস এন্ড একসেসোরিজ" {{$workOrderProduct->types_of_industry == 'Trims and Accessories / ট্রিমস এন্ড একসেসোরিজ' ? 'selected':''}}>Trims and Accessories / ট্রিমস এন্ড একসেসোরিজ</option>
                                                <option value="Others/ অন্যান্য" {{$workOrderProduct->types_of_industry == 'Others/ অন্যান্য' ? 'selected':''}}>Others/ অন্যান্য</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="category_id">@lang('website.Select Category') </label>
                                            <select name="category_id" id="category_id" class="form-control demo-select2" required>
                                                <option>@lang('website.Select')</option>
                                                @foreach(\App\Model\Category::where('type','work_order')->get() as $category)
                                                    <option value="{{$category->id}}" {{$workOrderProduct->workOrderCategory && $workOrderProduct->workOrderCategory->category_id == $category->id ? 'selected' : ''}}>{{getNameByBnEn($category)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mt-2" id="category_two">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control demo-select2">

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
                                            <select name="sub_sub_child_child_category_id" id="sub_sub_child_child_category_id"
                                                    class="form-control demo-select2">

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

                                    <div class="col-md-10" style="padding-top: 20px;">
                                        <!-- general form elements -->
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="currency_id">@lang('website.Currency (Active)') <span class="required">*</span></label>
                                                <input type="text" class="form-control" value="{{currency()->code == 'BDT' ? 'BDT(৳)' : 'USD($)'}}" style="background-color: #f3f3f3" required="" readonly>
                                                <input type="hidden" name="currency_id" id="currency_id" class="form-control" value="{{currency()->id}}" style="background-color: #f3f3f3" required="">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="unit_id">@lang('website.Unit') <span class="required">*</span></label>
                                                <select name="unit_id" id="unit_id" class="form-control demo-select2" required>
                                                    @foreach($units as $unit)
                                                        <option value="{{$unit->id}}" {{$workOrderProduct->unit_id == $unit->id ? 'selected':''}}>{{getNameByBnEn($unit)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="unit_price">@lang('website.Unit Price')<span class="required">*</span></label>
                                                <input type="text" name="unit_price" class="form-control" value="{{$workOrderProduct->unit_price}}" required>
                                            </div>
                                        </div>

                                        @php
                                        $details = \App\Model\WorkOrderProductDetails::where('work_order_product_id',$workOrderProduct->id)->get();
                                        @endphp
                                        @foreach($details as $key => $detail)
                                            @php
                                            $row = $key+1;
                                            @endphp
                                        <input type="hidden" name="detail_id[]" value="{{$detail->id}}">
                                        <div class="row mt-4 test_row">
                                            <div class="form-group col-6">
                                                <label for="machine_type">@lang('website.Machine Type') <span class="required">*</span></label>
                                                <select name="machine_type_id[]" id="machine_type" class="form-control machine_type demo-select2" required>
                                                    <option value="">@lang('website.Select')</option>
                                                    @foreach(\App\Model\MachineType::all() as $machine_type)
                                                        <option value="{{$machine_type->id}}"
                                                            {{$detail->machine_type_id == $machine_type->id?
                                                            'selected':''}}>{{getNameByBnEn($machine_type)}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="no_of_machines">@lang('website.Number of Machines')<span class="required">*</span></label>
                                                <input type="number" name="no_of_machines[]" id="nom_{{$row}}" value="{{$detail->no_of_machines}}" onkeyup="get_total_pc_1({{$row}},this)" class="form-control">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="pc_per_day">@lang('website.Production Capacity Per Day/Machine')<span class="required">*</span></label>
                                                <input type="number" name="pc_per_day[]" id="pc_per_day_{{$row}}" value="{{$detail->pc_per_day}}" class="form-control" onkeyup="get_total_pc({{$row}},this)" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="total_pc_per_day">@lang('website.Total Production Capacity Per Day') <span class="required">*</span></label>
                                                <input type="number" name="total_pc_per_day[]" id="total_pc_per_day_{{$row}}" value="{{$detail->total_pc_per_day}}" class="form-control" onkeyup="get_production_time_1({{$row}},this)" readonly>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="moq">@lang('website.Minimum Order Quantity') <span class="required">*  </span> <br></label>
                                                <input type="number" name="moq[]" id="moq_{{$row}}" class="form-control" value="{{$detail->moq}}" readonly>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="max_oq">@lang('website.Maximum Order Quantity') <span class="required">*  </span> <br></label>
                                                <input type="number" name="max_oq[]" id="max_oq_{{$row}}" class="form-control" value="{{$detail->max_oq}}" onkeyup="get_production_time({{$row}},this)" required>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="production_time">@lang('website.Production Time') <small >(@lang('website.Days')) </small><span class="required">*</span></label>
                                                <input type="number" name="production_time[]" id="production_time_{{$row}}" value="{{$detail->production_time}}" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="finishing_time">@lang('website.Finishing Time') <small >(@lang('website.Days')) </small> <span class="required">*</span></label>
                                                <input type="number" name="finishing_time[]" id="finishing_time_{{$row}}" value="{{$detail->finishing_time}}" class="form-control" onkeyup="get_delivery_time({{$row}},this)" required>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="delivery_time">@lang('website.Delivery Time') <small >(@lang('website.Days')) </small> <br></label>
                                                <input type="number" name="delivery_time[]" id="delivery_time_{{$row}}" value="{{$detail->delivery_time}}" class="form-control"  readonly>
                                            </div>
                                            <div>
                                                <hr>
                                            </div>

                                        </div>
                                        @endforeach
                                        {{--                                        <div class="row mt-4">--}}
                                        {{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <div class="col-12 text-center">--}}
{{--                                                <a class="btn add_more" id="add_more" style="font-size: 18px;"> <i class="fa fa-plus-circle text-info"></i> Add More </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="row mt-4">

                                        </div>
                                        <div class="row mt-4">


                                        </div>
                                        <div class="form-group">
                                            <label for="description">@lang('website.Product/Service Details') <span class="required">*</span></label>
                                            <textarea name="description" id="description"  class="form-control" style="background-color: #f3f3f3" required>{!! $workOrderProduct->description !!}</textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-10" style="padding-top: 20px;">
                                        <div class="form-group row">
                                            <label class="control-label ml-3 col-12">@lang('website.Attach Previous Work Images') <span class="required">*</span> <small class="text-danger">(Size: 290 * 300px)</small></label>
                                            <div class="ml-3 mr-3 col-10">
                                                <div class="row" id="photos">
                                                    @if(is_array(json_decode($workOrderProduct->photos)))
                                                        @foreach (json_decode($workOrderProduct->photos) as $key => $photo)
                                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                                <div class="img-upload-preview">
                                                                    <img loading="lazy"  src="{{url($photo)}}" alt="" class="img-responsive">
                                                                    <input type="hidden" name="previous_photos[]" value="{{$photo}}">
                                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="row" id="photos_alt"></div>
                                            </div>
                                            <div class="col-2">
                                                <a href="https://tinypng.com/" target="_blank" class="btn btn-primary" style="padding: 0 15px;"><i class="fa fa-edit"></i></a> @lang('website.Resize')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="woocommerce-form-login__submit btn btn-primary rounded-0" >@lang('website.Submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
{{--    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>--}}
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>

    <script>
        CKEDITOR.replace( 'description');

        var category_two = $("#sub_category_id").val();
        var category_three = $("#sub_sub_category_id").val();
        var category_four = $("#sub_sub_child_category_id").val();
        var category_five = $("#sub_sub_child_child_category_id").val();
        var category_six = $('#category_six_id').val();
        var category_seven = $('#category_seven_id').val();
        var category_eight = $('#category_eight_id').val();
        var category_nine = $('#category_nine_id').val();
        var category_ten = $('#category_ten_id').val();

        $(document).ready(function () {
            $("#category_three").hide()
            $("#category_four").hide()
            $("#category_five").hide()
            $("#category_six").hide()
            $("#category_seven").hide()
            $("#category_eight").hide()
            $("#category_nine").hide()
            $("#category_ten").hide()
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

            get_subcategories();

            //title to slug make
            $("#name").keyup(function () {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{URL('/buyer/products/slug')}}/" + name,
                    method: "get",
                    success: function (data) {
                        //console.log(data.response)
                        $('#slug').val(data.response);
                    }
                });
            })

            $(".price_summation").keyup(function () {
                var quantity = $("#quantity").val();
                var unit_price = $("#unit_price").val();
                if(quantity > 0 && unit_price > 0){
                    var expected_price = parseFloat(quantity) * parseFloat(unit_price);
                    $('#expected_price').val(expected_price);

                    $.post('{{ route('bid.price.convert') }}',
                        {
                            _token:'{{ csrf_token() }}',
                            bid_price:unit_price,
                            qty:quantity
                        },
                        function(data){
                            // location.reload();
                            console.log(data);
                            $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                            $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        });
                }else{
                    $('#expected_price').val('');
                    $('#bid_convert_unit_price').val('');
                    $('#bid_convert_total_price').val('');
                }
            })
            function get_subcategories() {
                var category_id = $('#category_id').val();
                $.post('{{ route('products.get_subcategories_by_category') }}', {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id
                }, function (data) {
                    $('#sub_category_id').html(null);
                    $('#sub_category_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#sub_category_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->sub_category_id : ''}}'){
                            $("#sub_category_id").val(this.value).change();
                        }
                    });
                    get_subsubcategories();
                });
            }
            function get_subsubcategories() {
                var sub_category_id = $('#sub_category_id').val();
                console.log(sub_category_id)
                $.post('{{ route('products.get_subsubcategories_by_subcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_category_id: sub_category_id
                }, function (data) {
                    //console.log(data)
                    $('#sub_sub_category_id').html(null);
                    $('#sub_sub_category_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#sub_sub_category_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->sub_sub_category_id : ' '}}'){
                            $("#sub_sub_category_id").val(this.value).change();
                        }
                    });
                    $('.demo-select2').select2();
                    get_sub_sub_child_categories();
                });
            }

            function get_sub_sub_child_categories() {
                var sub_sub_category_id = $('#sub_sub_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildcategories_by_subsubcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_category_id: sub_sub_category_id
                }, function (data) {
                    //console.log(data)
                    $('#sub_sub_child_category_id').html(null);
                    $('#sub_sub_child_category_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_child_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#sub_sub_child_category_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->sub_sub_child_category_id : ''}}'){
                            $("#sub_sub_child_category_id").val(this.value).change();
                        }
                    });
                    $('.demo-select2').select2();
                    get_sub_sub_child_child_categories();

                });
            }
            function get_sub_sub_child_child_categories() {
                var sub_sub_child_category_id = $('#sub_sub_child_category_id').val();
                console.log(sub_sub_category_id)
                $.post('{{ route('products.get_subsubchildchildcategories_by_subsubchildcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_category_id: sub_sub_child_category_id
                }, function (data) {
                    //console.log(data)
                    $('#sub_sub_child_child_category_id').html(null);
                    $('#sub_sub_child_child_category_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_sub_child_child_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#sub_sub_child_child_category_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->sub_sub_child_child_category_id : ''}}'){
                            $("#sub_sub_child_child_category_id").val(this.value).change();
                        }
                    });
                    $('.demo-select2').select2();
                    get_category_six();

                });
            }

            function get_category_six() {
                var sub_sub_child_child_category_id = $('#sub_sub_child_child_category_id').val();
                console.log(sub_sub_child_child_category_id)
                $.post('{{ route('products.get_category_six') }}', {
                    _token: '{{ csrf_token() }}',
                    sub_sub_child_child_category_id: sub_sub_child_child_category_id
                }, function (data) {
                    //console.log(data)
                    $('#category_six_id').html(null);
                    $('#category_six_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_six_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#category_six_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->category_six_id : ''}}'){
                            $("#category_six_id").val(this.value).change();
                        }
                    });
                    $('.demo-select2').select2();
                    get_category_seven();

                });
            }
            function get_category_seven() {
                var category_six_id = $('#category_six_id').val();
                console.log(category_six_id)
                $.post('{{ route('products.get_category_seven') }}', {
                    _token: '{{ csrf_token() }}',
                    category_six_id: category_six_id
                }, function (data) {
                    //console.log(data)
                    $('#category_seven_id').html(null);
                    $('#category_seven_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_seven_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#category_seven_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->category_seven_id : ''}}'){
                            $("#category_seven_id").val(this.value).change();
                        }
                    });

                    get_category_eight();

                });
            }
            function get_category_eight() {
                var category_seven_id = $('#category_seven_id').val();
                console.log(category_seven_id)
                $.post('{{ route('products.get_category_eight') }}', {
                    _token: '{{ csrf_token() }}',
                    category_seven_id: category_seven_id
                }, function (data) {
                    //console.log(data)
                    $('#category_eight_id').html(null);
                    $('#category_eight_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_eight_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#category_eight_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->category_eight_id : ''}}'){
                            $("#category_eight_id").val(this.value).change();
                        }
                    });

                    get_category_nine();

                });
            }
            function get_category_nine() {
                var category_eight_id = $('#category_eight_id').val();
                console.log(category_eight_id)
                $.post('{{ route('products.get_category_nine') }}', {
                    _token: '{{ csrf_token() }}',
                    category_eight_id: category_eight_id
                }, function (data) {
                    //console.log(data)
                    $('#category_nine_id').html(null);
                    $('#category_nine_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_nine_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#category_nine_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->category_nine_id : ''}}'){
                            $("#category_nine_id").val(this.value).change();
                        }
                    });
                    get_category_ten();
                });
            }
            function get_category_ten() {
                var category_nine_id = $('#category_nine_id').val();
                console.log(category_nine_id)
                $.post('{{ route('products.get_category_ten') }}', {
                    _token: '{{ csrf_token() }}',
                    category_nine_id: category_nine_id
                }, function (data) {
                    //console.log(data)
                    $('#category_ten_id').html(null);
                    $('#category_ten_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#category_ten_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));
                    }
                    $("#category_ten_id > option").each(function() {
                        if(this.value == '{{$workOrderProduct->workOrderCategory ? $workOrderProduct->workOrderCategory->category_ten_id : ''}}'){
                            $("#category_ten_id").val(this.value).change();
                        }
                    });
                });
            }

            $('#category_id').on('change', function () {
                var category_id = $('#category_id').val();

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
            $('#sub_category_id').on('change', function () {
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
            $('#sub_sub_category_id').on('change', function () {
                $("#category_four").show()
                $("#category_five").hide()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_categories();
            });
            $('#sub_sub_child_category_id').on('change', function () {
                $("#category_five").show()
                $("#category_six").hide()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_sub_sub_child_child_categories();
            });
            $('#sub_sub_child_child_category_id').on('change', function () {
                $("#category_six").show()
                $("#category_seven").hide()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_six();
            });
            $('#category_six_id').on('change', function () {
                $("#category_seven").show()
                $("#category_eight").hide()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_seven();
            });
            $('#category_seven_id').on('change', function () {
                $("#category_eight").show()
                $("#category_nine").hide()
                $("#category_ten").hide()
                get_category_eight();
            });
            $('#category_eight_id').on('change', function () {
                $("#category_nine").show()
                $("#category_ten").hide()
                get_category_nine();
            });
            $('#category_nine_id').on('change', function () {
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
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 100kb');
                },
                onAddRow:function(index){
                    var altData = '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow : function(index){
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
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 150kb');
                },
                onAddRow:function(index){
                    var altData = '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow : function(index){
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });
        });

        function get_total_pc_1(row,el){
            var nom = el.value;
            var current_row = row;
            var pc_per_day = $('#pc_per_day_'+current_row).val();
            if(nom == ''){
                // alert('Number of machine must be greater than 0')
                // $('#pc_per_day').val('');
                $('#total_pc_per_day_'+current_row).val('');
                return false;
            }

            if (nom > 0 && pc_per_day > 0){
                var total_pc_per_day = nom * pc_per_day;
                $('#total_pc_per_day_'+current_row).val(total_pc_per_day);

            }
        }
        function get_total_pc(row,el){
            var current_row = row;
            var pc_per_day = el.value;
            var nom = $('#nom_'+current_row).val();
            if(nom == ''){
                // alert('Number of machine must be greater than 0')
                // $('#pc_per_day').val('');
                $('#total_pc_per_day_'+current_row).val('');
                return false;
            }

            console.log(pc_per_day)
            if (nom > 0 && pc_per_day > 0){
                var total_pc_per_day = nom * pc_per_day;
                $('#total_pc_per_day_'+current_row).val(total_pc_per_day);

            }
        }
        function get_no_of_machine(row,el){
            var current_row = row;
            var no_of_machine = el.value;
            var pc_per_day =  $('#pc_per_day_'+current_row).val();
            var multiply_total_pc_per_day = no_of_machine * pc_per_day;
            $('#total_pc_per_day_'+current_row).val(multiply_total_pc_per_day);
            var total_pc_per_day = $('#total_pc_per_day_'+current_row).val();
            var max_oq =  $('#max_oq_'+current_row).val();
            if (max_oq > 0 && pc_per_day > 0){

                var production_time =Math.round(max_oq / total_pc_per_day) ;
                $('#production_time_'+current_row).val(production_time);

                var finishing_time =  $('#finishing_time_'+current_row).val();
                if (finishing_time > 0){
                    var delivery_time = parseInt(production_time) + parseInt(finishing_time);
                    $('#delivery_time_'+current_row).val(delivery_time);
                }
            }


        }
        function get_production_time_1(row,el){
            var current_row = row;
            var total_pc_per_day = el.value;
            var max_oq =  $('#max_oq_'+current_row).val();
            if(max_oq == ''){
                alert('Minimum order must be greater than 0')
                // $('#moq').val('');
                return false;
            }
            console.log(total_pc_per_day)
            if (max_oq > 0 && total_pc_per_day > 0){
                var production_time =Math.round(max_oq / total_pc_per_day) ;
                $('#production_time_'+current_row).val(production_time);
            }
        }
        function get_production_time(row,el){
            var current_row = row;
            var max_oq = el.value;
            var total_pc_per_day =  $('#total_pc_per_day_'+current_row).val();
            if(max_oq == ''){
                // alert('Minimum order must be greater than 0')
                return false;
            }

            console.log(total_pc_per_day)
            if (max_oq > 0 && total_pc_per_day > 0){
                var production_time =Math.ceil(max_oq / total_pc_per_day) ;
                $('#production_time_'+current_row).val(production_time);
            }
            var finishing_time =  $('#finishing_time_'+current_row).val();
            if (finishing_time > 0){
                var delivery_time = parseInt(production_time) + parseInt(finishing_time);
                $('#delivery_time_'+current_row).val(delivery_time);
            }


        }

        $('#max_oq').on('blur',function () {
            var current_row = row;
            var max_oq = $('#max_oq').val();
            var moq = $('#moq').val();
            //alert(max_oq);
            if (parseInt(max_oq) < parseInt(moq)){
                alert('Required order quantity must be greater than '+moq)
                $('#max_oq').val(null);
                $('#production_time').val(null);
                // get_production_time_1();
            }
        });
        function get_delivery_time(row,el){
            var current_row = row;
            var finishing_time = el.value;
            var production_time =  $('#production_time_'+current_row).val();
            console.log('finish time',finishing_time)
            console.log('production time',production_time)
            // if(moq == ''){
            //     alert('Finishing time must be greater than 0')
            //     $('#finishing_time_'+current_row).val('');
            //     return false;
            // }
            if (finishing_time > 0 && production_time > 0){
                var delivery_time = parseInt(production_time) + parseInt(finishing_time);
                $('#delivery_time_'+current_row).val(delivery_time);
            }
        }

        function get_bid_price(el){
            var bid_price = el.value;
            var qty = $('#quantity').val();
            if(qty == ''){
                alert('Quantity must be greater than 0')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                return false;
            }
            console.log(bid_price)
            if(qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}',
                    {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty
                    },
                    function (data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                    });
            }else{
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
            }
        }

    </script>

@endpush
