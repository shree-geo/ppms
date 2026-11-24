@extends('backend.layouts.app')
@section('title')
    Projects Environment
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Environment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Environment</li>
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
                        $permission = helperPermissionLink(url('project/environment_detail/create'), url('project/environment_detail'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/environment_detail', 'autocomplete' => 'off',
                            'role' => 'form', 'files'=>'true','enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <h3 class="col-md-12">
                                    <p style="text-align: center;font-size: 18px;">
                                        <strong>Government of Nepal's Standard</strong>
                                    </p>
                                </h3>
                                <table class="table table-striped table-bordered table-hover table-responsive  ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>TOR Approval</th>
                                            <td class="{{ $errors->has('gon_tor_approval') ? 'has-error' : '' }}">
                                                {{ Form::text('gon_tor_approval', null, ['class' => 'form-control']) }}
                                                {!! $errors->first('gon_tor_approval', '<span
                                                    class="text-danger">:message</span>') !!}


                                            </td>
                                            <td class="{{ $errors->has('gon_tor_approval_date') ? 'has-error' : '' }}">
                                                {{ Form::text('gon_tor_approval_date', null, ['class' => 'form-control datepicker']) }}
                                                {!! $errors->first('gon_tor_approval_date', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <input type="file" class="" id="images_1" name="gon_tor_approval_file" onchange="preview_images(1);" /><br/>
                                                <span class="help-block text-danger" > Only jpg, jpeg, png and pdf files are supported</span>

                                                      <div class="row mb-4" id="image_preview_1" style="width:100%;"></div>
                                                      {!! $errors->first('gon_tor_approval_file', '<span
                                                      class="text-danger">:message</span>') !!}
                                             </td>
                                        </tr>
                                        <tr>
                                            <th>IIE Approval</th>
                                            <td class="{{ $errors->has('gon_approval_iee') ? 'has-error' : '' }}">
                                                {{ Form::text('gon_approval_iee', null, ['class' => 'form-control']) }}
                                                {!! $errors->first('gon_approval_iee', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td class="{{ $errors->has('gon_approval_iee_date') ? 'has-error' : '' }}">
                                                {{ Form::text('gon_approval_iee_date', null, ['class' => 'form-control datepicker']) }}
                                                {!! $errors->first('gon_approval_iee_date', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <input type="file" class="" id="images_2" name="gon_iee_file" onchange="preview_images(2);" /><br/>
                                                <span class="help-block text-danger" > Only jpg, jpeg, png and pdf files are supported</span>

                                                 <div class="row" id="image_preview_2">
                                                    {!! $errors->first('gon_iee_file', '<span
                                                    class="text-danger">:message</span>') !!}
                                             </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>

                            <div class="row">
                                <h3 class="col-md-12">
                                    <p style="text-align: center;font-size: 18px;">
                                        <strong>ADB's Standard</strong>
                                    </p>
                                </h3>
                                <table class="table table-striped table-bordered table-hover table-responsive ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>file</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Approval by ADB</th>
                                            <td class="{{ $errors->has('adb_final_approval') ? 'has-error' : '' }}">
                                                {{ Form::text('adb_final_approval', null, ['class' => 'form-control']) }}
                                                {!! $errors->first('adb_final_approval', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td class="{{ $errors->has('adb_final_approval_date') ? 'has-error' : '' }}">
                                                {{ Form::text('adb_final_approval_date', null, ['class' => 'form-control datepicker']) }}
                                                {!! $errors->first('adb_final_approval_date', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                <input type="file" class="" id="images_3" name="adb_approval_file" onchange="preview_images(3);" /><br/>
                                                <span class="help-block text-danger" > Only jpg, jpeg, png and pdf files are supported</span>

                                                 <div class="row" id="image_preview_3">
                                                    {!! $errors->first('adb_approval_file', '<span
                                                    class="text-danger">:message</span>') !!}
                                             </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>Report Disclosed</th>
                                            <td class="{{ $errors->has('adb_report_disclosed') ? 'has-error' : '' }}">
                                                {{ Form::text('adb_report_disclosed', null, ['class' => 'form-control']) }}
                                                {!! $errors->first('adb_report_disclosed', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                            <td class="{{ $errors->has('adb_report_disclosed_date') ? 'has-error' : '' }}">
                                                {{ Form::text('adb_report_disclosed_date', null, ['class' => 'form-control datepicker']) }}
                                                {!! $errors->first('adb_report_disclosed_date', '<span
                                                    class="text-danger">:message</span>') !!}
                                            </td>
                                        </tr>
                                       
                                    </tbody>

                                </table>

                            </div>
                            <div class="row">
                                <h3 class="col-md-12">
                                    <p style="text-align: center;font-size: 18px;">
                                        <strong>EMP Monitoring Indicator </strong>
                                    </p>
                                </h3>
                                <table class="table table-striped table-bordered table-hover table-responsive ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>SS-EMP Prepared & Approved </th>
                                            <td class="{{ $errors->has('emp_ssemp_prepared') ? 'has-error' : '' }}">
                                                {{ Form::radio('emp_ssemp_prepared', 'y', null, ['class' => 'flat-red']) }} Yes
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('emp_ssemp_prepared', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('emp_ssemp_prepared', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Apoint of EHS Focal person (Contractor)</th>
                                            <td class="{{ $errors->has('focal_person') ? 'has-error' : '' }}">
                                                {{ Form::radio('focal_person', 'y', null, ['class' => 'flat-red']) }} Yes
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('focal_person', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('focal_person', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>
                            <div class="row">
                                <h3 class="col-md-12">
                                    <p style="text-align: center;font-size: 18px;">
                                        <strong>Safeguard Monitoring Indicators</strong>
                                    </p>
                                </h3>
                                <table class="table table-striped table-bordered table-hover table-responsive ">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Status</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Compliance With Statutory Clearances </th>
                                            <td class="{{ $errors->has('safe_statutory_clearance') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_statutory_clearance', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_statutory_clearance', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_statutory_clearance', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Environmental Clearance (EC), IEE approved</th>
                                            <td class="{{ $errors->has('safe_envi_clearance') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_envi_clearance', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_envi_clearance', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('safe_envi_clearance', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Site location clearance</th>
                                            <td class="{{ $errors->has('safe_site_clearance') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_site_clearance', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_site_clearance', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('safe_site_clearance', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Tree-cutting permit</th>
                                            <td class="{{ $errors->has('safe_tree_cutting') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_tree_cutting', 'y', null, ['class' => 'flat-red']) }} Yes
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_tree_cutting', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('safe_tree_cutting', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>No Objection Certificate/Letter for work from concern authority </th>
                                            <td class="{{ $errors->has('safe_no_objection') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_no_objection', 'y', null, ['class' => 'flat-red']) }} Yes
                                                &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_no_objection', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('safe_no_objection', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Permit/Consent to Construct (or equivalent)</th>
                                            <td class="{{ $errors->has('safe_construct_permit') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_construct_permit', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_construct_permit', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_construct_permit', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Permit/Consent to Operate (or equivalent)</th>
                                            <td class="{{ $errors->has('safe_operate_permit') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_operate_permit', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_operate_permit', 'n', null, ['class' => 'flat-red']) }} No
                                                {!! $errors->first('safe_operate_permit', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Road-cutting permit</th>
                                            <td class="{{ $errors->has('safe_road_cutting_permit') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_road_cutting_permit', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_road_cutting_permit', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_road_cutting_permit', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Utilities shifting permit</th>
                                            <td
                                                class="{{ $errors->has('safe_utility_shifting_permit') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_utility_shifting_permit', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_utility_shifting_permit', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_utility_shifting_permit', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>

                                        </tr>
                                        <tr>
                                            <th>Covid Response Plan</th>
                                            <td
                                                class="{{ $errors->has('safe_covid_reponse') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_covid_reponse', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_covid_reponse', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_covid_reponse', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>MoU With Hospital</th>
                                            <td
                                                class="{{ $errors->has('safe_mou') ? 'has-error' : '' }}">
                                                {{ Form::radio('safe_mou', 'y', null, ['class' => 'flat-red']) }}
                                                Yes &nbsp;&nbsp;&nbsp;
                                                {{ Form::radio('safe_mou', 'n', null, ['class' => 'flat-red']) }}
                                                No
                                                {!! $errors->first('safe_mou', '<span
                                                    class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                <input type="file" class="" id="images_4" name="safe_mou_file" onchange="preview_images(4);" /><br/>
                                                <span class="help-block text-danger" > Only jpg, jpeg, png and pdf files are supported</span>

                                                 <div class="row" id="image_preview_4">
                                                    {!! $errors->first('safe_mou_file', '<span
                                                    class="text-danger">:message</span>') !!}
                                             </td>
                                        </tr>

                                    </tbody>

                                </table>

                            </div>


                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/environment_detail') }}" class="btn btn-danger">cancel</a>

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
       function preview_images(id) {
           var div_id= 'images_'+id;
            var total_file = document.getElementById(div_id).files.length;

            for (var i = 0; i < total_file; i++) {
                if(event.target.files[i].type=='application/pdf'){
                    $('#image_preview_'+id).append("<div class='col-md-2'><embed src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive' title=''  style='height:140px; width:140px;'></div>");

                }else{

                $('#image_preview_'+id).append("<div class='col-md-2'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "' style='width: 100px;height: 100px;' width='100' height='100'></div>");
                }
            }
        }
    </script>
  @endsection  