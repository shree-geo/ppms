@extends('backend.layouts.app')
@section('title')
  Monthly Report
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Monthly Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Reports</li>
                            <li class="breadcrumb-item active">Monthly</li>
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
                            <h3 class="card-title">Monthly Report</h3>
                             <a href="{{url('reports/all')}}" class="pull-right  boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" style="font-size:20px;"></i></a>
                            </div>
                             <div class="card-header">
                                {!! Form::open(['method'=>'get','url'=>'/reports/all/monthly_progress', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="row">
                                <div class="form-group col-md-3 {{ ($errors->has('project_id'))?'has-error':''}}">
                                    <label>Project<label class="text-danger">*</label></label>
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}

                                  </div>
                              
                                <div class="form-group col-md-3 {{ ($errors->has('year'))?'has-error':''}}">
                                    <label>Year<label class="text-danger">*</label></label>
                                        <select class="form-control select2" name="year" id="year">
                                            <option value="">Select Year</option>
                                            @foreach($years as $yea)
                                            <option value="{{$yea->fy_name}}" {{Request::get('year')==$yea->fy_name?'selected':''}}>{{$yea->fy_name}}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}


                                  </div>
                                  <div class="form-group col-md-3 {{ ($errors->has('month'))?'has-error':''}}">
                                      <label>Month<label class="text-danger">*</label></label>
                                      {{Form::select('month',$months,Request::get('month'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'month','placeholder'=>
                                      'Select Month'])}}
                                        {!! $errors->first('month', '<span class="text-danger">:message</span>') !!}

  
                                    </div>
                                  </div>

                               
                                <button type="submit" class="btn btn-primary pull-right ml-1" style=" height:42px;"><i class="fa fa-search"></i> Search</button>


                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right ml-1" style="height:42px;" onclick="exportData()"><i class="fas fa-file-pdf"></i> </button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/reports/all/monthly_progress')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                            <div class="card-body">
                                <div class="col-md-12" style="overflow-x:auto;" >
                                    @if(count($progress_data)>0)
                                        @include('reports.export.monthly_progress')
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
                console.log('s');
                var project_id = $('#project_id').val();
                var year=$('#year').val();
                var month=$('#month').val();
                var url =  baseurl + '/reports/all/monthly_progress'+'?project_id='+project_id+'&year='+year+'&month='+month+'&export=export';
                window.location = url;
            } 
        
        </script>
@endsection

