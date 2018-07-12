
@extends('Admin.layouts.master') 

@section ('title', 'Designation')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Designations</h2>
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


     <?php
     //echo "<pre>"; print_r($designations)
     ?>   
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            
                            <h5 style="width: 100%;">
                                Manage Designation 
                                <a href="{{route('admin.designation.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a>
                            </h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables" >

                    <thead>
                    <tr>
                        
                        <th>Department</th>
                        <th>Designation Name</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                        <!-- <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th> -->
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($designations as $designation)
                    <tr class="gradeX">
                        
                        <td>{{$designation->department_name}}</td>
                        <td>{{$designation->designation_name}}</td>
                        <span class="hidden">{{$designation->designation_id}}</span>
                        <span class="hidden">{{$designation->designation_department_id}}</span>
                        <!-- <td>Status</td> -->
                        <td class="center">
                            
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$designation->designation_id}}">
                            <a href="{{route('admin.designation.edit', $designation->designation_id)}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </a>
                            </span>
                            
                            <span class="btn btn-xs btn-danger">
                                <!-- <button type="submit" name="delete" id="delete" > --><i class="fa fa-trash delRecord" id="delete-{{$designation->designation_id}}" ></i><!-- </button> -->
                            </span>
                            
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
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
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
                    url:"{{route('admin.designation.delete')}}",
                    type: 'POST',
                    data:{"id":id},
                    success: function( msg ) {
                        //alert(msg);
                        if ( msg.status === 1 ) {
                          //alert("sdf");   
                            toastr.success("Successfully deleted" );
                            //toastr.success("Record inserted successfully.");
                            //$("#dataTables").DataTable().ajax.reload(null, false );
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