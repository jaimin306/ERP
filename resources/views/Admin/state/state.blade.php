@extends('Admin.layouts.master') 
@section ('title', 'States')
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
                <div class="ibox-title ">
                    <h5 class="m-t-5">Manage States</h5>
                    <div class="ibox-tools">
                        <a href="{{route('admin.state.create')}}">
                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> <b>Add</b></button>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables" >
                            <thead>
                                <tr>
                                    <th style="width: 7%" >No.</th>
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th style="width: 5%" >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($states as $key => $state)
                                <tr class="gradeX">
                                    <td>{{++$key}}</td>
                                    <td>{{$state->country_name}}</td>
                                    <td>{{$state->state_name}}</td>
                                    <span class="hidden">{{$state->state_id}}</span>
                                    <span class="hidden">{{$state->state_country_id}}</span>
                                    <!-- <td>Status</td> -->
                                    <td class="center">
                                        <a href="{{route('admin.state.edit', $state->state_id)}}">
                                        <span class="btn btn-xs btn-primary editData" id="edit-{{$state->state_id}}">
                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                                        </span>
                                        </a>
                                        <span class="btn btn-xs btn-danger delRecord">
                                        <i class="fa fa-trash " id="delete-{{$state->state_id}}" ></i>
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
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
    
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
                    url:"{{route('admin.state.delete')}}",
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