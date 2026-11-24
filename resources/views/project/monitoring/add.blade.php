@extends('backend.layouts.app')
@section('title')
    Projects Monitoring
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Monitoring</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Monitoring</li>
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
                        $permission = helperPermissionLink(url('project/monitoring/create'), url('project/monitoring'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/monitoring', 'autocomplete' => 'off',
                            'role' => 'form', 'files'=>'true','enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('moni.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject</label><label class="text-danger">*</label>
                                        {{ Form::select('moni[project_id]', $projects->pluck('name', 'id'), Request::get('moni.project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('moni.project_id', '<span class="text-danger">:message</span>')
                                        !!}
                                    </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="form-group col-md-3 {{ $errors->has('moni.date') ? 'has-error' : '' }}">
                                    <label>Date</label><label class="text-danger">*</label>
                                    {!! Form::text('moni[date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Date'])
                                    !!}
                                    {!! $errors->first('moni.date', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('moni.type') ? 'has-error' : '' }}">
                                    <label>Type</label><label class="text-danger">*</label>
                                    {!! Form::text('moni[type]', null, ['class' => 'form-control', 'placeholder' => 'Type'])
                                    !!}
                                    {!! $errors->first('moni.type', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('moni.leadBy') ? 'has-error' : '' }}">
                                    <label>Lead By</label><label class="text-danger">*</label>
                                    {!! Form::text('moni[leadBy]', null, ['class' => 'form-control', 'placeholder' => 'Lead By']) !!}
                                    {!! $errors->first('moni.leadBy', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-3 {{ $errors->has('moni.no_of_participant') ? 'has-error' : '' }}">
                                    <label>Number of Participants</label><label class="text-danger">*</label>
                                    {!! Form::number('moni[no_of_participant]', null, ['class' => 'form-control',
                                    'placeholder' => 'Number of Participants']) !!}
                                    {!! $errors->first('moni.no_of_participant', '<span
                                        class="text-danger">:message</span>') !!}
                                </div>



                            </div>
                                <div class="form-group col-md-12 {{ $errors->has('moni.participant') ? 'has-error' : '' }}"
                                    style="width:100%;">
                                    <label>Participants</label><label class="text-danger">*</label>
                                    {!! Form::textarea('moni[participant]', null, ['class' => 'form-control', 'placeholder'
                                    => 'Participants', 'rows' => '4']) !!}
                                    {!! $errors->first('moni.participant', '<span class="text-danger">:message</span>') !!}
                                </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Monitoring</th>
                                            <th>Observation</th>
                                            <th>Suggestions</th>
                                            <th>Improvements</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <label>Social Safeguard</label>
                                            <td>
                                                {!! Form::textarea('moni[social_observation]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Observation', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.social_observation', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                {!! Form::textarea('moni[social_suggestion]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Suggestions', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.social_suggestion', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                 {!! Form::textarea('moni[social_improvement]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Improvements', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.social_improvement', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>
                                                <label>Technical</label>
                                            <td>
                                                {!! Form::textarea('moni[technical_observation]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Observation', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.technical_observation', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                {!! Form::textarea('moni[technical_suggestion]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Suggestions', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.technical_suggestion', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                 {!! Form::textarea('moni[technical_improvement]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Improvements', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.technical_improvement', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>
                                                <label>Environmental</label>
                                            <td>
                                                {!! Form::textarea('moni[env_observation]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Observation', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.env_observation', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                {!! Form::textarea('moni[env_suggestion]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Suggestions', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.env_suggestion', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                 {!! Form::textarea('moni[env_improvement]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Improvements', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.env_improvement', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>
                                                <label>GESI</label>
                                            <td>
                                                {!! Form::textarea('moni[gesi_observation]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Observation', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.gesi_observation', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                {!! Form::textarea('moni[gesi_suggestion]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Suggestions', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.gesi_suggestion', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                 {!! Form::textarea('moni[gesi_improvement]', null, ['class' => 'form-control', 'placeholder'
                                                => 'Improvements', 'rows' => '2']) !!}
                                                {!! $errors->first('moni.gesi_improvement', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                        <label>Files</label>
                                        <input type="file" class="" id="file_upload"  name="file"  /><br/>
                                        <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                        {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="row mb-4" id="image_preview" style="width:100%;"></div>

                                </div>
                           
                           


                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/monitoring') }}" class="btn btn-danger">cancel</a>

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
