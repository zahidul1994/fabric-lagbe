@extends('frontend.layouts.master')
@section('title', 'Product Entry')
@push('css')
    <style>
        .form-group {
            margin-top: 10px;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row" style="margin-top: -30px;">
        <div class="container">
            <div class="row">
                @include('frontend.seller.seller_breadcrumb')
                @include('frontend.seller.seller_sidebar')
                <div class="col-lg-9">
                    <form class="woocommerce-form-login" action="{{ route('seller.fabric.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-5">
                                        <h3 class="card-title float-left">
                                            {{-- @lang('website.Product Entry') --}}
                                            Fabric Product Entry
                                        </h3>
                                    </div>
                                    <div style="float: left;width: 15%;">
                                        <input type="hidden" name="lang" id="lang"
                                            value="{{ app()->getLocale('locale') }}">
                                        <input type="radio" name="payment_with" value="BDT" id="bdt"
                                            class="CurrencyChange" onchange="currency_changed(this)"
                                            @if (currency()->code == 'BDT') checked @endif>
                                        <label for="bdt">@lang('website.BDT')</label>
                                    </div>

                                    <div style="float: right;width: 15%;">
                                        <input type="radio" name="payment_with" value="USD" id="usd"
                                            class="CurrencyChange" onchange="currency_changed(this)"
                                            @if (currency()->code == 'USD') checked @endif>
                                        <label for="usd">@lang('website.USD')</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row m-2">
                                    <div class="col-md-12">
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span style="margin-left: 10px !important;">
                                                @lang('website.Product Information') <span class="required">*</span></span></h4>
                                        @php
                                            $lang = app()->getLocale('locale');
                                        @endphp
                                        <div class="row">
                                            <div
                                                class="form-group col-md-12 @if ($lang !== 'en') d-none @endif">
                                                <label for="name"> Product Name <span
                                                        class="required">*</span></label>
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

                                        {{-- <div class="form-group">
                                            <label for="category_id">@lang('website.Select Category') <span
                                                    class="required">*</span></label>
                                            <select name="category_id" id="category_id" class="form-control demo-select2"
                                                required>
                                                <option disabled selected>@lang('website.Select Product')</option>
                                               
                                                <option value="1">Fabrics</option>
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
                                                <option>Select Product</option>
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
                                        </div> --}}

                                    </div>
                                    <div class="form-group mt-2" id="category_others">
                                        <label for="category_others">Other Category</label>
                                        <input type="text" id="category_others" name="category_others"
                                            class="form-control"><br>

                                    </div>
                                    
                                    <div class="col-md-8" style="padding-top: 20px;">
                                        <!-- general form elements -->
                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span
                                                style="margin-left: 10px !important;">@lang('website.Product Image') <span
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
                                                <a href="https://tinypng.com/" target="_blank" class="btn btn-primary"
                                                    style="padding: 0 15px;"><i
                                                        class="fa fa-edit"></i></a>@lang('website.Resize')
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4" style="padding-top: 20px;">
                                       <h4 class="pl-2 pb-0 mb-2 bg-info"><span
                                            style="margin-left: 10px !important;">@lang('Product Video') <span
                                                class="required">*</span></span></h4>
                                        <div class="col-md-6 form-group">
                                           <label>Select Video:</label>
                                           <input type="file" name="video" class="form-control"/>
                                        </div>
                                       
                                       </div>

                                    
                                    <div class="col-md-12" style="padding-top: 20px;">
                                        <!-- general form elements -->

                                        {{-- add video --}}
                                       
                                         <br>

                                        {{-- add video ends --}}


                                        <h4 class="pl-2 pb-0 mb-2 bg-info"><span
                                                style="margin-left: 10px !important;">@lang('website.Product Price Details') <span
                                                    class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label for="quantity">@lang('website.Quantity') <span
                                                    class="required">*</span></label>
                                            <input type="number" class="form-control price_summation" name="quantity"
                                                id="quantity" min="1" value=""
                                                placeholder="@lang('website.Quantity must be greater than 0')" required>
                                        </div>

                                          <div class="form-group">
                                             <label>Price according to quantity </label>
                                            {{-- sample table --}}
                                        <table id="myTable">
                                            <tbody>
                                                
                                                
                                                <tr>
                                                 
                                                    <td><input type="number" class="form-control" name="var_quantity[]" placeholder="Quantity"></td>
                                                </tr>
                                                <tr>
                                                    <td><input type="number" class="form-control" name="var_price[]" placeholder="Price"></td>
                                                </tr>
                                                
                                                
                                            </tbody>
                                        </table>
                                        <button type="button" onclick="addColumn()">Add Column</button>
                                        {{-- sample table --}}
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Currency (Active)')</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ currency()->code == 'BDT' ? 'BDT(৳)' : 'USD($)' }}"
                                                        style="background-color: #f3f3f3" required="" readonly>
                                                    <input type="hidden" name="currency_id" id="currency_id"
                                                        class="form-control" value="{{ currency()->id }}"
                                                        style="background-color: #f3f3f3" required="">

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price') <span
                                                            class="required">*</span></label>
                                                    <input type="number" value="" step="0.00001" placeholder="0"
                                                        name="unit_price" id="unit_price"
                                                        class="form-control price_summation"
                                                        style="border: 1px solid #dddddd" onkeyup="get_bid_price(this)"
                                                        required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">VAT/LAC <span
                                                            class="required">*</span></label>
                                                    <input readonly type="number" value="" step="0.00001" placeholder="0"
                                                        name="vat" id="vat"
                                                        class="form-control"
                                                        style="border: 1px solid #dddddd" onkeyup="get_vat_price(this)">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price')<span
                                                            class="required">*</span></label>
                                                    <input readonly type="number" value="" step="0.00001"
                                                        name="expected_price" class="form-control" id="expected_price"
                                                        style="background-color: #f3f3f3" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Converted Currency')</label>
                                                    <input readonly type="text" class="form-control"
                                                        value="{{ currency()->code == 'BDT' ? 'USD($)' : 'BDT(৳)' }}"
                                                        style="background-color: #f3f3f3" required="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price')</label>
                                                    <input readonly type="number" class="form-control" name=""
                                                        id="bid_convert_unit_price" min="0" step="0.00001"
                                                        placeholder="" style="background-color: #f3f3f3" readonly
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">VAT/LAC <span
                                                            class="required">*</span></label>
                                                    <input readonly type="number" value="" step="0.00001" placeholder="0"
                                                        name="converted_vat" id="converted_vat"
                                                        class="form-control"
                                                        style="border: 1px solid #dddddd" >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price')</label>
                                                    <input readonly type="number" class="form-control" name=""
                                                        id="bid_convert_total_price" min="0" step="0.00001"
                                                        placeholder="" style="background-color: #f3f3f3" readonly
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="made_in">@lang('website.Made In')</label>
                                                <select name="made_in" id="made_in" class="form-control demo-select2"
                                                    required>
                                                    <option>@lang('website.Select')</option>
                                                    @foreach (\App\Model\Countries::all() as $country_of_origin)
                                                        <option value="{{ $country_of_origin->country_name }}">
                                                            {{ getCountryNameByBnEn($country_of_origin) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="raw_metarials">Raw Metarials</label>
                                                <input type="text" class="form-control" name="raw_metarials"
                                                id="raw_metarials" style="background-color: #f3f3f3">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="fabric_greige">Fabric Greige/Width/G.S.M </label>
                                                <input type="text" class="form-control" name="fabric_greige"
                                                id="fabric_greige" style="background-color: #f3f3f3">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="finished_width">Finished Width/G.S.M </label>
                                                <input type="text" class="form-control" name="finished_width"
                                                id="finished_width" style="background-color: #f3f3f3">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="composition">Composition </label>
                                                <input type="text" class="form-control" name="composition"
                                                id="composition" style="background-color: #f3f3f3">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="construction">Construction </label>
                                                <input type="text" class="form-control" name="construction"
                                                id="construction" style="background-color: #f3f3f3">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="color_name">Color Name </label>
                                                <select name="color_name" id="color_name" class="form-control demo-select2" required>
                                                    <option selected disabled> Select</option>
                                                    @foreach(\App\Model\Color::all() as $color)
                                                    <option value="{{$color->name}}">{{$color->name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_method">Delivery Method </label>
                                                <select name="delivery_method" id="delivery_method" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Truck">Truck</option>
                                                    <option value="Pick Up">Pick Up</option>
                                                    <option value="Lorry">Lorry</option>
                                                    <option value="Courier Service">Courier Service</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_charge">Delivery Charge </label>
                                                <select name="delivery_charge" id="delivery_charge" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Seller">Seller</option>
                                                    <option value="Buyer">Buyer</option>
                                                    <option value="FLL">FLL</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_time">Delivery Time </label>
                                                <select name="delivery_time" id="delivery_time" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Day">Day</option>
                                                    <option value="Night">Night</option>
                                                    <option value="Any time">Any time</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="insurance_provider">Insurance Coverage Provider </label>
                                                <select name="insurance_provider" id="insurance_provider" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Seller">Seller</option>
                                                    <option value="Buyer">Buyer</option>
                                                    <option value="FLL">FLL</option>
                                                    <option value="NA">NA</option>
                                                    <option value="Negotiable">Negotiable</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="payment_method">Payment Method </label>
                                                <select name="payment_method" id="payment_method" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="CASH">CASH</option>
                                                    <option value="L.C">L.C</option>
                                                    <option value="ADVANCED">ADVANCED</option>
                                                    <option value="TT">TT</option>
                                                    <option value="PO">PO</option>
                                                    <option value="CREDT">CREDT</option>
                                                    <option value="3rd Party">3rd Party</option>
                                                    <option value="MFS">MFS</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="partial_payment">Partial Payment</label>
                                                <select name="partial_payment" id="partial_payment" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Allowed">Allowed</option>
                                                    <option value="Not Allowed">Not Allowed</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="sample_provider">Sample Provider </label>
                                                <select name="sample_provider" id="sample_provider" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Yes">Yes </option>
                                                    <option value="No">No</option>
                                                    <option value="Negotiable">Negotiable</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="sample_charge">Sample Charge </label>
                                                <select name="sample_charge" id="sample_charge" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Paid">Paid </option>
                                                    <option value="Free">Free</option>
                                                    <option value="Negotiable">Negotiable</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="price_validity">@lang('website.Price Validate Till')</label>
                                                <input type="date" class="form-control" name="price_validity"
                                                    id="price_validity" style="background-color: #f3f3f3">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="partial_delivery">Partial Delivery</label>
                                                <select name="partial_delivery" id="partial_delivery" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Allowed">Allowed</option>
                                                    <option value="Not Allowed">Not Allowed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group @if ($lang !== 'en') d-none @endif">
                                            <label for="description">@lang('website.Product Description English')<span
                                                    class="required">*</span></label>
                                            <textarea name="description" id="description" class="form-control" style="background-color: #f3f3f3"></textarea>
                                        </div>
                                        <div class="form-group @if ($lang !== 'bn') d-none @endif">
                                            <label for="description_bn">@lang('website.Product Description Bangla')<span
                                                    class="required">*</span></label>
                                            <textarea name="description_bn" id="description_bn" class="form-control" style="background-color: #f3f3f3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="woocommerce-form-login__submit btn btn-primary rounded-0"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop2">@lang('website.Submit')</button>
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
                                            $popUp = \App\Model\PopUp::where('type', 'seller_product_entry')->first();
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
    {{--    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script> --}}
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
            $('.demo-select2').select2();
            get_subcategories();
        });
            //title to slug make
            $("#name").keyup(function() {
                var name = $("#name").val();
                $.ajax({
                    url: "{{ URL('/seller/products/slug') }}/" + name,
                    method: "get",
                    success: function(data) {
                        $('#slug').val(data.response);
                    }
                });
            })

            $(".price_summation").keyup(function() {
                var quantity = $("#quantity").val();
                var unit_price = $("#unit_price").val();
                var vat = $("#vat").val();
                if (quantity > 0 && unit_price > 0) {
                   
                    var expected_price =parseFloat(vat)+(parseFloat(quantity) * parseFloat(unit_price));
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

            function get_subcategories() {
                var category_id = $('#category_id').val();
                //var lang = $('#lang').val();

                console.log(lang)
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
                    window.location.href = '{{ route('seller.dying-product.create') }}';
                }
                if (category_id == 9) {
                    window.location.href = '{{ route('seller.sizing-product.create') }}';
                }
                 if (category_id == 4) {
                    window.location.href = '{{ route('seller.yarn-product.create') }}';
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
            rowHeight: '100px',
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

        function get_bid_price(el) {
            var bid_price = el.value;
            var unit_price = $('#unit_price').val();
            var defaultvatperent= '{{ getDefaultVat() }}';
            var vat = $('#vat').val();
            var qty = $('#quantity').val();
            var totalVat=((unit_price*qty)*defaultvatperent)/100;
            $('#vat').val(totalVat);
            if (qty == '') {
                alert('Please insert Quantity')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
                return false;
            }

            if (qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}', {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty,
                        vat: vat
                    },
                    function(data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        $('#converted_vat').val(data.converted_vat);
                    });
            } else {
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
            }
           


        }
        function get_vat_price(el){
            var vat = el.value;
            var qty = $('#quantity').val();
            
            if (qty == '') {
                alert('Quantity must be greater than 0')
                $('#unit_price').val('');
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                return false;
            }

            if (qty > 0 && bid_price > 0) {
                $.post('{{ route('bid.price.convert') }}', {
                        _token: '{{ csrf_token() }}',
                        bid_price: bid_price,
                        qty: qty,
                        vat: vat
                    },
                    function(data) {
                        // location.reload();
                        console.log(data);
                        $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                        $('#bid_convert_total_price').val(data.bid_convert_total_price);
                        $('#converted_vat').val(data.converted_vat);
                    });
            } else {
                $('#expected_price').val('');
                $('#bid_convert_unit_price').val('');
                $('#bid_convert_total_price').val('');
                $('#converted_vat').val('');
            }
        }


        // for qty and price data
        function addColumn() {
			var table = document.getElementById("myTable");
			var rows = table.rows;
            
			var numRows = rows.length;

			// Create a new cell for each row and insert it at the end

			for (var i = 0; i < numRows; i++) {
				var row = rows[i];
				var cell = row.insertCell(-1);
				if (i == 0) {
					cell.innerHTML = '<td><input type="number" name="var_quantity[]"></td>';
				} else {
					cell.innerHTML = '<td><input type="number" name="var_price[]"></td>';
				}
			}
		     }
        // for qty and price data
    </script>
@endpush
