
@extends('Admin.layouts.master') 

@section ('title', 'Vendor Type')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Vendor Type</h2>
<?php
//print_r($_SESSION);
?>
@if( Session::has( 'success' ))
     {{ Session::get( 'success' ) }}ddd
@elseif( Session::has( 'warning' ))
     {{ Session::get( 'warning' ) }}dfff <!-- here to 'withWarning()' -->
@endif
            
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add Vendor Type</h5>
                        </div>
                        <div class="ibox-content">

                            @if(Request::segment(4) != '')

                            {!! Form::open(['route' => 'admin.vendorType.update', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}

                            <input type="hidden" name="id" id="id" value="{{Request::segment(4)}}" >

                            @else

                            {!! Form::open(['route' => 'admin.vendorType.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'add']) !!}
                            @endif
                                <div class="form-group">
                                    {!! Form::label('name', 'Vendor Type Name <span class="text-danger"> *</span>', ['class' => 'col-lg-2 control-label'], false) !!}
                                    <div class="col-sm-4">
                                        <input type="text" name="vendor_type_name" id="vendor_type_name" class="form-control" placeholder="Name" value="@if(Request::segment(4) != ''){{trim($vendor_type->vendor_type_name)}} @endif">
                                    </div>
                                </div>
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a class="btn btn-white" href="{{route('admin.vendorType')}}" >Cancel</a>
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
        vendor_type_name: "required"
    },
});


</script>
@stop