@extends('frontend.layouts.master')
@section("title","All Ecommerce Orders")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        .m_t_30{
            margin-top: -30px;
        }
    </style>
@endpush
@section('content')
    <!-- Main content -->
    <div class="full-row m_t_30">
        <div class="container">
            <div class="row">
                @include('frontend.buyer.buyer_breadcrumb')
                @include('frontend.buyer.buyer_sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title float-left">@lang('website.Ecommerce Orders')</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#@lang('website.SL')</th>
                                            <th>@lang('website.Date')</th>
                                            <th>@lang('website.Total Price')</th>
                                            <th>@lang('website.Payment Status')</th>
                                            <th>@lang('website.Delivery Status')</th>
                                            <th>@lang('website.Order Status')</th>
                                            <th>@lang('website.Action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($orders as $order)
                                        <tr>
                                         <td>{{getNumberToBangla($loop->index+1)}}</td>
                                         <td>{{date('dS F, Y H:i:s a',strtotime(@$order->created_at))}}</td>
                                        <td>{{getNumberWithCurrencyByBnEn(@$order->grand_total)}}</td>
                                         <td>@if ($order->payment_status=='Partial')
                                            @lang('website.Partial')
                                            @elseif($order->payment_status=='Cash')
                                            @lang('website.Cash')
                                            @elseif($order->payment_status=='LC')
                                            @lang('website.LC')
                                            @elseif($order->payment_status=='Check')
                                            @lang('website.Check')
                                            @else
                                            <a class="" target="_blank" href="{{url('order-summary/'.$order->id)}}"> @lang('website.Payment Now')</a>
                                         @endif  </td>
                                         <td><div class="form-group col-md-2">
                                          <label class="switch" >
                                              <input disabled value="{{$order->id }}" {{$order->delivery_status == 'Complete'? 'checked':''}} type="checkbox" >
                                              <span class="slider round"></span>
                                          </label>
                                      </div></td>
                                         <td>@if ($order->order_status=='Pending')
                                            @lang('website.Pending')
                                            @elseif($order->order_status=='Accpted')
                                            @lang('website.Accpted')
                                            @elseif($order->order_status=='Rejected')
                                            @lang('website.Rejected')
                                            @else
                                            @lang('website.Other')
                                         @endif </td>
                                         <td>
                                          
                                         <a class="text-success"  href="{{route('buyer.ecommerce-orders.show',encrypt($order->id))}}">
                                                      <i class="fa fa-eye"></i> @lang('website.Check')
                                                  </a>
                                      </td>
                                      </tr>
                                      @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#@lang('website.SL')</th>
                                            <th>@lang('website.Date')</th>
                                            <th>@lang('website.Total Price')</th>
                                            <th>@lang('website.Payment Status')</th>
                                            <th>@lang('website.Delivery Status')</th>
                                            <th>@lang('website.Order Status')</th>
                                            <th>@lang('website.Action')</th>
                                            
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });

    </script>
@endpush
