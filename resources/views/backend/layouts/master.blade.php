<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('title') | Fabric Lagbe </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/favicon-fabric.png')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('backend/plugins/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/custom-style.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/dist/css/spectrum.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{--toastr js--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active {

            background-color: #8a9cb0;
        }
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 36px!important;
        }
        .dropdown-menu {
            padding: 0!important;
        }
        ::-webkit-scrollbar {
            width: 5px;
            background: #46528a;
        }
        .sidebar {
            padding-bottom: 0;
            padding-top: 0;
            padding-left: 0!important;
            padding-right: 0!important;
            overflow-y: auto;
            height: calc(100% - 4rem);
        }
        .nav-pills .nav-link {
             border-radius: 0!important;
        }
        .user-panel img {
            width: 100%;
            height: auto;
        }
        .content-header {
            padding: 0px .5rem!important;
        }
    </style>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
@include('backend.includes.header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->

{{--@if(Auth::check() && Auth::user()->role_id == '')--}}
    @include('backend.includes.admin_sidebar')
{{--@endif--}}

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('backend.includes.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('backend/dist/js/demo.min.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="{{asset('backend/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jVectorMap -->
<script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('backend/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS 1.0.2 -->
<script src="{{asset('backend/plugins/chartjs-old/Chart.min.js')}}"></script>

<script src="{{asset('backend/plugins/select2/select2.full.min.js')}}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{asset('backend/dist/js/pages/dashboard2.min.js')}}"></script>
<script src="{{asset('backend/plugins/form.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error )
    toastr.error('{{$error}}','Error',{
        closeButton:true,
        progressBar:true
    });
    @endforeach
    @endif
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    })
</script>

<script type="text/javascript">

    function ShowHideDiv1() {
        if ($("#Check").is(":checked")) {
            $("#div_check_number").show();
        } else {
            $("#div_check_number").hide();
        }
    }

    // function ShowHideDiv2() {
    //     var commission_due_amount = parseInt($('#commission_due_amount').val());
    //     //commission_due_amount = parseFloat(commission_due_amount).toFixed(2);
    //     //alert(typeof commission_due_amount)
    //     var amount = parseInt($('#amount').val());
    //     //alert(typeof commission_due_amount)
    //     // amount = parseFloat(amount).toFixed(2);
    //     if(amount > commission_due_amount){
    //         alert('You not enter' + amount + 'greater than of commission due amount' + commission_due_amount + '!');
    //         $('#amount').val(0);
    //     }
    // }

</script>
@stack('js')
</body>
</html>
