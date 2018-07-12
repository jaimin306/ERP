
@extends('Admin.layouts.master') 

@section('title', 'Settings')

@section('content')

<?php 
//print_r($country);
?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Settings</h2>

            <!-- <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">Home</a>
                </li>
                <li>
                    <a>Forms</a>
                </li>
                <li class="active">
                    <strong>Basic Form</strong>
                </li>
            </ol> -->
        </div>
        <div class="col-lg-2">

        </div>
    </div>


        
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            
                            <h5 style="width: 100%;">
                                Manage Setting 
                                <!-- <a href="{{route('admin.country.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a> -->
                                <!-- <a href="{{route('admin.country.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a> -->
                            </h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Short Code</th>
                        <th>Name</th>
                        <th>Phone Code</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                        <!-- <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th> -->
                    </tr>
                    </thead>
                    <!--<tbody>
                        @foreach($countries as $country)
                    <tr class="gradeX">
                        <td>{{$country->name}}</td>
                        <td>{{$country->shortname}}</td>
                        <td>{{$country->phonecode}}</td>
                        <span class="hidden">{{$country->id}}</span>
                        <td class="center">
                            
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$country->id}}">
                            <a href="{{route('admin.country.edit', $country->id)}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </a>
                            </span>
                            <span class="btn btn-xs btn-danger">
                            <i class="fa fa-trash delRecord" id="delete-{{$country->id}}" ></i>
                            </span>
                            
                        </td>
                        
                    </tr>
                        @endforeach
                   
                    </tbody>
                    -->
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
       /* $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });*/
//$('.dataTables-example').DataTable();
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
        var id = $(this).attr('id').split("-")[1];

        if(id){
            var confirm = window.confirm("Are you sure you want to delete record ?");
            if(confirm){
                $.ajax({
                    url:"{{route('admin.country.delete')}}",
                    type: 'POST',
                    data:{"id":id},
                    success: function( msg ) {
                        //alert(msg);
                        if ( msg.status === 1 ) {
                          //alert("sdf");   
                            //toastr.success("Successfully deleted" );
                            //toastr.success("Record inserted successfully.");
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