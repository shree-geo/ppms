@extends('backend.layouts.app')
@section('title')
    Projects Members
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Members</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Members</li>
                            <li class="breadcrumb-item active">{{ trans('app.edit') }}</li>
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
                        <h3 class="card-title">{{ trans('app.edit') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/member/create'), url('project/member'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)

                            {!! Form::model($edits, ['method' => 'put', 'route' => ['member.update', $edits->id], 'enctype'
                            => 'multipart/form-data']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Project<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif


                                <div class="form-group col-md-4 {{ $errors->has('samiti_year') ? 'has-error' : '' }}">
                                    <label>Samiti Year<label class="text-danger"> *</label>
                                    </label>
                                    {!! Form::number('samiti_year', null, ['class' => 'form-control', 'placeholder' =>
                                    'year']) !!}
                                    {!! $errors->first('samiti_year', '<span class="text-danger">:message</span>') !!}

                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-3 {{ $errors->has('member_name') ? 'has-error' : '' }}">
                                    <label>Member Name
                                        <label class="text-danger"> *</label>
                                    </label>
                                    {!! Form::text('member_name', null, ['class' => 'form-control', 'placeholder' =>
                                    'Name']) !!}
                                    {!! $errors->first('member_name', '<span class="text-danger">:message</span>') !!}

                                    <!-- /.input group -->
                                </div>


                                <div class="form-group col-md-3 {{ $errors->has('position_id') ? 'has-error' : '' }}">
                                    <label>Position<label class="text-danger">*</label></label>
                                    {{ Form::select('position_id', $positions, Request::get('position_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'position_id', 'placeholder' => 'Select Position']) }}
                                    {!! $errors->first('position_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('member_cast_id') ? 'has-error' : '' }}">
                                    <label>Casts<label class="text-danger">*</label></label>
                                    {{ Form::select('member_cast_id', $casts, Request::get('member_cast_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'member_cast_id', 'placeholder' => 'Select Position']) }}
                                    {!! $errors->first('member_cast_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                               
                                <div class="form-group col-md-3 {{ $errors->has('member_gender') ? 'has-error' : '' }}">
                                    <label>Gender <label class="text-danger"> *</label></label>
                                    <select id="member_gender" name="member_gender" class="form-control select2">
                                        <option value="" selected>Select Gender</option>
                                        <option value="male" {{ $edits->member_gender == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ $edits->member_gender == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="other" {{ $edits->member_gender == 'other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    {!! $errors->first('member_gender', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('excluded_group') ? 'has-error' : '' }}">
                                    <label>Is excluded ?</label> &nbsp;&nbsp;
                                    <input type="checkbox" name="excluded_group" value="1" {{(isset($edits['excluded_group']) && $edits['excluded_group'] == 1) ? 'checked' : null }}>

                                    {!! $errors->first('excluded_group', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>

                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/member') }}" class="btn btn-danger">cancel</a>

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
