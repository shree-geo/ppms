@extends('backend.layouts.app')
@section('title')
    Projects Safeguard
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Safeguard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Safeguard</li>
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
                        $permission = helperPermissionLink(url('project/safeguard_detail/create'), url('project/safeguard_detail'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)

                            {!! Form::model($edits,['method' => 'put', 'route' => ['safeguard_detail.update',$edits->id], 'autocomplete' => 'off',
                            'role' => 'form']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>')!!}
                                    </div>
                                @endif

                            </div>
                           
                            <div class="row">
                              <table class="table table-bordered table-responsive col-md-12">
                                  <thead>
                                      <th>Activity</th>
                                      <th>Status</th>
                                      <th>Date</th>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <th>DDR Report Submission</th>
                                          <td class="{{ $errors->has('ddr_status') ? 'has-error' : '' }}">
                                            {{Form::text('ddr_status',null,['class'=>'form-control','placeholder'=>'status'])}}
                                            {!! $errors->first('ddr_status', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                          <td class="{{ $errors->has('ddr_date') ? 'has-error' : '' }}" >
                                            {{Form::text('ddr_date',null,['class'=>'form-control','placeholder'=>'Date'])}}
                                            {!! $errors->first('ddr_date', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                      </tr>
                                      <tr>
                                          <th>IR</th>
                                          <td class="{{ $errors->has('ir_status') ? 'has-error' : '' }}">
                                            {{Form::text('ir_status',null,['class'=>'form-control','placeholder'=>'status'])}}
                                            {!! $errors->first('ir_status', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                          <td class="{{ $errors->has('ir_date') ? 'has-error' : '' }}">
                                            {{Form::text('ir_date',null,['class'=>'form-control datepicker','placeholder'=>'Date'])}}
                                            {!! $errors->first('ir_date', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                      </tr>
                                      <tr>
                                          <th>IPP</th>
                                          <td class="{{ $errors->has('ipp_status') ? 'has-error' : '' }}">
                                            {{Form::text('ipp_status',null,['class'=>'form-control','placeholder'=>'status'])}}
                                            {!! $errors->first('ipp_status', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                          <td class="{{ $errors->has('ipp_date') ? 'has-error' : '' }}">
                                            {{Form::text('ipp_date',null,['class'=>'form-control datepicker','placeholder'=>'Date'])}}
                                            {!! $errors->first('ipp_date', '<span class="text-danger">:message</span>')!!}
                                        </td>
                                      </tr>
                                  </tbody>
                              </table>
                                

                            </div>
                          
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/safeguard_detail') }}" class="btn btn-danger">Cancel</a>

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

