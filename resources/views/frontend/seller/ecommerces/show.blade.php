@extends('frontend.layouts.master')
@section("title"," Ecommerce Sales Details")

@section('content')
    <!-- Main content -->
    <div class="full-row m_t_30">
        <div class="container">
            <div class="row">
                @include('frontend.seller.seller_breadcrumb')
                @include('frontend.seller.seller_sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        
                                       
                    
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
                                                           
                                                            <tr>
                                                                <td>{{1}}</td>
                                                                <td>{{@$orderinfo->name}}</td>                                        
                                                                <td>{{@$order->quantity}}</td>
                                                                <td>{{@$order->unit}}</td>
                                                                <td>{{@$order->price}}</td>
                                                            </tr>
                                                          
                                                        </tbody>
                                                    </table>
                                                </div>
                    
                                            </div>
                    
                                            <div class="row">
                    
                                                <div class="col-6">
                                                   
                                                    
                                                </div>
                    
                                                <div class="col-6">
                                                   
                                                    <div class="table-responsive">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop










