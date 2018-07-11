
@extends('Admin.layouts.master')

@section ('title', 'State')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>States</h2>
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
//print_r($countries);
//print_r($state);
?>
        
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add State</h5>
                        </div>
                        <div class="ibox-content">

                            @if(!empty(Request::segment(4) ))

                            {!! Form::open(['route' => 'admin.state.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                            @endif

                            <!-- {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!} -->
                            <!-- <form method="get" class="form-horizontal"> -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="name" id="name" value="@if(!empty(Request::segment(4))) {{$state->name}} @endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Country</label>
                                    <div class="col-sm-4">
                                        <select name="country_id" id="country_id" class="form-control" >
                                            <option value="">Select Country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" <?php if( (!empty(Request::segment(4)) ) && ($state->country_id == $country->id) ){ ?> selected="selected" <?php } ?> >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="{{route('admin.state')}}" class="btn btn-white" >Cancel</a>
                                        <!-- <button class="btn btn-white" type="submit">Cancel</button> -->
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

<script type="text/javascript">

/*$("#eeed").validate({
    rules: {
        name: "required",
        shortname: "required",
        phonecode: "required",
    },
});*/

$("#add").validate({
    rules: {
        name: "required",
        country_id: "required"
    },
});


</script>