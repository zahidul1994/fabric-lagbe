@extends('backend.layouts.master')
@section("title","Staff Edit")
@push('css')

@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Staff Edit</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Staff Edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
            <!-- general form elements -->
                <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title float-left">Staff Edit</h3>
                    <div class="float-right">
                        <a href="{{route('admin.staffs.index')}}">
                            <button class="btn btn-success">
                                <i class="fa fa-backward"> </i>
                                Back
                            </button>
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.staffs.update',$staff->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$staff->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Name</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{$staff->email}}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="number" class="form-control" name="phone" id="phone" value="{{$staff->phone}}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <small class="text-info">(if you don't want to change password ? leave blank it. )</small></label>
                            <input type="password" class="form-control" name="password" id="password" >
                        </div>
                        @php
                        $role = \App\Model\Role::find($userRole->id);
                        @endphp
                        <div class="form-group">
                            <label for="department_id">Department</label>
                            <select name="department_id" id="department_id" class="form-control">
                                @foreach(\App\Model\Department::all() as $department)
                                    <Option value="{{$department->id}}" {{$role->department_id == $department->id ? 'selected':''}}>{{$department->name}}</Option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="roles">Role</label>
                            <select name="roles" id="roles" class="form-control">
                                @foreach($roles as $role)
                                    <Option value="{{$role->id}}" {{$userRole->id == $role->id ? 'selected' : '' }}>{{$role->name}}</Option>
                                @endforeach
                            </select>
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
    $(document).ready(function () {
        getRole();
    });
    $('#department_id').on('change', function () {
        getRole();
    });
    function getRole(){
        var department_id = $('#department_id').val();
        $.post('{{ route('admin.get_role') }}', {
            _token: '{{ csrf_token() }}',
            department_id: department_id
        }, function (data) {
            $('#roles').html(null);
            for (var i = 0; i < data.length; i++) {
                $('#roles').append($('<option>', {
                    value: data[i].id,
                    text: data[i].name
                }));
            }
            $("#roles > option").each(function() {
                if(this.value == '{{$userRole->id}}'){
                    $("#roles").val(this.value).change();
                }
            });
        });
    }
</script>
@endpush
