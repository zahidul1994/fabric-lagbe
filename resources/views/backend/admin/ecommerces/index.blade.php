@extends('backend.layouts.master')
@section("title","Order List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            margin: 0;
            white-space: nowrap;
            text-align: right;
            display: flex;
            flex-direction: row;
            gap: 5px;
            align-items: center;
            justify-content: end;
        }

        .dataTables_paginate.paging_input .paginate_button {
            border: 1px solid #ddd;
            padding: 2px 5px;
            cursor: pointer;
            transition: all .2s linear;
        }

        .dataTables_paginate.paging_input .paginate_button:hover {
            background: rgba(50, 50, 50, 1);
            color: #fff;
        }

        .dataTables_paginate.paging_input .paginate_input {
            width: 80px;
        }

    </style>
@endpush
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
                        <li class="breadcrumb-item active">Order List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Order List</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- <form role="form" action="{{route('admin.ecommerce-orders.create')}}" method="get">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="">From Date</label>
                                            <div class="">
                                                <input type="date" name="start_date" value="{{$start_date}}" class="form-control" id="inputEmail3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputPassword3" class="">To Date</label>
                                            <input type="date" name="end_date" value="{{$end_date}}" class="form-control" id="inputPassword3">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('admin.ecommerce-orders.index')}}" type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form> --}}
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Order Lists</h3>
                        <div class="float-right">
                      
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="customised_data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th width="10%">Date</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Grand Total</th>
                                <th>Payment Status</th>
                                <th>Delivery Status</th>
                                <th>Order Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                  <tr>
                                   <td>{{$loop->index+1}}</td>
                                   <td>{{date('dS F, Y H:i:s a',strtotime(@$order->created_at))}}</td>
                                   <td>{{@$order->user->name}}</td>
                                   <td>{{@$order->user->phone}}</td>
                                   <td>{{@$order->grand_total}}</td>
                                   <td>{{@$order->payment_status?:'Not Payment'}}</td>
                                   <td><div class="form-group col-md-2">
                                    <label class="switch" >
                                        <input onchange="delevery_status(this)" value="{{$order->id }}" {{$order->delivery_status == 'Complete'? 'checked':''}} type="checkbox" >
                                        <span class="slider round"></span>
                                    </label>
                                </div></td>
                                   <td>{{@$order->order_status}}</td>
                                   <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="bg-dark dropdown-item" href="{{route('admin.ecommerce-orders.show',encrypt($order->id))}}">
                                                <i class="fa fa-eye"></i> Details
                                            </a>
                                            @if($order->order_status=='Pending')
                                            <a href="{{url('admin/ecommerce-order/'.encrypt($order->id).'/approve')}}" class="bg-dark dropdown-item"><i
                                                    class="fas fa-check"></i> Approve
                                            </a>
                                            <a href="{{url('admin/ecommerce-order/'.encrypt($order->id).'/reject')}}" class="bg-dark dropdown-item" style="margin-right: 5px;">
                                                <i class="fas fa-ban"></i> Reject
                                            </a>
                                          @endif
                                          
                                        </div>
                                    </div>
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    

@stop
@push('js')
    <script src="{{asset('backend/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('backend/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.5/pagination/input.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
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
            $.post('{{ route('admin.ecommerce-order-delivery') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Delivery Status Complete successfully');
                    // location.reload();
                }
                else{
                    toastr.error( 'Delivery Status Pending successfully');
                }
            });
        }
    </script>
@endpush
