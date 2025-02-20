@extends('backend.layouts.master')
@section("title","Edit Seller Profile")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #212529;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: default;
            float: left;
            margin-right: 5px;
            margin-top: 5px;
            padding: 0 5px;
        }
    </style>
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Seller Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-10 offset-1">
                <!-- general form elements -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title float-left">Edit Seller Profile</h3>
                        <div class="float-right">
                            <a href="{{route('admin.seller.profile.show',encrypt($sellerInfo->id))}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" class="" action="{{route('admin.seller.profile.update',$sellerInfo->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="">Name</label>
                                    <input type="text" value="{{$sellerInfo->name}}" name="name" class="form-control" id="name" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone (@lang('website.Optional'))</label>
                                    <input type="number" value="{{$sellerInfo->phone}}" name="phone" class="form-control" id="phone" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Whatsapp Number (@lang('website.Optional'))</label>
                                    <input type="number" value="{{$sellerInfo->whatsapp_number}}" name="whatsapp_number" class="form-control" id="whatsapp_number" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email (@lang('website.Optional'))</label>
                                    <input type="email" value="{{$sellerInfo->email}}" name="email" class="form-control" id="email" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="address">Address (@lang('website.Optional'))</label>
                                    <input type="text" value="{{$sellerInfo->address}}" name="address" class="form-control" id="address" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_name">Company Name (@lang('website.Optional'))</label>
                                    <input type="text" value="{{$sellerInfo->seller->company_name}}" name="company_name" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="designation">Designation</label>
                                    <input type="text" value="{{$sellerInfo->seller->designation}}" name="designation" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_phone">Company Phone (@lang('website.Optional'))</label>
                                    <input type="text" value="{{$sellerInfo->seller->company_phone}}" name="company_phone" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_email">Company Email (@lang('website.Optional'))</label>
                                    <input type="email" value="{{$sellerInfo->seller->company_email}}" name="company_email" class="form-control" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="company_address">Company Address (@lang('website.Optional'))</label>
                                    <input type="text" value="{{$sellerInfo->seller->company_address}}" name="company_address" class="form-control">
                                </div>
                                @php
                                    $divisions = \App\Model\Division::all();
                                @endphp
                                <div class="form-group col-md-6" id="division_area">
                                    <label for="division_id">Division (@lang('website.Optional')) <span class="required">*</span>  </label>
                                    <select name="division_id" id="division_id" class="form-control select2" >
                                        <option value="">Select</option>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}" {{$sellerInfo->seller->division_id ==$division->id ? 'selected':''}}>{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6" id="district_area">
                                    <label for="district_id">District <span class="required">*</span> </label>
                                    <select name="district_id" id="district_id" class="form-control select2" >
                                    </select>
                                </div>
                                @php
                                    $sellerUser = \App\Model\Seller::where('user_id',$sellerInfo->id)->first();
                                    $selectedCategory = json_decode($sellerUser->selected_category);
                                @endphp

                                <div class="form-group col-md-8" id="selected_category_1">
                                    <label for="category_1">Select your product willing to buy </label>
                                    <select name="category_1" id="category_id" class="form-control select2" required>
                                        <option selected disabled>@lang('website.Select')</option>
                                        @foreach(\App\Model\Category::all() as $category)
                                            <option value="{{$category->id}}" {{$selectedCategory && $selectedCategory->category_1 == $category->id ? 'selected':'' }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_2">
                                    <select name="category_2" id="sub_category_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_3">
                                    <select name="category_3" id="sub_sub_category_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_4">
                                    <select name="category_4" id="sub_sub_child_category_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_5">

                                    <select name="category_5" id="sub_sub_child_child_category_id" class="form-control select2">

                                    </select>

                                </div>
                                <div class="form-group col-md-8" id="selected_category_6">
                                    <select name="category_6" id="category_six_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_7">
                                    <select name="category_7" id="category_seven_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_8">
                                    <select name="category_8" id="category_eight_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_9">
                                    <select name="category_9" id="category_nine_id" class="form-control select2">

                                    </select>
                                </div>
                                <div class="form-group col-md-8" id="selected_category_10">
                                    <select name="category_10" id="category_ten_id" class="form-control select2">

                                    </select>
                                </div>
                                {{--                                @php--}}
                                {{--                                    $categories = \App\Model\Category::all();--}}
                                {{--                                @endphp--}}
                                {{--                                <div id="category_area" class="form-group col-md-6">--}}
                                {{--                                    <label for="selected_category">Type your Product willing to sell (@lang('website.Optional'))</label>--}}
                                {{--                                    <select name="selected_category[]" id="selected_category" class="form-control select2" multiple>--}}
                                {{--                                        @foreach($categories as $category)--}}
                                {{--                                            @php--}}
                                {{--                                                $ids = explode(',',$sellerInfo->seller->selected_category)--}}
                                {{--                                            @endphp--}}
                                {{--                                            @if(!empty($ids))--}}
                                {{--                                                @foreach($ids as $id)--}}
                                {{--                                                    <option value="{{$category->id}}" {{ $id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>--}}
                                {{--                                                @endforeach--}}
                                {{--                                            @else--}}
                                {{--                                                <option value="{{$category->id}}">{{$category->name}}</option>--}}
                                {{--                                            @endif--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="form-group row" style="background-color: #fff;">
                                <label class="control-label ml-3">Trade Licence Image (@lang('website.Optional'))</label>
                                <div class="col-sm-10">
                                    <div class="row" id="trade_licence" style="background-color: #fff;">
                                        @if ($sellerInfo->seller->trade_licence)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url($sellerInfo->seller->trade_licence) }}"> <img loading="lazy"  src="{{ url($sellerInfo->seller->trade_licence) }}" alt="" class="img-responsive"> </a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" id="trade_licence_alt"></div>
                                </div>
                            </div>

                            <div class="form-group row" style="background-color: #fff;">
                                <label class="control-label ml-3">National ID Image (Front) (@lang('website.Optional'))</label>
                                <div class="col-sm-10">
                                    <div class="row" id="nid_front">
                                        @if ($sellerInfo->seller->nid_front != null)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url($sellerInfo->seller->nid_front) }}"> <img loading="lazy"  src="{{ url($sellerInfo->seller->nid_front) }}" alt="" class="img-responsive"></a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" id="nid_alt"></div>
                                </div>
                            </div>
                            <div class="form-group row" style="background-color: #fff;">
                                <label class="control-label ml-3">National ID Image (Back) (@lang('website.Optional'))</label>
                                <div class="col-sm-10">
                                    <div class="row" id="nid_back">
                                        @if ($sellerInfo->seller->nid_back != null)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url($sellerInfo->seller->nid_back) }}"> <img loading="lazy"  src="{{ url($sellerInfo->seller->nid_back) }}" alt="" class="img-responsive"></a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row" id="nid_alt"></div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@push('js')
    <script src="{{asset('backend/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            get_district_by_division();
        });
        $('#division_id').on('change', function () {
            get_district_by_division();
        });
        function get_district_by_division() {
            var division_id = $('#division_id').val();
            //console.log(category_id)
            $.post('{{ route('get_district_by_division') }}', {
                _token: '{{ csrf_token() }}',
                division_id: division_id
            }, function (data) {
                $('#district_id').html(null);
                $('#district_id').append($('<option>', {
                    value: null,
                    text: null
                }));
                for (var i = 0; i < data.length; i++) {
                    $('#district_id').append($('<option>', {
                        value: data[i].id,
                        text: data[i].name
                    }));
                }
                $("#district_id > option").each(function() {
                    if(this.value == '{{$sellerInfo->seller->district_id}}'){
                        $("#district_id").val(this.value).change();
                    }
                });
            });
        }

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
        $("#trade_licence").spartanMultiImagePicker({
            fieldName: 'trade_licence',
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
            onAddRow:function(index){
                var altData = '<input type="text" placeholder="" name="trade_licence[]" class="form-control" required=""></div>'
                //var index = index + 1;
                //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            },
            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },
        });
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    </script>
    <script>

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

                });
            }
        });
    </script>
@endpush
