@extends('backend.layouts.app')
@section('title')
    Project Reports
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Reports</h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Reports</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">
                            <div class="card-header with-border">
                                <h3 class="card-title">Projects Reports</h3>
                               
                                <?php

                                $permission = helperPermissionLink(url('project/reportUpload/create'), url('project/reportUpload'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                             {!! Form::open(['method'=>'get','url'=>'/project/reportUpload', 'autocomplete'=>'off', 'role'=>'form']) !!}
                             <div class="row">
                                <div class="form-group col-md-4">
                                    <label> Project</label>

                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                                  <div class="form-group col-md-4">
                                    <label>Year</label>
                             
                                        <select class="form-control select2" name="year">
                                            <option value="">Select Year</option>
                                            @foreach($years as $yea)
                                            <option value="{{$yea->fy_name}}" {{ Request::get('year') == $yea->fy_name ? 'selected' : '' }}>{{$yea->fy_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
    
                                    <div class="form-group col-md-4 ">
                                    <label> Month</label>
                                    {{Form::select('months',$monthList,Request::get('months'),['class'=>'form-control select2','id'=>'months','placeholder'=>
                                                                        'Select Month'])}}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/project/reportUpload')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                                {!! Form::close() !!}
                                {{-- <button class="btn btn-success pull-right" onclick="exportData()" style="height: 42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button> --}}
                            </div>
                            <div class="card-body">
                                @if(!count($reports)<=0)
                                        <div class="col-md-12 topFilter">
                                            <table id="example1"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Title</th>
                                                <th>File</th>
                                                
                                                <th style="width: 10px" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($reports as $key=>$report)
                                                @foreach($report as $val)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->year}}</td>
                                                    <td>{{$monthList[$val->months]}}</td>
                                                    <td>{{$val->title}}</td>
                                                    <td><a href="{{ asset('storage/uploads/reports/'. $val->file) }}"
                                                        target="_blank">File</a></td>
                                                    
                                                   

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($allowEdit)
                                                            <a href="{{route('reportUpload.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['reportUpload.destroy',
                                                                $val->id],'class'=> 'inline']) !!}
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"
                                                                    onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>

                                                            {!! Form::close() !!}
                                                        @endif
                                                        

                                                    </td>
                                                </tr>
                                                    <?php $i++; ?>

                                                @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                @else
                                    <div class="col-md-12">
                                        <label class="form-control label-danger">No records found</label>
                                    </div>
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
