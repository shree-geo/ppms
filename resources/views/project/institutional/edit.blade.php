@extends('backend.layouts.app')
@section('title')
    Projects Institutional
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Institutions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Institutional</li>
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
                        <h3 class="card-title">{{trans('app.add')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('project/institutional/create'), url('project/institutional'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route'=>['institutional.update',$edits['insti']->id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('insti.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('insti[project_id]',$projects->pluck('name','id'),Request::get('insti.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('insti.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                </div>
                                 
                                <div class="row">
                                 <div class="form-group col-md-6 {{ ($errors->has('insti.institution_name'))?'has-error':'' }}">
                                    <label>Institution Name<label class="text-danger">*</label></label>
                                    {!! Form::text('insti[institution_name]',null,['class'=>'form-control','placeholder' => 'Institution Name']) !!}
                                    {!! $errors->first('insti.institution_name','<span class="text-danger">:message</span>') !!}
                                </div>
                                 <div class="form-group col-md-6 {{ ($errors->has('insti.institution_type'))?'has-error':'' }}">
                                    <label>Institution Type <label class="text-danger"> *</label></label>
                                    <select id="type" name="insti[institution_type]" class="form-control select2">
                                        <option value="" selected>Select</option>
                                        <option value="school" {{($edits['insti']!=null &&$edits['insti']->institution_type=='school')?'selected':''}}>School</option>
                                        <option value="healthpost" {{($edits['insti']!=null &&$edits['insti']->institution_type=='healthpost')?'selected':''}}>Health Post</option>
                                        <option value="others" {{($edits['insti']!=null &&$edits['insti']->institution_type=='others')?'selected':''}}>Others</option>
                                    </select>
                                    {!! $errors->first('insti.institution_type','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('insti.total_female'))?'has-error':'' }}">
                                    <label>Female<label class="text-danger">*</label></label>
                                    {!! Form::number('insti[total_female]',null,['class'=>'form-control','placeholder' => 'Female','min'=>'0']) !!}
                                    {!! $errors->first('insti.total_female','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('insti.total_male'))?'has-error':'' }}">
                                   <label>Male<label class="text-danger">*</label></label>
                                   {!! Form::number('insti[total_male]',null,['class'=>'form-control','placeholder' => 'Male','min'=>'0']) !!}
                                   {!! $errors->first('insti.total_male','<span class="text-danger">:message</span>') !!}
                               </div>
                                </div>

                          
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/institutional')}}" class="btn btn-danger">cancel</a>
                                
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







