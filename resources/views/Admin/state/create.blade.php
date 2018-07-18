@extends('Admin.layouts.master')
@section ('title', 'State')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>States</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add State</h5>
                </div>
                <div class="ibox-content">
                    @if(!empty(Request::segment(4) ))
                    {!! Form::open(['route' => 'admin.state.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                    <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >
                    @else
                    {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                    @endif
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Select Country <span class="text-danger"> *</span></label>
                        <div class="col-sm-4">
                            <select name="country_id" id="country_id" class="form-control" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->id}}" <?php if( (!empty(Request::segment(4)) ) && ($state->country_id == $country->id) ){ ?> selected="selected" <?php } ?> >{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {!! Form::label('name', 'Name  <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                        
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="name" id="name" value="@if(!empty(Request::segment(4))) {{$state->name}} @endif" >
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{route('admin.state')}}" class="btn btn-white" >Cancel</a>
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
            name: "required",
            country_id: "required"
        },
    });
    
    
</script>
@stop