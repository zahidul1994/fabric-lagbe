@extends('frontend.layouts.master')
@section('title', 'Membership Packages')
@push('css')
    <style>
        .btn-1 {
            padding: 0 10px;
            background-color: purple;
        }
    </style>
{{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>--}}
{{--    <script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>--}}
@endpush
@section('content')
    <!-- /.breadcrumb -->
    <div class="full-row" style="margin-top: -30px;">
        <div class="container">
            <div class="row">
                @if(Request::segment(2) == 'work-order')
                    <div class="col-lg-12 pt-3">
                        <h3 class="mb-2 text-secondary">Manufacturer Work Order</h3>
                    </div>
                    @include('frontend.seller.work_order_sidebar')
                @else
                    @include('frontend.seller.seller_breadcrumb')
                    @include('frontend.seller.seller_sidebar')
                @endif
                <div class="col-lg-9">
                    <h4>@lang('website.Membership Packages')</h4>

{{--                    <form action="{{route('seller.pay-now')}}" method="POST">--}}
{{--                        @csrf--}}
                       <div class="row">

                        <div class="col-md-6">
                            @php
                            if(isset($monthly))
                            {
                                $amount = $monthly;  
                            }
                            else{
                                $amount = getMembershipPackageAmount($membershipPackage->id);
                            }
                            
                            $vat = vat($amount);
                            @endphp
                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label">@lang('website.Package Amount'):</label>
                                </div>
                                <div class="col ">
                                    ৳{{getNumberToBangla($amount)}}
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label">@lang('website.VAT') ({{getNumberToBangla(vat_percentage())}}%):</label>
                                </div>
                                <div class="col">
                                    ৳{{getNumberToBangla($vat)}}
                                </div>

                            </div>



                            <div class="row">
                                <div class="col">
                                    <label class="col-form-label">@lang('website.Total Amount'):</label>
                                </div>
                                <div class="col">
                                    ৳{{getNumberToBangla($amount + $vat)}}
                                    <input type="hidden" id="amount" value="{{$amount + $vat}}">
                                </div>

                            </div>
                        </div>
                        {{-- div for manual payment starts--}}
                        <div class="col-md-6">
                            {{-- <form action="{{route('seller.pay-now')}}" method="POST"> --}}
                                <form action=" {{route('seller.buy-now-manually',$membershipPackage->id)}}" method="POST">

                                @csrf
                                <div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">

                                                <div class="col-4">
                                                    <input type="radio" name="payment_with" value="Pay Manually" id="PayManually" class="shipping_method" onclick="ShowHidePaymentWith()">
                                                    <label for="PayManually">@lang('website.Pay Manually')</label>
                                                </div>
                                                <div class="row">

                                                    <div class="col-8">


                                                        {{-- for adding amount --}}
                                                        <input type="hidden" name="amount" value="{{$amount + $vat}}">
                                                        {{-- for adding amount ends--}}

                                                        <div id="div_pay_manually" style="display: none;">
                                                            <div class="col-4">
                                                                <input type="radio" name="payment_type" value="Cash" id="Cash" class="shipping_method" onclick="ShowHidePaymentType()">
                                                                <label for="Cash">@lang('website.Cash')</label>
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="radio" name="payment_type" value="LC" id="LC" class="shipping_method" onclick="ShowHidePaymentType()">
                                                                <label for="LC">@lang('website.LC')</label>
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="radio" name="payment_type" value="Check" id="Check" class="shipping_method" onclick="ShowHidePaymentType()">
                                                                <label for="Check">@lang('website.Cheque')</label>
                                                            </div>
                                                            <div id="div_check_number" style="display: none;">
                                                                <div class="col-4">
                                                                    @lang('website.Bank Name'):
                                                                    <input type="text" name="bank_name" id="txtBankName" />
                                                                </div>
                                                                <div class="col-4">
                                                                    @lang('website.Cheque Number'):
                                                                    <input type="text" name="check_number" id="txtEmail" />
                                                                </div>
                                                                <div class="col-4">
                                                                    @lang('website.Dispatch Date'):
                                                                    <input type="text" name="dispatch_date" id="txtDispatchDate" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br/>
                                    <div class="col-12">&nbsp;</div>
                                    <div class="row" id="div_description" style="display: none;">
                                        <div class="col-4">
                                            <label>@lang('website.Description') <span>*</span></label>
                                        </div>
                                        <div class="col-8">
                                            <textarea name="description" id="meta_desc" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="col-4 mt-3">
                                            <label>@lang('website.Account Name'): </label>
                                        </div>
                                        <div class="col-8 mt-3">@lang('website.Fabric Lagbe Limited')</div>

                                        <div class="col-4">
                                            <label>@lang('website.A/c No').: </label>
                                        </div>
                                        <div class="col-8">{{getNumberToBangla(1301010010590)}}</div>
                                        <div class="col-4">
                                            <label>@lang('website.Bank Name'): </label>
                                        </div>
                                        <div class="col-8">@lang('website.Mutual Trust Bank Limited')</div>
                                        <div class="col-4">
                                            <label>@lang('website.Branch Name'): </label>
                                        </div>
                                        <div class="col-8">@lang('website.Gulshan Branch')</div>
                                        <div class="col-4">
                                            <label>@lang('website.Branch Code'): </label>
                                        </div>
                                        <div class="col-8">{{getNumberToBangla(175261840)}}</div>
                                        <div class="col-4">
                                            <label>@lang('website.Swift Code'): </label>
                                        </div>
                                        <div class="col-8">MTBLBDDHGUL</div>
                                        <div class="col-4">
                                            <label>@lang('website.Routing Number'): </label>
                                        </div>
                                        <div class="col-8">{{getNumberToBangla(145261720)}}</div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success" style="background-color: #4ce43a;">@lang('website.Submit')</button>
                                        </div>

                                    </div>

                                    <div class="row" style="padding-top: 20px;">
        {{--                                <div class="col-md-6">--}}
        {{--                                    <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #ab0e0e;">@lang('website.Close')</button>--}}
        {{--                                </div>--}}

                                    </div>
                                </div>
                            </form>
                        </div>
                         {{-- div for manual payment ends--}}

                       </div>
                                <div class="col-4">
                                    <label class="col-form-label">Do You Agree ?</label>
                                </div>
                                <div class="col-md-8 row">



                                    <div class="col-md-4">
                                        <a href="{{route('seller.buy-now',['id'=>$membershipPackage->id,'monthly'=> $monthly])}}" class="btn btn-success" >Pay Online</a>
                                    </div> 

                                    <div class="col-md-4">
                                        <a href="{{url('seller/memberships-package-list')}}"><button type="button" class="btn btn-success" style="background-color: #ab0e0e;">@lang('website.Close')</button></a>
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <button class="btn btn-info" id="bKash_button">
                                            Pay with bKash
                                        </button>
                                    </div> --}}

                        <br/>

                        <div class="row" style="padding-top: 20px;">

                        </div>
{{--                    </form>--}}

                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="price" name="price" value="{{$bkashAmount}}"><br><br>
{{--    <input type="hidden" id="price" name="price" value="1"><br><br>--}}

