
@extends('Admin.layouts.master')

@section ('title', 'User')

@section('content')


@if ($message = Session::get('success'))
       <div class="alert alert-success">
           <p>{{ $message }}</p>
       </div>
   @endif



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
           
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
                            <h5>Add User</h5>
                        </div>
                        <div class="ibox-content">

                            @if(!empty(Request::segment(4) ))

                            {!! Form::open(['route' => 'admin.user.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add', 'autocomplete'=>'off']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.user.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                            @endif

                            <!-- {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!} -->
                            <!-- <form method="get" class="form-horizontal"> -->

                                <div class="form-group">
                                    {!! Form::label('name', 'User Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="user_name" id="user_name" value="@if(!empty(Request::segment(4))){{$user->user_name}}@endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name', 'Email', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="email" id="email" value="@if(!empty(Request::segment(4))){{$user->email}}@endif" onkeyup="checkEmail()" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                        <span id="email_err" style="color: red;"></span>
                                    </div>
                                </div>

                                @if(empty(Request::segment(4)))
                                <div class="form-group">
                                    {!! Form::label('name', 'Password', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="Password" class="form-control" name="password" id="password" value="@if(!empty(Request::segment(4))){{$user->password}}@endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    {!! Form::label('name', 'First Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="first_name" id="first_name" value="@if(!empty(Request::segment(4))){{$user->first_name}}@endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name', 'Last Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="last_name" id="last_name" value="@if(!empty(Request::segment(4))){{$user->last_name}}@endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>
<input type="hidden" name="hdn_desg_id" id="hdn_desg_id" value="@if(!empty(Request::segment(4))){{$user->designation_id}}@endif"  >
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Department</label>
                                    <div class="col-sm-4">
                                        <select name="department_id" id="department_id" class="form-control" onchange="getDesg(this.value, eid = '')" >
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" @if( (!empty(Request::segment(4)) ) && ($user->department_id == $department->id) )selected="selected" @endif >{{$department->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Designation</label>
                                    <div class="col-sm-4" id="desg_div" >
                                        <select name="designation_id" id="designation_id" class="form-control" >
                                            <option value="">Select Designation</option>

                                            @foreach($designations as $designation)

                                                <!-- <option value="{{$designation->id}}" <?php if( (!empty(Request::segment(4)) ) && ($user->designation_id == $designation->id) ){ ?> selected="selected" <?php } ?> >{{$designation->designation_name}}</option> -->
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name', 'Phone', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="phone" id="phone" value="@if(!empty(Request::segment(4))) {{$user->phone}} @endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('name', 'Website', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="website" id="website" value="@if(!empty(Request::segment(4))) {{$user->website}} @endif" >
                                        <!-- {!! Form::text('name', null, [ 'value' => '', 'class' => 'form-control', 'placeholder' => 'Name']) !!} -->
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="{{route('admin.user')}}" class="btn btn-white" >Cancel</a>
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
$(document).ready( function(){
    
    var edit_id = '{{ Request::segment(4) }}';

    if (edit_id != '') {
        
        var department_id = $("#department_id").val();
        var hdn_desg_id = $("#hdn_desg_id").val();
        
        getDesg(department_id, hdn_desg_id)
    }
    
});
//$("#department_id").on('change', function(){
        //alert($(this).val());
    function getDesg(id, desg_id){
        //var id = $(this).val();
        
        $.ajaxSetup({
            header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
        });
        var url = '{{route("admin.user.getDesignation", ":id" )}}';
        url = url.replace(":id",id);

        $.ajax({
            url:url,
            type:"get",
            data:{desg_id:desg_id},
            success:function(data){
                //alert(data);
                $("#desg_div").html(data);
            }


        });
    }
//});

$("#add").validate({
    rules: {
        user_name: "required",
        password: "required",
        department_id: "required",
        designation_id: "required",
        first_name: "required",
        last_name: "required",
        email: {
            required :true,
            email:true
        }
    },
});

function checkEmail(){
    var email = $("#email").val();
    $.ajaxSetup({
        header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
    });
    var url = '{{route("admin.user.chkUserEmail", ":email" )}}';
    url = url.replace(":email",email);

    $.ajax({
        url:url,
        type:"get",
        success:function(data){
            if (data > 0) {
                $("#email_err").html('Email is Duplicate');
                return false;
            }else{
                $("#email_err").html('');
            }
            return false;
        }
    });
}


</script>
@stop