@extends('Admin.layouts.master')
@section ('title', 'User')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Users</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
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
                    <div class="form-group">
                        <label class="col-md-2 control-label">First Name <span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="@if(!empty(Request::segment(4))){{$user->first_name}}@endif" >
                        </div>
                        <label class="col-md-2 control-label">Last Name <span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="@if(!empty(Request::segment(4))){{$user->last_name}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Username <span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="user_name" id="user_name" value="@if(!empty(Request::segment(4))){{$user->user_name}}@endif" >
                        </div>
                        @if(empty(Request::segment(4)))
                        {!! Form::label('name', 'Password <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4">
                            <input type="Password" class="form-control" name="password" id="password" value="@if(!empty(Request::segment(4))){{$user->password}}@endif" >
                        </div>
                        @endif
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Email <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" id="email" value="@if(!empty(Request::segment(4))){{$user->email}}@endif" onkeyup="checkEmail()" >
                            <i id="phonelogo" class="fa fa-envelope" style="display: none;"></i>
                            <span id="email_err" style="color: red;"></span>
                        </div>
                        {!! Form::label('name', 'Contact No', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="phone" id="phone" value="@if(!empty(Request::segment(4))) {{$user->phone}} @endif" >
                        </div>
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Website', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="website" id="website" value="@if(!empty(Request::segment(4))) {{$user->website}} @endif" >
                        </div>
                        <input type="hidden" name="hdn_desg_id" id="hdn_desg_id" value="@if(!empty(Request::segment(4))){{$user->designation_id}}@endif"  >
                        <label class="col-lg-2 control-label">Select Department <span class="text-danger"> *</span></label>
                        <div class="col-md-4" id="tst">
                            <select name="department_id" id="department_id" class="form-control" onchange="getDesg(this.value, eid = '')" >
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" @if( (!empty(Request::segment(4)) ) && ($user->department_id == $department->id) )selected="selected" @endif >{{$department->department_name}}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>
                    <div class="form-group">
                        <label id="desgid"class="col-md-2 control-label">Select Designation <span class="text-danger"> *</span></label>
                        <div class="col-md-4" id="desg_div">
                            <select name="designation_id" id="designation_id" class="form-control" >
                                <option value="">Select Designation</option>
                                @foreach($designations as $designation)
                                <!-- <option value="{{$designation->id}}" <?php if( (!empty(Request::segment(4)) ) && ($user->designation_id == $designation->id) ){ ?> selected="selected" <?php } ?> >{{$designation->designation_name}}</option> -->
                                @endforeach
                            </select>
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
    $(document).ready( function(){
        
        var edit_id = '{{ Request::segment(4) }}';
    
        if (edit_id != '') {
            
            var department_id = $("#department_id").val();
            var hdn_desg_id = $("#hdn_desg_id").val();
            
            getDesg(department_id, hdn_desg_id)
        }
        
    });
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
    
        var edit_id = '{{ Request::segment(4) }}';
        
        $.ajaxSetup({
            header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
        });
        var url = '{{route("admin.user.chkUserEmail", ":email" )}}';
        url = url.replace(":email",email);
    
        $.ajax({
            url:url,
            type:"get",
            data:{edit_id:edit_id},
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