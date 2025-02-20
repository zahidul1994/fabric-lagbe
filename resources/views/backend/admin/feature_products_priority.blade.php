@extends('backend.layouts.master')
@section("title","Feature Product List")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Feature Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Feature Product List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Feature Product Lists</h3>
                        <div class="float-right">
                            <a href="{{route($type == 'seller'?'admin.seller-product-list':'admin.buyer-product-list')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('admin.feature_products_priority.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="user_type" value="{{$type}}">
                    <div class="card-body table-responsive">
                        <table id="" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Date Time</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Featured Status</th>
                                <th>Priority Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key => $product)
                                <input type="hidden" name="product_id[]" value="{{$product->id}}">
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{date('d M  Y, H:i:s a',strtotime($product->created_at))}}</td>
                                    <td>{{$product->name}}</td>
                                    <td><img src="{{url($product->thumbnail_img)}}" width="50" height="50"></td>
                                    <td>
                                        <div class="form-group col-md-2">
                                            <label class="switch" style="margin-top:40px;">
                                                <input onchange="update_featured(this)" value="{{ $product->id }}" {{$product->featured_product_v2 == 1? 'checked':''}} type="checkbox" >
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="priority[]" value="{{$type == 'seller' ? $product->priority_seller: $product->priority_buyer}}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

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
