@extends('Admin.layouts.master') 
@section ('title', 'Email Settings')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Email Settings</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                @include('Admin.includes.leftSetting')
            </div>
        </div>
       
        <div class="col-lg-9">
            <div class="mail-box">
                <form class="form-horizontal" role="form" action="{{route('admin.settings.updateEmailSetting')}}" method="post" name="form" id="add" autocomplete="off" >
                    <div class="modal-header">
                        <h4 class="modal-title">Email Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Host Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="email_host" name="email_host" placeholder="Please Enter Host Name Here" value="{{$settings['email_host']}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="email_username" value="{{$settings['email_username']}}" name="email_username" placeholder="Please Enter Username Here" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Password <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="password" id="email_password" value="{{$settings['email_password']}}" name="email_password" placeholder="Please Enter Email Password Here" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
                    </div>
                </form>
            </div>
            <div class="mail-box">
                <form class="form-horizontal" role="form" action="#" method="post" name="form" id="testEmail" autocomplete="off" >
                    <div class="modal-header">
                        <h4 class="modal-title">Send Test Email</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="test_email" name="test_email" placeholder="Please Enter Your Email Address For Testing"  class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Send Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('javascript')
<script type="text/javascript">
    $("#add").validate({
        rules: {
            email_host: "required",
            email_username: "required",
            email_password: "required",
        },
    });
    $("#testEmail").validate({
        rules: {
            test_email: {
                required:true,
                email:true
            }
        },
    });    
    
</script>
@stop