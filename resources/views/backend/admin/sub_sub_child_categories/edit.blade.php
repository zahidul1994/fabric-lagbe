@extends('backend.layouts.master')
@section("title","Edit Sub Subcategory")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Sub Sub Child Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Sub Sub Child Category</li>
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
                        <h3 class="card-title float-left">Edit Sub Sub Child Category</h3>
                        <div class="float-right">
                            <a href="{{route('admin.sub-sub-child-categories.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('admin.sub-sub-child-categories.update',$subSubChildCategory->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$subSubChildCategory->name}}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name_bn">নাম</label>
                                    <input type="text" class="form-control" name="name_bn" id="name_bn" value="{{$subSubChildCategory->name_bn}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sub_sub_category_id">Sub Category Name</label>
                                <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control">
                                    @foreach($subSubCategories as $subSubCategory)
                                        <option value="{{$subSubCategory->id}}" {{$subSubCategory->id == $subSubChildCategory->sub_sub_category_id ? 'selected' : ''}}>{{$subSubCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Meta Title (@lang('website.Optional'))</label>
                                <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$subSubChildCategory->meta_title}}">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">Meta Description (@lang('website.Optional'))</label>
                                <textarea name="meta_description" id="meta_desc" class="form-control"  rows="3">{{$subSubChildCategory->meta_description}}</textarea>
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
