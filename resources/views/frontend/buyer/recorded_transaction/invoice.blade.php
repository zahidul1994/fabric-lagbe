<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fabric Lagbe | Invoice Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    <img src="{{asset('frontend/logo.png')}}" width="154px">
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                @lang('website.Company Info')
                <address>
                    <strong>@lang('website.Fabric Lagbe')</strong><br>
                    <b>Address :</b>@lang('website.Azad Plaza (4th Floor), TA-98/1, Gulshan, Badda Link Road, Gulshan-1, Dhaka-1212') <br>
                    <b>Phone :</b> {{getNumberToBangla('09678')}}-{{getNumberToBangla('236236')}}<br>
                    <b>Email :</b> info@fabriclage.com<br>
                </address>
            </div>
        @php
            $seller = \App\Model\Seller::where('user_id',$saleRecord->seller_user_id)->first();
            $buyer = \App\User::where('id',$saleRecord->buyer_user_id)->first();
        @endphp
        <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                @lang('website.Buyer Info')
                <address>
                    <strong>{{getNameByBnEn($buyer)}}</strong><br>
                    {{getAddressByBnEn($buyer)}}<br>
                    Phone:
                    @if(app()->getLocale('locale') == 'en')
                        {{$buyer->country_code}}
                    @else
                        +৮৮০
                    @endif
                    {{getNumberToBangla($buyer->phone)}}<br>
                    Email: {{$buyer->email}}
                </address>
            </div>
            <!-- /.col -->
{{--            <div class="col-sm-3 invoice-col">--}}
{{--                @lang('website.Seller Info')--}}
{{--                <address>--}}
{{--                    <b>Seller Name:</b> <strong> {{getNameByBnEn($seller->user)}}</strong><br>--}}
{{--                    <b>Phone:</b>--}}
{{--                    @if(app()->getLocale('locale') == 'en')--}}
{{--                        {{$seller->user->country_code}}--}}
{{--                    @else--}}
{{--                        +৮৮০--}}
{{--                    @endif--}}
{{--                    {{getNumberToBangla($seller->user->phone)}}<br>--}}
{{--                    <b>Company Name:</b> {{getCompanyNameByBnEn($seller)}}<br>--}}
{{--                    <b>Company Address:</b> {{getCompanyAddressByBnEn($seller)}}<br>--}}
{{--                    <b>Email:</b> {{$seller->company_email}}--}}
{{--                </address>--}}
{{--            </div>--}}
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice: {{getInvoiceByBnEn($saleRecord->invoice_code)}}</b><br>
                <br>
                {{--                <b>Order ID:</b> 4F3S8J<br>--}}
                <b>Date:</b> {{getDateConvertByBnEn($saleRecord->created_at)}}<br>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>@lang('website.Product Name')</th>
                        <th>@lang('website.Qty')</th>
                        <th>@lang('website.Unit Price')</th>
                        <th>@lang('website.Bid Unit Price')</th>
                        <th>@lang('website.Bid Total Price')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{getNameByBnEn($saleRecord->product)}}</td>
                        <td>{{getNumberToBangla($saleRecord->product->quantity)}} {{getNameByBnEn($saleRecord->product->unit)}}</td>
                        <td>{{getNumberWithCurrencyByBnEn($saleRecord->product->unit_price)}}</td>
                        <td>{{getNumberWithCurrencyByBnEn($saleRecord->productBid->unit_bid_price)}}</td>
                        <td>{{getNumberWithCurrencyByBnEn($saleRecord->amount)}}</td>
                        {{--                            <td>{{$saleRecord->product->currency->name}}</td>--}}
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                {{--                <p class="lead">Payment Methods:</p>--}}
                {{--                <img src="../../dist/img/credit/visa.png" alt="Visa">--}}
                {{--                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
                {{--                <img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
                {{--                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

                {{--                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
                {{--                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr--}}
                {{--                    jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                {{--                </p>--}}
            </div>
            <!-- /.col -->
            <div class="col-6">

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>@lang('website.Total'):</th>
                            <td>{{getNumberWithCurrencyByBnEn($saleRecord->amount)}}</td>
                        </tr>
                        <tr>
                            <th>@lang('website.Total') <small>(@lang('website.In Word'))</small> :</th>
                            <td>
                               {{ucwords($digit->format($saleRecord->amount))}} Only
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        {{--        <div style="padding-top: 20px;">--}}
        {{--            <h3 class="text-center">Terms and Condition</h3>--}}
        {{--            <p>--}}
        {{--                1. once you confirm you will not be able to accept other bids,--}}
        {{--                no one will be able to bid on this product as well.--}}
        {{--            </p>--}}
        {{--            <p>--}}
        {{--                2. Our authority will not take any responsibility for any other transaction or--}}
        {{--                product related issue. Payment, delivery, quality, quantity, testing parameter of--}}
        {{--                this product will be handled manually by buyer and seller. Fabric Lagbe will not--}}
        {{--                liable for any of the aforementioned issues.--}}
        {{--            </p>--}}
        {{--            <p>--}}
        {{--                3. I'm liable to pay {{sellerCurrentCommission($saleRecord->seller_user_id)}}% commission of the above mentioned total price as per--}}
        {{--                Bangladeshi Govt. commission regulation act.--}}
        {{--            </p>--}}
        {{--        </div>--}}
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
    window.addEventListener("load", window.print());
</script>
</body>
</html>
