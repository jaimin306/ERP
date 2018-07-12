
@extends('Admin.layouts.master')

@section ('title', 'Designation')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Designations</h2>
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
//print_r($menus);
?>
  
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Designation</h5>
                        </div>
                        <div class="ibox-content">

                            @if(!empty(Request::segment(4) ))

                            {!! Form::open(['route' => 'admin.designation.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.designation.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                            @endif

                            <!-- {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!} -->
                            <!-- <form method="get" class="form-horizontal"> -->

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Department</label>
                                    <div class="col-sm-4">
                                        <select name="department_id" id="department_id" class="form-control" >
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" <?php if( (!empty(Request::segment(4)) ) && ($designation->department_id == $department->id) ){ ?> selected="selected" <?php } ?> >{{$department->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="designation_name" id="name" value="@if(!empty(Request::segment(4))) {{$designation->designation_name}} @endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label class="col-lg-2 control-label" >Permission</label> -->
                                    <div class="col-lg-12" >
                                        <table class="table table-bordered table-stripped table-hover">
                                             <thead>
                                               <tr>
                                                   <th class="col-lg-1">#</th>
                                                   <th class="col-lg-3">Name</th>
                                                   <th class="col-lg-2">Create</th>
                                                   <th class="col-lg-2">Edit</th>
                                                   <th class="col-lg-2">Delete</th>
                                                   <th class="col-lg-2">View</th>
                                               </tr>
                                           </thead>
                                        @foreach($menus as $menu)
                                            <tr>
                                                <input type="text" name="menu_id_{{$menu->id}}" id="menu_id_{{$menu->id}}" >
                                                <td class="col-lg-1">
                                                    <input type="checkbox" name="chk_all_{{$menu->id}}" id="chk_all_{{$menu->id}}" >
                                                </td>
                                                <td class="col-lg-3">
                                                    {{$menu->label}}
                                                </td>
                                                <td class="col-lg-2">
                                                    <input type="checkbox" name="chk_create_{{$menu->id}}" id="chk_create_{{$menu->id}}" >
                                                </td>
                                                <td class="col-lg-2">
                                                    <input type="checkbox" name="chk_edit_{{$menu->id}}" id="chk_edit_{{$menu->id}}" >
                                                </td>
                                                <td class="col-lg-2">
                                                    <input type="checkbox" name="chk_delete_{{$menu->id}}" id="chk_delete_{{$menu->id}}" >
                                                </td>
                                                <td class="col-lg-2">
                                                    <input type="checkbox" name="chk_view_{{$menu->id}}" id="chk_view_{{$menu->id}}" >
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                        </table>
                                    </div>
                                </div>
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="{{route('admin.designation')}}" class="btn btn-white" >Cancel</a>
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

@section('javascript')

<script type="text/javascript">

/*$("#eeed").validate({
    rules: {
        name: "required",
        shortname: "required",
        phonecode: "required",
    },
});*/
$(document).ready(function(){
    $("#add").validate({
        rules: {
            designation_name: "required",
            department_id: "required"
        }
    });
});
    
    $("input[name^=chk_all_]").change(function() {
        var id = $(this).attr('id').split("_")[2];
        //alert($(this).attr('id'));
        //alert(id);
        if ($(this).is(":checked")) {
            //alert("ues");
            $("#chk_create_"+id).prop("checked",true);
            $("#chk_edit_"+id).prop("checked",true);
            $("#chk_delete_"+id).prop("checked",true);
            $("#chk_view_"+id).prop("checked",true);
            $("#menu_id_"+id).val(id);
        }else{
            $("#chk_create_"+id).prop("checked",false);
            $("#chk_edit_"+id).prop("checked",false);
            $("#chk_delete_"+id).prop("checked",false);
            $("#chk_view_"+id).prop("checked",false);
            $("#menu_id_"+id).val('');
        }
    }); 

    $("input[name^=chk_create_]").change(function(){
        var id = $(this).attr('id').split("_")[2];

        if ( $(this).is(":checked") ) {
            if ( ($("#chk_edit_"+id).is(":checked")) && ($("#chk_delete_"+id).is(":checked")) && ($("#chk_view_"+id).is(":checked")) ) {
                $("#chk_all_"+id).prop("checked",true);
                
            }
            $("#menu_id_"+id).val(id);
        }else {

            $("#chk_all_"+id).prop("checked",false);
            $("#menu_id_"+id).val('');
        }

    }); 

    $("input[name^=chk_edit_]").change(function(){
        var id = $(this).attr('id').split("_")[2];

        if ( $(this).is(":checked") ) {
            if ( ($("#chk_create_"+id).is(":checked")) && ($("#chk_delete_"+id).is(":checked")) && ($("#chk_view_"+id).is(":checked")) ) {
                $("#chk_all_"+id).prop("checked",true);
            }
            $("#menu_id_"+id).val(id);
        }else {

            $("#chk_all_"+id).prop("checked",false);
            $("#menu_id_"+id).val('');
        }

    }); 

    $("input[name^=chk_delete_]").change(function(){
        var id = $(this).attr('id').split("_")[2];

        if ( $(this).is(":checked") ) {
            if ( ($("#chk_edit_"+id).is(":checked")) && ($("#chk_create_"+id).is(":checked")) && ($("#chk_view_"+id).is(":checked")) ) {
                $("#chk_all_"+id).prop("checked",true);
            }
            $("#menu_id_"+id).val(id);
        }else {

            $("#chk_all_"+id).prop("checked",false);
            $("#menu_id_"+id).val('');
        }

    }); 

    $("input[name^=chk_view_]").change(function(){
        var id = $(this).attr('id').split("_")[2];

        if ( $(this).is(":checked") ) {
            if ( ($("#chk_edit_"+id).is(":checked")) && ($("#chk_delete_"+id).is(":checked")) && ($("#chk_create_"+id).is(":checked")) ) {
                $("#chk_all_"+id).prop("checked",true);
            }
            $("#menu_id_"+id).val(id);
        }else {

            $("#chk_all_"+id).prop("checked",false);
            $("#menu_id_"+id).val('');
        }

    });


</script>
@stop