@extends('backend.layouts.app')
@section('title')
    Projects
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Details</li>
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
                        {{-- <h3 class="card-title">{{trans('app.edit')}}</h3> --}}
                        <?php
                        $permission = helperPermissionLink(url('project/details/create'), url('project/details'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                        <nav class="nav nav-tabs tabul">
                            <a class="nav-item nav-link tabs active" href="#introduction" data-toggle="tab"
                                id="main"><b>Main</b></a>
                                <a class="nav-item nav-link tabs" href="#baseline" id="detailbaseline"><b>Baseline</b></a>
                                <a class="nav-item nav-link tabs" href="#oba_contract" id="obaContract"><b>Oba Contract Details</b></a>
                                @if(Request::old('project.sector')!=null)
                                <a class="nav-item nav-link tabs" href="#details" id="detail"
                                style="display: {{ Request::old('project.sector') == 'water_supply' ? 'block' : 'none' }}"><b>Details</b></a>
                            <a class="nav-item nav-link tabs" href="#source" id="detailsource" style="display: {{ Request::old('project.sector') == 'water_supply' ? 'block' : 'none' }}"><b>Source</b></a>
                            <a class="nav-item nav-link tabs" href="#reservoir" id="detailreservoir"
                                style="display: {{ Request::old('project.sector') == 'water_supply' ? 'block' : 'none' }}"><b>Reservoir</b></a>
                                @else
                            <a class="nav-item nav-link tabs" href="#details" id="detail"
                                style="display: {{ $edits['project']->sector == 'water_supply' ? 'block' : 'none' }}"><b>Details</b></a>
                            <a class="nav-item nav-link tabs" href="#source" id="detailsource" style="display: {{ $edits['project']->sector == 'water_supply' ? 'block' : 'none' }}"><b>Source</b></a>
                            <a class="nav-item nav-link tabs" href="#reservoir" id="detailreservoir"
                                style="display: {{ $edits['project']->sector == 'water_supply' ? 'block' : 'none' }}"><b>Reservoir</b></a>
                                @endif

                        </nav>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)
                            {!! Form::model($edits, ['method' => 'put', 'route' => ['details.update', $edits['project']->id], 'autocomplete' => 'off', 'id'=>'regForm','role' => 'form' ,'enctype' => 'multipart/form-data', 'file' => true]) !!}
                            <div class="tab-content">
                                <div class="tab-pane in active" id="introduction">
                                    <div class="row">
                                        @if(auth()->user()->user_group_id!=3)
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.region_id') ? 'has-error' : '' }}">
                                            <label>Region <label class="text-danger"> *</label></label>
                                            {{ Form::select('project[region_id]', $project_regions->pluck('region_name', 'id'), Request::get('project[region_id]'), ['class' => 'form-control select2', 'id' => 'region_id', 'placeholder' => 'Select Region Name']) }}
                                            {!! $errors->first('project.region_id', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        @endif
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.name') ? 'has-error' : '' }}">
                                            <label>Sub Project Name <label class="text-danger"> *</label></label>
                                            {{ Form::text('project[name]', null, ['class' => 'form-control', 'placeholder' => ' Sub Project Name']) }}
                                            {!! $errors->first('project.name', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.sector') ? 'has-error' : '' }}">
                                            <label>Sector <label class="text-danger"> *</label></label>
                                            @if (Request::old('project.sector') != null)
                                            <select id="sector" name="project[sector]" class="form-control select2"
                                            id="sector">
                                            <option value="" selected>Select Project Sector</option>
                                            <option value="water_supply"
                                                {{ Request::old('project.sector') == 'water_supply' ? 'selected' : '' }}>Water
                                                Supply</option>
                                            <option value="sanitation"
                                                {{ Request::old('project.sector') == 'sanitation' ? 'selected' : '' }}>Sanitation
                                            </option>
                                            <option value="drainage"
                                                {{ Request::old('project.sector') == 'drainage' ? 'selected' : '' }}>Drainage
                                            </option>
                                        </select>
                                            @else
                                            <select id="sector" name="project[sector]" class="form-control select2"
                                                id="sector">
                                                <option value="" selected>Select Project Sector</option>
                                                <option value="water_supply"
                                                    {{ $edits['project']->sector == 'water_supply' ? 'selected' : '' }}>Water
                                                    Supply</option>
                                                <option value="sanitation"
                                                    {{ $edits['project']->sector == 'sanitation' ? 'selected' : '' }}>Sanitation
                                                </option>
                                                <option value="drainage"
                                                    {{ $edits['project']->sector == 'drainage' ? 'selected' : '' }}>Drainage
                                                </option>
                                            </select>
                                            @endif
                                            {!! $errors->first('project.sector', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.package_no') ? 'has-error' : '' }}">
                                            <label>Package Number</label><label class="text-danger"> *</label>
                                            {!! Form::text('project[package_no]', null, ['class' => 'form-control', 'placeholder' => 'Package Number']) !!}
                                            {!! $errors->first('project.package_no', '<span class="text-danger">:message</span>') !!}

                                        </div>

                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.proj_loan_no') ? 'has-error' : '' }}">
                                            <label>Loan Number</label>
                                            {!! Form::text('project[proj_loan_no]', isset($pmoDetails) ? $pmoDetails['loan_num'] : '', ['class' => 'form-control', 'placeholder' => 'Loan number', 'readonly']) !!}
                                            {!! $errors->first('project.proj_loan_no', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.project_no') ? 'has-error' : '' }}">
                                            <label>Project Number</label>
                                            {{ Form::text('project[project_no]', isset($pmoDetails) ? $pmoDetails['project_num'] : '', ['class' => 'form-control', 'placeholder' => 'Project Number', 'readonly']) }}
                                            {!! $errors->first('project.project_no', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.reporting_fy_id') ? 'has-error' : '' }}">
                                            <label>Reporting Fiscal Year <label class="text-danger"> *</label></label>
                                            {{ Form::select('project[reporting_fy_id]', $fiscal_years->pluck('fy_name', 'id'), Request::get('project[reporting_fy_id]'), ['class' => 'form-control select2', 'id' => 'reporting_fy_id', 'placeholder' => 'Select Fiscal Year']) }}
                                            {!! $errors->first('project.reporting_fy_id', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('project.proj_start_fy_id') ? 'has-error' : '' }}">
                                            <label>Project Start Fiscal Year <label class="text-danger"> *</label></label>
                                            {{ Form::select('project[proj_start_fy_id]', $fiscal_years->pluck('fy_name', 'id'), Request::get('project[proj_start_fy_id]'), ['class' => 'form-control select2', 'id' => 'proj_start_fy_id', 'placeholder' => 'Select Fiscal Year']) }}
                                            {!! $errors->first('project.proj_start_fy_id', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div
                                            class="form-group col-md-4 {{ $errors->has('details.project_type_id') ? 'has-error' : '' }}">
                                            <label>Project Type <label class="text-danger"> *</label></label>
                                            @if ($edits['project']['sector'] != null || ($edits['details'] != null && $edits['details']['project_type_id'] != null))

                                                {{ Form::select('details[project_type_id]', $projectTypeName->pluck('type_name', 'id'), Request::get('project_type_id'), ['class' => 'form-control select2', 'id' => 'type_name', 'placeholder' => 'Select Project Type Name', 'style' => 'width:100%;']) }}
                                            @else
                                                <select name='details[project_type_id]' id="type_name"
                                                    class="form-control select2">
                                                    <option value="">Select Project Type Name</option>
                                                </select>
                                                @endif
                                                {!! $errors->first('details.project_type_id', '<span class="text-danger">:message</span>') !!}

                                        </div>

                                    </div>
                             
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered" id="dynamicTable">
                                                <tr>
                                                    <th>District</th>
                                                    <th>Local Government</th>
                                                    <th>Ward</th>
                                                    <th>Action</th>
                                                </tr>
                                                @if (Request::old('address') != null)
                                                    @foreach (Request::old('address') as $key => $address)
                                                        <tr>
                                                            <td
                                                                class="{{ $errors->has("address . $key . district_id") ? 'has-error' : '' }}">
                                                                {{ Form::select('address[' . $key . '][district_id]', $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => 'district_id_' . $key, 'placeholder' => 'Select District', 'required', 'onchange= changeMuni()', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . district_id", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            <td
                                                                class="{{ $errors->has("address . $key . muni_id") ? 'has-error' : '' }}">
                                                                {{ Form::select('address[' . $key . '][muni_id]', $municipality->pluck('muni_name', 'id'), Request::get('muni_id'), ['class' => 'form-control select2', 'id' => 'muni_id_' . $key, 'placeholder' => 'Select Nepal Government', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . muni_id", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            <td
                                                                class="{{ $errors->has("address . $key . ward_no") ? 'has-error' : '' }}">
                                                                {{ Form::text('address[' . $key . '][ward_no]', null, ['class' => 'form-control', 'placeholder' => 'Ward Number', 'required', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . ward_no", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            @if ($loop->first)
                                                                {{-- <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button> --}}
                                                                <td> <button type="button" name="add" id="add1"
                                                                        class="btn btn-sm btn-success"><i
                                                                            class="fas fa-plus"></i></button></td>
                                                            @else
                                                                <td><button type="button"
                                                                        class="btn btn-sm btn-danger remove-tr"><i
                                                                            class="fas fa-trash"></i></button></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    @foreach ($edits['address'] as $key => $address)
                                                        <tr>
                                                            <td
                                                                class="{{ $errors->has("address . $key . district_id") ? 'has-error' : '' }}">
                                                                {{ Form::select('address[' . $key . '][district_id]', $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => 'district_id_' . $key, 'placeholder' => 'Select District', 'required', 'onchange= changeMuni()', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . district_id", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            <td
                                                                class="{{ $errors->has("address . $key . muni_id") ? 'has-error' : '' }}">
                                                                {{ Form::select('address[' . $key . '][muni_id]', $municipality->pluck('muni_name', 'id'), Request::get('muni_id'), ['class' => 'form-control select2', 'id' => 'muni_id_' . $key, 'placeholder' => 'Select Nepal Government', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . muni_id", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            <td
                                                                class="{{ $errors->has("address . $key . ward_no") ? 'has-error' : '' }}">
                                                                {{ Form::text('address[' . $key . '][ward_no]', null, ['class' => 'form-control', 'placeholder' => 'Ward Number', 'required', 'style' => 'width:100%;']) }}
                                                                {!! $errors->first("address . $key . ward_no", '<span class="text-danger">:message</span>') !!}
                                                            </td>
                                                            @if ($loop->first)
                                                                {{-- <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button> --}}
                                                                <td> <button type="button" name="add" id="add1"
                                                                        class="btn btn-sm btn-success"><i
                                                                            class="fas fa-plus"></i></button></td>
                                                            @else
                                                                <td><button type="button"
                                                                        class="btn btn-sm btn-danger remove-tr"><i
                                                                            class="fas fa-trash"></i></button></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach

                                                @endif

                                            </table>
                                        </div>
                                    </div>

                                    <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Project Related
                                            Dates</b></h4>
                                    <div class="row">
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.mou_signing_date') ? 'has-error' : '' }}>
                                            <label>MOU signing Date</label>
                                            {{ Form::text('project[mou_signing_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'MOU signing Date']) }}
                                            {!! $errors->first('project.mou_signing_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.financial_aggre_date') ? 'has-error' : '' }}>
                                            <label>Financial Agreement Date</label>
                                            {{ Form::text('project[financial_aggre_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Financial Agreement Date']) }}
                                            {!! $errors->first('project.financial_aggre_date', '<span class="text-danger">:message</span>') !!}

                                        </div>



                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.ded_pre_to_comm_date') ? 'has-error' : '' }}>
                                            <label>DED Presentation to Communities Date</label>
                                            {{ Form::text('project[ded_pre_to_comm_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'DED Presentation to Communities Date']) }}
                                            {!! $errors->first('project.ded_pre_to_comm_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.bid_docu_date') ? 'has-error' : '' }}>
                                            <label>Finalisation of Bid Documents Date</label>
                                            {{ Form::text('project[bid_docu_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Finalisation of Bid Documents Date']) }}
                                            {!! $errors->first('project.bid_docu_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.ded_approv_date') ? 'has-error' : '' }}>
                                            <label>DED Approved Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[ded_approv_date]', null, ['class' => 'form-control', 'placeholder' => 'DED Approved Date']) }}
                                            {!! $errors->first('project.ded_approv_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.ifb_pub_date') ? 'has-error' : '' }}>
                                            <label>IFB publication Date</label>
                                            {{ Form::text('project[ifb_pub_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'IFB publication Date']) }}
                                            {!! $errors->first('project.ifb_pub_date', '<span class="text-danger">:message</span>') !!}

                                        </div>


                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.submission_date') ? 'has-error' : '' }}>
                                            <label>Submission Date</label>
                                            {{ Form::text('project[submission_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Submission Date']) }}
                                            {!! $errors->first('project.submission_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.aprro_contractor') ? 'has-error' : '' }}>
                                            <label>Approved Contractor Name</label>
                                            {{ Form::text('project[aprro_contractor]', null, ['class' => 'form-control', 'placeholder' => 'Approved Contractor Name']) }}
                                            {!! $errors->first('project.aprro_contractor', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.contract_amount') ? 'has-error' : '' }}>
                                            <label>Contract Amount</label> <label class="text-danger"> *</label>
                                            {{ Form::text('project[contract_amount]', null, ['class' => 'form-control', 'placeholder' => 'Contract Amount', 'min' => '1']) }}
                                            {!! $errors->first('project.contract_amount', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.estimated_amount') ? 'has-error' : '' }}>
                                            <label>Estimated Amount</label>
                                            {{ Form::text('project[estimated_amount]', null, ['class' => 'form-control', 'placeholder' => 'Estimated Amount', 'min' => '1']) }}
                                            {!! $errors->first('project.estimated_amount', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.contract_signing_date') ? 'has-error' : '' }}>
                                            <label>Contract Signing Date</label>
                                            {{ Form::text('project[contract_signing_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Contract Signing Date']) }}
                                            {!! $errors->first('project.contract_signing_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.completion_date_stage1') ? 'has-error' : '' }}>
                                            <label>Completion Date, Stage 1</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[completion_date_stage1]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Completion Date, Stage 1']) }}
                                            {!! $errors->first('project.completion_date_stage1', '<span  class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.completion_date_stage2') ? 'has-error' : '' }}>
                                            <label>Completion Date (O & M), Stage 2</label><label class="text-danger">
                                                *</label>
                                            {{ Form::text('project[completion_date_stage2]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Completion Date (O & M), Stage 2']) }}
                                            {!! $errors->first('project.completion_date_stage2', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.dlp_date') ? 'has-error' : '' }}>
                                            <label>Defect Liability Period (DLP) Date</label>
                                            {{ Form::text('project[dlp_date]', null, ['class' => 'form-control', 'placeholder' => 'DLP Date']) }}
                                            {!! $errors->first('project.dlp_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.contract_completion_date') ? 'has-error' : '' }}>
                                            <label>Contract Complition Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[contract_completion_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Contract Complition Date']) }}
                                            {!! $errors->first('project.contract_completion_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.pbg_issued_date') ? 'has-error' : '' }}>
                                            <label>PBG Issued Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[pbg_issued_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'PBG Issued Date']) }}
                                            {!! $errors->first('project.pbg_issued_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.pbg_expiry_date') ? 'has-error' : '' }}>
                                            <label>PBG Expiry Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[pbg_expiry_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'PBG Expiry Date']) }}
                                            {!! $errors->first('project.pbg_expiry_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.apg_issued_date') ? 'has-error' : '' }}>
                                            <label>APG Issued Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[apg_issued_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'APG Issued Date']) }}
                                            {!! $errors->first('project.apg_issued_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                        <div class="form-group col-md-4"
                                            {{ $errors->has('project.apg_expiry_date') ? 'has-error' : '' }}>
                                            <label>APG Expiry Date</label><label class="text-danger"> *</label>
                                            {{ Form::text('project[apg_expiry_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'APG Expiry Date']) }}
                                            {!! $errors->first('project.apg_expiry_date', '<span class="text-danger">:message</span>') !!}

                                        </div>
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <div class="tab-pane fade " id="details">
                                    @include('project.layouts.details')
                                </div>
                                <div class="tab-pane fade " id="baseline">
                                    @include('project.layouts.baseline')
                                </div>
                                <div class="tab-pane fade " id="source">
                                    @include('project.layouts.source')
                                </div>
                                <div class="tab-pane fade " id="reservoir">
                                    @include('project.layouts.reservoir')
                                </div>
                                <div class="tab-pane fade " id="oba_contract">
                                    @include('project.layouts.obaContract')
                                </div>
                                <div class="card-footer">
                                    {{-- <button type="submit" class="btn btn-primary">Save</button> --}}
                                    <a href="{{ url('/project/details') }}" class="btn btn-danger">Cancel</a>
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-secondary btnPrevious" id="prevBtn"
                                            onclick="nextPrev(-1)">Previous</button>
                                        <button type="submit" name="buttonId" value="mainForm" class="btn btn-secondary" id="submitBtn">Submit</button>
                                        <button type="button" class="btn btn-primary btnNext" id="nextBtn"
                                            onclick="nextPrev(1)">Next</button>
                                    </div>


                                </div>
                                {!! Form::close() !!}
                                {{-- </div> --}}

                            </div>
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
    @include('project.layouts.dynamic')
    <script src={{url("js/pdfpreview.js")}}>  </script>
    

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
          
        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tabs");

            let last_visible_id;
            for(let i =0; i<x.length ; i++){
                if(x[i].style.display =='block' || x[i].style.display ==''){
                    last_visible_id = x[i].id;
                }
            }

            if (currentTab >= x.length) {
                return false;
            }

            if(last_visible_id == x[n].id){
                $('#nextBtn').removeClass('btn-primary').addClass('btn-success');
                document.getElementById("nextBtn").innerHTML = 'Submit';
                document.getElementById("nextBtn").addEventListener("click", function(){
                    document.getElementById("regForm").submit();
                });
            } else {
                $('#nextBtn').removeClass('btn-success').addClass('btn-primary');
                    document.getElementById("nextBtn").innerHTML = "Next";
            }

            if(x[n].style.display =='none'){
                showTab(n+1);
            } else {
                x[n].style.display = "block";
                var id = x[n].id;
                $('#' + id).attr('data-toggle', 'tab').trigger('click');

                if (n == 0) {
                    document.getElementById("prevBtn").style.display = "none";
                 
                    document.getElementById("submitBtn").style.display = "inline";
                } else {
                    document.getElementById("prevBtn").style.display = "inline";
                    document.getElementById("submitBtn").style.display = "none";
                }
            }

        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tabs");

            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

    </script>



@endsection
