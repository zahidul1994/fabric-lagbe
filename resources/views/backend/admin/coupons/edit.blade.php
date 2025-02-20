@extends('backend.layouts.master')
@section("title","Edit Coupon")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Coupon</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
            <!-- general form elements -->
                <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title float-left">Edit Coupon</h3>
                    <div class="float-right">
                        <a href="{{route('admin.coupons.index')}}">
                            <button class="btn btn-success">
                                <i class="fa fa-backward"> </i>
                                Back
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.coupons.update',$coupon->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="code">Coupon Code</label>
                            <input type="text" class="form-control" name="code" id="code" value="{{$coupon->code}}" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Coupon Type </label>
                            <select class="form-control" name="type" required>
                                <option selected disabled>Select</option>
                                <option value="Flat" {{$coupon->type == 'Flat'?'selected':''}}>Flat</option>
                                <option value="Percentage" {{$coupon->type == 'Percentage'?'selected':''}}>Percentage</option>
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="{{$coupon->amount}}" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
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

@endpush