@endsection
@push('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script id="myScript" src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>

    <script>
        var price = document.getElementById('price').value;
        console.log(price);
        var paymentID = '';
        bKash.init({
            paymentMode: 'checkout', //fixed value ‘checkout’
            //paymentRequest format: {amount: AMOUNT, intent: INTENT}
            //intent options
            //1) ‘sale’ – immediate transaction (2 API calls)
            //2) ‘authorization’ – deferred transaction (3 API calls)
            paymentRequest: {
                amount: price, //max two decimal points allowed
                intent: 'sale'
            },
            createRequest: function(request) { //request object is basically the paymentRequest object, automatically pushed by the script in createRequest method
                console.log("create working !!")
                $.ajax({
                    url: '/bkash/create',
                    type: 'POST',
                    data: JSON.stringify(request),
                    contentType: 'application/json',
                    success: function(data) {

                        console.log(data)
                        var bkashData =JSON.parse(data);
                        if (bkashData && bkashData.paymentID != null) {
                            paymentID = bkashData.paymentID;
                            bKash.create().onSuccess(bkashData); //pass the whole response data in bKash.create().onSucess() method as a parameter
                        } else {
                            bKash.create().onError();
                        }
                    },
                    error: function() {
                        bKash.create().onError();
                    }
                });
            },
            executeRequestOnAuthorization: function() {
                console.log("execute working !!")
                $.ajax({
                    url: '/bkash/execute',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "paymentID": paymentID
                    }),
                    success: function(data) {

                        console.log("execution response" , data)
                        var bkashData =JSON.parse(data);
                        if (bkashData && bkashData.paymentID != null) {
                            console.log("success")
                            console.log("trxID: ",bkashData.trxID)
                            //window.location.href = `success.html?trxID=${data.trxID}`;//Merchant’s success page
                            window.location.href = '/bkash/success'; // Your redirect route when successful payment
                        } else {
                            console.log("error ");
                            window.location.href = '/bkash/fail'; // Your redirect route when fail payment
                            bKash.execute().onError();
                        }
                    },
                    error: function() {
                        bKash.execute().onError();
                    }
                });
            },
            onClose: function(){
                window.location.href='/seller/buy_now_details/'+'{{$membershipPackage->id}}';  // Your redirect route when cancel payment
            },
        });

        function clickPayButton() {
            $("#bKash_button").trigger('click');
        }
    </script>
@endpush
