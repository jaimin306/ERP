
@extends('Admin.layouts.master') 

@section('title', 'Department')

@section('content')

<?php 
//print_r($department);
?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Department</h2>

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
                                Manage Department 
                                <a href="{{route('admin.department.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a>
                            </h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                    <tr class="gradeX">
                        <td>{{$department->department_name}}</td>
                        <span class="hidden">{{$department->id}}</span>
                        <!-- <td>Status</td> -->
                        <td class="center">
                            
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$department->id}}">
                            <a href="{{route('admin.department.edit', $department->id)}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </a>
                            </span>
                            <!-- <form name="del_rec" id="del_rec" method="post" action="{{route('admin.department.delete', $department->id)}}" > -->
                            <span class="btn btn-xs btn-danger">
                                <!-- <button type="submit" name="delete" id="delete" > --><i class="fa fa-trash delRecord" id="delete-{{$department->id}}" ></i><!-- </button> -->
                            </span>
                            <!-- </form> -->
                        </td>
                        <!-- <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td class="center">4</td> -->
                        
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
                    url:"{{route('admin.department.delete')}}",
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