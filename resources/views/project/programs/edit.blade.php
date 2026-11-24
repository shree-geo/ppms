@extends('backend.layouts.app')
@section('title')
    Projects programs
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Programs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Programs</li>
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

                        $permission = helperPermissionLink(url('project/programs/create'), url('project/programs'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                        {!! Form::model($edits,['method'=>'put','route'=>['programs.update',$edits['programs']->id], 'autocomplete'=>'off', 'role'=>'form', 'enctype' => 'multipart/form-data', 'file' => true]) !!}
                            
                     <div class="row">
                          @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('programs.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('programs[project_id]',$projects->pluck('name','id'),Request::get('programs.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('programs.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                    <div class="form-group col-md-4 {{ ($errors->has('programs.program_type_id'))?'has-error':'' }}">
                                    <label>Program Type <label class="text-danger"> *</label></label>
                                    {{Form::select('programs[program_type_id]',$program_types->pluck('type_name','id'),Request::get('programs[program_type_id]'),['class'=>'form-control select2','id'=>'program_type_id','placeholder'=>
                                                                        'Select Program Type'])}}
                                    {!! $errors->first('programs.program_type_id', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                    <div class="form-group col-md-4 {{ ($errors->has('programs.program_title'))?'has-error':'' }}">
                                    <label>Program Title <label class="text-danger"> *</label></label>
                                    {{Form::text('programs[program_title]',null,['class'=>'form-control ','id'=>'program_title','placeholder'=>
                                                                        'Program Title'])}}
                                    {!! $errors->first('programs.program_title', '<span class="text-danger">:message</span>') !!}

                                    </div>
                            </div>
                                <div class="row">
                                    <div class="form-group  {{ ($errors->has('programs.program_details'))?'has-error':''}}"  style="width:100%;">
                                    <label>Program Details<label class="text-danger"> *</label></label>
                                    {{Form::textarea('programs[program_details]',null,['class'=>'form-control ','id'=>'program_details','placeholder'=>
                                                                        'Program Details','rows'=>'5'])}}
                                    {!! $errors->first('programs.program_details', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4"{{($errors->has('programs.start_date'))?'has-error':''}}>
                                        <label>Start Date<label class="text-danger"> *</label></label>
                                        {{ Form::text('programs[start_date]',null,['class'=>'form-control datepicker','placeholder'=>'Start Date'])}}
                                        {!! $errors->first('programs.start_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"{{($errors->has('programs.end_date'))?'has-error':''}}>
                                        <label>End Date<label class="text-danger"> *</label></label>
                                        {{ Form::text('programs[end_date]',null,['class'=>'form-control datepicker','placeholder'=>' End Date'])}}
                                        {!! $errors->first('programs.end_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-group col-md-6 {{ ($errors->has('programs.bramin_f'))?'has-error':'' }}">
                                            <label>Braman/Chhetri Female<label class="text-danger"> *</label></label>
                                            {!! Form::number('programs[bramin_f]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Female','min'=>'0']) !!}
                                            {!! $errors->first('programs.bramin_f','<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div class="form-group col-md-6 {{ ($errors->has('programs.bramin_m'))?'has-error':'' }}">
                                                <label>Braman/Chhetri Male<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[bramin_m]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Male','min'=>'0']) !!}
                                                {!! $errors->first('programs.bramin_m','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.dalit_f'))?'has-error':'' }}">
                                                <label>Dalit Female<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[dalit_f]',null,['class'=>'form-control','placeholder' => 'Dalit Female','min'=>'0']) !!}
                                                {!! $errors->first('programs.dalit_f','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.dalit_m'))?'has-error':'' }}">
                                                <label>Dalit Male<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[dalit_m]',null,['class'=>'form-control','placeholder' => 'Dalit Male','min'=>'0']) !!}
                                                {!! $errors->first('programs.dalit_m','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.janjati_f'))?'has-error':'' }}">
                                                <label>Janajati Female<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[janjati_f]',null,['class'=>'form-control','placeholder' => 'Janajati Female','min'=>'0']) !!}
                                                {!! $errors->first('programs.janjati_f','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.janjati_m'))?'has-error':'' }}">
                                                <label>Janajati Male<label class="text-danger"> *</label></label>
                                                    {!! Form::number('programs[janjati_m]',null,['class'=>'form-control','placeholder' => 'Janajati Male','min'=>'0']) !!}
                                                    {!! $errors->first('programs.janjati_m','<span class="text-danger">:message</span>') !!}
                                            </div>
                                                                
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.muslim_f'))?'has-error':'' }}">
                                                <label>Muslim Female<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[muslim_f]',null,['class'=>'form-control','placeholder' => 'Muslim Female','min'=>'0']) !!}
                                                {!! $errors->first('programs.muslim_f','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.muslim_m'))?'has-error':'' }}">
                                            <label>Muslim Male<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[muslim_m]',null,['class'=>'form-control','placeholder' => 'Muslim Male','min'=>'0']) !!}
                                                {!! $errors->first('programs.muslim_m','<span class="text-danger">:message</span>') !!}
                                            </div>
                                                                
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.others_f'))?'has-error':'' }}">
                                                <label>Others Female<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[others_f]',null,['class'=>'form-control','placeholder' => 'Others Female','min'=>'0']) !!}
                                                {!! $errors->first('programs.others_f','<span class="text-danger">:message</span>') !!}
                                            </div>
                                            <div class="form-group col-md-6 {{ ($errors->has('programs.others_m'))?'has-error':'' }}">
                                                <label>Others Male<label class="text-danger"> *</label></label>
                                                {!! Form::number('programs[others_m]',null,['class'=>'form-control','placeholder' => 'Others Male','min'=>'0']) !!}
                                                {!! $errors->first('programs.others_m','<span class="text-danger">:message</span>') !!}
                                            </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('file.*') ? 'has-error' : '' }}">
                                            <label>Files</label><br/>
                                            <input type="file" class="" id="file_upload" name="files[]" multiple /><br/>
                                            <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>
                                                {!! $errors->first('files.*', '<span class="text-danger">:message</span>') !!}                                            
                                            </div>
                                            <div class="row mb-4" id="image_preview" style="width:100%;"></div>

                                    </div>
                                            @if($edits['programs']->file!=null)

                                            <?php $files = json_decode($edits['programs']->file);  ?>
                                            @foreach($files as $key=>$val)
                                            <?php $extension = explode('.', $val); ?>
                                            @if ($extension[1] == 'pdf')
                                            <a href="{{url('delete/programs/'.$edits['programs']->id.'/'.$val)}}" id="x-edit">
                                                <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                            </a>&nbsp;
                                            <a href="{{ asset('storage/uploads/programs/' . $val) }}" target="_blank">{{ $val }}</a>&nbsp;&nbsp;&nbsp;
                                            @else                                          
                                            
                                            <div class="row">
                                                <div class="col-md-4" >
                                                    <a href="{{url('delete/programs/'.$edits['programs']->id.'/'.$val)}}" id="x-edit">
                                                    <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                                </a>
                                                    <img src="{{asset('/storage/uploads/programs/'. $val)}}" style="height:180px; ">
                                                </div>
                                            </div>
                                                @endif
                                                @endforeach
                                              
                                         @else
                                            No File Available
                                         @endif
                                         
                                           
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/programs')}}" class="btn btn-danger">cancel</a>
                                
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

@endsection







