@extends('backend.layouts.app')
@section('title')
  Structure Progress 
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Structure Progress </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Structure Progress</li>
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
                                <h3 class="card-title">Structure Progress</h3>

                           
                                <?php

                                $permission = helperPermissionLink(url('project/structure_progress/create'), url('project/structure_progress'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                             <div class="card-header" >
                             {!! Form::open(['method'=>'get','url'=>'/project/structure_progress', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left col-md-3">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                             <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                                {!! Form::close() !!}
                        </div>
                            <div class="card-body">
                                @if(!count($progressData)<=0)
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
                                              
                                                <th style="width: 80px" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($progressData as $key=>$progress)
                                                @foreach($progress as $prog)
                                                @foreach($prog as $value)
                                                @foreach($value as $val)
                                                @if($loop->first)
                                               <tr>
                                                <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->year}}</td>
                                                    <td>{{$monthList[$val->month]}}</td>
                                               
                                                

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($allowEdit)
                                                            <a  href="{{ url('project/structure_progress/editData/'.$val->project_id.'/'.$val->year.'/'.$val->month) }}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif
                                                       
                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'url'=>'/project/structure_progress/deleteData/'.$val->project_id.'/'.$val->year.'/'.$val->month,'class'=> 'inline']) !!}
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
                                                @endif

                                                @endforeach
                                                @endforeach
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