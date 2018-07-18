
@extends('Admin.layouts.master') 

@section('title', 'Account Type')

@section('content')

<?php 
//print_r($country);
?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Account Type</h2>
        </div>
        <div class="col-lg-2"></div>
    </div>
  @if(session('success'))
    <h1>{{session('success')}}</h1>
@endif
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title ">
                        <h5 class="m-t-5">Manage Account Type</h5>
                        <div class="ibox-tools">
                            <a href="{{route('admin.accountType.create')}}">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> <b>Add</b></button>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th style="width: 10%">No.</th>
                                        <th>Account Type</th>
                                        <th style="width: 5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                @foreach($accountTypes as $key => $accountType)
                                <tr class="gradeX">
                                <td>{{++$key}}</td>
                                <td>{{$accountType->account_type}}</td>
                                <span class="hidden">{{$accountType->id}}</span>
                                <!-- <td>Status</td> -->
                                <td class="center">
                                    <a href="{{route('admin.accountType.edit', $accountType->id)}}">
                                        <span class="btn btn-xs btn-primary editData" id="edit-{{$accountType->id}}"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                                        </span>
                                    </a>
                                    <span class="btn btn-xs btn-danger delRecord">
                                        <i class="fa fa-trash " id="delete-{{$accountType->id}}" ></i>
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

    $(document).on('click','.delRecord', function(){ 
        var id = $(this).children().attr('id').split("-")[1];

        if(id){
            var confirm = window.confirm("Are you sure you want to delete record ?");
            if(confirm){
                $.ajax({
                    url:"{{route('admin.accountType.delete')}}",
                    type: 'POST',
                    data:{"id":id},
                    success: function( msg ) {
                        if ( msg.status === 1 ) {
                            setInterval(function() {
                                window.location.reload();
                            }, 500);
                        }
                      }
                });

            }
        }
        return false;
        
    });

    
</script>

@stop