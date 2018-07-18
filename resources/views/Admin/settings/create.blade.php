@extends('Admin.layouts.master') 
@section ('title', 'Company Settings')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Company Settings</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>

<?php
// echo '<pre>';print_r($settings);
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                @include('Admin.includes.leftSetting')
            </div>
        </div>
       
        <div class="col-lg-9">
            <div class="mail-box">
                <form class="form-horizontal" role="form" action="{{route('admin.settings.updateCompanySetting')}}" method="post" name="form" id="add" autocomplete="off" >
                    <div class="modal-header">
                        <h4 class="modal-title">Company Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Name <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="company_name" name="company_name" placeholder="Please Enter Company Name Here" value="{{$settings['company_name']}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Phone <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="company_phone" value="{{$settings['company_phone']}}" name="company_phone" placeholder="Please Enter Company Phone Here" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="company_email" value="{{$settings['company_email']}}" name="company_email" placeholder="Please Enter Company Email Here" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Website </label>
                            <div class="col-md-9">
                                <input type="text" id="company_website" value="{{$settings['company_website']}}" name="company_website" placeholder="Please Enter Company Website Here" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Address <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea id="company_address" style="resize: none" name="company_address" placeholder="Please Enter Company Address Here" class="form-control">{{$settings['company_address']}}</textarea>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">Country <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="country_id" name="country_id">
                                    <option value="">Please Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{$settings['country_id'] == $country->id ? 'selected' : '' }}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">State <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" id="state_id" name="state_id">
                                    <option value="">Please Select State</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-md-3 control-label">City </label>
                            <div class="col-md-9">
                                <input type="text" id="city" name="city" value="{{$settings['city']}}" placeholder="Please Enter City Name Here" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Zip Code </label>
                            <div class="col-md-9">
                                <input type="text" id="zip_code" name="zip_code" value="{{$settings['zip_code']}}" placeholder="Please Enter Zip Code Here" class="form-control">
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
            company_name: "required",
            company_address: "required",
            company_email: "required",
            company_phone: "required",
            country_id: "required",
            state_id: "required",
        },
    });

    $(document).on('change', '#country_id', function() {
        var country_id = $(this).val();
        $.ajax({
            type: 'GET',
            dataType: "JSON",
            url : "{{url('admin/settings/getStateByCountry')}}/"+country_id,
            success:function(data){
                if(data.success)
                {
                    var state_id = $('#state_id').empty();
                    $.each(data.states, function(i, state){
                        $('<option/>', {
                            value:state.id,
                            text:state.name
                        }).appendTo(state_id);
                    })
                }
            },
        }).done(function(data){
            var getstate = "{{$settings['state_id']}}";
            if(getstate != ""){
                $("#state_id").val(getstate);
            }
            
        });
    });
    $("#country_id").trigger('change');
    
</script>
@stop