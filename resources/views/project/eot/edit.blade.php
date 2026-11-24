@extends('backend.layouts.app')
@section('title')
    Projects Eot Details
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Eot Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Eot</li>
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

                        $permission = helperPermissionLink(url('project/eot/create'), url('project/eot'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                       
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route'=>['eot.update',$edits['eot']->id], 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('eot.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('eot[project_id]',$projects->pluck('name','id'),Request::get('eot.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('ben.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                              
                                </div>
                                <div class="row">
                                   
                                <div class="form-group col-md-4 {{ ($errors->has('eot.contract_start_date'))?'has-error':'' }}">
                                    <label>Contract Start Date<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[contract_start_date]',null,['class'=>'form-control ','placeholder' => 'Start Date','readonly']) !!}
                                    {!! $errors->first('eot.contract_start_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                  <div class="form-group col-md-4">
                                    <label>Original Stage 1 completion Date</label>
                                    {!! Form::text('eot[original_stage1]',null,['class'=>'form-control ','placeholder' => 'Start Date','id'=>'original_stage1','readonly']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Original Stage 2 completion Date</label>
                                    {!! Form::text('eot[original_stage2]',null,['class'=>'form-control ','placeholder' => 'Start Date','id'=>'original_stage2','readonly']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stage1 completion Date</label>
                                    {!! Form::text('eot[revised_stage1]',null,['class'=>'form-control ','placeholder' => 'Date','id'=>'revised_stage1','readonly']) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Stage2 completion Date</label>
                                    {!! Form::text('eot[revised_stage2]',null,['class'=>'form-control ','placeholder' => 'Date','id'=>'revised_stage2','readonly']) !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.revised_stage1_completion_date'))?'has-error':'' }}">
                                    <label>Revised Stage1 Completion Date<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[revised_stage1_completion_date]',null,['class'=>'form-control datepicker','placeholder' => 'Revised Stage1 Completion Date','id'=>'revised_stage1_completion_date']) !!}
                                    {!! $errors->first('eot.revised_stage1_completion_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.revised_stage2_completion_date'))?'has-error':'' }}">
                                    <label>Revised Stage2 Completion Date<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[revised_stage2_completion_date]',null,['class'=>'form-control datepicker','placeholder' => 'Revised Stage2 Completion Date','id'=>'revised_stage2_completion_date']) !!}
                                    {!! $errors->first('eot.revised_stage2_completion_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.serial_no'))?'has-error':'' }}">
                                    <label> Eot Number<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[serial_no]',null,['class'=>'form-control ','placeholder' => 'Eot Number','id'=>'serial_no']) !!}
                                    {!! $errors->first('eot.serial_no','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.extended_by'))?'has-error':'' }}">
                                    <label>Extended By<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[extended_by]',null,['class'=>'form-control ','placeholder' => 'Extended By','id'=>'extended_by']) !!}
                                    {!! $errors->first('eot.extended_by','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.approved_by'))?'has-error':'' }}">
                                    <label>Approved By<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[approved_by]',null,['class'=>'form-control ','placeholder' => 'Approved By','id'=>'approved_by']) !!}
                                    {!! $errors->first('eot.approved_by','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('eot.approved_date'))?'has-error':'' }}">
                                    <label>Approved Date<label class="text-danger">*</label></label>
                                    {!! Form::text('eot[approved_date]',null,['class'=>'form-control datepicker','placeholder' => 'Approved Date','id'=>'approved_date']) !!}
                                    {!! $errors->first('eot.approved_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                   
                                     <div class="form-group col-md-12 {{ ($errors->has('eot.remarks'))?'has-error':'' }}" style="width: 100%;">
                                    <label>Remarks</label>
                                    {!! Form::textarea('eot[remarks]',null,['class'=>'form-control','placeholder' => 'Remarks','rows'=>'5']) !!}
                                    {!! $errors->first('eot.remarks','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                               

                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                        <label>File</label>

                                        <input type="file" class="" id="file_upload" name="file" /><br />
                                        <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                        {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                    <div class="row mb-4" id="image_preview" style="width:100%;"></div>

                                </div>

                            @if ($edits['eot']->file != null)
                                <?php $extension = explode('.', $edits['eot']->file); ?>
                                @if ($extension[1] == 'pdf')
                                <a href="{{ asset('storage/uploads/eot/' . $edits['eot']->file) }}"
                                    target="_blank">{{ $edits['eot']->file }}</a>
                                    <a href="{{ url('delete/eot/' . $edits['eot']->id . '/' . $edits['eot']->file) }}"
                                                   id="x-edit">
                                                   <i class="fa fa-close"
                                                       onclick="return confirm('Do you want to delete?')"></i>
                                               </a>
                                @else
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="{{ url('delete/eot/' . $edits['eot']->id . '/' . $edits['eot']->file) }}"
                                                id="x-edit">
                                                <i class="fa fa-close"
                                                    onclick="return confirm('Do you want to delete?')"></i>
                                            </a>
                                            <img src="{{ asset('storage/uploads/eot/' . $edits['eot']->file) }}"
                                                style="height:140px;">
                                        </div>

                                    </div>
                                @endif

                            @else
                                No Photo Available
                            @endif
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/eot')}}" class="btn btn-danger">cancel</a>
                                
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
@section('js')
<script src={{url("js/pdfpreview.js")}}>  </script>

     <script>
        $('#project_id').change(function(){
            var proj_id= $('#project_id').val();
            $.ajax({
                type:'get',
                url:baseurl + '/projectDetails/' + proj_id,
                success:function(res){
                         $('#contract_start_date').val(res.contract_signing_date);
                         $('#original_stage1').val(res.completion_date_stage1);
                         $('#original_stage2').val(res.completion_date_stage2);
                         $('#revised_stage1').val(res.latest_eot);
                         $('#revised_stage2').val(res.revised_stage2_date);
                }
            })
        })
    </script>
@endsection







