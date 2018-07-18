@extends('Admin.layouts.master') 
@section ('title', 'Item Category')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Country</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add Item Category</h5>
                </div>
                <div class="ibox-content">
                    @if(Request::segment(4) != '')
                    {!! Form::open(['route' => 'admin.itemCategory.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add', 'autocomplete' => 'off']) !!}
                    <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >
                    @else
                    {!! Form::open(['route' => 'admin.itemCategory.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'autocomplete' => 'off', 'id' => 'add']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('name', 'Item Category <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        <div class="col-sm-4">
                            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Name" value="@if(Request::segment(4) != ''){{trim($itemCategory->category_name)}}@endif">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white" href="{{route('admin.itemCategory')}}" >Cancel</a>
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
            category_name: "required",
        },
    });
    
    
</script>
@stop