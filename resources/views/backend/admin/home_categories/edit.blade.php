@extends('backend.layouts.master')
@section("title","Edit Home Categories")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Home Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Home Categories</li>
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
                        <h3 class="card-title float-left">Edit Home Categories</h3>
                        <div class="float-right">
                            <a href="{{route('admin.home-categories.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.home-categories.update',$homeCategory->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">
                            <div class="form-group col-md-5">
                                <label for="category_id">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control select2">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$homeCategory->category_id == $category->id ? 'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="icon">Category Icon</label>
                                <input type="file" class="form-control" name="icon" id="icon">
                            </div>
                            <div class="col-md-2">
                                <label for="example-text-input" class="form-control-label">Previous Icon</label>
                                <div class="form-group">
                                    <img src="{{$homeCategory->icon?url($homeCategory->icon):''}}" height="50" width="50">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description">Description En</label>
                                <textarea class="form-control" name="description" id="description">{!! $homeCategory->description !!}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description_bn">Description BN</label>
                                <textarea class="form-control" name="description_bn" id="description_bn">{!! $homeCategory->description_bn !!}</textarea>
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
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2();
        /*$('.textarea').wysihtml5({
            toolbar: { fa: true }
        })*/
    </script>
@endpush
