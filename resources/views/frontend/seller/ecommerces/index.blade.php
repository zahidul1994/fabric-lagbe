@extends('frontend.layouts.master')
@section("title","All Ecommerce Sales")
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
                @include('frontend.seller.seller_breadcrumb')
                @include('frontend.seller.seller_sidebar')
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h3 class="card-title float-left">@lang('website.Ecommerce Sales')</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#@lang('website.SL')</th>
                                            <th>@lang('website.Date')</th>
                                            <th>@lang('website.Product Name')</th>
                                            <th>@lang('website.Delivery Status')</th>
                                            <th>@lang('website.Action')</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sales as $sale)
                                        <tr>
                                         <td>{{getNumberToBangla($loop->index+1)}}</td>
                                        
                                         <td>{{date('dS F, Y H:i:s a',strtotime(@$sale->created_at))}}</td>
                                         <td><a href="{{route('frontend-product-details',@$sale->product->slug?:'test-data')}}" style="color: black">{{@$sale->product->name}}</a></td>
                                         <td><div class="form-group col-md-2">
                                            @if($sale->delivery_status == 'Complete')
                                           
                                            <label class="switch" >
                                                <input disabled onchange="delevery_status(this)" value="{{$sale->id }}" {{$sale->delivery_status == 'Complete'? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                            @else
                                                <label class="switch" >
                                                    <input value="{{$sale->id }}" {{$sale->delivery_status == 'Complete'? 'checked':''}} type="checkbox" >
                                                    <span class="slider round"></span>
                                                </label>
                                            @endif
                                      </div></td>
                                         <td>
                                         <a class="text-success"  href="{{route('seller.ecommerce-sales.show',encrypt($sale->id))}}">
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
                                            <th>@lang('website.Product Name')</th>
                                            <th>@lang('website.Delivery Status')</th>
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
        
        });
        $(function () {
            $("#customised_data_table").DataTable();
           
        });
       
        function delevery_status(el){
            if(el.checked){
                var status = "Complete"; 
            }
            else{
                var status =  "Pending";
            }
            $.post('{{ route('seller.ecommerce-sales-delivery') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Delivery Status Complete successfully');
                     location.reload();
                }
                else{
                    toastr.error( 'Delivery Status Pending successfully');
                }
            });
        }
    </script>
@endpush
