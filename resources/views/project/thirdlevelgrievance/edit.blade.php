@extends('backend.layouts.app')
@section('title')
Third Level Grievance Details
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Third Level Grievance Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Third Level Grievance Details</li>
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

                        $permission = helperPermissionLink(url('project/thirdlevelgrievance/create'), url('project/thirdlevelgrievance'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route'=>['thirdlevelgrievance.update',$edits['grievanceThirdLevel']->id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                           
                                
                             <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('grievanceThirdLevel.name'))?'has-error':'' }}">
                                    <label>Name</label><label class="text-danger">*</label>
                                    {!! Form::text('grievanceThirdLevel[name]',null,['class'=>'form-control','placeholder' => 'Name']) !!}
                                    {!! $errors->first('grievanceThirdLevel.name','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceThirdLevel.level'))?'has-error':'' }}">
                                    <label>Level</label>
                                    {!! Form::text('grievanceThirdLevel[level]',$edits['grievanceThirdLevel']->level,['class'=>'form-control','placeholder' => 'Level', 'readonly']) !!}
                                    {!! $errors->first('grievanceThirdLevel.level','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceThirdLevel.designation'))?'has-error':'' }}">
                                    <label>Designation</label><label class="text-danger">*</label>
                                    {!! Form::text('grievanceThirdLevel[designation]',null,['class'=>'form-control','placeholder' => 'Designation']) !!}
                                    {!! $errors->first('grievanceThirdLevel.designation','<span class="text-danger">:message</span>') !!}
                                </div>
                                                              
                             </div>

                             <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('grievanceThirdLevel.contact_no'))?'has-error':'' }}">
                                    <label>Contact Number</label>
                                    {!! Form::text('grievanceThirdLevel[contact_no]',null,['class'=>'form-control','placeholder' => 'Enter Contact No.'],'required') !!}
                                    {!! $errors->first('grievanceThirdLevel.contact_no','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('grievanceThirdLevel.email'))?'has-error':'' }}">
                                    <label>Email ID</label>
                                    {!! Form::email('grievanceThirdLevel[email]',null,['class'=>'form-control','placeholder' => 'Enter Valid Email','required']) !!}
                                    {!! $errors->first('grievanceThirdLevel.email','<span class="text-danger">:message</span>') !!}
                                </div>

                             
                             </div>
                          
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{url('/project/thirdlevelgrievance')}}" class="btn btn-danger">Cancel</a>                                
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







