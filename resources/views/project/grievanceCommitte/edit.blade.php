@extends('backend.layouts.app')
@section('title')
   Grievance Committe
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Grievance Committe</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Grievance Committe</li>
                            <li class="breadcrumb-item active">{{trans('app.edit')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="form">
                <div class="card card-default">
                    <div class="card-header with-border">
                        <h3 class="card-title">{{trans('app.edit')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('project/grievanceCommitte/create'), url('project/grievanceCommitte'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route'=>['grievanceCommitte.update',$edits['grievanceCommitte']->id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                            @if ($edits['grievanceCommitte']->level=='ward')
                                <h3 class="text-center">First Level Grievance Details</h3>                                    
                            @else
                                <h3 class="text-center">Second Level Grievance Details</h3>
                            @endif
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('grievanceCommitte[project_id]',$projects->pluck('name','id'),Request::get('grievanceCommitte.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name','required'=>'required'])}}
                                        {!! $errors->first('grievanceCommitte.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                            
                                </div>
                             
                             <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.name'))?'has-error':'' }}">
                                    <label>Name</label>
                                    {!! Form::text('grievanceCommitte[name]',null,['class'=>'form-control','placeholder' => 'Name','required']) !!}
                                    {!! $errors->first('grievanceCommitte.name','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.level'))?'has-error':'' }}">
                                    <label>Level</label>
                                    {!! Form::text('grievanceCommitte[level]',$edits['grievanceCommitte']->level,['class'=>'form-control','placeholder' => 'Level', 'readonly']) !!}
                                    {!! $errors->first('grievanceCommitte.level','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.designation'))?'has-error':'' }}">
                                    <label> Designation</label>
                                    {!! Form::text("grievanceCommitte[designation]", null, ['class' => 'form-control', 'placeholder' => 'Enter Designation.']) !!}
                                    {!! $errors->first("grievanceCommitte.designation", '<span class="text-danger">:message</span>') !!}

                                </div>                               
                             </div>

                             <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.contact_no'))?'has-error':'' }}">
                                    <label>Contact Number</label>
                                    {!! Form::text('grievanceCommitte[contact_no]',null,['class'=>'form-control','placeholder' => 'Enter Contact No.']) !!}
                                    {!! $errors->first('grievanceCommitte.contact_no','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceCommitte.email'))?'has-error':'' }}">
                                    <label>Email ID</label>
                                    {!! Form::email('grievanceCommitte[email]',null,['class'=>'form-control','placeholder' => 'Enter Valid Email']) !!}
                                    {!! $errors->first('grievanceCommitte.email','<span class="text-danger">:message</span>') !!}
                                </div>

                              
                             </div>
                          
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/grievanceCommitte')}}" class="btn btn-danger">Cancel</a>                                
                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;
                                </button>
                                You Cannot access this module Please Contact your Super Admin user to access this.
                            </div>

                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection







