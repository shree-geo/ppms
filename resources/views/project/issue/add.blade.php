@extends('backend.layouts.app')
@section('title')
    Issues
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Issues</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Issues</li>
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
                        $permission = helperPermissionLink(url('project/issue/create'),
                        url('project/issue'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/issue', 'autocomplete' => 'off', 'role' => 'form', 'enctype' => 'multipart/form-data', 'file' => true]) !!}

                            <div class="row mb-2" style="border-bottom: 5px solid rgb(12, 131, 211);">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('issue.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('issue[project_id]', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('issue.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif
                                <div class="form-group col-md-4 {{ $errors->has('issue.category') ? 'has-error' : '' }}">
                                    <label>Category <label class="text-danger"> *</label></label>
                                    {{-- {!! Form::select('issue[category]', ['issue' => 'Issue', 'meeting' => 'Meeting'], null, ['class' => 'form-control select2', 'id' => 'category', 'placeholder' => 'Select a Category...']) !!} --}}
                                    {!! Form::select('issue[category]', ['issue' => 'Issue'], null, ['class' => 'form-control select2', 'id' => 'category', 'placeholder' => 'Select a Category...']) !!}
                                    {!! $errors->first('issue.category', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('issue.number') ? 'has-error' : '' }}">
                                    <label>Number <label class="text-danger"> *</label></label>
                                    {!! Form::number('issue[number]', null, ['class' => 'form-control', 'placeholder' => 'Enter a Number']) !!}
                                    {!! $errors->first('issue.number', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('issue.issue') ? 'has-error' : '' }}">
                                    <label>Issue <label class="text-danger"> *</label></label>
                                    {!! Form::textarea('issue[issue]', null, ['class' => 'form-control textarea2', 'placeholder' => '']) !!}
                                    {!! $errors->first('issue.issue', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3  {{ ($errors->has('issue.date'))?'has-error':'' }}">
                                    <label>Date <label class="text-danger"> *</label></label>                                
                                    {!! Form::text('issue[date]',null, ['class'=>'form-control datepicker','placeholder' => 'Pick a  Date',]) !!}
                                    {!! $errors->first('issue.date','<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('files.*') ? 'has-error' : '' }}">
                                        <label>Files<label class="text-danger"> *</label></label><br/>
                                        <input type="file" class="" id="file_upload" name="files[]" multiple /><br/>
                                        <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span> <br/>
                                            {!! $errors->first('files.*', '<span class="text-danger">:message</span>') !!}                                            
                                        </div>
                                        <div class="row mb-4" id="image_preview" style="width:100%;"></div>
                                </div>
                            </div>
                            <div class="row" id="IssueDiv">
                                <div class="col-md-12 mb-4">
                                
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('issue.reason') ? 'has-error' : '' }}">
                                    <label>Reason <label class="text-danger"> *</label></label>
                                    {!! Form::textarea('issue[reason]', null, ['class' => 'form-control issueDiv textarea2', 'placeholder' => '']) !!}
                                    {!! $errors->first('issue.reason', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-6 {{ $errors->has('issue.responsibility') ? 'has-error' : '' }}">
                                    <label>Responsibility <label class="text-danger"> *</label></label>
                                    {!! Form::textarea('issue[responsibility]', null, ['class' => 'form-control issueDiv textarea2', 'placeholder' => '']) !!}
                                    {!! $errors->first('issue.responsibility', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('issue.action') ? 'has-error' : '' }}">
                                    <label>Action <label class="text-danger"> *</label></label>
                                    {!! Form::textarea('issue[action]', null, ['class' => 'form-control issueDiv textarea2 ', 'placeholder' => '']) !!}
                                    {!! $errors->first('issue.action', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6  {{ $errors->has('issue.status') ? 'has-error' : '' }}">
                                    <label>Status <label class="text-danger"> *</label></label>
                                    {!! Form::text('issue[status]', null, ['class' => 'form-control issueDiv', 'placeholder' => 'Status']) !!}

                                    {!! $errors->first('issue.status', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="row" id="MeetingDiv">
                                <div class="col-md-12 mb-4">
                                
                                </div>
                                <div class="form-group col-md-12 {{ $errors->has('issue.participation') ? 'has-error' : '' }}">
                                    <label>Participation <label class="text-danger"> *</label></label>
                                    {!! Form::text('issue[participation]', null, ['class' => 'form-control meetingDiv', 'placeholder' => 'Participation']) !!}
                                    {!! $errors->first('issue.participation', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>



                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('project/issue') }}" class="btn btn-danger">Cancel</a>

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
    <script>
        $("#category").change(function() {
            if ($(this).val() == "issue") {
                $('#IssueDiv').show();
                $('#MeetingDiv').hide();
                console.log('issue');
            } else if ($(this).val() == "meeting") {
                $('#MeetingDiv').show();
                $('#IssueDiv').hide();
                console.log('meeting');
            } else {
                $('#MeetingDiv').hide();
                $('#IssueDiv').hide();
                
            }

        });
        $("#category").trigger("change");

    </script>
 <script src={{url("js/pdfpreview.js")}}>  </script>

@endsection
