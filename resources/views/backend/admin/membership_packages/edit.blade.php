@extends('backend.layouts.master')
@section("title","Edit Membership Package")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Membership Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Membership Package</li>
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
                        <h3 class="card-title float-left">Edit Membership Package</h3>
                        <div class="float-right">
                            <a href="{{route('admin.brands.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.membership_packages.update',$membership_package->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="base_price" id="base_price" value="{{$membership_package->base_price}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="package_name">Package Name (EN)</label>
                                <input type="text" class="form-control" name="package_name" id="package_name" value="{{$membership_package->package_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="package_name">Package Name (BN)</label>
                                <input type="text" class="form-control" name="package_name_bn" id="package_name_bn" value="{{$membership_package->package_name_bn}}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Validation For</label>
                                {{--                                <input type="month" class="form-control" name="package_name" id="package_name" >--}}
                                <select class="form-control" name="validation" id="validation">
                                    <option selected disabled>Select One</option>
                                    <option value="1" {{$membership_package->validation == 1 ? 'selected':''}}>One Months</option>
                                    <option value="2" {{$membership_package->validation == 2 ? 'selected':''}}>Two Months</option>
                                    <option value="3" {{$membership_package->validation == 3 ? 'selected':''}}>Three Months</option>
                                    <option value="4" {{$membership_package->validation == 4 ? 'selected':''}}>Four Months</option>
                                    <option value="5" {{$membership_package->validation == 5 ? 'selected':''}}>Five Months</option>
                                    <option value="6" {{$membership_package->validation == 6 ? 'selected':''}}>Six Months</option>
                                    <option value="7" {{$membership_package->validation == 7 ? 'selected':''}}>Seven Months</option>
                                    <option value="8" {{$membership_package->validation == 8 ? 'selected':''}}>Eight Months</option>
                                    <option value="9" {{$membership_package->validation == 9 ? 'selected':''}}>Nine Months</option>
                                    <option value="10" {{$membership_package->validation == 10 ? 'selected':''}}>Ten Months</option>
                                    <option value="11" {{$membership_package->validation == 11 ? 'selected':''}}>Eleven Months</option>
                                    <option value="12" {{$membership_package->validation == 12 ? 'selected':''}}>Twelve Months</option>
                                </select>
                                <div class="form-group">
                                    <label for="price">Validation Price</label>
                                    <input type="text" class="form-control" name="price" id="price" value="{{$membership_package->price}}" required>
                                </div>
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
    <script>
        $('#validation').on('change',function (){
            var month =   $('#validation').val();
            var basePrice = $('#base_price').val();
            var validationPrice = Math.round((basePrice/12)*month);
            $('#price').val(validationPrice);
        })
    </script>
@endpush
