
@extends('Admin.layouts.master') 

@section ('title', 'Department')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Department</h2>
<?php
//print_r($_SESSION);
?>
@if( Session::has( 'success' ))
     {{ Session::get( 'success' ) }}ddd
@elseif( Session::has( 'warning' ))
     {{ Session::get( 'warning' ) }}dfff <!-- here to 'withWarning()' -->
@endif
            <!-- <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Home</a>
                </li>
                <li>
                    <a>Forms</a>
                </li>
                <li class="active">
                    <strong>Basic Form</strong>
                </li>
            </ol> -->
        </div>
        <div class="col-lg-2">

        </div>
    </div>

<?php
    //print_r($department);
?>



    
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Department</h5>
                        </div>
                        <div class="ibox-content">

                            @if(Request::segment(4) != '')

                            {!! Form::open(['route' => 'admin.department.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.department.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                            @endif
                            <!-- <form method="get" class="form-horizontal"> -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <!-- <input type="text" class="form-control"> -->
                                        <!-- {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'value' => '{{$department->name}}' ]) !!} -->
                                        <input type="text" name="department_name" id="department_name" class="form-control" placeholder="Name" value="@if(Request::segment(4) != ''){{trim($department->department_name)}} @endif">
                                    </div>
                                </div>

                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a class="btn btn-white" href="{{route('admin.department')}}" >Cancel</a>
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>

            </div>

            

@stop

        
@section('javascript')
<script type="text/javascript">

$("#add").validate({
    rules: {
        department_name: "required"
    }
});


</script>
@stop