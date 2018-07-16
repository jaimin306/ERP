
@extends('Admin.layouts.master') 

@section ('title', 'Users')

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
            <h2>User</h2>
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
                                Manage Users 
                                <a href="{{route('admin.user.create')}}" class="btn btn-success btn-sm pull-right" ><i class="fa fa-plus"></i> <b>Add</b></a>
                            </h5>
                        </div>
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables" >

                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        
                        <!-- <th>Department</th>
                        <th>Designation</th> -->
                        
                        <th>Action</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                    <tr class="gradeX">
                        <td>{{$user->user_name}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        
                        <td class="center">
                            <a href="{{route('admin.user.edit', $user->id)}}">
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$user->id}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </span>
                            </a>
                            
                            <span class="btn btn-xs btn-danger delRecord">
                                <!-- <button type="submit" name="delete" id="delete" > --><i class="fa fa-trash " id="delete-{{$user->id}}" ></i><!-- </button> -->
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
                    url:"{{route('admin.user.delete')}}",
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