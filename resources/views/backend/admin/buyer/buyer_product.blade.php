@extends('backend.layouts.master')
@section("title","Buyer Requested Product List")
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
                    <h1>Buyer Requested Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Buyer Requested Product List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Buyer Requested Product List</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.buyer-product-list')}}" method="get">
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
                                <a href="{{route('admin.buyer-product-list')}}" type="reset" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
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
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Buyer Requested Product Lists</h3>
                        <div class="float-right">
                            <a href="{{route('admin.feature_products_priority','buyer')}}" class="btn btn-success text-white">Set feature products priority</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table id="customised_data_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Date Time</th>
                                <th>Buyer Name</th>
                                <th>Buyer Phone</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Image Alt</th>
                                <th>Qty</th>
                                <th>Total Price (BDT)</th>
                                <th>Bid Status</th>
                                <th>Verification Status</th>
                                <th>Featured Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal html start--}}
        <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal-content">

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
    $(function() {
        $('#customised_data_table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            pagingType: "input",
            aLengthMenu: [
                [10, 25, 50, 100, 200, 400, 500, -1],
                [10, 25, 50, 100, 200, 400, 500, "All"]
            ],

            ajax: '{{ route('admin.buyer-product-list.ajax',['start_date'=>$start_date,'end_date'=>$end_date]) }}',
            columns: [
                {
                    "title": "#SL",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    searching: false,
                    orderable: false,

                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'user_type',
                    name: 'user_type'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'thumbnail_img',
                    name: 'thumbnail_img'
                },
                {
                    data: 'image_alt',
                    name: 'image_alt'
                },
                {
                    data: 'quantity',
                    name: 'quantity'
                },
                {
                    data: 'expected_price',
                    name: 'expected_price'
                },
                {
                    data: 'bid_status',
                    name: 'bid_status'
                },
                {
                    data: 'verification_status',
                    name: 'verification_status',
                    searching: false,
                },
                {
                    data: 'featured_status',
                    name: 'featured_status',
                    searching: false,
                },
                {
                    data: 'actions',
                    name: 'actions',
                    searching: false,
                    orderable: false,
                    class: 'text-center'
                }
            ]
        });
    });
</script>
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

        //update status
        function update_status1(el){
            if(el.checked){
                var verification_status = 1;
            }
            else{
                var verification_status = 0;
            }
            $.post('{{ route('admin.seller-product.status') }}', {_token:'{{ csrf_token() }}', id:el.value, verification_status:verification_status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Product verification Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var featured_status = 1;
            }
            else{
                var featured_status = 0;
            }
            $.post('{{ route('admin.featured-product.status') }}', {_token:'{{ csrf_token() }}', id:el.value, featured_status:featured_status}, function(data){
                if(data == 1){
                    toastr.success('success', 'Product featured Status updated successfully');
                }
                else{
                    toastr.danger('danger', 'Something went wrong');
                }
                location.reload();
            });
        }
    </script>
@endpush
