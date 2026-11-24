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
                            <li class="breadcrumb-item">Projects</li>
                            <li class="breadcrumb-item active">Show</li>
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
                        {{-- <h3 class="card-title">{{ trans('app.edit') }}</h3> --}}

                        <nav class="nav nav-tabs">
                            <a class="nav-item nav-link active" href="#introduction" data-toggle="tab"><b>Details</b></a>
                            <a class="nav-item nav-link" href="#baseline" data-toggle="tab"><b>Baseline</b></a>
                            <a class="nav-item nav-link" href="#socio" data-toggle="tab"><b>SocioEconomic</b></a>
                            <a class="nav-item nav-link" href="#gesi" data-toggle="tab"><b>Gesi Action Plan</b></a>
                            <a class="nav-item nav-link" href="#obas" data-toggle="tab"><b>OBA Details</b></a>
                            <a class="nav-item nav-link" href="#samiti" data-toggle="tab"><b>Samiti Members</b></a>
                            <a class="nav-item nav-link" href="#monitoring" data-toggle="tab"><b>Monitoring</b></a>
                            <a class="nav-item nav-link" href="#vo" data-toggle="tab"><b>Vo Details</b></a>
                            <a class="nav-item nav-link" href="#eot" data-toggle="tab"><b>Eot Details</b></a>
                            <a class="nav-item nav-link" href="#worker" data-toggle="tab"><b>Worker Details</b></a>
                            <a class="nav-item nav-link" href="#quality" data-toggle="tab"><b>Quality Control Test</b></a>
                            <a class="nav-item nav-link" href="#grievance" data-toggle="tab"><b>Grievance Details</b></a>
                            <a class="nav-item nav-link" href="#committe" data-toggle="tab"><b>Grievance Committe</b></a>
                            <a class="nav-item nav-link" href="#safeguard" data-toggle="tab"><b>Social Safeguard</b></a>
                            @if ($project->sector == 'water_supply')
                                <a class="nav-item nav-link" href="#projectdetail" data-toggle="tab"><b>Project
                                        Details</b></a>
                                <a class="nav-item nav-link" href="#sources" data-toggle="tab"><b>Water Sources</b></a>
                                <a class="nav-item nav-link" href="#reservoirs" data-toggle="tab"><b>Water
                                        Reservoirs</b></a>
                            @endif
                            <a class="nav-item nav-link" href="#environment" data-toggle="tab"><b>Environment</b></a>
                            <a class="nav-item nav-link" href="#structure_progress" data-toggle="tab"><b>Structure Progress</b></a>


                        </nav>
                    </div>
                    <div class="card-body">

                        <div class="tab-content">
                            <div class="tab-pane in active" id="introduction">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <p class="title-size">
                                            <strong>Project Detail</strong>
                                        </p>
                                    </div>
                                    <div class="col-md-12" style="text-align: left">
                                        <table class="table table-border table-striped table-hover">
                                            <tr>
                                                <th> Region</th>
                                                <td>{{ $project->region->region_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $project->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Package Number</th>
                                                <td>{{ $project->package_no }}</td>
                                            </tr>
                                            <tr>
                                                <th>Sector</th>
                                                <td>{{ $project->sector == 'water_supply' ? 'Water Supply' : ($project->sector == 'sanitation' ? 'Sanitation' : 'Drainage') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>
                                                    @foreach ($project->address as $dis)
                                                        District:<b>{{ $dis->district->english_name }}</b><br>
                                                        Municipality:
                                                        <b>{{ $dis->municipality ? $dis->municipality->muni_name : '' }}</b><br>
                                                        Ward Number:<b>{{ $dis->ward_no }}</b><br>
                                                        <hr>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Reporting Fiscal Year</th>
                                                <td>{{ $project->reportingFY->fy_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Project Start Fiscal Year</th>
                                                <td>{{ $project->projectStartFY->fy_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Project Completion Date</th>
                                                <td>{{ $project->latest_eot}}</td>
                                            </tr>
                                            <tr>
                                                <th>Contract Amount</th>
                                                <td>{{ $project->latest_revised_contract_amount}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <p class="title-size">
                                            <strong>Project Related Dates</strong>
                                        </p>
                                    </div>

                                    <div class="col-md-6" style="text-align: left">
                                        <table class="table table-border table-striped table-hover">
                                            <tr>
                                                <th>MOU signing Date</th>
                                                <td>{{ $project->mou_signing_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Financial Agreement Date</th>
                                                <td>{{ $project->financial_aggre_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Original Contract Amount</th>
                                                <td>{{ $project->contract_amount }}</td>
                                            </tr>
                                            <tr>
                                                <th>Estimated Amount</th>
                                                <td>{{ $project->estimated_amount }}</td>
                                            </tr>

                                            <tr>
                                                <th>DED Presentation to Communities Date</th>
                                                <td>{{ $project->ded_pre_to_comm_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Finalisation of Bid Documents Date</th>
                                                <td>{{ $project->bid_docu_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>DED Approved Date</th>
                                                <td>{{ $project->ded_approv_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>IFB publication Date</th>
                                                <td>{{ $project->ifb_pub_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Submission Date</th>
                                                <td>{{ $project->submission_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Approved Contractor Name</th>
                                                <td>{{ $project->aprro_contractor }}</td>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="col-md-6" style="text-align: left">
                                        <table class="table table-border table-striped table-hover">

                                            <tr>
                                                <th>Contract Signing Date</th>
                                                <td>{{ $project->contract_signing_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Completion Date, Stage 1</th>
                                                <td>{{ $project->completion_date_stage1 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Completion Date (O & M), Stage 2</th>
                                                <td>{{ $project->completion_date_stage2 }}</td>
                                            </tr>
                                            <tr>
                                                <th>Defect Liability Period (DLP) Date</th>
                                                <td>{{ $project->dlp_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Original Contract Completion Date</th>
                                                <td>{{ $project->contract_completion_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>PBG Issued Date</th>
                                                <td>{{ $project->pbg_issued_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>PBG Expiry Date</th>
                                                <td>{{ $project->pbg_expiry_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>APG Issued Date</th>
                                                <td>{{ $project->apg_issued_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>APG Expiry Date</th>
                                                <td>{{ $project->apg_expiry_date }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="baseline">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Present Status</th>
                                                <th>From socioeconomic study</th>
                                                <th>After completion</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Private connection</th>
                                                <td> {{ isset($baseline['before']['private_conn']) ? $baseline['before']['private_conn'] : '' }}
                                                </td>

                                                <td> {{ isset($baseline['after']['private_conn']) ? $baseline['after']['private_conn'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Public tap stand</th>
                                                <td>{{ isset($baseline['before']['public_tap']) ? $baseline['before']['public_tap'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['public_tap']) ? $baseline['after']['public_tap'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Source </th>
                                                <td>{{ isset($baseline['before']['source']) ? $baseline['before']['source'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['source']) ? $baseline['after']['source'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Average time spent to fetch water, min</th>
                                                <td>{{ isset($baseline['before']['average_time']) ? $baseline['before']['average_time'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['average_time']) ? $baseline['after']['average_time'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Per capita availability, lpcd</th>
                                                <td>{{ isset($baseline['before']['per_capita']) ? $baseline['before']['per_capita'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['per_capita']) ? $baseline['after']['per_capita'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Quality</th>
                                                <td>{{ isset($baseline['before']['quality']) ? $baseline['before']['quality'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['quality']) ? $baseline['after']['quality'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Public Toilets</th>
                                                <td>{{ isset($baseline['before']['public_toilet']) ? $baseline['before']['public_toilet'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['public_toilet']) ? $baseline['after']['public_toilet'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Water seal cistern flush</th>
                                                <td>{{ isset($baseline['before']['water_seal']) ? $baseline['before']['water_seal'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['water_seal']) ? $baseline['after']['water_seal'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>VIP</th>
                                                <td>{{ isset($baseline['before']['vip']) ? $baseline['before']['vip'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['vip']) ? $baseline['after']['vip'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Pit Latrine</th>
                                                <td>{{ isset($baseline['before']['pit_latrine']) ? $baseline['before']['pit_latrine'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['pit_latrine']) ? $baseline['after']['pit_latrine'] : '' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>None</th>
                                                <td>{{ isset($baseline['before']['none']) ? $baseline['before']['none'] : '' }}
                                                </td>
                                                <td>{{ isset($baseline['after']['none']) ? $baseline['after']['none'] : '' }}
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="socio">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong>Beneficiary Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Beneficiary (Population)</th>
                                                <th>Dalit</th>
                                                <th>Janjati</th>
                                                <th>Brahmin/Chhetri</th>
                                                <th>Muslim</th>
                                                <th>Others</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($beneficiary) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($beneficiary as $ben)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td>{{ $ben->beneficiary_sector == 'water_supply' ? 'Water Supply' : ($ben->beneficiary_sector == 'sanitation' ? 'Sanitation' : 'Drainage') }}
                                                        </td>
                                                        <td>
                                                            <b>HouseHold:</b>{{ $ben->dalit_hh ? $ben->dalit_hh : 0 }}<br>
                                                            <b>Female:</b>{{ $ben->dalit_f ? $ben->dalit_f : 0 }}<br>
                                                            <b>Male:</b>{{ $ben->dalit_m ? $ben->dalit_m : 0 }}
                                                        </td>
                                                        <td>
                                                            <b>HouseHold:</b>{{ $ben->janjati_hh ? $ben->janjati_hh : 0 }}<br>
                                                            <b>Female:</b>{{ $ben->janjati_f ? $ben->janjati_f : 0 }}<br>
                                                            <b>Male:</b>{{ $ben->janjati_m ? $ben->janjati_m : 0 }}
                                                        </td>
                                                        <td>
                                                            <b>HouseHold:</b>{{ $ben->bramin_hh ? $ben->bramin_hh : 0 }}<br>
                                                            <b>Female:</b>{{ $ben->bramin_f ? $ben->bramin_f : 0 }}<br>
                                                            <b>Male:</b>{{ $ben->bramin_m ? $ben->bramin_m : 0 }}
                                                        </td>
                                                        <td>
                                                            <b>HouseHold:</b>{{ $ben->muslim_hh ? $ben->muslim_hh : 0 }}<br>
                                                            <b>Female:</b>{{ $ben->muslim_f ? $ben->muslim_f : 0 }}<br>
                                                            <b>Male:</b>{{ $ben->muslim_m ? $ben->muslim_m : 0 }}
                                                        </td>
                                                        <td>
                                                            <b>HouseHold:</b>{{ $ben->other_hh ? $ben->other_hh : 0 }}<br>
                                                            <b>Female:</b>{{ $ben->other_f ? $ben->other_f : 0 }}<br>
                                                            <b>Male:</b>{{ $ben->other_m ? $ben->other_m : 0 }}
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <p class="title-size">
                                            <strong>Population and Household Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <tr>
                                            <th></th>
                                            <th>Survey Year</th>
                                            <th>Base Year</th>
                                            <th>Design Year</th>
                                        </tr>

                                        <tr>
                                            <th>Year</th>
                                            <td>{{ $project->survey_year }}</td>
                                            <td>{{ $project->base_year }}</td>
                                            <td>{{ $project->design_year }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total HouseHold</th>

                                            <td>{{ $project->survey_total_household }}</td>
                                            <td>{{ $project->base_total_household }}</td>
                                            <td>{{ $project->design_total_household }}</td>

                                        </tr>
                                        <tr>
                                            <th>Total Population</th>

                                            <td>{{ $project->survey_total_population }}</td>
                                            <td>{{ $project->base_total_population }}</td>
                                            <td>{{ $project->design_total_population }}</td>

                                        </tr>
                                        <tr>
                                            <th>Family Size</th>

                                            <td>{{ $project->survey_family_size }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>

                                    </table>
                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <p class="title-size">
                                            <strong>Institutional Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Institution Name</th>
                                                <th>Institution Type</th>
                                                <th>Male</th>
                                                <th>Female</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($institution) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($institution as $insti)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td>{{ $insti->institution_name }}</td>
                                                        <td>{{ $insti->institution_type == 'school' ? 'School' : ($insti->institution_type == 'healthpost' ? 'Health Post' : 'Others') }}
                                                        </td>
                                                        <td>{{ $insti->total_male }}</td>
                                                        <td>{{ $insti->total_female }}</td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <p class="title-size">
                                            <strong>Affordability of Population for UWSSP services</strong>
                                        </p>
                                    </div>
                                    <div class="col-md-6" style="text-align: left">
                                        <table class="table table-striped table-bordered table-hover table-responsive">
                                            <tr>
                                                <th> High Income</th>
                                                <td>{{ $project->aff_high_income }}</td>
                                            </tr>
                                            <tr>
                                                <th> Average Income</th>
                                                <td>{{ $project->aff_avg_income }}</td>
                                            </tr>
                                            <tr>
                                                <th>Low Income</th>
                                                <td>{{ $project->aff_low_income }}</td>
                                            </tr>
                                            <tr>
                                                <th>BPL</th>
                                                <td>{{ $project->aff_bpl_income }}</td>
                                            </tr>

                                        </table>
                                    </div>



                                </div>
                            </div>
                            <div class="tab-pane fade" id="gesi">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Program Type</th>
                                                <th>Program Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Bramin</th>
                                                <th>Dalit</th>
                                                <th>Janajati</th>
                                                <th>Muslim</th>
                                                <th>Others</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($programs) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($programs as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td>{{ $val->programType->type_name }}</td>
                                                        <td>{{ $val->program_title }}</td>
                                                        <td>{{ $val->start_date }}</td>
                                                        <td>{{ $val->end_date }}</td>
                                                        <td><strong>Male:</strong> {{ $val->bramin_m }}<br>
                                                            <strong>Female:</strong> {{ $val->bramin_f }}
                                                        </td>
                                                        <td><strong>Male:</strong> {{ $val->dalit_m }}<br>
                                                            <strong>Female:</strong> {{ $val->dalit_f }}
                                                        </td>
                                                        <td><strong>Male:</strong> {{ $val->janjati_m }}<br>
                                                            <strong>Female:</strong> {{ $val->janjati_f }}
                                                        </td>
                                                        <td><strong>Male:</strong> {{ $val->muslim_m }}<br>
                                                            <strong>Female:</strong> {{ $val->muslim_f }}
                                                        </td>
                                                        <td><strong>Male:</strong> {{ $val->others_m }}<br>
                                                            <strong>Female:</strong> {{ $val->others_f }}
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>



                            <div class="tab-pane fade" id="obas">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Oba Type</th>
                                                <th>District</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th style="font-weight: bold;">Status</th>
                                                <th style="font-weight: bold;">Owner Name</th>
                                                <th style="font-weight: bold;">Cast</th>
                                                <th style="font-weight: bold;">Family Size</th>
                                                <th style="font-weight: bold;">Male</th>
                                                <th style="font-weight: bold;">Female</th>
                                                <th colspan="2" style="font-weight: bold;">HouseHold Women?</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($obas) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($obas as $val)
                                                    <?php $rowcount = count($val->details); ?>
                                                    @foreach ($val->details as $key1 => $detail)
                                                        <tr>
                                                            @if (!$key1)
                                                                <td rowspan="{{ $rowcount }}">
                                                                    {{ $i }}
                                                                </td>
                                                                <td rowspan="{{ $rowcount }}">
                                                                    {{ $val->obaTypes->oba_type_name }}</td>
                                                                <td rowspan="{{ $rowcount }}">
                                                                    {{ $val->district->english_name }}</td>
                                                                <td rowspan="{{ $rowcount }}">{{ $val->year }}
                                                                </td>
                                                                <td rowspan="{{ $rowcount }}">
                                                                    {{ $month[$val->months] }}</td>
                                                                <td rowspan="{{ $rowcount }}">
                                                                    {{ ucfirst($val->status) }}</span>
                                                                </td>
                                                                <?php $i++; ?>
                                                            @endif
                                                            <td>{{ $detail->owner_name }}</td>
                                                            <td>{{ $casts[$detail->casts_id] }} </td>
                                                            <td>{{ $detail->family_size }}</td>
                                                            <td>{{ $detail->male_count }}</td>
                                                            <td>{{ $detail->female_count }} </td>
                                                            <td colspan="2">
                                                                {{ $detail->househead_women == 1 ? 'Yes' : 'No' }}</td>
                                                        </tr>

                                                    @endforeach
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="12" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="samiti">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Member Name</th>
                                                <th>Position</th>
                                                <th>Cast</th>
                                                <th>Samiti Year</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($members) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($members as $member)
                                                    <tr>
                                                        <th scope=row>{{ $i }}</th>
                                                        <td>{{ $member->member_name }}</td>
                                                        <td>{{ $member->position_id == '1' ? 'Chairperson' : ($member->position_id == '2' ? 'Vice Chairperson' : ($member->position_id == '3' ? 'Secretary' : ($member->position_id == '4' ? 'Treasurer' : ($member->position_id == '5' ? 'Member' : '')))) }}
                                                        </td>
                                                        <td>{{ $member->member_cast_id == '1' ? 'Brahmin/Chhetry' : ($member->member_cast_id == '2' ? 'Janajati' : ($member->member_cast_id == '3' ? 'Dalit' : ($member->member_cast_id == '4' ? 'Others' : ($member->member_cast_id == '5' ? 'Muslim' : '')))) }}
                                                        </td>
                                                        <td>{{ $member->samiti_year }}</td>
                                                        <td>{{ $member->member_gender == 'male' ? 'Male' : 'Female' }}
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="6" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="monitoring">
                                <div class="row">
                                    @if (count($monitorings) > 0)
                                        @foreach ($monitorings as $monitoring)
                                            <table class="table table-striped table-bordered table-hover table-responsive">
                                                <tr>
                                                    <th>Date</th>
                                                    <td>{{ $monitoring->date }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Type</th>
                                                    <td>{{ $monitoring->type }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Lead By</th>
                                                    <td>{{ $monitoring->leadBy }}</td>

                                                </tr>
                                                <tr>
                                                    <th>Number of Participants</th>
                                                    <td>{{ $monitoring->no_of_participant }}</td>

                                                </tr>
                                                <tr>
                                                    <th>Participants</th>
                                                    <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->participant }}</div></td>

                                                </tr> 
                                                 <tr>
                                                    <th>Files</th>
                                                    <td>
                                                        @if($monitoring->file!=null)
                                                         <?php $extension = explode('.', $monitoring->file); ?>
                                                        @if ($extension[1] == 'pdf')
                                                        <a href="{{ asset('storage/uploads/monitoring/' . $monitoring->file) }}"
                                                            target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                      @else
                                                      <a href="{{ asset('storage/uploads/monitoring/' . $monitoring->file) }}"
                                                        target="_blank"> <img src="{{ asset('storage/uploads/monitoring/' . $monitoring->file) }}" style="height:100px;" ></a>
                                                        @endif
                                                        @else
                                                            No File available
                                                         @endif
                                                    </td>

                                                </tr>

                                            </table>
                                            <div class="col-md-12" >
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
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->social_observation }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->social_suggestion }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->social_improvement }}</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <label>Technical</label>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->technical_observation }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->technical_suggestion }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->technical_improvement }}</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <label>Environmental</label>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->env_observation }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->env_suggestion }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->env_improvement }}</div></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>
                                                                <label>GESI</label>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->gesi_observation }}</div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->gesi_suggestion }} </div></td>
                                                            <td><div style=" word-wrap: break-word; white-space: normal;">{{ $monitoring->gesi_improvement }}</div></td>
                                                        </tr>
                                                    </tbody>
                
                                                </table>
                                                <hr style="border-top: 5px solid rgb(0 123 255);">
                                            </div>
                                            @endforeach
                                    @else
                                        <table class="table table-striped table-bordered table-hover table-responsive">
                                            <tr>
                                                <td class="text-center">No Data Found !!</td>
                                            </tr>
                                        </table>
                                    @endif

                                </div>
                            </div>

                            <div class="tab-pane fade" id="vo">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Vo Number</th>
                                                <th>Revised Contract Amount</th>
                                                <th>Revised Cost Estimated</th>
                                                <th>Variation Percentage</th>
                                                <th>Variation Amount</th>
                                                <th>Approved Date</th>
                                                <th>Approved By</th>
                                                <th>File</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vos) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($vos as $val)
                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <th>{{ $val->serial_no }}</th>
                                                        <td>{{ $val->revised_contract_amount }}</td>
                                                        <td>{{ $val->revised_cost_estimated }}</td>
                                                        <td>{{ $val->variation_per }}</td>
                                                        <td>{{ $val->variation_amount }}</td>
                                                        <td>{{ $val->approved_date }}</td>
                                                        <td>{{ $val->approved_by }}</td>
                                                        <td>
                                                            @if($val->file!=null)
                                                             <?php $extension = explode('.', $val->file); ?>
                                                            @if ($extension[1] == 'pdf')
                                                            <a href="{{ asset('storage/uploads/vo/' . $val->file) }}"
                                                                target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:80px;"></a>
                                                          @else
                                                          <a href="{{ asset('storage/uploads/vo/' . $val->file) }}"
                                                            target="_blank">  <img src="{{ asset('storage/uploads/vo/' . $val->file) }}" style="height:100px;" ></a>
                                                            @endif
                                                            @else
                                                                No File available
                                                             @endif
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="9" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="eot">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Eot Number</th>
                                                <th>Revised Stage1 Completion Date</th>
                                                <th>Revised Stage2 Completion Date</th>
                                                <th>Extended By</th>
                                                <th>Approved Date</th>
                                                <th>Approved By</th>
                                                <th>File</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($eots) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($eots as $val)
                                                    <tr>
                                                        <td>{{ $val->serial_no }}</td>
                                                        <td>{{ $val->revised_stage1_completion_date }}</td>
                                                        <td>{{ $val->revised_stage2_completion_date }}</td>
                                                        <td>{{ $val->extended_by }}</td>
                                                        <td>{{ $val->approved_date }}</td>
                                                        <td>{{ $val->approved_by }}</td>
                                                        <td>
                                                            @if($val->file!=null)
                                                             <?php $extension = explode('.', $val->file); ?>
                                                            @if ($extension[1] == 'pdf')
                                                            <a href="{{ asset('storage/uploads/eot/' . $val->file) }}"
                                                                target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:80px;"></a>
                                                          @else
                                                          <a href="{{ asset('storage/uploads/eot/' . $val->file) }}"
                                                            target="_blank"> <img src="{{ asset('storage/uploads/eot/' . $val->file) }}" style="height:100px;" ></a>
                                                            @endif
                                                            @else
                                                                No File available
                                                             @endif
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="worker">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong> Worker Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Dalit</th>
                                                <th>Janjati</th>
                                                <th>Brahmin/Chhetri</th>
                                                <th>Muslim</th>
                                                <th>Others</th>
                                                <th>Local</th>
                                                <th>Skill</th>
                                                <th>Unskill</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($workerDetails) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($workerDetails as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td>{{ $val->year }}</td>
                                                        <td>{{ $month[$val->month] }}</td>
                                                        <td><b>Female:</b>{{ $val->dalit_f ? $val->dalit_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->dalit_m ? $val->dalit_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->janjati_f ? $val->janjati_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->janjati_m ? $val->janjati_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->bramin_f ? $val->bramin_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->bramin_m ? $val->bramin_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->muslim_f ? $val->muslim_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->muslim_m ? $val->muslim_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->others_f ? $val->others_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->others_m ? $val->others_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->local_f ? $val->local_f : 0 }}<br>
                                                            <b>Male:</b>{{ $val->local_m ? $val->local_m : 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->skill_female ? $val->skill_female : 0 }}<br>
                                                            <b>Male:</b>{{ $val->skill_male? $val->skill_male: 0 }}
                                                        </td>
                                                        <td><b>Female:</b>{{ $val->unskill_female ? $val->unskill_female : 0 }}<br>
                                                            <b>Male:</b>{{ $val->unskill_male? $val->unskill_male: 0 }}
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="11" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="grievance">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong>Grievance Status</strong>
                                        </p>
                                    </div>
                                    <div class="col-md-12" style="overflow-x:auto;">
                                    <table id="example" class="table table-striped table-bordered table-hover table-responsive" >
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Grievance Issues</th>
                                                <th>Grievance Level</th>
                                                <th>Complain By</th>
                                                <th>Complain Date</th>
                                                <th>Affected Site/Location</th>
                                                <th>Action Taken to solve</th>
                                                <th>Current Status</th>
                                                <th>Remarks</th>
                                                <th>Files</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($grievanceDetails) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($grievanceDetails as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td><div style=" word-wrap: break-word; white-space: normal;">{{ $val->issue }}</div></td>
                                                        <td>{{($val->grievance_level=='first')?'First Level':(($val->grievance_level=='second')?'Second Level':'Third Level')}}</td>
                                                        <td>{{ $val->complain_by }}</td>
                                                        <td>{{ $val->complain_date }}</td>
                                                        <td>{{ $val->affected_site }}</td>
                                                        <td><div style=" word-wrap: break-word; white-space: normal;">{{ $val->action_taken }}</div></td>
                                                        <td>{{ $val->current_status }}</td>
                                                        <td><div style=" word-wrap: break-word; white-space: normal;">{{ $val->remarks }}</div></td>
                                                        <td>
                                                            @if($val->files!=null)
                                                            <?php $files = json_decode($val->files);  ?>
                                                            @foreach($files  as $file)
                                                             <?php $extension = explode('.', $file); ?>
                                                            @if ($extension[1] == 'pdf')
                                                            <a href="{{ asset('storage/uploads/grievance/file/' . $file) }}"
                                                                target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:80px;"></a>
                                                          @else
                                                          <a href="{{ asset('storage/uploads/grievance/file/' . $file) }}"
                                                          target="_blank"> <img src="{{ asset('storage/uploads/grievance/file/' . $file) }}" style="height:100px;" ></a>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                                No File available
                                                             @endif
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="10" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="committe">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong>First Level Grievance Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Name</th>
                                                <th>Designation </th>
                                                <th>Email </th>
                                                <th>Contact No. </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($grievanceCommitte) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($grievanceCommitte as $level_key => $grievance)
                                                    @if ($level_key == 'first')
                                                        @foreach ($grievance as $val)
                                                            <tr>
                                                                <td scope="row">{{ $i }}</td>
                                                                <td>{{ $val->name }}</td>
                                                                <td>{{ $val->designation }}</td>
                                                              
                                                                <td>{{ $val->email }}</td>
                                                                <td>{{ $val->contact_no }}</td>

                                                            </tr>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong>Second Level Grievance Details</strong>
                                        </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Name</th>
                                                <th>Designation </th>
                                                <th>Email </th>
                                                <th>Contact No. </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($grievanceCommitte) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($grievanceCommitte as $level_key => $grievance)
                                                    @if ($level_key == 'second')
                                                        @foreach ($grievance as $val)
                                                            <tr>
                                                                <td scope="row">{{ $i }}</td>
                                                                <td>{{ $val->name }}</td>
                                                                <td>{{ $val->designation}}
                                                                </td>
                                                                <td>{{ $val->email }}</td>
                                                                <td>{{ $val->contact_no }}</td>

                                                            </tr>
                                                            <?php $i++; ?>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="quality">
                                <div class="row">

                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>QC Type</th>
                                                <th>Code Followed</th>
                                                <th>Test</th>
                                                <th>Result</th>
                                                <th>Tested By</th>
                                                <th>File</th>
                                                <th>Remarks</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($qcTestDetails) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($qcTestDetails as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td>{{ $val->testType->test_name }}</td>
                                                        <td>{{ $val->followed_code }}</td>
                                                        <td>
                                                            <span><b>Date:</b></span> {{ $val->test_date }}<br>
                                                            <span><b>Address:</b></span>
                                                            {{ $val->test_location == 'site' ? 'Site' : 'Laboratory' }}<br>
                                                        </td>
                                                        <td>{{ $val->result == 'y' ? 'Yes' : 'No' }}</td>
                                                        <td>{{ $val->test_by }}</td>
                                                        <td>
                                                            @if($val->report_file!=null)
                                                            <?php $files = json_decode($val->report_file);  ?>
                                                            @foreach($files  as $file)
                                                             <?php $extension = explode('.', $file); ?>
                                                            @if ($extension[1] == 'pdf')
                                                            <a href="{{ asset('storage/uploads/qcTestReport/' . $file) }}"
                                                                target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:80px;"></a>
                                                          @else
                                                          <a href="{{ asset('storage/uploads/qcTestReport/' . $file) }}"
                                                          target="_blank"><img src="{{ asset('storage/uploads/qcTestReport/' . $file) }}" style="height:100px;" ></a>
                                                            @endif
                                                            @endforeach
                                                            @else
                                                                No File available
                                                             @endif
                                                        </td>
                                                        <td><div style=" word-wrap: break-word; white-space: normal;">{{ $val->remarks }}</div></td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="safeguard">
                                <div class="row">
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>DDR Report Submission </th>
                                                <th>IR </th>
                                                <th>IPP </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($safeguardDetails) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($safeguardDetails as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        <td><b>Status:</b> {{ $val->ddr_status }}<br>
                                                            <b>Date:</b> {{ $val->ddr_date }}
                                                        </td>
                                                        <td><b>Status:</b> {{ $val->ir_status }}<br>
                                                            <b>Date:</b> {{ $val->ir_date }}
                                                        </td>
                                                        <td><b>Status:</b> {{ $val->ipp_status }}<br>
                                                            <b>Date:</b> {{ $val->ipp_date }}
                                                        </td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                    <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Social Safeguard Indicator</strong>
                                        </p>
                                    </h3>
                                    <table class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Indicator Name </th>
                                                <th>Indicator Value </th>
                                                <th>File </th>
                                                <th>Remarks </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($safeguardIndicatorDetails) > 0)
                                                <?php $i = 1; ?>
                                                @foreach ($safeguardIndicatorDetails as $val)
                                                    <tr>
                                                        <td scope="row">{{ $i }}</td>
                                                        
                                                        <td>{{ $val->indicator_name }}</td>
                                                        <td>{{ $val->indicator_value }} </td>
                                                        <td>
                                                            @if($val->file!=null)
                                                           
                                                            <?php $files = json_decode($val->file);  ?>
                                        <div class="row">
                                            @foreach($files as $key=>$value)
                                            <?php $extension = explode('.', $value); ?>
                                            <div class="col-md-2 m-3" >
                                            
                                                @if ($extension[1] == 'pdf')
                                                
                                                
                                                <a href="{{asset('/storage/uploads/safeguardindicator/file/' . $value) }}" target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>&nbsp;
                                          @else
                                            
                                            
                                          <a href="{{asset('/storage/uploads/safeguardindicator/file/' . $value) }}" target="_blank"> <img src="{{asset('/storage/uploads/safeguardindicator/file/'. $value)}}" style="height:100px;"></a>
                                            </div>
                                            @endif
                                            @endforeach
                                            @endif
                                            
                                            </div>
                                                        </td>
                                                        <td><div style=" word-wrap: break-word; white-space: normal;">{{$val->remarks}}</div></td>

                                                    </tr>
                                                    <?php $i++; ?>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No records found</td>
                                                </tr>
                                            @endif

                                        </tbody>

                                    </table>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="projectdetail">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="title-size">
                                            <strong>Private Connection</strong>
                                        </p>
                                        <table class="table table-striped table-bordered table-hover table-responsive">
                                            <thead>
                                                <tr>

                                                    <th>Base Year</th>
                                                    <th>Design Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ isset($projectdetail->base_year_pvt_connection) ?$projectdetail->base_year_pvt_connection:'' }}</td>
                                                    <td> {{ isset($projectdetail->design_year_pvt_connection) ?$projectdetail->design_year_pvt_connection:'' }}</td>

                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="title-size">
                                            <strong>Water Demand</strong>
                                        </p>
                                        <table class="table table-striped table-bordered table-hover table-responsive">
                                            <thead>
                                                <tr>

                                                    <th>Base Year</th>
                                                    <th>Design Year</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ isset($projectdetail->base_year_water_demand) ? $projectdetail->base_year_water_demand :''}}</td>
                                                    <td> {{ isset($projectdetail->design_year_water_demand) ? $projectdetail->design_year_water_demand:'' }}</td>

                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="title-size">
                                            <strong>Treatment Unit</strong>
                                        </p>
                                        <table class="table table-striped table-bordered table-hover table-responsive">
                                            <thead>
                                                <tr>

                                                    <th>Water Discharge</th>
                                                    <th>Existing</th>
                                                    <th>Designed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ isset($projectdetail->treated_water_dicharge) ?$projectdetail->treated_water_dicharge:'' }}</td>
                                                    <td> {{ isset($projectdetail->existing_treatment_detail) ?$projectdetail->existing_treatment_detail:'' }}</td>
                                                    <td> {{ isset($projectdetail->proposed_treatment_detail) ?$projectdetail->proposed_treatment_detail:'' }}</td>


                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade" id="sources">                      
                                <div class="row">
                                    @if (count($projectsource)> 0)
                                    @foreach ($projectsource as $val)
                                    <div class="col-md-12 ">
                                        <div class="card"
                                            style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;">                                            
                                            <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                                                <div class="form-group col-md-3">
                    
                                                    <label> Source Name </label>
                                                   <input type="text" name="name" class="form-control" value={{$val->source_name}} readonly>
                                                  
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Source Type </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->source_type}} readonly >
                                          
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Source Location </label>
                                                   <input type="text" name="name" class="form-control" value={{$val->source_location}} readonly >

                                                   
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Source Latitude </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->source_lat}} readonly >
                                                   
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Source Longitude </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->source_lan}} readonly >
                                                 
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Proposed Intake </label>
                                                   <textarea name="text" class="form-control textarea1" readonly >{{$val->proposed_intake}}</textarea>
                                                   
                    
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Discharge</label>
                                                    <textarea name="text" class="form-control textarea1" readonly >{{$val->discharge}}</textarea>
                                           
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Remarks</label>
                                                    <textarea name="text" class="form-control textarea1" readonly>{{$val->remarks}}</textarea>                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @else
                                    <div class="col-md-12">
                                    <p class="text-center font-weight-bold">No records found</p>     
                                    </div>                              
                                @endif
                                    
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reservoirs">
                                <div class="row">
                                    @if (count($projectreservoir) > 0)
                                    @foreach ($projectreservoir as $val)
                                    <div class="col-md-12 ">
                                        <div class="card"
                                            style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;">                                            
                                            <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                                                <div class="form-group col-md-3">
                    
                                                    <label> Reservoir Name </label>
                                                   <input type="text" name="name" class="form-control" value={{$val->reservoir_name}} readonly>
                                                  
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Capacity </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->capacity}} readonly >
                                          
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Reservoir Location </label>
                                                   <input type="text" name="name" class="form-control" value={{$val->reservoir_location}} readonly >

                                                   
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Reservoir Latitude </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->reservoir_lat}} readonly >
                                                   
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Reservoir Longitude </label>
                                                    <input type="text" name="name" class="form-control" value={{$val->reservoir_lang}} readonly >
                                                 
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label> Reservoir Type </label>
                                                    <input type="text" name="name" class="form-control text-capitalize" value={{$val->reservoirs_type}} readonly >                                                                       
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                    @else
                                    <div class="col-md-12">
                                    <p class="text-center font-weight-bold">No records found</p>     
                                    </div>                              
                                @endif
                                </div>

                            </div>
                            <div class="tab-pane fade" id="environment">
                                @if(count($environment)>0)
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
                                                <td>{{$environment[0]->gon_tor_approval}}</td>
                                                <td>{{ $environment[0]->gon_tor_approval_date}}</td>
                                                <td>
                                                    @if($environment[0]->gon_tor_approval_file!=null)
                                                     <?php $extension = explode('.', $environment[0]->gon_tor_approval_file); ?>
                                                    @if ($extension[1] == 'pdf')
                                                    <a href="{{ asset('storage/uploads/environment/' . $environment[0]->gon_tor_approval_file) }}"
                                                        target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                  @else
                                                  <a href="{{ asset('storage/uploads/environment/' . $environment[0]->gon_tor_approval_file) }}"
                                                    target="_blank"> <img src="{{ asset('storage/uploads/environment/' . $environment[0]->gon_tor_approval_file) }}" style="height:100px;" ></a>
                                                    @endif
                                                    @else
                                                        No File available
                                                     @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>IIE Approval</th>
                                                <td>{{$environment[0]->gon_approval_iee}}</td>
                                                <td>{{$environment[0]->gon_approval_iee_date}}</td>
                                                <td>
                                                    @if($environment[0]->gon_iee_file!=null)
                                                     <?php $extension = explode('.', $environment[0]->gon_iee_file); ?>
                                                    @if ($extension[1] == 'pdf')
                                                    <a href="{{ asset('storage/uploads/environment/' . $environment[0]->gon_iee_file) }}"
                                                        target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                  @else
                                                  <a href="{{ asset('storage/uploads/environment/' . $environment[0]->gon_iee_file) }}"
                                                    target="_blank"> <img src="{{ asset('storage/uploads/environment/' . $environment[0]->gon_iee_file) }}" style="height:100px;" ></a>
                                                    @endif
                                                    @else
                                                        No File available
                                                     @endif
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
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Approval by ADB</th>
                                                <td>{{ $environment[0]->adb_final_approval}}</td>
                                                <td>{{ $environment[0]->adb_final_approval_date}}</td>
                                                <td>
                                                    @if($environment[0]->adb_approval_file!=null)
                                                     <?php $extension = explode('.', $environment[0]->adb_approval_file); ?>
                                                    @if ($extension[1] == 'pdf')
                                                    <a href="{{ asset('storage/uploads/environment/' . $environment[0]->adb_approval_file) }}"
                                                        target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                  @else
                                                  <a href="{{ asset('storage/uploads/environment/' . $environment[0]->adb_approval_file) }}"
                                                    target="_blank"><img src="{{ asset('storage/uploads/environment/' . $environment[0]->adb_approval_file) }}" style="height:100px;" ></a>
                                                    @endif
                                                    @else
                                                        No File available
                                                     @endif
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Report Disclosed</th>
                                                <td>{{ $environment[0]->adb_report_disclosed}}</td>
                                                <td>{{ $environment[0]->adb_report_disclosed_date}}</td>
                                                <td></td>
                                               
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
                                                <td>{{$environment[0]->emp_ssemp_prepared=='y'?'Yes':'No'}}</td>
                          
                                            </tr>
                                            <tr>
                                                <th>Apoint of EHS Focal person (Contractor)</th>
                                                <td>{{$environment[0]->focal_person=='y'?'Yes':'No'}}</td>

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
                                                <td>{{$environment[0]->safe_statutory_clearance=='y'?'Yes':'No'}}</td>
                                                <td></td>
                                                

                                            </tr>
                                            <tr>
                                                <th>Environmental Clearance (EC), IEE approved</th>
                                                <td>{{$environment[0]->safe_envi_clearance=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Site location clearance</th>
                                                <td>{{$environment[0]->safe_site_clearance=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Tree-cutting permit</th>
                                                <td>{{$environment[0]->safe_tree_cutting=='y'?'Yes':'No'}}</td>

                                                <td></td>
                                                
                                            </tr>
                                            <tr>
                                                <th>No Objection Certificate/Letter for work from concern authority </th>
                                                <td>{{$environment[0]->safe_no_objection=='y'?'Yes':'No'}}</td>
                                                <td></td>


                                            </tr>
                                            <tr>
                                                <th>Permit/Consent to Construct (or equivalent)</th>
                                                <td>{{$environment[0]->safe_construct_permit=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Permit/Consent to Operate (or equivalent)</th>
                                                <td>{{$environment[0]->safe_operate_permit=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Road-cutting permit</th>
                                                <td>{{$environment[0]->safe_road_cutting_permit=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Utilities shifting permit</th>
                                           
                                                <td>{{$environment[0]->safe_utility_shifting_permit=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>Covid Response Plan</th>
                                           
                                                <td>{{$environment[0]->safe_covid_reponse=='y'?'Yes':'No'}}</td>
                                                <td></td>

                                            </tr>
                                            <tr>
                                                <th>MoU With Hospital</th>
                                           
                                                <td>{{$environment[0]->safe_mou=='y'?'Yes':'No'}}</td>
                                                <td>
                                                    @if($environment[0]->safe_mou_file!=null)
                                                     <?php $extension = explode('.', $environment[0]->safe_mou_file); ?>
                                                    @if ($extension[1] == 'pdf')
                                                    <a href="{{ asset('storage/uploads/environment/' . $environment[0]->safe_mou_file) }}"
                                                        target="_blank"><img src="{{ asset('uploads/images/pdf.png') }}" style="height:70px;"></a>
                                                  @else
                                                  <a href="{{ asset('storage/uploads/environment/' . $environment[0]->safe_mou_file) }}"
                                                    target="_blank"><img src="{{ asset('storage/uploads/environment/' . $environment[0]->safe_mou_file) }}" style="height:100px;" ></a>
                                                    @endif
                                                    @else
                                                        No File available
                                                     @endif
                                                </td>
                                            </tr>
    
                                        </tbody>
    
                                    </table>
    
                                </div>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="structure_progress">
                                <div class=" table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-responsive" border="1px"  style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Structure Name</th>
                                                <th>Cordinate/Location</th>
                                                <th>Units</th>
                                                <th>Designed Total Capacity</th>
                                                <th>Target</th>
                                                <th>Progress</th>
                                                <th>Target For Next Reporting</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dynamicData">
                                            <?php $i = 1; ?>
                                            @foreach($structureName as $structure)
                                            @if(isset($structureEst[$structure->id]))
                                            <tr>
                                                <th> {{ $i++ }}. {{$structure->structure_name}}</th>
                                                <th>{{$structure->location}}</th>
                                                <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                                                <td id="estimation_{{$structure->id}}">{{isset($structureEst[$structure->id])?$structureEst[$structure->id]:'N/A'}}</td>
                                                <td>{{isset( $structure_progress[$structure->id] )&& $structure_progress[$structure->id][0]['target_total']!=null? $structure_progress[$structure->id][0]['target_total']:0}}</td>
                                               
                                               <td>{{isset( $structure_progress[$structure->id])&& $structure_progress[$structure->id][0]['progress_total']!=null? $structure_progress[$structure->id][0]['progress_total']:0}}</td>
                                               <td>{{isset( $structure_progress[$structure->id])&& $structure_progress[$structure->id][0]['target_for_next_month']!=null? $structure_progress[$structure->id][0]['target_for_next_month']:0}}</td>
                                           </tr>
                                           @endif
                                            <?php $j = 1;?>
                                            @if(isset($structure->child))
                                             <?php  $k= $i++; ?>
                                             <tr>
                                               <th> {{ $k }}. {{$structure->structure_name}}</th>
                                               <th>{{$structure->location}}</th>
                                               <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                               <td></td>
                                           </tr>
                                            @foreach($structure->child as $child)
                                            @if(isset($structureEst[$child->id]))
                                            <tr>
                                                <th><p style="padding-left: 25px;">{{ $k.'.'.$j++ }}. {{$child->structure_name}}</p></th>
                                                <th> {{$child->location}}</th>
                                                <td>{{$child->unit_id!=null?$child->unit->unit_name:''}}</td>
                                                <td>{{isset($structureEst[$child->id])?$structureEst[$child->id]:'N/A'}}</td>
                                                <td>{{isset( $structure_progress[$child->id])&& $structure_progress[$child->id][0]['target_total']!=null? $structure_progress[$child->id][0]['target_total']:0}}</td>
                                                
                                                <td>{{isset( $structure_progress[$child->id])&& $structure_progress[$child->id][0]['progress_total']!=null? $structure_progress[$child->id][0]['progress_total']:0}}</td>
                                                <td>{{isset( $structure_progress[$child->id])&& $structure_progress[$child->id][0]['target_for_next_month']!=null? $structure_progress[$child->id][0]['target_for_next_month']:0}}</td>
                                                
                                            </tr>
                                            @endif
                                            @endforeach
                                            @endif
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
