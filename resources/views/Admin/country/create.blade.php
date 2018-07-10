
@extends('Admin.layouts.master') 

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Country</h2>
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
    //print_r($country);
?>



    
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Country</h5>
                        </div>
                        <div class="ibox-content">

                            @if(Request::segment(4) != '')

                            {!! Form::open(['route' => 'admin.country.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.country.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
                            @endif
                            <!-- <form method="get" class="form-horizontal"> -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <!-- <input type="text" class="form-control"> -->
                                        <!-- {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name', 'value' => '{{$country->name}}' ]) !!} -->
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="@if(Request::segment(4) != ''){{$country->name}} @endif">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    {!! Form::label('status', 'Status', ['class' => 'col-lg-2 control-label']) !!} -->
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <!-- <div class="col-sm-4"> -->
                                        <!-- <input type="text" class="form-control"> -->
                                       <!--  <input type="checkbox" name="status" id="status" checked="checked" >
                                    </div>
                                </div>  -->
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
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

        