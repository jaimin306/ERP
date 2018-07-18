@extends('Admin.layouts.master') 
@section ('title', 'Items')
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@else
<!-- <div class="alert alert-success">
    @php
    
    @endphp
    </div> -->
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Items</h2>
    </div>
    <div class="col-lg-2">
    </div>
</div>
<?php
    //echo "<pre>"; print_r($states)
    ?>   
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title ">
                    <h5 class="m-t-5">Manage Items</h5>
                    <div class="ibox-tools">
                        <a href="{{route('admin.item.create')}}">
                        <button class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> <b>Add</b></button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables" >
                            <thead>
                                <tr>
                                    <th style="width: 7%">No.</th>
                                    <th>Item Name</th>
                                    <th>Vendor Name</th>
                                    <th>Item Code</th>
                                    <th>Item Image</th>
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $item)
                                <tr class="gradeX">
                                    <td>{{++$key}}</td>
                                    <td>{{$item->item_name}}</td>
                                    <td>{{$item->first_name."  ".$item->last_name}}</td>
                                    <td>{{$item->item_code}}</td>
                                    <td>
                                        @if(!empty($item->item_image))
                                            <img src="{{URL::asset('uploads/item/images').'/'.$item->item_image}}" height="50" width="50" >
                                        @else
                                            <img src="{{URL::asset('uploads/noimage.jpg')}}" height="50" width="50" >
                                        @endif
                                        
                                    </td>
                                    <td class="center">
                                        <a href="{{route('admin.item.edit', $item->id)}}">
                                        <span class="btn btn-xs btn-primary editData" id="edit-{{$item->id}}">
                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                                        </span>
                                        </a>
                                        <span class="btn btn-xs btn-danger delRecord">
                                        <i class="fa fa-trash " id="delete-{{$item->id}}" ></i>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
$table->increments('id');
            $table->unsignedInteger('item_category_id');
            $table->unsignedInteger('vendor_id');
            $table->string('item_name');
            $table->string('item_code');
            $table->string('item_image');
            $table->text('item_description');

            $table->foreign('item_category_id')->references('id')->on('item_categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');

            $table->timestamps(); -->
@stop
@section('javascript')
<script>
    $(document).ready(function () {
       
    
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTftigp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Excel'},
                    {extend: 'pdf', title: 'PDF'},
    
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
    
                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]
    
            });
    });
    
    $(".delRecord").on('click', function(){ 
        var id = $(this).children().attr('id').split("-")[1];
    
        if(id){
            var confirm = window.confirm("Are you sure you want to delete record ?");
            if(confirm){
                $.ajax({
                    url:"{{route('admin.item.delete')}}",
                    type: 'POST',
                    data:{"id":id},
                    success: function( msg ) {
                        if ( msg.status === 1 ) {
                            toastr.success("Successfully deleted" );
                            setInterval(function() {
                                window.location.reload();
                            }, 1000);
                        }
                      }
                });
    
            }
        }
        return false;
        
    });
</script>
@stop