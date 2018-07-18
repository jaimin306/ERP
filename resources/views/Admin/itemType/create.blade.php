
@extends('Admin.layouts.master')

@section ('title', 'Item Type')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Item Type</h2>
        </div>
        <div class="col-lg-2"></div>
    </div>
        
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Item Type</h5>
                        </div>
                        <div class="ibox-content">
                            @if(!empty(Request::segment(4) ))

                            {!! Form::open(['route' => 'admin.itemType.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add' , 'autocomplete' => 'off' ]) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.itemType.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'autocomplete' => 'off' , 'id' => 'add']) !!}
                            @endif

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Item Category<span class="text-danger"> *</span></label>
                                    <div class="col-sm-4">
                                        <select name="item_category_id" id="item_category_id" class="form-control" >
                                            <option value="">Please Select Item Category</option>
                                            @foreach($categories as $itemCat)
                                                <option value="{{$itemCat->id}}" <?php if( (!empty(Request::segment(4)) ) && ($itemType->item_category_id == $itemCat->id) ){ ?> selected="selected" <?php } ?> >{{$itemCat->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    {!! Form::label('name', 'Item Type <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="item_type" id="item_type" value="@if(!empty(Request::segment(4))){{$itemType->item_type}}@endif" >
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="{{route('admin.itemType')}}" class="btn btn-white" >Cancel</a>
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

$("#add").validate({
    rules: {
        item_category_id: "required",
        item_type: "required"
    },
});


</script>
@stop