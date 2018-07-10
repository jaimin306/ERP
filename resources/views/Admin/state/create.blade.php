
@extends('admin.layouts.master') 

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


        
            <div class="wrapper wrapper-content">
               
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Add States</h5>
                        </div>
                        <div class="ibox-content">
                            {!! Form::open(['route' => 'admin.state.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post']) !!}
                            <!-- <form method="get" class="form-horizontal"> -->
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'col-lg-2 control-label']) !!}
                                    <!-- <label class="col-sm-2 control-label">Normal</label> -->
                                    <div class="col-sm-4">
                                        <!-- <input type="text" class="form-control"> -->
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                    </div>
                                </div>
                                

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="submit">Cancel</button>
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

        