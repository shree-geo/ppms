@extends('backend.layouts.app')
@section('title')
Monthly Physical and Financial Report
@endsection
@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Monthly Physical Financial Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                        <li class="breadcrumb-item active">Monthly Physical Financial</li>
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
                        <h3 class="card-title">Monthly Physical Financial Report</h3>
                         <a href="{{url('reports/all')}}" class="pull-right  boxTopButton" data-toggle="tooltip" title="Go Back"><i class="fa fa-arrow-circle-left fa-2x" style="font-size:20px;"></i></a>
                        </div>
                         <div class="card-header">
                            {!! Form::open(['method'=>'get','url'=>'/reports/all/physical_financial', 'autocomplete'=>'off', 'role'=>'form']) !!}
                            <div class="row">
                         
                          
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

                            <a class="btn btn-danger pull-right ml-1" href="{{url('/reports/all/physical_financial')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                        </div>
                        @if($summary!=null && count($summary['progress'])>0)
                        <div class="card-body">
                            <div class="col-md-12"  >
                                    @include('reports.export.bar')
                                </div>
                                
                                
                            </div>
                            @else
                            <div class="card-body">
                                <h5 class="text-danger text-center" style="font-weight: bold;">Data Not Found !!</h5>
                            </div>
                            @endif
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>


            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

{{-- @include('reports.export.bar') --}}


@endsection