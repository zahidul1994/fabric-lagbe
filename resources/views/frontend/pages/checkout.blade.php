@extends('frontend.layouts.master')
@section('title', 'Checkout')
@push('css')
    <style>
        .button {
            float: left;
            margin: 0 5px 0 0;
            width: 100px;
            height: 40px;
            position: relative;
        }

        .button label,
        .button input {
            padding-top: 5px;
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid #0dcaf0;
        }

        .button input[type="radio"] {
            opacity: 0.011;
            z-index: 100;
            border: 1px solid #0dcaf0;
            /* border-color: #0dcaf0; */
        }

        .button input[type="radio"]:checked+label {
            padding-top: 5px;
            background: #20b8be;
            border-radius: 4px;
        }

        .button label {
            cursor: pointer;
            z-index: 90;
            line-height: 1.8em;
        }
    </style>
@endpush
@section('content')
    <!-- breadcrumb -->
    {{-- <div class="full-row bg-light py-5">
        <div class="container">
            <div class="row text-secondary">
                <div class="col-sm-6">
                    <h3 class="mb-2 text-secondary">Checkout</h3>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- breadcrumb -->

    <!--==================== Checkout Section Start ====================-->
    <div id="main-content" class="full-row site-content">
        <div class="container">
            <div class="row ">
                <div id="primary" class="content-area col-md-12">
                    <article id="post-19" class="post-19 page type-page status-publish hentry">
                        <div class="entry-content">
                            <div class="woocommerce">
                                <div class="woocommerce-notices-wrapper"></div>
                                <form name="checkout" method="POST" class="checkout woocommerce-checkout"
                                    action="{{ route('order-submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="col2-set" id="customer_details">
                                                <div class="woocommerce-billing-fields">
                                                    <h3>Delivery Information</h3>
                                                    <div class="woocommerce-billing-fields__field-wrapper">
                                                        <div class="row">
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="full_name" class="">Full Name</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="full_name" id="full_name" value="{{ @auth::user()->name }}" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="region" class="">Region</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="region" id="region" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="phone" class="">Phone Number</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="phone" id="phone" value="{{ @auth::user()->country_code }}{{ @auth::user()->phone }}" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="city" class="">City</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="city" id="city" value="{{ @auth::user()->city }}" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="house_no" class="">Building/House No/Floor/Street</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="house_no" id="house_no" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="area" class="">Area</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="area" id="area" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="colony" class="">Colony/Suburb/Locality/Landmark</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="colony" id="colony" required>
                                                                </span>
                                                            </p>
                                                            <p class="col-md-6 form-row form-row-last">
                                                                <label for="address" class="">Address</label>
                                                                <span class="woocommerce-input-wrapper">
                                                                    <input type="text" class="input-text" name="address" id="address" value="{{ @auth::user()->address }}" required>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="woocommerce-shipping-fields">
                                                    <h3 id="ship-to-different-address">
                                                        <label
                                                            class="woocommerce-form_label woocommerce-form_label-for-checkbox checkbox">
                                                            Select a lebel for effective delivery
                                                        </label>
                                                    </h3>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="button">
                                                                <input type="radio" id="office" name="delivery_to"
                                                                    value="office" />
                                                                <label class="btn btn-default"
                                                                    for="office">Office</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="button">
                                                                <input type="radio" id="home" name="delivery_to"
                                                                    value="home" />
                                                                <label class="btn btn-default" for="home">Home</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="button">
                                                                <label class="btn btn-success"
                                                                    onclick="saveValue()">Save</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="order-review-inner">
                                                <h3 id="order_review_heading">Your order</h3>
                                                <div id="order_review" class="woocommerce-checkout-review-order">
                                                    <table class="shop_table woocommerce-checkout-review-order-table">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-name" colspan="2">Product Details
                                                                </th>
                                                                <th class="product-total">Subtotal</th>
                                                                <th class="product-total">Total</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @foreach (Cart::content() as $cartData)
                                                                <tr class="cart_item">
                                                                    <td class="product-name"><img
                                                                            src="{{ url($cartData->options->image) }}"
                                                                            style="height: 55px; width: 100%;"> </td>
                                                                    <td class="product-name">{{ $cartData->name }} </td>
                                                                    <td><strong
                                                                            class="product-quantity">{{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price) }}
                                                                            ×
                                                                            {{ $cartData->qty }}
                                                                            {{ $cartData->options->unit }}</strong></td>
                                                                    <td class="product-total">
                                                                        <span class="woocommerce-Price-amount amount"><bdi><span
                                                                                    class="woocommerce-Price-currencySymbol"></span>{{ getNumberWithCurrencyByBnEn($cartData->options->unit_vat_price * $cartData->qty) }}</bdi>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="cart-subtotal">
                                                                <th colspan="2">Subtotal</th>
                                                                <td colspan="2"><span
                                                                        class="woocommerce-Price-amount amount"><bdi><span
                                                                                class="woocommerce-Price-currencySymbol"></span>{{ getNumberWithCurrencyByBnEn(Cart::total()) }}</bdi>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <input type="hidden" name="vat" value="0"
                                                                id="vat">
                                                            {{-- <tr class="woocommerce-shipping-totals shipping">
                                                                <th colspan="2">VAT</th>
                                                               
                                                                <td data-title="Shipping" colspan="2">{{getNumberWithCurrencyByBnEn(50)}}
                                                                </td>
                                                            </tr> --}}
                                                            <tr class="woocommerce-shipping-totals shipping">
                                                                <th>Delivery Charge</th>
                                                                <th colspan="2"> <select required class="form-control"
                                                                        name="delivery_charge" id="delivery_charge">
                                                                        <option disabled selected value="">Select One
                                                                        </option>
                                                                        <option data-time="3" value=50>Inside City
                                                                        </option>
                                                                        <option data-time="5" value=80>Inside Dhaka
                                                                        </option>
                                                                        <option data-time="7" value=120>Outside division
                                                                        </option>
                                                                        <option data-time="15" value=150>Outside District
                                                                        </option>
                                                                    </select> </th>
                                                                <td data-title="Shipping" colspan="2"
                                                                    id="shipingCharge">
                                                                    {{ getNumberWithCurrencyByBnEn(0) }}
                                                                </td>


                                                            </tr>
                                                            <th>Delivery Time</th>
                                                            <td colspan="2" id="shipingTime">
                                                              
                                                            </td>


                                                            <tr class="woocommerce-shipping-totals shipping"
                                                                id="couponDiscount">
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="actions">
                                                                    <div class="input-group mb-3">
                                                                        <input type="hidden" name="coupon_discount"
                                                                            value="0" id="coupon_discount">
                                                                        <input type="text" class="form-control"
                                                                            id="coupon_code" name="coupon_code"
                                                                            value=""
                                                                            placeholder="Enter Store Fabric code">
                                                                        <span role="button"
                                                                            class="input-group-text bg-info"
                                                                            id=""
                                                                            onclick="getCouponAmount()">Apply coupon</span>
                                                                    </div>
                                                                    {{-- <div class="coupon form-group ">
                                                                        <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="Enter Store Fabric code">
                                                                        <button type="submit" class="btn btn-info" name="apply_coupon" value="">Apply coupon</button>
                                                                    </div> --}}

                                                                </td>
                                                            </tr>
                                                            <tr class="order-total">
                                                                <th colspan="2">Total</th>
                                                                <td colspan="2">
                                                                    {{-- <input type="hidden" > --}}
                                                                    <strong>
                                                                        <span class="woocommerce-Price-amount amount"
                                                                            id=""><bdi><span
                                                                                    class="woocommerce-Price-currencySymbol"></span>
                                                                                <span id="total_value"></span>
                                                                                {{-- {{ getNumberWithCurrencyByBnEn(Cart::total()+ 50 + 50)  }} --}}
                                                                            </bdi></span>
                                                                    </strong>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                    <div class="woocommerce-checkout-payment" style="margin-top:5px;">
                                                        <div class="form-row place-order">
                                                            <div class="text-center">
                                                                <button type="submit"
                                                                    class="btn btn-primary alt text-center">Place order
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- .entry-content -->
                    </article>
                    <!-- #post-## -->
                </div>
                <!-- .entry-content-wrapper -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!--==================== Checkout Section End ====================-->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getTotalAmount();
        });

        function getTotalAmount() {
            var vat = $('#vat').val();
            var delivery_charge = ($('#delivery_charge').val()) || 0;
            var coupon_discount = $('#coupon_discount').val();
            $.post('{{ route('get_total_amount') }}', {
                _token: '{{ csrf_token() }}',
                vat: 0,
                delivery_charge: delivery_charge,
                coupon_discount: coupon_discount
            }, function(data) {
                //    $.post('{{ route('get_total_amount') }}', {_token:'{{ csrf_token() }}',vat:vat, delivery_charge:delivery_charge, coupon_discount:coupon_discount}, function(data){
                if (data) {
                    $('#total_value').html(data)
                    // $('#couponDiscount').
                } else {

                }

            });
        }

        function getCouponAmount() {
            var coupon = $('#coupon_code').val();
            $.post('{{ route('get_coupon_amount') }}', {
                _token: '{{ csrf_token() }}',
                coupon: coupon
            }, function(data) {
                if (data) {
                    console.log(data);
                    $('#couponDiscount').html(
                        `<th colspan="2">Coupon Discount</th>` +
                        `<td data-title="Shipping" colspan="2">` + data.value + `</td>`)
                    $('#coupon_discount').val(data.amount);
                    getTotalAmount();
                } else {
                    $('#couponDiscount').html(`
                    <th colspan="2">Coupon Discount</th>
                    <td data-title="Shipping" colspan="2">0
                    </td>
                    `)
                }

            });
        }

        function saveValue() {
            var vat = $('#vat').val();
            var full_name = $('#full_name').val();
            var delivery_charge = $('#delivery_charge').val();
            var region = $('#region').val();
            var phone = $('#phone').val();
            var city = $('#city').val();
            var house_no = $('#house_no').val();
            var area = $('#area').val();
            var colony = $('#colony').val();
            var address = $('#address').val();
            var coupon_discount = $('#coupon_discount').val();
            var delivery_to = $("input[name='delivery_to']:checked").val();
            $.post('{{ route('saveusercheckout') }}', {
                _token: '{{ csrf_token() }}',
                vat: 0,
                delivery_charge: delivery_charge,
                coupon_discount: coupon_discount,
                full_name: full_name,
                region: region,
                phone: phone,
                city: city,
                house_no: house_no,
                area: area,
                colony: colony,
                address: address,
                full_name: full_name,
                delivery_to: delivery_to,

            }, function(data) {

                if (data) {
                    console.log(data);
                } else {

                }

            });
        }
        //  

        $('#delivery_charge').on('change', function(e) {
            $('#shipingCharge').html('৳' + ($(e.target).val()));
            
            $('#shipingTime').html($('#delivery_charge option:selected').data('time')+ ' Days');
            getTotalAmount();
        });
    </script>
@endpush
