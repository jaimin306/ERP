
@extends('Admin.layouts.master') 

@section ('title', 'States')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>States</h2>
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
     //echo "<pre>"; print_r($states)
     ?>   
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            
                            <h5 style="width: 100%;">
                                Manage States 
                                <a href="{{route('admin.state.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a>
                            </h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables" >

                    <thead>
                    <tr>
                        <th>State Name</th>
                        <th>Country Name</th>
                        <!-- <th>Status</th> -->
                        <th>Action</th>
                        <!-- <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th> -->
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($states as $state)
                    <tr class="gradeX">
                        <td>{{$state->state_name}}</td>
                        <td>{{$state->country_name}}</td>
                        <span class="hidden">{{$state->state_id}}</span>
                        <span class="hidden">{{$state->state_country_id}}</span>
                        <!-- <td>Status</td> -->
                        <td class="center">
                            
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$state->state_id}}">
                            <a href="{{route('admin.state.edit', $state->state_id)}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </a>
                            </span>
                            
                            <span class="btn btn-xs btn-danger">
                                <!-- <button type="submit" name="delete" id="delete" > --><i class="fa fa-trash delRecord" id="delete-{{$state->state_id}}" ></i><!-- </button> -->
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
                    url:"{{route('admin.state.delete')}}",
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