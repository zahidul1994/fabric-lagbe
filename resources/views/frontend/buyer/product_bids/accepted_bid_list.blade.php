@extends('frontend.layouts.master')
@section("title","Accepted Bids")
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
                                    <h3 class="card-title float-left">@lang('website.Accepted Bids')</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped table-responsive">
                                        <thead>
                                        <tr>
                                            <th>@lang('website.SL')</th>
                                            <th>@lang('website.Product Image')</th>
                                            <th>@lang('website.Product Name')</th>
                                            <th>@lang('website.Bid Type')</th>
                                            <th>@lang('website.Quantity')</th>
                                            <th>@lang('website.Bid Price') (@lang('website.Unit'))</th>
                                            <th>@lang('website.Bid Price') (@lang('website.Total'))</th>
                                            <th>@lang('website.Date')</th>
                                            <th>@lang('website.Ratings')</th>
                                            <th>@lang('website.Status')</th>
                                            <th>@lang('website.Action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product_bids as $key => $product_bid)
                                            <tr>
                                                <td>{{getNumberToBangla($key + 1)}}</td>
                                                <td>
                                                    <img src="{{url($product_bid->product->thumbnail_img)}}" width="80" height="80" alt="">
                                                </td>
                                                <td>{{getNameByBnEn($product_bid->product)}}</td>
                                                <td>
                                                    @if($product_bid->bid_type == 'partial')
                                                        @lang('website.Partial Bid')
                                                    @else
                                                        @lang('website.Full Bid')
                                                    @endif
                                                </td>
                                                <td>{{$product_bid->bid_quantity ? getNumberToBangla($product_bid->bid_quantity) : getNumberToBangla($product_bid->product->quantity)}} {{getNameByBnEn($product_bid->product->unit)}}</td>
{{--                                                <td>{{single_price($product_bid->unit_bid_price)}}</td>--}}
{{--                                                <td>{{single_price($product_bid->total_bid_price)}}</td>--}}
                                                <td>{{getNumberWithCurrencyByBnEn($product_bid->unit_bid_price)}}</td>
                                                <td>{{getNumberWithCurrencyByBnEn($product_bid->total_bid_price)}}</td>
                                                <td>{{ getDateConvertByBnEn($product_bid->created_at)}}</td>
                                                <td>{{getNumberToBangla(productRating($product_bid->product_id))}}</td>
                                                <td>
                                                    <span class="bg-success">@lang('website.Accepted')</span>
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary" href="{{route('buyer.accepted-seller-details',$product_bid->id)}}">@lang('website.Details')</a>

                                                    <a target="_blank" class="btn btn-info mt-1" href="{{route('buyer.chat-with-admin',$product_bid->id)}}">@lang('website.Chat')</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>@lang('website.SL')</th>
                                            <th>@lang('website.Product Image')</th>
                                            <th>@lang('website.Product Name')</th>
                                            <th>@lang('website.Bid Type')</th>
                                            <th>@lang('website.Quantity')</th>
                                            <th>@lang('website.Bid Price') (@lang('website.Unit'))</th>
                                            <th>@lang('website.Bid Price') (@lang('website.Total'))</th>
                                            <th>@lang('website.Date')</th>
                                            <th>@lang('website.Ratings')</th>
                                            <th>@lang('website.Status')</th>
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
