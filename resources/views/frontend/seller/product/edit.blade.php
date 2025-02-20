@extends('frontend.layouts.master')
@section("title","Product Edit")
@push('css')
    <style>
        .form-group{
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
                    <div class="row">
                        <div class="col-3">
                            <h3 class="card-title float-left">
                                @lang('website.Product Edit')
                            </h3>
                        </div>
                        <div style="float: left;width: 15%;padding-top: 8px;">
                            <input type="radio" name="payment_with" value="BDT" id="bdt" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'BDT') checked @endif>
                            <label for="bdt">@lang('website.BDT')</label>
                        </div>

                        <div style="float: right;width: 15%;padding-top: 8px;">
                            <input type="radio" name="payment_with" value="USD" id="usd" class="CurrencyChange" onchange="currency_changed(this)" @if(currency()->code == 'USD') checked @endif>
                            <label for="usd">@lang('website.USD')</label>
                        </div>
                    </div>
                    <form class="woocommerce-form-login" action="{{route('seller.products.update',$product->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="card card-info card-outline">
                            <div class="card-body">
                                <div class="row m-2">
                                    <div class="col-md-10">
                                        <h4 class="pl-2 pb-0 mb-0 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Information') <span class="required">*</span></span></h4>
                                       <div class="row">
                                           @php
                                               $lang = app()->getLocale('locale');
                                           @endphp
                                           <div class="form-group col-md-12 @if($lang !== 'en') d-none @endif" >
                                               <label for="name">@lang('website.Product Type English')</label>
                                               <input type="text" class="form-control " name="name" id="name" value="{{getNameByBnEn($product)}}" >
                                               <input type="hidden" id="slug" name="slug" class="form-control"
                                                      value="{{$product->slug}}">
                                               <input type="hidden" name="lang" id="lang" value="{{app()->getLocale('locale')}}">
                                           </div>
                                           <div class="form-group col-md-12 @if($lang !== 'bn') d-none @endif" >
                                               <label for="name_bn">@lang('website.Product Type Bangla')</label>
                                               <input type="text" class="form-control " name="name_bn" id="name_bn" value="{{$product->name_bn}}">
                                           </div>
                                       </div>

                                        <div class="form-group mt-2">
                                            <label for="category_id">@lang('website.Select Category')</label>
                                            <select name="category_id" id="category_id" class="form-control demo-select2" required>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{getNameByBnEn($category)}}</option>
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
                                        <h4 class="pl-2 pb-0 mb-0 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Image') <span class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label class="control-label ml-3">@lang('website.Gallery Images') <span class="required">*</span> <small class="text-danger">(Size: 290 * 300px)</small></label>
                                            <div class="ml-3 mr-3">
                                                <div class="row" id="photos">
                                                    @if(is_array(json_decode($product->photos)))
                                                        @foreach (json_decode($product->photos) as $key => $photo)
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
                                        </div>
                                    </div>
                                    <div class="col-md-10" style="padding-top: 20px;">
                                        <!-- general form elements -->

                                        <h4 class="pl-2 pb-0 mb-0 bg-info"><span style="margin-left: 10px !important;">@lang('website.Product Price Details') <span class="required">*</span></span></h4>
                                        <div class="form-group">
                                            <label for="quantity">@lang('website.Quantity')</label>
                                            <input type="number" class="form-control price_summation" name="quantity" id="quantity" min="1" minlength="4" value="{{$product->quantity}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="unit_id">@lang('website.Unit')</label>
                                            <select name="unit_id" id="unit_id" class="form-control demo-select2" required>
                                                <option value="">Select</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->id}}" {{$product->unit_id == $unit->id ? 'selected' : ''}}>{{getNameByBnEn($unit)}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Currency (Active)')</label>
                                                    <input type="text" class="form-control" value="{{currency()->code == 'BDT' ? 'BDT(৳)' : 'USD($)'}}" style="background-color: #f3f3f3" required="" readonly>
                                                    <input type="hidden" name="currency_id" id="currency_id" class="form-control" value="{{currency()->id}}" style="background-color: #f3f3f3" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price') <span class="required">*</span></label>
                                                    <input type="number" value="{{currency()->code == 'BDT' ? $product->unit_price : convert_to_usd($product->unit_price)}}" step="0.00001" placeholder="Unit Price" name="unit_price" id="unit_price" class="form-control price_summation" style="border: 1px solid #dddddd" onkeyup="get_bid_price(this)" required="">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="unit_price">VAT/LAC <span
                                                            class="required">*</span></label>
                                                    <input readonly type="number"  value="{{currency()->code == 'BDT' ? $product->vat : convert_to_usd($product->vat)}}" step="0.00001" placeholder="0"
                                                        name="vat" id="vat"
                                                        class="form-control"
                                                        style="border: 1px solid #dddddd" onkeyup="get_vat_price(this)">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price') <span class="required">*</span></label>
                                                    <input type="number" value="{{currency()->code == 'BDT' ? $product->expected_price : convert_to_usd($product->expected_price)}}" step="0.00001" name="expected_price" class="form-control" id="expected_price" style="background-color: #f3f3f3" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="currency_id">@lang('website.Converted Currency')</label>
                                                    <input type="text" class="form-control" value="{{currency()->code == 'BDT' ? 'USD($)' : 'BDT(৳)'}}" style="background-color: #f3f3f3" required="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="unit_price">@lang('website.Unit Price')</label>
                                                    <input type="number" class="form-control" name="" id="bid_convert_unit_price" min="0" step="0.00001" placeholder="0" style="background-color: #f3f3f3" readonly required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="expected_price">@lang('website.Total Price')</label>
                                                    <input type="number" class="form-control" name="" id="bid_convert_total_price" min="0" step="0.00001" placeholder="0" style="background-color: #f3f3f3" readonly required>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group col-md-12">
                                                <label for="made_in">@lang('website.Made In')</label>
                                                <select name="made_in" id="made_in" class="form-control demo-select2" required>
                                                    <option >Select</option>
                                                    @foreach(\App\Model\Countries::all() as $country_of_origin)
                                                        <option value="{{$country_of_origin->country_name}}" {{$product->made_in == $country_of_origin->country_name? 'selected':''}}>{{$country_of_origin->country_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="fabric_greige">Fabric Greige/Width/G.S.M </label>
                                                <input type="text" class="form-control" name="fabric_greige"
                                                id="fabric_greige" style="background-color: #f3f3f3" value="{{$product->fabric_greige}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="finished_width">Finished Width/G.S.M </label>
                                                <input type="text" class="form-control" name="finished_width"
                                                id="finished_width" style="background-color: #f3f3f3" value="{{$product->finished_width}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="composition">Composition </label>
                                                <input type="text" class="form-control" name="composition"
                                                id="composition" style="background-color: #f3f3f3" value="{{$product->composition}}">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="construction">Construction </label>
                                                <input type="text" class="form-control" name="construction"
                                                id="construction" style="background-color: #f3f3f3" value="{{$product->construction}}">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="color_name">Color Name </label>
                                                <select name="color_name" id="color_name" class="form-control demo-select2" required>
                                                    <option selected disabled> Select</option>
                                                    @foreach(\App\Model\Color::all() as $color)
                                                    <option value="{{$color->name}}" {{$product->color_name == $color->name ? 'selected':''}}>{{$color->name}}</option>
                                                    @endforeach
                                                </select>
                                   
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_method">Delivery Method </label>
                                                <select name="delivery_method" id="delivery_method" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Truck" {{$product->delivery_method == 'Truck'?'selected':''}}>Truck</option>
                                                    <option value="Pick Up" {{$product->delivery_method == 'Pick Up'?'selected':''}}>Pick Up</option>
                                                    <option value="Lorry" {{$product->delivery_method == 'Lorry'?'selected':''}}>Lorry</option>
                                                    <option value="Courier Service" {{$product->delivery_method == 'Courier Service'?'selected':''}}>Courier Service</option>
                                                    <option value="Others" {{$product->delivery_method == 'Others'?'selected':''}}>Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_charge">Delivery Charge </label>
                                                <select name="delivery_charge" id="delivery_charge" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Seller" {{$product->delivery_charge == 'Seller'?'selected':''}}>Seller</option>
                                                    <option value="Buyer" {{$product->delivery_charge == 'Buyer'?'selected':''}}>Buyer</option>
                                                    <option value="FLL" {{$product->delivery_charge == 'FLL'?'selected':''}}>FLL</option>
                                                    <option value="Others" {{$product->delivery_charge == 'Others'?'selected':''}}>Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="delivery_time">Delivery Time </label>
                                                <select name="delivery_time" id="delivery_time" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Day" {{$product->delivery_time == 'Day'?'selected':''}}>Day</option>
                                                    <option value="Night" {{$product->delivery_time == 'Night'?'selected':''}}>Night</option>
                                                    <option value="Any time" {{$product->delivery_time == 'Any time'?'selected':''}}>Any time</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="insurance_provider">Insurance Coverage Provider </label>
                                                <select name="insurance_provider" id="insurance_provider" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Seller" {{$product->insurance_provider == 'Seller'?'selected':''}}>Seller</option>
                                                    <option value="Buyer" {{$product->insurance_provider == 'Buyer'?'selected':''}}>Buyer</option>
                                                    <option value="FLL" {{$product->insurance_provider == 'FLL'?'selected':''}}>FLL</option>
                                                    <option value="NA" {{$product->insurance_provider == 'NA'?'selected':''}}>NA</option>
                                                    <option value="Negotiable" {{$product->insurance_provider == 'Negotiable'?'selected':''}}>Negotiable</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="payment_method">Payment Method </label>
                                                <select name="payment_method" id="payment_method" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="CASH" {{$product->payment_method == 'CASH'?'selected':''}}>CASH</option>
                                                    <option value="L.C" {{$product->payment_method == 'L.C'?'selected':''}}>L.C</option>
                                                    <option value="ADVANCED" {{$product->payment_method == 'ADVANCED'?'selected':''}}>ADVANCED</option>
                                                    <option value="TT" {{$product->payment_method == 'TT'?'selected':''}}>TT</option>
                                                    <option value="PO" {{$product->payment_method == 'PO'?'selected':''}}>PO</option>
                                                    <option value="CREDT" {{$product->payment_method == 'CREDT'?'selected':''}}>CREDT</option>
                                                    <option value="3rd Party" {{$product->payment_method == '3rd Party'?'selected':''}}>3rd Party</option>
                                                    <option value="MFS" {{$product->payment_method == 'MFS'?'selected':''}}>MFS</option>
                                                    <option value="Others" {{$product->payment_method == 'Others'?'selected':''}}>Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="partial_payment">Partial Payment</label>
                                                <select name="partial_payment" id="partial_payment" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Allowed" {{$product->partial_payment == 'Allowed'?'selected':''}}>Allowed</option>
                                                    <option value="Not Allowed" {{$product->partial_payment == 'Not Allowed'?'selected':''}}>Not Allowed</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="sample_provider">Sample Provider </label>
                                                <select name="sample_provider" id="sample_provider" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Yes" {{$product->sample_provider == 'Yes'?'selected':''}}>Yes </option>
                                                    <option value="No" {{$product->sample_provider == 'No'?'selected':''}}>No</option>
                                                    <option value="Negotiable" {{$product->sample_provider == 'Negotiable'?'selected':''}}>Negotiable</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="sample_charge">Sample Charge </label>
                                                <select name="sample_charge" id="sample_charge" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Paid" {{$product->sample_charge == 'Paid'?'selected':''}}>Paid </option>
                                                    <option value="Free" {{$product->sample_charge == 'Free'?'selected':''}}>Free</option>
                                                    <option value="Negotiable" {{$product->sample_charge == 'Negotiable'?'selected':''}}>Negotiable</option>
                                                    <option value="NA" {{$product->sample_charge == 'NA'?'selected':''}}>NA</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="price_validity">@lang('website.Price Validate Till')</label>
                                                <input type="date" class="form-control" name="price_validity" id="price_validity" value="{{$product->price_validity}}"  style="background-color: #f3f3f3">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="partial_delivery">Partial Delivery</label>
                                                <select name="partial_delivery" id="partial_delivery" class="form-control demo-select2"
                                                    required>
                                                    <option selected disabled> Select</option>
                                                    <option value="Allowed" {{$product->partial_delivery == 'Allowed'?'selected':''}}>Allowed</option>
                                                    <option value="Not Allowed" {{$product->partial_delivery == 'Not Allowed'?'selected':''}}>Not Allowed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group @if($lang !== 'en') d-none @endif">
                                            <label for="description">@lang('website.Product Description English')</label>
                                            <textarea name="description" id="description"  class="form-control" style="background-color: #f3f3f3">{!! $product->description !!}</textarea>
                                        </div>
                                        <div class="form-group @if($lang !== 'bn') d-none @endif">
                                            <label for="description_bn">@lang('website.Product Description Bangla')</label>
                                            <textarea name="description_bn" id="description_bn"  class="form-control" style="background-color: #f3f3f3">{!! $product->description_bn !!}</textarea>
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
        CKEDITOR.replace( 'description_bn');

        // $("#category_two").hide()

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

            get_loading_bid_price();

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
                //console.log(name);
                $.ajax({
                    url: "{{URL('/seller/products/slug')}}/" + name,
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
                var defaultvatperent= '{{ getDefaultVat() }}';
                  var vat = $('#vat').val();
                 var qty = $('#quantity').val();
                   var totalVat=((unit_price*qty)*defaultvatperent)/100;
            $('#vat').val(totalVat);
                if(quantity > 0 && unit_price > 0){
                    var expected_price = parseFloat(quantity) * parseFloat(unit_price)+parseFloat(totalVat);
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
                //console.log(category_id)
                $.post('{{ route('products.get_subcategories_by_category') }}', {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id
                }, function (data) {
                    $('#sub_category_id').html(null);
                    $('#sub_category_id').append($('<option>', {
                        value: null,
                        text: 'Select Product'
                    }));
                    // console.log(data)
                    for (var i = 0; i < data.length; i++) {
                        $('#sub_category_id').append($('<option>', {
                            value: data[i].id,
                            text: getNameBnEn(data[i].name,data[i].name_bn)
                        }));

                        //$('.demo-select2').select2();
                    }
                    $("#sub_category_id > option").each(function() {
                        if(this.value == '{{$product->sub_category_id}}'){
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
                        if(this.value == '{{$product->sub_sub_category_id}}'){
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
                        if(this.value == '{{$product->sub_sub_child_category_id}}'){
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
                        if(this.value == '{{$product->sub_sub_child_child_category_id}}'){
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
                        if(this.value == '{{$product->category_six_id}}'){
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
                        if(this.value == '{{$product->category_seven_id}}'){
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
                        if(this.value == '{{$product->category_eight_id}}'){
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
                        if(this.value == '{{$product->category_nine_id}}'){
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
                        if(this.value == '{{$product->category_ten_id}}'){
                            $("#category_ten_id").val(this.value).change();
                        }
                    });
                });
            }


            $('#category_id').on('change', function () {
                var category_id = $('#category_id').val();
                // if(category_id == 4){
                //     toastr.warning( 'For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     // alert('For yarn Sell, Please Contact with 09678-236236 or send email : support@fabriclagbe.com');
                //     $('#category_id').val('');
                //     $("#category_two").hide()
                //     return false;
                // }

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

            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });

        });

        function get_bid_price(el){
            var bid_price = el.value;
            var qty = $('#quantity').val();
            var unit_price = $('#unit_price').val();
            var defaultvatperent= '{{ getDefaultVat() }}';
            var vat = $('#vat').val();
            var totalVat=((unit_price*qty)*defaultvatperent)/100;
            $('#vat').val(totalVat);
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

        function get_loading_bid_price(){
            var bid_price = $('#unit_price').val();
            var qty = $('#quantity').val();
            console.log(bid_price)
            $.post('{{ route('bid.price.convert') }}',
                {
                    _token:'{{ csrf_token() }}',
                    bid_price:bid_price,
                    qty:qty
                },
                function(data){
                    // location.reload();
                    console.log(data);
                    $('#bid_convert_unit_price').val(data.bid_convert_unit_price);
                    $('#bid_convert_total_price').val(data.bid_convert_total_price);
                });
        }

    </script>
@endpush
