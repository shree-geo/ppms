@extends('backend.layouts.app')
@section('title')
  Summary Report
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Summary Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                            <li class="breadcrumb-item active">Summary</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">
                            <div class="card-header with-border">
                            <h3 class="card-title">Summary Report</h3>
                             <a href="{{url('reports/all')}}" class="pull-right  boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" style="font-size:20px;"></i></a>
                            </div>
                             <div class="card-header">
                                {!! Form::open(['method'=>'get','url'=>'/reports/all/summary_report', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="row">
                               
                                  <div class="form-group col-md-4">
                                    <label>From</label>
                                  {!! Form::text('from', Request::get('from'),['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'from' ]) !!}

                                  </div>
                                <div class="form-group col-md-4">
                                    <label>To</label>
                                  {!! Form::text('to', Request::get('to'), ['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'to' ]) !!}

                                  </div>
                                  </div>

                               
                                <button type="submit" class="btn btn-primary pull-right ml-1" style=" height:42px;"><i class="fa fa-search"></i> Search</button>


                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right ml-1" style="height:42px;" onclick="exportData()"><i class="fas fa-file-pdf"></i> </button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/reports/all/summary_report')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                            <div class="card-body">
                                <div class="col-md-12" >
                                    @if(count($summary)>0)
                                    @include('reports.export.summary')
                                    @endif


                                </div>
                            

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>


                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection
@section('js')

  <script>
            function exportData() {
                var from=$('#from').val();
                var to=$('#to').val();
                var url =  baseurl + '/reports/all/summary_report'+'?from='+from+'&to='+to+'&export=export';
                window.location = url;
            } 
        
        </script>
@endsection

