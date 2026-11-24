@extends('backend.layouts.app')
@section('title')
  Obas Report
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Obas Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                            <li class="breadcrumb-item active">Obas</li>
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
                                <h3 class="card-title">Obas Report</h3>
                             <a href="{{url('reports/all')}}" class="pull-right  boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" style="font-size:20px;"></i></a>
                            </div>
                             <div class="card-header">
                                {!! Form::open(['method'=>'get','url'=>'/reports/all/obas', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="row">
                                <div class="form-group col-md-3  ">
                                    <label>Project</label>
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                  </div>
                                <div class="form-group col-md-3  ">
                                    <label>District</label>
                                       {{Form::select('dis_id',$districts->pluck('english_name','id'),Request::get('dis_id'),['class'=>'form-control select2','id'=>'dis_id','placeholder'=>
                                                                        'Select District'])}}
                                  </div>
                                  <div class="form-group col-md-3">
                                      <label>Type</label>
                                          {{Form::select('oba_types_id',$oba_types->pluck('oba_type_name','id'),Request::get('oba_types_id'),['class'=>'form-control select2','id'=>'oba_types_id','placeholder'=>
                                                                        'Select Type'])}}

                                  </div>
                              
                                <div class="form-group col-md-3  ">
                                    <label>From</label>
                                  {!! Form::text('from', Request::get('from'),['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'from' ]) !!}

                                  </div>
                                  <div class="form-group col-md-3">
                                      <label>To</label>
                                    {!! Form::text('to', Request::get('to'), ['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'to' ]) !!}
  
                                    </div>
                                  </div>

                                <button type="submit" class="btn btn-primary pull-right ml-1" style="height:42px;"><i class="fa fa-search"></i> Search</button>


                                {!! Form::close() !!}
                                  <button class="btn btn-success pull-right ml-1" style="height:42px;" onclick="exportData()"><i class="fa fa-file-excel-o"
                                    aria-hidden="true"></i> Export</button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/reports/all/obas')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                            <div class="card-body">
                                @if($obas['obas']->count()>0)
                                @foreach($obas['obas'] as $project_key=>$oba)
                                @foreach($oba as $type_key=>$types)
                              
                               @if($loop->first)
                                <div class="row pt-3 pb-2 pl-3">
                                    <div class="form-group col-md-4">
                                        <span style="font-size:18px !important;">Project: <b>{{$types[0]->project->name}}</b> </span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <span style="font-size:18px !important;">Target: <b>{{$obas['target'][$types[0]->project_id]}}</b></span>
                                    </div>
    
                                </div>
                                @endif
                                <div class="col-md-12" style="overflow-x:auto;">
                                        @include('reports.export.obaReport')
                                </div>
                                
                                @endforeach
                                <hr style="border-top: 5px solid rgb(0 123 255);">
                                @endforeach
                                @else
                                <span class="text-danger" style="text-align: center;">No Data!!</span>
                                @endif
                            

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
                var dis_id=$('#dis_id').val();
                var oba_types_id=$('#oba_types_id').val();
                var from = $('#from').val();
                var to = $('#to').val();
                var url =  baseurl + '/reports/all/obas'+'?project_id='+project_id+'&dis_id='+dis_id+'&oba_types_id='+oba_types_id+'&from='+from +'&to='+to+'&export=export';
                window.location = url;
            } 
        
        </script>
@endsection
