@extends('backend.layouts.app')
@section('title')
    Report
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
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">

                            <div class="card-body">
                                <div class="row">
                                
                                    <div class="col-lg-3 col-xs-6">
                                        <div class="small-box bg-blue" >
                                            <div class="inner mb-5">

                                                <h5>GESI Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/programs')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        <div class="small-box bg-green" >
                                            <div class="inner mb-5">

                                                <h5>QC Test Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/qcTest')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>   
                                     <div class="col-lg-3 col-xs-6">
                                        <div class="small-box bg-yellow" >
                                            <div class="inner mb-5">

                                                <h5>Workers Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/workers')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                     <div class="col-lg-3 col-xs-6"  >
                                        <div class="small-box bg-red" >
                                            <div class="inner mb-5 ">

                                                <h5>OBA Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/obas')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                     <div class="col-lg-3 col-xs-6"  >
                                        <div class="small-box bg-orange" >
                                            <div class="inner mb-5 ">

                                                <h5>Monthly Progress Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/monthly_progress')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                     <div class="col-lg-3 col-xs-6"  >
                                        <div class="small-box bg-blue" >
                                            <div class="inner mb-5 ">

                                                <h5>Summary Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/summary_report')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                     <div class="col-lg-3 col-xs-6"  >
                                        <div class="small-box bg-green" >
                                            <div class="inner mb-4 ">

                                                <h5> Monthly Physical & Financial Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/physical_financial')}}" class="small-box-footer" >More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-6"  >
                                        <div class="small-box bg-yellow" >
                                            <div class="inner mb-5 ">

                                                <h5>Physical and Financial Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/physical_financial_summary')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        <div class="small-box bg-blue" >
                                            <div class="inner mb-5">

                                                <h5>WUSC Reports</h5>
                                            </div>
                                            <div class="icon">
                                                <i class="fa fa-bar-chart"></i>
                                            </div>
                                            <a href="{{url('reports/all/samiti_member')}}" class="small-box-footer">More info <i
                                                    class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
