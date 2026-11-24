@extends('backend.layouts.app')
@section('title')
   Reports
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Reports</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Reports</li>
                            <li class="breadcrumb-item active">{{ trans('app.add') }}</li>
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
                        <h3 class="card-title">{{ trans('app.add') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/reportUpload/create'), url('project/reportUpload'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/reportUpload', 'autocomplete' => 'off', 'role' => 'form', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-6 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4  {{ ($errors->has('type'))?'has-error':'' }}">
                                    <label>Type <label class="text-danger"> *</label>  </label>                              
                                    {!! Form::select('type', ['consolided' => 'Consolided Report', 'safeguard' => 'Safeguard Report'], null, ['class'=>'form-control select2','placeholder' => 'Select a Type...']) !!}
                                    {!! $errors->first('type','<span class="text-danger">:message</span>') !!}
                                </div>
                            <div class="form-group col-md-4 {{ ($errors->has('year'))?'has-error':''}}">
                                <label>Year <label class="text-danger"> *</label></label>
                         
                                    <select class="form-control select2" name="year">
                                        <option value="">Select Year</option>
                                        @foreach($years as $yea)
                                        <option value="{{$yea->fy_name}}">{{$yea->fy_name}}</option>
                                        @endforeach
                                    </select>
                                {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4 {{ ($errors->has('months'))?'has-error':''}}">
                                <label> Month <label class="text-danger"> *</label></label>
                                {{Form::select('months',$monthList,Request::get('months'),['class'=>'form-control select2','id'=>'months','placeholder'=>
                                                                    'Select Month'])}}
                                {!! $errors->first('months', '<span class="text-danger">:message</span>') !!}
                                </div>

                          
                                <div class="form-group col-md-4 {{ $errors->has('title') ? 'has-error' : '' }}">
                                    <label>Title<label class="text-danger">*</label></label>
                                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    {!! $errors->first('title', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('description') ? 'has-error' : '' }}"
                                    style="width:100%;">
                                    <label>Descriprion</label><label class="text-danger">*</label>
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder'
                                    => 'Description', 'rows' => '4']) !!}
                                    {!! $errors->first('description', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                        <label>Files</label>
                                        <input type="file" class="" id="file_upload"  name="file"  /><br/>
                                        <span class="help-block text-danger"> Only pdf, jpg, jpeg, png and pdf files are supported</span>

                                        {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="row mb-4" id="image_preview" style="width:100%;"></div>

                                </div>





                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/reportUpload') }}" class="btn btn-danger">cancel</a>

                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
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