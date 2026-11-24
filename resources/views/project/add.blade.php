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
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Details</li>
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
                        $permission = helperPermissionLink(url('project/details/create'), url('project/details'));

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

                            {!! Form::open(['method' => 'post', 'url' => '/project/details', 'autocomplete' => 'off', 'role'
                            => 'form']) !!}

                            <div class="row">
                                @if(auth()->user()->user_group_id!=3)
                                <div class="form-group col-md-4 {{ $errors->has('region_id') ? 'has-error' : '' }}">
                                    <label>Region <label class="text-danger"> *</label></label>
                                    {{ Form::select('region_id', $project_regions->pluck('region_name', 'id'), Request::get('region_id'), ['class' => 'form-control select2', 'id' => 'region_id', 'placeholder' => 'Select Region Name']) }}
                                    {!! $errors->first('region_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                                @endif
                                <div class="form-group col-md-4 {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label>Sub Project Name <label class="text-danger"> *</label></label>
                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => ' Sub Project Name']) }}
                                    {!! $errors->first('name', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('sector') ? 'has-error' : '' }}">
                                    <label>Sector <label class="text-danger"> *</label></label>
                                    <select id="sector" name="sector" class="form-control select2">
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
                                    {!! $errors->first('sector', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4 {{ $errors->has('package_no') ? 'has-error' : '' }}">
                                    <label>Package Number</label><label class="text-danger"> *</label>
                                    {!! Form::text('package_no', null, ['class' => 'form-control', 'placeholder' => 'Package Number']) !!}
                                    {!! $errors->first('package_no', '<span class="text-danger">:message</span>') !!}

                                </div>

                                <div class="form-group col-md-4">
                                    <label> Loan Number </label>
                                    {!! Form::text('proj_loan_no', isset($pmoDetails)?$pmoDetails['loan_num']:'', ['class' => 'form-control', 'placeholder' =>
                                    'Project Loan number', 'readonly']) !!}

                                </div>
                                <div class="form-group col-md-4">
                                    <label>Project Number</label>
                                    {{ Form::text('project_no', isset($pmoDetails)?$pmoDetails['project_num']:'', ['class' => 'form-control', 'placeholder' => 'Project Number', 'readonly']) }}

                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-4 {{ $errors->has('reporting_fy_id') ? 'has-error' : '' }}">
                                    <label>Reporting Fiscal Year <label class="text-danger"> *</label></label>
                                    {{ Form::select('reporting_fy_id', $fiscal_years->pluck('fy_name', 'id'), Request::get('reporting_fy_id'), ['class' => 'form-control select2', 'id' => 'reporting_fy_id', 'placeholder' => 'Select Fiscal Year']) }}
                                    {!! $errors->first('reporting_fy_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('proj_start_fy_id') ? 'has-error' : '' }}">
                                    <label>Project Start Fiscal Year <label class="text-danger"> *</label></label>
                                    {{ Form::select('proj_start_fy_id', $fiscal_years->pluck('fy_name', 'id'), Request::get('proj_start_fy_id'), ['class' => 'form-control select2', 'id' => 'proj_start_fy_id', 'placeholder' => 'Select Fiscal Year']) }}
                                    {!! $errors->first('proj_start_fy_id', '<span class="text-danger">:message</span>') !!}

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
                                        @if(Request::old('address')!=null)
                                        @foreach(Request::old('address') as $key=>$address)
                                          <tr>
                                            <td class="{{ ($errors->has("address.$key.district_id"))?'has-error':'' }}">
                                                {{ Form::select("address[$key][district_id]", $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => "district_id_$key", 'placeholder' => 'Select District', 'required','onchange= changeMuni()' ,'style'=>'width:100%;']) }}
                                                {!! $errors->first("address.$key.district_id", '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td class="{{ ($errors->has("address.$key.muni_id"))?'has-error':'' }}">
                                                 <select name="address[{{$key}}][muni_id]" id="muni_id_{{ $key }}" class="form-control select2" style="width: 100%;">
                                                    <option value=""> Select Local Government</option>
                                                </select>
                                                {!! $errors->first("address.$key.muni_id", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td class="{{ ($errors->has("address.$key.ward_no"))?'has-error':'' }}">
                                                {{ Form::text("address[$key][ward_no]", null, ['class' => 'form-control', 'placeholder' => 'Ward Number','required','style'=>'width:100%;']) }}
                                                {!! $errors->first("address.$key.ward_no", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                             @if($loop->first)
                                            {{-- <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button> --}}
                                          <td> <button type="button" name="add" id="add1" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button></td>
                                            @else
                                            <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                                          @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="{{ ($errors->has('address.0.district_id'))?'has-error':'' }}">
                                                {{ Form::select('address[0][district_id]', $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => 'district_id_0', 'placeholder' => 'Select District', 'required','onchange= changeMuni()' ,'style'=>'width:100%;']) }}
                                                {!! $errors->first('address.0.district_id', '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td class="{{ ($errors->has('address.0.muni_id'))?'has-error':'' }}">
                                                 <select name="address[0][muni_id]" id="muni_id_0" class="form-control select2" style="width: 100%;">
                                                    <option value=""> Select Local Government</option>
                                                </select>
                                                {!! $errors->first('address.0.muni_id', '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td class="{{ ($errors->has('address.0.ward_no'))?'has-error':'' }}">
                                                {{ Form::text('address[0][ward_no]', null, ['class' => 'form-control', 'placeholder' => 'Ward Number','required','style'=>'width:100%;']) }}
                                                {!! $errors->first('address.0.ward_no', '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td><button type="button" name="add" id="add1" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button></td>
                                        </tr>
                                        @endif

                                    </table>
                                </div>
                            </div>

                            <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Project Related Dates</b></h4>
                            <div class="row">
                                <div class="form-group col-md-4" {{ $errors->has('mou_signing_date') ? 'has-error' : '' }}>
                                    <label>MOU signing Date</label>
                                    {{ Form::text('mou_signing_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'MOU signing Date']) }}
                                    {!! $errors->first('mou_signing_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('financial_aggre_date') ? 'has-error' : '' }}>
                                    <label>Financial Agreement Date</label>
                                    {{ Form::text('financial_aggre_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Financial Agreement Date']) }}
                                    {!! $errors->first('financial_aggre_date', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                
                 

                                <div class="form-group col-md-4"
                                    {{ $errors->has('ded_pre_to_comm_date') ? 'has-error' : '' }}>
                                    <label>DED Presentation to Communities Date</label>
                                    {{ Form::text('ded_pre_to_comm_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'DED Presentation to Communities Date']) }}
                                    {!! $errors->first('ded_pre_to_comm_date', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('bid_docu_date') ? 'has-error' : '' }}>
                                    <label>Finalisation of Bid Documents Date</label>
                                    {{ Form::text('bid_docu_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Finalisation of Bid Documents Date']) }}
                                    {!! $errors->first('bid_docu_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('ded_approv_date') ? 'has-error' : '' }}>
                                    <label>DED Approved Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('ded_approv_date', null, ['class' => 'form-control ', 'placeholder' => 'DED Approved Date']) }}
                                    {!! $errors->first('ded_approv_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('ifb_pub_date') ? 'has-error' : '' }}>
                                    <label>IFB publication Date</label>
                                    {{ Form::text('ifb_pub_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'IFB publication Date']) }}
                                    {!! $errors->first('ifb_pub_date', '<span class="text-danger">:message</span>') !!}

                                </div>
               

                                <div class="form-group col-md-4" {{ $errors->has('submission_date') ? 'has-error' : '' }}>
                                    <label>Submission Date</label>
                                    {{ Form::text('submission_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Submission Date']) }}
                                    {!! $errors->first('submission_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('aprro_contractor') ? 'has-error' : '' }}>
                                    <label>Approved Contractor Name</label>
                                    {{ Form::text('aprro_contractor', null, ['class' => 'form-control', 'placeholder' => 'Approved Contractor Name']) }}
                                    {!! $errors->first('aprro_contractor', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('contract_amount') ? 'has-error' : '' }}>
                                    <label>Contract Amount</label><label class="text-danger"> *</label>
                                    {{ Form::text('contract_amount', null, ['class' => 'form-control', 'placeholder' => 'Contract Amount', 'min'=>'1']) }}
                                    {!! $errors->first('contract_amount', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('estimated_amount') ? 'has-error' : '' }}>
                                    <label>Estimated Amount</label>
                                    {{ Form::text('estimated_amount', null, ['class' => 'form-control', 'placeholder' => 'Estimated Amount', 'min'=>'1']) }}
                                    {!! $errors->first('estimated_amount', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('contract_signing_date') ? 'has-error' : '' }}>
                                    <label>Contract Signing Date</label>
                                    {{ Form::text('contract_signing_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Contract Signing Date']) }}
                                    {!! $errors->first('contract_signing_date', '<span class="text-danger">:message</span>')
                                    !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('completion_date_stage1') ? 'has-error' : '' }}>
                                    <label>Completion Date, Stage 1</label><label class="text-danger"> *</label>
                                    {{ Form::text('completion_date_stage1', null, ['class' => 'form-control datepicker', 'placeholder' => 'Completion Date, Stage 1']) }}
                                    {!! $errors->first('completion_date_stage1', '<span
                                        class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4"
                                    {{ $errors->has('completion_date_stage2') ? 'has-error' : '' }}>
                                    <label>Completion Date (O & M), Stage 2</label><label class="text-danger"> *</label>
                                    {{ Form::text('completion_date_stage2', null, ['class' => 'form-control datepicker', 'placeholder' => 'Completion Date (O & M), Stage 2']) }}
                                    {!! $errors->first('completion_date_stage2', '<span
                                        class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('dlp_date') ? 'has-error' : '' }}>
                                    <label>Defect Liability Period (DLP) Date</label>
                                    {{ Form::text('dlp_date', null, ['class' => 'form-control', 'placeholder' => 'DLP Date']) }}
                                    {!! $errors->first('dlp_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('contract_completion_date') ? 'has-error' : '' }}>
                                    <label>Contract Complition Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('contract_completion_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Contract Complition Date']) }}
                                    {!! $errors->first('contract_completion_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('pbg_issued_date') ? 'has-error' : '' }}>
                                    <label>PBG Issued Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('pbg_issued_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'PBG Issued Date']) }}
                                    {!! $errors->first('pbg_issued_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('pbg_expiry_date') ? 'has-error' : '' }}>
                                    <label>PBG Expiry Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('pbg_expiry_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'PBG Expiry Date']) }}
                                    {!! $errors->first('pbg_expiry_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('apg_issued_date') ? 'has-error' : '' }}>
                                    <label>APG Issued Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('apg_issued_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'APG Issued Date']) }}
                                    {!! $errors->first('apg_issued_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4" {{ $errors->has('apg_expiry_date') ? 'has-error' : '' }}>
                                    <label>APG Expiry Date</label><label class="text-danger"> *</label>
                                    {{ Form::text('apg_expiry_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'APG Expiry Date']) }}
                                    {!! $errors->first('apg_expiry_date', '<span class="text-danger">:message</span>') !!}

                                </div>
                            </div>

                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/details') }}" class="btn btn-danger">cancel</a>

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
 <script type="text/javascript">
   var municipality= <?php echo json_encode($municipalities); ?>;
   var address= <?php echo json_encode(Request::old('address')); ?>;

   if(address!=null){
      for(var key in address){
            var collection = municipality[address[key]['district_id']];

                    for(var key1 in address){
                    for (var key in collection) {
                    var select='';

                        if(collection[key]['id']==address[key1]['muni_id']){
                         var select='selected';
                    }
                    $('#muni_id_'+key1).append(`<option value="${collection[key]['id']}" ${select} >${collection[key]['muni_name']}</option>`);
                    }
            }
      }
   }

    function changeMuni(){
        var dis_id= event.target.id.split('-');
        var index=dis_id[1].split('_');
         var m_district = $('#'+dis_id[1]).val();
            $('#muni_id_'+index[2]).html('');
            var collection = municipality[m_district];
            $('#muni_id_'+index[2]).append(`<option value="0" selected disabled>Select Local Government</option>`);
            for (var key in collection) {
                $('#muni_id_'+index[2]).append(
                    `<option value="${collection[key]['id']}">${collection[key]['muni_name']}</option>`);
            }
    }
  
        var row_count =address!=null?address.length:0;
        $('#add1').click(function() {
            ++row_count;
            $("#dynamicTable").append(`<tr>
                <td  class="{{ $errors->has('address.${row_count}.district_id') ? 'has-error' : '' }}">
                {{ Form::select('address[${row_count}][district_id]', $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => 'district_id_${row_count}', 'placeholder' => 'Select District','onchange=changeMuni()','style'=>'width:100%;']) }}
                   {!! $errors->first('address[${row_count}][district_id]', '<span class="text-danger">:message</span>') !!}
                </td>
                <td class="{{ $errors->has('address.${row_count}.muni_id') ? 'has-error' : '' }}">
                 <select name="address[${row_count}][muni_id]" id="muni_id_${row_count}" class="form-control select2" style="width: 100%;">
                     <option value="">Select Local Government</option>
                     </select>
                     {!! $errors->first('address[${row_count}][muni_id]', '<span class="text-danger">:message</span>') !!}
                 </td>
                <td class="{{ $errors->has('address.${row_count}.ward_no') ? 'has-error' : '' }}">
                    {{ Form::text('address[${row_count}][ward_no]', null, ['class' => 'form-control', 'placeholder' => 'Ward Number','style'=>'width:100%;']) }}
                {!! $errors->first('address[${row_count}][ward_no]', '<span class="text-danger">:message</span>') !!}
                </td>
              <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td></tr>`);
        $('.select2').select2();
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    </script>


@endsection
