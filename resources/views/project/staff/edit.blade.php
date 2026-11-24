@extends('backend.layouts.app')
@section('title')
    Staff
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Staff</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Staff</li>
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

                        $permission = helperPermissionLink(url('project/staff/create'), url('project/staff'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                        {!! Form::model($edits,['method'=>'put','route'=>['staff.update',$edits['staff']->id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('staff.project_id'))?'has-error':'' }}">
                                        <label>Subproject</label><label class="text-danger">*</label>
                                        {{Form::select('staff[project_id]',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('staff.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                              <div class="form-group col-md-4 {{ ($errors->has('staff.ofc_name'))?'has-error':'' }}">
                                    <label>Office Name </label><label class="text-danger"> *</label>
                                    {!! Form::text('staff[ofc_name]',null,['class'=>'form-control','placeholder' => 'Office Name']) !!}
                                    {!! $errors->first('staff.ofc_name','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ ($errors->has('staff.department'))?'has-error':'' }}">
                                    <label>Department </label><label class="text-danger"> *</label>
                                    {!! Form::text('staff[department]',null,['class'=>'form-control','placeholder' => 'Department']) !!}
                                    {!! $errors->first('staff.department','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.name'))?'has-error':'' }}">
                                        <label>Name </label><label class="text-danger"> *</label>
                                    {!! Form::text('staff[name]',null,['class'=>'form-control','placeholder' => 'Name']) !!}
                                    {!! $errors->first('staff.name','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.designaion_id'))?'has-error':'' }}">
                                        <label>Designation </label><label class="text-danger"> *</label>
                                        {{Form::select('staff[designaion_id]',$designation->pluck('designation_name','id'),Request::get('staff.designaion_id'),['class'=>'form-control select2','id'=>'designation','placeholder'=>'Select Designation'])}}
                                        {!! $errors->first('staff.designaion_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.gender'))?'has-error':'' }}">
                                        <label>Gender </label><label class="text-danger"> *</label>                                
                                        {!! Form::select('staff[gender]', ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'], null, ['class'=>'form-control select2','placeholder' => 'Select a Gender...']) !!}
                                        {!! $errors->first('staff.gender','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.contact_no'))?'has-error':'' }}">
                                        <label>Contact Number </label>                                
                                        {!! Form::text('staff[contact_no]',null, ['class'=>'form-control','placeholder' => '98XXXXXXXX',]) !!}
                                        {!! $errors->first('staff.contact_no','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.email'))?'has-error':'' }}">
                                        <label>Email </label>                                
                                        {!! Form::email('staff[email]',null, ['class'=>'form-control','placeholder' => 'Enter a Email Adddress',]) !!}
                                        {!! $errors->first('staff.email','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.join_date'))?'has-error':'' }}">
                                        <label>Join Date </label><label class="text-danger"> *</label>                                
                                        {!! Form::text('staff[join_date]',null, ['class'=>'form-control datepicker','placeholder' => 'Pick a Join Date',]) !!}
                                        {!! $errors->first('staff.join_date','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>End Date </label>                                
                                        {!! Form::text('staff[end_date]',null, ['class'=>'form-control datepicker','placeholder' => 'Pick a End Date',]) !!}
                                        {!! $errors->first('staff.end_date','<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3  {{ ($errors->has('staff.status'))?'has-error':'' }}">
                                        <label>Status </label><label class="text-danger"> *</label>  <br>
                                        
                                        <input type="radio"  name="staff[status]" value="active"  {{ $edits['staff']->status== 'active'  ? 'checked' : '' }}> Active &nbsp;&nbsp;&nbsp;
                                        <input type="radio"  name="staff[status]" value="inactive"  {{ $edits['staff']->status== 'inactive' ? 'checked' : '' }}> Inactive                         

                                        {{-- {!! Form::select('staff[status]', ['active' => 'Active', 'inactive' => 'Inactive'], null, ['class'=>'form-control select2','placeholder' => 'Select a Status...']) !!} --}}
                                        {!! $errors->first('staff.status','<span class="text-danger">:message</span>') !!}
                                    </div>


                                </div>
                                                                   
                                         
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/staff')}}" class="btn btn-danger">Cancel</a>
                                
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







