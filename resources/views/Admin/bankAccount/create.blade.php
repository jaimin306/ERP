@extends('Admin.layouts.master')
@section ('title', 'Bank Account')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Bank Account</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<?php 
//echo '<pre>';print_r($bankAccount);
?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Bank Account</h5>
                </div>
                <div class="ibox-content">
                    @if(!empty(Request::segment(4) ))
                    {!! Form::open(['route' => 'admin.bankAccount.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post','autocomplete' => 'off', 'id' => 'add']) !!}
                    <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >
                    @else
                    {!! Form::open(['route' => 'admin.bankAccount.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post','autocomplete' => 'off', 'id' => 'add']) !!}
                    @endif
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Select Account Type <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select name="account_type_id" id="account_type_id" class="form-control" >
                                <option value="">Select Account Type</option>
                                @foreach($accountTypes as $accounttype)
                                <option value="{{$accounttype->id}}" <?php if( (!empty(Request::segment(4)) ) && ($bankAccount->account_type_id == $accounttype->id) ){ ?> selected="selected" <?php } ?> >{{$accounttype->account_type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="control-label col-lg-2 ">Bank Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="@if(!empty(Request::segment(4))){{$bankAccount->bank_name}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2 ">Account Holder <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="account_holder" id="account_holder" value="@if(!empty(Request::segment(4))){{$bankAccount->account_holder}}@endif" >
                        </div>
                        <label class="control-label col-lg-2 ">Account No. <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="account_no" id="account_no" value="@if(!empty(Request::segment(4))){{$bankAccount->account_no}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2 ">Branch Name <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="branch_name" id="branch_name" value="@if(!empty(Request::segment(4))){{$bankAccount->branch_name}}@endif" >
                        </div>
                        <label class="control-label col-lg-2 ">MICR Code </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="micr_code" id="micr_code" value="@if(!empty(Request::segment(4))){{$bankAccount->micr_code}}@endif" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-lg-2 ">IFSC Code <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" value="@if(!empty(Request::segment(4))){{$bankAccount->ifsc_code}}@endif" >
                        </div>
                        <label class="control-label col-lg-2 ">Bank Address </label>
                        <div class="col-sm-4">
                            <textarea style="resize: none" class="form-control" name="bank_address" id="bank_address">@if(!empty(Request::segment(4))){{$bankAccount->bank_address}}@endif</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('admin.bankAccount')}}" class="btn btn-white" >Cancel</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
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
            account_type_id: "required",
            bank_name: "required",
            account_no: "required",
            account_holder: "required",
            branch_name: "required",
            ifsc_code: "required",
        },
    });
</script>
@stop