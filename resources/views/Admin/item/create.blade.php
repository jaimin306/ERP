@extends('Admin.layouts.master')
@section ('title', 'Item')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Items</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Item</h5>
                </div>
                <div class="ibox-content">
                    @if(!empty(Request::segment(4) ))
                    {!! Form::open(['route' => 'admin.item.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add', 'autocomplete'=>'off']) !!}
                    <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >
                    @else
                    {!! Form::open(['route' => 'admin.item.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                    @endif
                    <div class="form-group">
                        <label class="col-md-2 control-label">Item Name <span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="item_name" id="item_name" value="@if(!empty(Request::segment(4))){{$item->item_name}}@endif" >
                        </div>
                        <label class="col-md-2 control-label">Item Code <span class="text-danger"> *</span></label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="item_code" id="item_code" value="@if(!empty(Request::segment(4))){{$item->item_code}}@endif" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Item Image</label>
                        <div class="col-md-4">
                            <input type="file" name="item_image" id="item_image" class="form-control">
                            @if(!empty(Request::segment(4)))
                                <!-- <input type="" name="hdn_item_image" id="hdn_item_image" value="{{$item->item_image}}" > -->
                                <span id="img">{{$item->item_image}}</span>
                            @endif

                        </div>
                        
                        {!! Form::label('name', 'Select Vendor', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-4">
                            <select name="vendor_id" id="vendor_id" class="form-control select2" >
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}" @if( (!empty(Request::segment(4)) ) && ($item->vendor_id == $vendor->id) )selected="selected" @endif >{{$vendor->first_name."  ".$vendor->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Select Item Category <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4" id="tst">
                            <select name="item_category_id" id="item_category_id" class="form-control select2" onchange="getType(this.value, eid = '')" >
                                <option value="">Select Item Type</option>
                                @foreach($itemCategories as $item_category)
                                <option value="{{$item_category->id}}" @if( (!empty(Request::segment(4)) ) && ($item->item_category_id == $item_category->id) )selected="selected" @endif >{{$item_category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="hdn_type_id" id="hdn_type_id" value="@if(!empty(Request::segment(4))){{$item->item_type_id}}@endif"  >
                        {!! Form::label('name', 'Select Item Type <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-md-4" id="type_div">
                            <select name="item_type_id" id="item_type_id" class="form-control select2" >
                                <option value="">Select Item Type</option>
                                @foreach($itemTypes as $item_type)
                                @endforeach
                            </select>
                        </div>                     
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Item Description', ['class' => 'col-lg-2 control-label']) !!}
                        <div class="col-md-10">
                            <textarea name="item_description" id="item_description" >@if(!empty(Request::segment(4)) ){{$item->item_description}}@endif</textarea>
                        </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('admin.item')}}" class="btn btn-white" >Cancel</a>
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
        CKEDITOR.replace('item_description');
        $(".select2").select2();
        
        var edit_id = '{{ Request::segment(4) }}';
    
        if (edit_id != '') {
            
            var category_id = $("#item_category_id").val();
            var hdn_type_id = $("#hdn_type_id").val();
            
            getType(category_id, hdn_type_id)
        }
        
    });
        function getType(id, type_id){
            //var id = $(this).val();
            
            $.ajaxSetup({
                header:{ 'X-CRSF-Token': '{{ csrf_token() }}'}
            });
            var url = '{{route("admin.item.getType", ":id" )}}';
            url = url.replace(":id",id);
    
            $.ajax({
                url:url,
                type:"get",
                data:{type_id:type_id},
                success:function(data){
                    //alert(data);
                    $("#type_div").html(data);
                }
    
    
            });
        }
    //});
    
    $("#add").validate({
        rules: {
            item_name: "required",
            item_type_id: "required",
            item_category_id: "required",
            item_code: "required",
        },
    });
    
        
    
</script>
@stop