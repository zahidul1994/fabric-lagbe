@extends('frontend.layouts.master')
@section('title', 'Buyer Edit Profile')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <style>
        select+.select2-container {
            z-index: 98;
            width: 100% !important;
        }
        .select2-container--default .color-preview {
            height: 12px;
            width: 12px;
            display: inline-block;
            margin-right: 5px;
            margin-top: 2px;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 45px!important;
        }
    </style>
@endpush
@section('content')
    <div class="full-row" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                @include('frontend.buyer.buyer_breadcrumb')
                @include('frontend.buyer.buyer_sidebar')
                <div class="col-lg-9">
                    <h4>@lang('website.Edit Profile')</h4>
                    <form class="woocommerce-form-login" action="{{route('buyer.profile-update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <p class="col-lg-4 col-md-4 col-12">
                                <label for="name">@lang('website.Name') <span class="required">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{Auth::User()->name}}" id="name" style="background-color: #f3f3f3"/>
                            </p>
                            <p class="col-lg-4 col-md-4 col-12">
                                <label for="email"> @lang('website.Email Address')&nbsp;</label>
                                <input type="email" class="form-control" name="email" value="{{Auth::User()->email}}" id="" style="background-color: #f3f3f3"/>
                            </p>
                            <p class="col-lg-4 col-md-4 col-12">
                                <label for="number"> @lang('website.WhatsApp Number')&nbsp;</label>
                                <input type="number" class="form-control" name="whatsapp_number" value="{{Auth::User()->whatsapp_number}}" id="" style="background-color: #f3f3f3"/>
                            </p>
                            @php
                                $buyer = \App\Model\Buyer::where('user_id',Auth::id())->first();
                                $selectedCategory = json_decode($buyer->selected_category);
                            @endphp
                            <div id="selected_category_1" class="col-md-7">
                                <label for="category_1">@lang('website.Select your Product willing to buy') <span class="required">*</span> </label>
                                <select name="category_1" id="category_id" class="form-control select2 bg-gray-light" required>
                                    <option selected disabled>@lang('website.Select')</option>
                                    @foreach(\App\Model\Category::all() as $category)
                                        <option value="{{$category->id}}" {{$selectedCategory && $selectedCategory->category_1 == $category->id ? 'selected':'' }}>{{getNameByBnEn($category)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_2">
                                <select name="category_2" id="sub_category_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_3" >
                                <select name="category_3" id="sub_sub_category_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_4" >
                                <select name="category_4" id="sub_sub_child_category_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_5" >
                                <select name="category_5" id="sub_sub_child_child_category_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_6" >
                                <select name="category_6" id="category_six_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_7" >
                                <select name="category_7" id="category_seven_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_8" >
                                <select name="category_8" id="category_eight_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_9" >
                                <select name="category_9" id="category_nine_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="mt-3 col-md-7" id="selected_category_10" >
                                <select name="category_10" id="category_ten_id" class="form-control select2">

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label ml-3">@lang('website.National ID Image') (@lang('website.Front')) <small class="text-danger">(jpg,jpeg,png file only)</small></label>
                                <div class="ml-3 mr-3">
                                    <div class="row" id="nid_front">
                                        @if (Auth::user()->nid_front != null)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url(Auth::user()->nid_front) }}"> <img loading="lazy"  src="{{ url(Auth::user()->nid_front) }}" alt="" class="img-responsive"></a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label ml-3">@lang('website.National ID Image') (@lang('website.Back')) <small class="text-danger">(jpg,jpeg,png file only)</small></label>
                                <div class="ml-3 mr-3">
                                    <div class="row" id="nid_back">
                                        @if (Auth::user()->nid_back != null)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url(Auth::user()->nid_back) }}"> <img loading="lazy"  src="{{ url(Auth::user()->nid_back) }}" alt="" class="img-responsive"></a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label ml-3">@lang('website.Profile Image') <small class="text-danger">(jpg,jpeg,png file only)</small></label>
                                <div class="ml-3 mr-3">
                                    <div class="row" id="avatar_original">
                                        @if (Auth::user()->avatar_original != null)
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="img-upload-preview">
                                                    <a href="{{ url(Auth::user()->avatar_original) }}"> <img loading="lazy"  src="{{ url(Auth::user()->avatar_original) }}" alt="" class="img-responsive"></a>
                                                    <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </div>
                            </div>

{{--                            <div class="col-lg-6 col-md-6 col-12 mb-5">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>@lang('website.Profile Image') </label>--}}
{{--                                    <input type="file"  name="avatar_original" class="form-control"  >--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <button type="submit" class="woocommerce-form-login__submit btn btn-primary rounded-0" >@lang('website.Update')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/dist/js/spartan-multi-image-picker-min.js')}}"></script>
<script>

    // Get BN EN Name
    function getNameBnEn($name,$name_bn){
        var lang = $('#lang').val();
        var curr_lang = '';
        if(lang === 'en'){
            curr_lang = $name;
        }else{
            curr_lang = $name_bn ? $name_bn : $name;
        }
        return curr_lang;
    }
    $("#nid_front").spartanMultiImagePicker({
        fieldName: 'nid_front',
        maxCount: 1,
        rowHeight: '200px',
        groupClassName: 'col-md-4 col-sm-4 col-xs-6',
        maxFileSize: '5000000',
        dropFileLabel: "Drop Here",
        onExtensionErr: function (index, file) {
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
        },
        onSizeErr: function (index, file) {
            console.log(index, file, 'file size too big');
            alert('Image size too big. Please upload below 500kb');
        },
        onAddRow:function(index){
            var altData = '<input type="text" placeholder="" name="nid[]" class="form-control" required=""></div>'
            //var index = index + 1;
            //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
            //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
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
        maxFileSize: '5000000',
        dropFileLabel: "Drop Here",
        onExtensionErr: function (index, file) {
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
        },
        onSizeErr: function (index, file) {
            console.log(index, file, 'file size too big');
            alert('Image size too big. Please upload below 500kb');
        },

        onRemoveRow : function(index){
            var index = index + 1;
            $(`#abc_${index}`).remove()
        },
    });
    $("#avatar_original").spartanMultiImagePicker({
        fieldName: 'avatar_original',
        maxCount: 1,
        rowHeight: '200px',
        groupClassName: 'col-md-4 col-sm-4 col-xs-6',
        maxFileSize: '5000000',
        dropFileLabel: "Drop Here",
        onExtensionErr: function (index, file) {
            console.log(index, file, 'extension err');
            alert('Please only input png or jpg type file')
        },
        onSizeErr: function (index, file) {
            console.log(index, file, 'file size too big');
            alert('Image size too big. Please upload below 500kb');
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
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#sub_sub_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_category_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#sub_sub_child_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_child_category_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#sub_sub_child_child_category_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#sub_sub_child_child_category_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#category_six_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_six_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#category_seven_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_seven_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#category_eight_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_eight_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#category_nine_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_nine_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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
                $('#category_ten_id').append($('<option selected disabled>@lang('website.Select Product')</option>'));
                for (var i = 0; i < data.length; i++) {
                    $('#category_ten_id').append($('<option>', {
                        value: data[i].id,
                        text: getNameBnEn(data[i].name,data[i].name_bn)
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

