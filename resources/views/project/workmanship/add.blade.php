@extends('backend.layouts.app')
@section('title')
    Population and Household Details
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Population and Household Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Household Detail</li>
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
                        
                        $permission = helperPermissionLink(url('project/workmanship/create'), url('project/workmanship'));
                        
                        $allowEdit = $permission['isEdit'];
                        
                        $allowDelete = $permission['isDelete'];
                        
                        $allowAdd = $permission['isAdd'];
                        ?>
                        @if (auth()->user()->user_group_id == 2 && count($projects) >= 1)
                            <?php $allowAdd = 0; ?>
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/workmanship', 'autocomplete' => 'off', 'role' => 'form']) !!}

                            <h4 style="margin-bottom: 45px; margin-left:350px;"><b>Population and Household Details (Survey,
                                    Base, Design) Year</b></h4>
                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)

                                    <div
                                        class="form-group col-md-4 {{ $errors->has('project.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project[project_id]', $projects->pluck('name', 'id'), Request::get('project.project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Survey Year</th>
                                            <th>Base Year</th>
                                            <th>Design Year</th>
                                        </tr>

                                        <tr>
                                            <td>
                                                {!! Form::number('project[survey_year]', null, ['class' => 'form-control', 'placeholder' => 'Survey Year']) !!}
                                                {!! $errors->first('project.survey_year', '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::number('project[base_year]', null, ['class' => 'form-control', 'placeholder' => 'Base Year']) !!}
                                                {!! $errors->first('project.base_year', '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! $errors->first('project.aff_high_income', '<span class="text-danger">:message</span>') !!}
                                                {!! Form::number('project[aff_high_income]', null, ['class' => 'form-control', 'placeholder' => 'Design Year']) !!}</td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <label>HouseHold Number</label>
                                                {!! Form::number('project[survey_total_household]', null, ['class' => 'form-control', 'placeholder' => 'Household Number']) !!}
                                                {!! $errors->first('project.survey_total_household', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <label>HouseHold Number</label>
                                                {!! Form::number('project[base_total_household]', null, ['class' => 'form-control', 'placeholder' => 'Household Number']) !!}
                                                {!! $errors->first('project.base_total_household', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <label>HouseHold Number</label>
                                                {!! Form::number('project[design_total_household]', null, ['class' => 'form-control', 'placeholder' => 'Household Number']) !!}
                                                {!! $errors->first('project.design_total_household', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Population</label>
                                                {!! Form::number('project[survey_total_population]', null, ['class' => 'form-control', 'placeholder' => 'Population']) !!}
                                                {!! $errors->first('project.survey_total_population', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <label>Population</label>
                                                {!! Form::number('project[base_total_population]', null, ['class' => 'form-control', 'placeholder' => 'Population']) !!}
                                                {!! $errors->first('project.base_total_population', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <label>Population</label>
                                                {!! Form::number('project[design_total_population]', null, ['class' => 'form-control', 'placeholder' => 'Population']) !!}

                                                {!! $errors->first('project.design_total_population', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Family Size</label>
                                                {!! Form::text('project[survey_family_size]', null, ['class' => 'form-control', 'placeholder' => 'Family Size']) !!}
                                                {!! $errors->first('project.survey_family_size', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Affordability of
                                    HouseHold for UWSSP services</b></h4>

                            <div class="row">
                                <div
                                    class="form-group col-md-3 {{ $errors->has('project.aff_high_income') ? 'has-error' : '' }}">
                                    <label>High Income</label>
                                    {!! Form::text('project[aff_high_income]', null, ['class' => 'form-control', 'placeholder' => 'High income']) !!}
                                    {!! $errors->first('project.aff_high_income', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-3 {{ $errors->has('project.aff_avg_income') ? 'has-error' : '' }}">
                                    <label>Average Income</label>
                                    {!! Form::text('project[aff_avg_income]', null, ['class' => 'form-control', 'placeholder' => 'Average income']) !!}
                                    {!! $errors->first('project.aff_avg_income', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-3 {{ $errors->has('project.aff_low_income') ? 'has-error' : '' }}">
                                    <label>Low Income</label>
                                    {!! Form::text('project[aff_low_income]', null, ['class' => 'form-control', 'placeholder' => 'Low income']) !!}
                                    {!! $errors->first('project.aff_low_income', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div
                                    class="form-group col-md-3 {{ $errors->has('project.aff_bpl_income') ? 'has-error' : '' }}">
                                    <label>BPL</label>
                                    {!! Form::text('project[aff_bpl_income]', null, ['class' => 'form-control', 'placeholder' => 'BPL']) !!}
                                    {!! $errors->first('project.aff_bpl_income', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>




                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/workmanship') }}" class="btn btn-danger">cancel</a>

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
