@extends('frontend.layouts.master')
@section('title', 'Order Summery')
@push('css')
    <style>
        @import url(https://fonts.bunny.net/css?family=darker-grotesque);

        :root {
            --line-border-color: #a53860;
            --disabled-line-border: #d1d2d4;
            --button-active-color: #830a48;
            --text-color: #868991;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            max-width: 100vw;
            position: relative;
            width: 35rem;
        }

        .progress-container::before {
            background-color: var(--disabled-line-border);
            content: "";
            height: 0.4rem;
            left: 0;
            position: absolute;
            top: 58%;
            transform: translateY(-50%);
            width: 100%;
            z-index: -1;
        }

        .progress {
            background-color: var(--line-border-color);
            height: 0.4rem;
            left: 0;
            position: absolute;
            top: 58%;
            transform: translateY(-50%);
            transition: 0.4s ease;
            width: 0%;
            z-index: -1;
        }

        .circle {
            align-items: center;
            background-color: #fff;
            border: 3px solid var(--disabled-line-border);
            border-radius: 50%;
            color: var(--text-color);
            display: flex;
            height: 3rem;
            justify-content: center;
            transition: 0.4s ease;
            width: 3rem;
        }

        .circle.active {
            border-color: var(--line-border-color);

        }
    </style>
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

        .button input[type="radio"]:checked + label {
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
    <div class="full-row" style="background-color: #ffffff;">
        <div class="container">
            <h3 style="font-weight: bold; color:black; margin-top:-40px"> <a class="btn btn-sm btn-success btn-round" href="{{ url()->previous()
            }}">Back</a>       Order Details</h3>
            <div class="card " style="background-color: #f3f3f3">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-8">
                            <h4 style="font-weight: bold; color:black">Order#</h4>
                            <p style="line-height: 20px;"> Placed on
                                {{ date('d M Y H:i:s a', strtotime($order->created_at)) }}<br>
                                Paid By<br>
                                Authorization Code: {{ $order->invoice_code }}
                            </p>
                        </div>
                        <div class="col-4" style="text-align: right">
                            <span style="font-weight: bold; color:black"> Total:
                                {{ getNumberWithCurrencyByBnEn($order->grand_total) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="background-color: #f3f3f3; margin-top:10px;">
                <div class="card-header">
                    Package 1
                </div>
                <div class="card-body ">
                   
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                     
                        @foreach ($order->orderdetail as $key => $orderDetail)
                            @php
                                $product = \App\Model\Product::find($orderDetail->product_id);
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{url($product->thumbnail_img)}}" width="50" height="50"></td>
                                <td>{{$product->name}}</td>
                                <td>{{$orderDetail->quantity }} </td>
                                <td>{{$orderDetail->unit}} </td>
                                <td>{{getNumberWithCurrencyByBnEn($orderDetail->price_with_vat)}}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4"></th>
                            <td >Sub Total</th>
                            <td>{{getNumberWithCurrencyByBnEn($order->total)}}</th>
                        </tr>
                        <tr>
                            <td colspan="4"></th>
                            <td>Delivery Charge</td>
                            <td>{{getNumberWithCurrencyByBnEn($order->delivery_cost)}}</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="4"></th>
                            <td>VAT</td>
                            <td>{{getNumberWithCurrencyByBnEn($order->vat)}}</td>
                        </tr> --}}
                        <tr>
                            <td colspan="4"></th>
                            <td>Discount</td>
                            <td>{{getNumberWithCurrencyByBnEn($order->coupon_discount)}}</td>
                        </tr>
                        <tr>
                            <td colspan="4"></th>
                            <th>Total</th>
                            <td>{{getNumberWithCurrencyByBnEn($order->grand_total)}}</td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="row" style="background-color: #fff;">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            @if($order->delivery_status !=="Complete")
                               
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="button" style="width: 100%" data-bs-toggle="modal" data-bs-target="#pay_online">
                                        <input type="radio" id="office" name="delivery_to" value="office"/>
                                        <label class="btn btn-default" for="office">Pay Online</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="button" style="width: 100%" data-bs-toggle="modal" data-bs-target="#pay_manually">
                                        <input type="radio" id="home" name="delivery_to" value="home" />
                                        <label class="btn btn-default" for="home">Pay Manual</label>
                                    </div>
                                </div>
                                
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="pay_online" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pay Online</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="div_pay_online">
                        
                        <div class="col-6 ">
                            <a class="btn btn-info" style="width: 100%; margin-top:10px;" href="{{route('order-pay-ssl',$order->id)}}">
                                @lang('website.SSL Commerz')
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-info" style="width: 100%; margin-top:10px;" href="{{route('order-pay-stripe',$order->id)}}">
                                @lang('website.Stripe')
                            </a>
                        </div>
                        <div class="col-6" >
                            <button class="btn btn-info " id="bKash_button" style="width: 100%; margin-top:10px;">
                                Pay with bKash
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary">Understood</button>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="pay_manually" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Pay Manually</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('order-pay-manually',$order->id)}}" method="POST">
                    @csrf
                <div class="modal-body">
             
                    <div id="div_pay_manually">
                        <div class="col-4">
                            <input type="radio" name="payment_type" value="Cash" id="Cash" class="payment_method" onclick="ShowHidePaymentType()">
                            <label for="Cash">@lang('website.Cash')</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" name="payment_type" value="LC" id="LC" class="payment_method" onclick="ShowHidePaymentType()">
                            <label for="LC">@lang('website.LC')</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" name="payment_type" value="Check" id="Check" class="payment_method" onclick="ShowHidePaymentType()">
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
                    <br/>
                    <div class="col-12">&nbsp;</div>
                    <div class="row" id="div_description" >
                        <div class="col-4">
                            <label>@lang('website.Description') <span>*</span></label>
                        </div>
                        <div class="col-8">
                            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="price" name="price" value="{{$order->grand_total}}"><br><br>
@endsection
@push('js')
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
                window.location.href='/order-summary/'+'{{$order->id}}';  // Your redirect route when cancel payment
            },
        });
        function clickPayButton() {
            $("#bKash_button").trigger('click');
        }
    </script>
@endpush
