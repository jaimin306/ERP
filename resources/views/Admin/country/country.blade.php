
@extends('Admin.layouts.master') 

@section('title', 'Country')

@section('content')


@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Country</h2>
        </div>
        <div class="col-lg-2">

        </div>
    </div>


        
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title ">
                            <h5 class="m-t-5">Manage Country</h5>
                            <div class="ibox-tools">
                                <a href="{{route('admin.country.create')}}">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> <b>Add</b></button>
                                </a>
                            </div>
                        </div>
                        
                       
                        <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >

                    <thead>
                    <tr>
                        <th style="width: 7%">No.</th>
                        <th>Short Code</th>
                        <th>Name</th>
                        <th>Phone Code</th>
                        <th style="width: 5%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($countries as $key => $country)
                    <tr class="gradeX">
                        <td>{{++$key}}</td>
                        <td>{{$country->name}}</td>
                        <td>{{$country->shortname}}</td>
                        <td>{{$country->phonecode}}</td>
                        <span class="hidden">{{$country->id}}</span>
                        <td class="center">
                            <a href="{{route('admin.country.edit', $country->id)}}">
                            <span class="btn btn-xs btn-primary editData" id="edit-{{$country->id}}">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i>
                            </span>
                            </a>
                            <span class="btn btn-xs btn-danger delRecord">
                                <i class="fa fa-trash " id="delete-{{$country->id}}" ></i><!-- </button> -->
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