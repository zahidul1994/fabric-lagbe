@extends('backend.layouts.master')
@section('title', 'Order List')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
{{--                    <h1>Order List</h1>--}}
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                   

                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> <strong>@lang('website.Fabric Lagbe')</strong><br>
                                    <small class="float-right">Date: {{date('d-m-Y')}}</small>
                                </h4>
                            </div>

                        </div>

                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                User Info
                                <address>
                                    <strong>{{(@$order->user->name)}}</strong><br>
                                    {{(@$order->user->user_type)}}<br>
                                     Address: {{(@$order->user->address)}}<br>
                                    Phone: {{(@$order->user->phone)}}<br>
                                    Email: {{(@$order->user->email)}}
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                Shipping Info
                                @php
				        	$shipping_address = json_decode($order->shipping_address);
			            	@endphp
                             
                                <address>
                                    <strong>{{@$shipping_address->full_name?:'Not Set'}}</strong><br>
                                    {{(@$shipping_address->user_type?:'Not Set')}}<br>
                                    Address: {{(@$shipping_address->address?:'Not Set')}}<br>
                                   Phone: {{(@$shipping_address->phone?:'Not Set')}}<br>
                                   Delivery To: {{(@$shipping_address->delivery_to?:'Not Set')}}
                                </address>
                            </div>

                            <div class="col-sm-4 invoice-col">
                                <b>Invoice #00 {{@$order->id}}</b><br>
                                <b>Order ID: </b> {{@$order->invoice_code}}<br>
                                <b>Date: {{@$order->created_at}}</b> <br>
                                <b>Payment Status:</b> {{@$order->payment_status}}<br>
                                <b>Grand Total: {{@$order->grand_total}}</b> <br>
                                <b>Delivery: {{@$order->delivery_status}}</b> 
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                             <th>Quantity</th>
                                             <th>Unit</th>
                                             <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderdetail as $orderinfo)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{@$orderinfo->name}}</td>                                        
                                            <td>{{@$orderinfo->quantity}}</td>
                                            <td>{{@$orderinfo->unit}}</td>
                                            <td>{{@$orderinfo->price_with_vat}}</td>
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                               
                                <p class="lead">Payment Methods: {{@$order->payment_status?: 'Not Payment'}}</p>
                                @php
                                $orderinfo=json_decode(@$order->payment_method);
                                @endphp
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    {{@$orderinfo->description}}
                                </p>
                            </div>

                            <div class="col-6">
                               
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:69%">Subtotal:</th>
                                            <td>{{$order->total}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Shipping:</th>
                                            <td> {{$order->delivery_cost}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td> {{$order->grand_total}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                @if($order->order_status=='Pending')
                                <a href="{{url('admin/ecommerce-order/'.encrypt($order->id).'/approve')}}" class="btn btn-success float-right"><i
                                    class="fas fa-check"></i> Approve
                                </a>
                                <a href="{{url('admin/ecommerce-order/'.encrypt($order->id).'/reject')}}" class="btn btn-danger float-right" style="margin-right: 5px;">
                                    <i class="fas fa-ban"></i> Reject
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@stop
@push('js')
@endpush
