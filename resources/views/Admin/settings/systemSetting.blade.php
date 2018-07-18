@extends('Admin.layouts.master') 
@section ('title', 'System Settings')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>System Settings</h2>
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
                <form class="form-horizontal" role="form" action="{{route('admin.settings.updateSystemSetting')}}" method="post" name="form" id="add" autocomplete="off" enctype='multipart/form-data' >
                    <div class="modal-header">
                        <h4 class="modal-title">System Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date Format <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="date_format" name="date_format">
                                    <option value="dd.mm.yyyy" {{$settings['date_format'] == 'dd.mm.yyyy' ? 'selected' : '' }}>dd.mm.yyyy</option>
                                    <option value="mm.dd.yyyy" {{$settings['date_format'] == 'mm.dd.yyyy' ? 'selected' : '' }}>mm.dd.yyyy</option>
                                    <option value="yyyy.mm.dd" {{$settings['date_format'] == 'yyyy.mm.dd' ? 'selected' : '' }}>yyyy.mm.dd</option>
                                    <option value="yyyy.dd.mm" {{$settings['date_format'] == 'yyyy.dd.mm' ? 'selected' : '' }}>yyyy.dd.mm</option>
                                    <option value="dd/mm/yyyy" {{$settings['date_format'] == 'dd/mm/yyyy' ? 'selected' : '' }}>dd/mm/yyyy</option>
                                    <option value="mm/dd/yyyy" {{$settings['date_format'] == 'mm/dd/yyyy' ? 'selected' : '' }}>mm/dd/yyyy</option>
                                    <option value="yyyy/mm/dd" {{$settings['date_format'] == 'yyyy/mm/dd' ? 'selected' : '' }}>yyyy/mm/dd</option>
                                    <option value="yyyy/dd/mm" {{$settings['date_format'] == 'yyyy/dd/mm' ? 'selected' : '' }}>yyyy/dd/mm</option>
                                    <option value="dd-mm-yyyy" {{$settings['date_format'] == 'dd-mm-yyyy' ? 'selected' : '' }}>dd-mm-yyyy</option>
                                    <option value="mm-dd-yyyy" {{$settings['date_format'] == 'mm-dd-yyyy' ? 'selected' : '' }}>mm-dd-yyyy</option>
                                    <option value="yyyy-mm-dd" {{$settings['date_format'] == 'yyyy-mm-dd' ? 'selected' : '' }}>yyyy-mm-dd</option>
                                    <option value="yyyy-dd-mm" {{$settings['date_format'] == 'yyyy-dd-mm' ? 'selected' : '' }}>yyyy-dd-mm</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Time Format <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="time_format" name="time_format">
                                    <option value="12" {{$settings['time_format'] == '12' ? 'selected' : '' }}>12 Hours</option>
                                    <option value="24" {{$settings['time_format'] == '24' ? 'selected' : '' }}>24 Hours</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Logo </label>
                            <div class="col-md-7">
                                <input type="file" id="company_logo" name="company_logo" class="form-control">
                                <input type="hidden" id="hidden_company_logo" name="hidden_company_logo" value="{{$settings['company_logo']}}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <img src="{{ asset('uploads/Logo/'.$settings['company_logo']) }}" height="70" width="110" style="border:1px solid #b7b5b5">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Login Background </label>
                            <div class="col-md-7">
                                <input type="file" id="login_background" name="login_background" class="form-control">
                                <input type="hidden" id="hidden_login_background" name="hidden_login_background" value="{{$settings['login_background']}}" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <img src="{{ asset('uploads/Background/'.$settings['login_background']) }}" height="70" width="110" style="border:1px solid #b7b5b5">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Save</button>
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
            // country_id: "required",
            // state_id: "required",
        },
    });
    
</script>
@stop