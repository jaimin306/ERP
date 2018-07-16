<!DOCTYPE html>
<html>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:26:54 GMT -->
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>@yield('title', 'ERP')</title>

    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/animate.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">

    <link href="{{URL::asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

    <link href="{{URL::asset('css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/custom.css')}}" rel="stylesheet">
    {!! Html::style('css/toastr.min.css') !!}
    

</head>

<body class="">
<?php 
//echo "string";
//print_r($_SESSION);
?>
    <div id="wrapper">
        @include('Admin.includes.sidebar')
        <div id="page-wrapper" class="gray-bg">
        @include('Admin.includes.header')

        <!-- Content Wrapper. Contains page content -->
        <!-- <div class="content-wrapper"> -->
        
            <!-- Content Header (Page header) -->
            

            <!-- Main content -->
            <section class="content">
                @include('includes.partials.messages')
                @yield('content')
            </section><!-- /.content -->
        <!-- /.content-wrapper -->

        @include('Admin.includes.footer')
    </div><!-- ./wrapper -->


    </div>

    <!-- Mainly scripts -->
    {!! Html::script('js/jquery-3.1.1.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/plugins/metisMenu/jquery.metisMenu.js') !!}
    {!! Html::script('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}

   
    <!-- iCheck -->
    {!! Html::script('js/plugins/iCheck/icheck.min.js') !!}
    {!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
     {!! Html::script('js/inspinia.js') !!}


    {!! Html::script('js/plugins/pace/pace.min.js') !!}
    {!! Html::script('js/plugins/validate/jquery.validate.min.js') !!}
    {!! Html::script('js/toastr.min.js') !!}
    

    
    <!-- Custom and plugin javascript -->
    
    @yield('before-scripts-end')
    
    @yield('after-scripts-end')

    @yield('javascript')

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.7.1/empty_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Oct 2017 15:26:54 GMT -->
</html>