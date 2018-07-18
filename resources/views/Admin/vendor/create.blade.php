@extends('Admin.layouts.master')
@section ('title', 'Vendor')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Vendors</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Vendor</h5>
                </div>
                <div class="ibox-content">
                    @if(!empty(Request::segment(4) ))
                    {!! Form::open(['route' => 'admin.vendor.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add', 'autocomplete'=>'off']) !!}
                    <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >
                    @else
                    {!! Form::open(['route' => 'admin.vendor.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add', 'autocomplete'=>'off']) !!}
                    @endif
                    <div class="form-group">
                        <label class="col-md-2 control-label">First Name<span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="@if(!empty(Request::segment(4))){{$vendor->first_name}}@endif" >
                        </div>
                        <label class="col-md-2 control-label">Last Name<span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="last_name" id="last_name" value="@if(!empty(Request::segment(4))){{$vendor->last_name}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Address Line1</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="address_line1" id="address_line1" value="@if(!empty(Request::segment(4))){{$vendor->address_line1}}@endif" >
                        </div>
                        
                        {!! Form::label('name', 'Address Line2', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="address_line2" id="address_line2" value="@if(!empty(Request::segment(4))){{$vendor->address_line2}}@endif" >
                        </div>
                        
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Select Country  <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4" id="tst">
                            <select name="country_id" id="country_id" class="form-control select2" onchange="getStates(this.value, eid = '')" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" @if( (!empty(Request::segment(4)) ) && ($country->id == $vendor->country_id) )selected="selected" @endif >{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>   
                        <input type="hidden" name="hdn_state_id" id="hdn_state_id" value="@if(!empty(Request::segment(4))){{$vendor->state_id}}@endif"  >
                        {!! Form::label('name', 'Select State  <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}

                        <div class="col-md-4" id="state_div">
                            <select name="state_id" id="state_id" class="form-control select2" >
                                <option value="">Select State</option>
                                
                            </select>
                        </div>
                                             
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">City</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="city" id="city" value="@if(!empty(Request::segment(4))){{$vendor->city}}@endif" >
                        </div>
                        
                        {!! Form::label('name', 'ZipCode', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="zipcode" id="zipcode" value="@if(!empty(Request::segment(4))){{$vendor->zipcode}}@endif" >
                        </div>
                        
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Email  <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" id="email" value="@if(!empty(Request::segment(4))){{$vendor->email}}@endif" onkeyup="checkEmail()" >
                            <i id="phonelogo" class="fa fa-envelope" style="display: none;"></i>
                            <span id="email_err" style="color: red;"></span>
                        </div>
                        {!! Form::label('name', 'Contact No', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="contact_number" id="contact_number" value="@if(!empty(Request::segment(4))) {{$vendor->contact_number}} @endif" >
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Additional Contact Number', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="additional_contact_number" id="additional_contact_number" value="@if(!empty(Request::segment(4))) {{$vendor->additional_contact_number}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Fax No', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <input type="text" class="form-control" name="fax_no" id="fax_no" value="@if(!empty(Request::segment(4))) {{$vendor->fax_no}} @endif" >
                        </div>                        
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Discount Days', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="discount_days" id="discount_days" value="@if(!empty(Request::segment(4))) {{$vendor->discount_days}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Discount Percentage', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" value="@if(!empty(Request::segment(4))) {{$vendor->discount_percentage}} @endif" >
                        </div>                        
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Vendor Code', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="vendor_code" id="vendor_code" value="@if(!empty(Request::segment(4))) {{$vendor->vendor_code}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Vendor Type  <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4" id="tst">
                            <select name="vendor_type_id" id="vendor_type_id" class="form-control select2" >
                                <option value="">Select Vendor Type</option>
                                @foreach($vendorTypes as $vendor_type)
                                <option value="{{$vendor_type->id}}" @if( (!empty(Request::segment(4)) ) && ($vendor_type->id == $vendor->vendor_type_id) )selected="selected" @endif >{{$vendor_type->vendor_type_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('name', 'Term Days', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="term_days" id="term_days" value="@if(!empty(Request::segment(4))) {{$vendor->term_days}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Tax ID No', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <input type="text" class="form-control" name="tax_id_no" id="tax_id_no" value="@if(!empty(Request::segment(4))) {{$vendor->tax_id_no}} @endif" >
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('name', 'Taxable Amount', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="taxable_amount" id="taxable_amount" value="@if(!empty(Request::segment(4))) {{$vendor->taxable_amount}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Consumer User Tax', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <select name="consumer_user_tax" id="consumer_user_tax" class="form-control select2" >
                                <option value="">Consumer User Tax</option>
                                <option value="yes" @if( (!empty(Request::segment(4))) && ($vendor->consumer_user_tax == 'yes') )selected="selected" @endif  >Yes</option>
                                <option value="no" @if( (!empty(Request::segment(4))) && ($vendor->consumer_user_tax == 'no') )selected="selected" @endif>No</option>
                            </select>
                           <!--  <input type="text" class="form-control" name="consumer_user_tax" id="consumer_user_tax" value="@if(!empty(Request::segment(4))) {{$vendor->consumer_user_tax}} @endif" > -->
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('name', 'Balance Owed', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="text" class="form-control" name="balance_owed" id="balance_owed" value="@if(!empty(Request::segment(4))) {{$vendor->balance_owed}} @endif" >
                        </div>
                        
                        {!! Form::label('name', 'Date Opened', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <input type="text" class="form-control datepicker" name="date_opened" id="date_opened" value="@if(!empty(Request::segment(4))) {{$vendor->date_opened}} @endif" >
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('name', 'Account Status', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="web">
                            <input type="checkbox" value="1" name="account_status" id="account_status" @if( !empty(Request::segment(4)) && $vendor->account_status == 1 ) checked="checked"@endif >
                        </div>
                        
                        {!! Form::label('name', 'Bank Account', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4" id="tst">
                            <select name="bank_account_id" id="bank_account_id" class="form-control select2" >
                                <option value="">Select Bank Account</option>
                                @foreach($bankAccounts as $bank_account)
                                <option value="{{$bank_account->id}}" @if( (!empty(Request::segment(4)) ) && ($bank_account->id == $vendor->bank_account_id) )selected="selected" @endif >{{$bank_account->bank_name." - ".$bank_account->account_no." - ".$bank_account->account_holder }}</option>
                                @endforeach
                            </select>
                        </div>                        
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('admin.vendor')}}" class="btn btn-white" >Cancel</a>
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
        $(".select2").select2();
        
        $('.datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd'
        });

        
        var edit_id = '{{ Request::segment(4) }}';
    
        if (edit_id != '') {
            
            var country_id = $("#country_id").val();
            var hdn_state_id = $("#hdn_state_id").val();
            
            getStates(country_id, hdn_state_id)
        }
        
    });
        function getStates(id, state_id){
            //var id = $(this).val();
            
            $.ajaxSetup({
                header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
            });
            var url = '{{route("admin.vendor.getState", ":id" )}}';
            url = url.replace(":id",id);
    
            $.ajax({
                url:url,
                type:"get",
                data:{state_id:state_id},
                success:function(data){
                    //alert(data);
                    $("#state_div").html(data);
                }
    
    
            });
        }
    //});
    
    $("#add").validate({
        rules: {
            vendor_type_id: "required",
            country_id: "required",
            state_id: "required",
            first_name: "required",
            last_name: "required",
            email: {
                required :true,
                email:true
            }
        },
        highlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().addClass(errorClass);
            } else {
                elem.addClass(errorClass);
            }
        },    
        unhighlight: function (element, errorClass, validClass) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                $("#select2-" + elem.attr("id") + "-container").parent().removeClass(errorClass);
            } else {
                elem.removeClass(errorClass);
            }
        },
        invalidHandler: function(e,validator) {
            for (var i=0;i<validator.errorList.length;i++){
                $(validator.errorList[i].element).closest('.ibox-content').show();
                $(validator.errorList[i].element).closest('.ibox-content').parent().find('.collapse-link').children().removeClass().addClass('fa fa-chevron-up');
            }
        },
        errorPlacement: function(error, element) {
            var elem = $(element);
            if (elem.hasClass("select2-hidden-accessible")) {
                element = $("#select2-" + elem.attr("id") + "-container").parent();
                error.insertAfter(element);
            } else {
                error.insertAfter(element);
            }
        },
    });
    
    function checkEmail(){
        var email = $("#email").val();
    
        var edit_id = '{{ Request::segment(4) }}';
        
        $.ajaxSetup({
            header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
        });
        var url = '{{route("admin.vendor.chkEmail", ":email" )}}';
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