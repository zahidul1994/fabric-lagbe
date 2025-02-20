@extends('backend.layouts.master')
@section("title","Buyer Update")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap4.css')}}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyer Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Buyer Information</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#edit" data-toggle="tab">Update Buyer</a></li>
                                <li class="nav-item"><a class="nav-link" href="#change_pass" data-toggle="tab">Change Password</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <!-- /.tab-pane -->
                                <div class="tab-pane active" id="edit">
                                    <form class="form-horizontal" action="{{route('admin.buyer.profile-update',$buyer->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" value="{{$buyer->name}}" class="form-control" id="inputName">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Phone (@lang('website.Optional')) </label>
                                            <div class="col-sm-10">
                                                <input type="number" name="phone" value="{{$buyer->phone}}" class="form-control" id="phone">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-2 col-form-label">Whatsapp Number  </label>
                                            <div class="col-sm-10">
                                                <input type="number" name="whatsapp_number" value="{{$buyer->whatsapp_number}}" class="form-control" id="whatsapp_number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email (@lang('website.Optional')) </label>
                                            <div class="col-sm-10">
                                                <input type="email" name="email" value="{{$buyer->email}}" class="form-control" id="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address (@lang('website.Optional')) </label>
                                            <div class="col-sm-10">
                                                <input type="text" name="address" value="{{$buyer->address}}" class="form-control" id="address">
                                            </div>
                                        </div>


                                        @php
                                        $buyerUser = \App\Model\Buyer::where('user_id',$buyer->id)->first();
                                        $selectedCategory = json_decode($buyerUser->selected_category);
                                        @endphp

                                        <div class="form-group row" id="selected_category_1">
                                            <label for="category_1" class="col-sm-3 col-form-label">Select your product willing to sell </label>
                                            <div class="col-sm-9">
                                                <select name="category_1" id="category_id" class="form-control select2" required>
                                                    <option selected disabled>@lang('website.Select')</option>
                                                    @foreach(\App\Model\Category::all() as $category)
                                                        <option value="{{$category->id}}" {{$selectedCategory && $selectedCategory->category_1 == $category->id ? 'selected':'' }}>{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_2">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_2" id="sub_category_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_3">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_3" id="sub_sub_category_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_4">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_4" id="sub_sub_child_category_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_5">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_5" id="sub_sub_child_child_category_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_6">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_6" id="category_six_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_7">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_7" id="category_seven_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_8">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_8" id="category_eight_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_9">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_9" id="category_nine_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" id="selected_category_10">
                                            <label class="col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9">
                                                <select name="category_10" id="category_ten_id" class="form-control select2">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="background-color: #fff;">
                                            <label class="control-label col-sm-3">National ID Image (Front)</label>
                                            <div class="col-sm-9">
                                                <div class="row" id="nid_front">
                                                    @if ($buyer->nid_front != null)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <a href="{{ url($buyer->nid_front) }}"> <img loading="lazy"  src="{{ url($buyer->nid_front) }}" alt="" class="img-responsive"></a>
                                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row" id="nid_alt"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row" style="background-color: #fff;">
                                            <label class="control-label col-sm-3">National ID Image (Back)</label>
                                            <div class="col-sm-9">
                                                <div class="row" id="nid_back">
                                                    @if ($buyer->nid_back != null)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <a href="{{ url($buyer->nid_back) }}"> <img loading="lazy"  src="{{ url($buyer->nid_back) }}" alt="" class="img-responsive"></a>
                                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="row" id="nid_alt"></div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="change_pass">
                                    <form class="form-horizontal" action="{{route('admin.buyer.password.update',$buyer->id)}}" method="POST" >
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control" id="inputName">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop
@push('js')
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script>
        $("#nid_front").spartanMultiImagePicker({
            fieldName: 'nid_front',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '1000000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },

            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });

        $("#nid_back").spartanMultiImagePicker({
            fieldName: 'nid_back',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '1000000',
            dropFileLabel: "Drop Here",
            onExtensionErr: function (index, file) {
                console.log(index, file, 'extension err');
                alert('Please only input png or jpg type file')
            },
            onSizeErr: function (index, file) {
                console.log(index, file, 'file size too big');
                alert('Image size too big. Please upload below 100kb');
            },

            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
        $(document).ready(function () {
            $('.select2').select2();
            get_subcategories();
            $("#selected_category_2").hide()
            $("#selected_category_3").hide()
            $("#selected_category_4").hide()
            $("#selected_category_5").hide()
            $("#selected_category_6").hide()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()

        $('#category_id').on('change', function () {
            $("#selected_category_2").show()
            $("#selected_category_3").hide()
            $("#selected_category_4").hide()
            $("#selected_category_5").hide()
            $("#selected_category_6").hide()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_subcategories();
        });
        $('#sub_category_id').on('change', function () {
            $("#selected_category_3").show()
            $("#selected_category_4").hide()
            $("#selected_category_5").hide()
            $("#selected_category_6").hide()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_subsubcategories();
        });
        $('#sub_sub_category_id').on('change', function () {
            $("#selected_category_4").show()
            $("#selected_category_5").hide()
            $("#selected_category_6").hide()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_sub_sub_child_categories();
        });
        $('#sub_sub_child_category_id').on('change', function () {
            $("#selected_category_5").show()
            $("#selected_category_6").hide()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_sub_sub_child_child_categories();
        });
        $('#sub_sub_child_child_category_id').on('change', function () {
            $("#selected_category_6").show()
            $("#selected_category_7").hide()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_category_six();
        });
        $('#category_six_id').on('change', function () {
            $("#selected_category_7").show()
            $("#selected_category_8").hide()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_category_seven();
        });
        $('#category_seven_id').on('change', function () {
            $("#selected_category_8").show()
            $("#selected_category_9").hide()
            $("#selected_category_10").hide()
            get_category_eight();
        });
        $('#category_eight_id').on('change', function () {
            $("#selected_category_9").show()
            $("#selected_category_10").hide()
            get_category_nine();
        });
        $('#category_nine_id').on('change', function () {
            $("#selected_category_10").show()
            get_category_ten();
        });
        function get_subcategories() {
            var category_id = $('#category_id').val();
            $.post('{{ route('products.get_subcategories_by_category') }}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                $('#sub_category_id').html(null);
                $('#sub_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                // $('#sub_category_id').append($('<option>', {
                //     value: null,
                //     text: 'Select Product',
                //     attribute:'selected disabled'
                // }));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_category_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#sub_category_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_2?$selectedCategory->category_2:''}}'){
                        $("#sub_category_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_subsubcategories()
            });
        }
        function get_subsubcategories() {
            var sub_category_id = $('#sub_category_id').val();
            $.post('{{ route('products.get_subsubcategories_by_subcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_category_id: sub_category_id
            }, function (data) {
                $('#sub_sub_category_id').html(null);
                $('#sub_sub_category_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_category_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#sub_sub_category_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_3?$selectedCategory->category_3:''}}'){
                        $("#sub_sub_category_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_sub_sub_child_categories();
            });
        }
        function get_sub_sub_child_categories() {
            var sub_sub_category_id = $('#sub_sub_category_id').val();
            $.post('{{ route('products.get_subsubchildcategories_by_subsubcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_category_id: sub_sub_category_id
            }, function (data) {
                $('#sub_sub_child_category_id').html(null);
                $('#sub_sub_child_category_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_child_category_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#sub_sub_child_category_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_4?$selectedCategory->category_4:''}}'){
                        $("#sub_sub_child_category_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_sub_sub_child_child_categories();

            });
        }
        function get_sub_sub_child_child_categories() {
            var sub_sub_child_category_id = $('#sub_sub_child_category_id').val();
            $.post('{{ route('products.get_subsubchildchildcategories_by_subsubchildcategory') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_child_category_id: sub_sub_child_category_id
            }, function (data) {
                $('#sub_sub_child_child_category_id').html(null);
                $('#sub_sub_child_child_category_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_child_child_category_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#sub_sub_child_child_category_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_5?$selectedCategory->category_5:''}}'){
                        $("#sub_sub_child_child_category_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_category_six();
            });
        }
        function get_category_six() {
            var sub_sub_child_child_category_id = $('#sub_sub_child_child_category_id').val();
            $.post('{{ route('products.get_category_six') }}', {
                _token: '{{ csrf_token() }}',
                sub_sub_child_child_category_id: sub_sub_child_child_category_id
            }, function (data) {
                $('#category_six_id').html(null);
                $('#category_six_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_six_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#category_six_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_6?$selectedCategory->category_6:''}}'){
                        $("#category_six_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_category_seven();
            });
        }
        function get_category_seven() {
            var category_six_id = $('#category_six_id').val();
            $.post('{{ route('products.get_category_seven') }}', {
                _token: '{{ csrf_token() }}',
                category_six_id: category_six_id
            }, function (data) {
                $('#category_seven_id').html(null);
                $('#category_seven_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_seven_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#category_seven_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_7?$selectedCategory->category_7:''}}'){
                        $("#category_seven_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_category_eight();
            });
        }
        function get_category_eight() {
            var category_seven_id = $('#category_seven_id').val();

            $.post('{{ route('products.get_category_eight') }}', {
                _token: '{{ csrf_token() }}',
                category_seven_id: category_seven_id
            }, function (data) {
                $('#category_eight_id').html(null);
                $('#category_eight_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_eight_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#category_eight_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_8?$selectedCategory->category_8:''}}'){
                        $("#category_eight_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_category_nine();
            });
        }
        function get_category_nine() {
            var category_eight_id = $('#category_eight_id').val();
            $.post('{{ route('products.get_category_nine') }}', {
                _token: '{{ csrf_token() }}',
                category_eight_id: category_eight_id
            }, function (data) {
                $('#category_nine_id').html(null);
                $('#category_nine_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_nine_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#category_nine_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_9?$selectedCategory->category_9:''}}'){
                        $("#category_nine_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
                get_category_ten();
            });
        }
        function get_category_ten() {
            var category_nine_id = $('#category_nine_id').val();
            $.post('{{ route('products.get_category_ten') }}', {
                _token: '{{ csrf_token() }}',
                category_nine_id: category_nine_id
            }, function (data) {
                $('#category_ten_id').html(null);
                $('#category_ten_id').append($('<option selected disabled>Select Product</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_ten_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#category_ten_id > option").each(function() {
                    if(this.value == '{{$selectedCategory && $selectedCategory->category_10?$selectedCategory->category_10:''}}'){
                        $("#category_ten_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
            });
        }
        });
    </script>
@endpush
