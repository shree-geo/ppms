@extends('backend.layouts.app')
@section('title')
  WUSC Report
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>WUSC Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                            <li class="breadcrumb-item active">WUSC</li>
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
                            <h3 class="card-title">WUSC Report</h3>
                             <a href="{{url('reports/all')}}" class="pull-right  boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" style="font-size:20px;"></i></a>
                            </div>
                             <div class="card-header">
                                {!! Form::open(['method'=>'get','url'=>'/reports/all/samiti_member', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Project</label>
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                  </div>
                                  </div>

                                <button type="submit" class="btn btn-primary pull-right ml-1" style=" height:42px;"><i class="fa fa-search"></i> Search</button>


                                {!! Form::close() !!}
                                  <button class="btn btn-success pull-right ml-1" style=" height:42px;" onclick="exportData()"><i class="fa fa-file-excel-o"
                                    aria-hidden="true"></i> Export</button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/reports/all/samiti_member')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                            <div class="card-body">
                                <div class="col-md-12" style="overflow-x:auto;" >
                                        @include('reports.export.member')
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
                var project_id = $('#project_id').val();
                var from = $('#from').val();
                var to = $('#to').val();
                var url =  baseurl + '/reports/all/samiti_member'+'?project_id='+project_id+'&export=export';
                window.location = url;
            } 
        
        </script>
@endsection
