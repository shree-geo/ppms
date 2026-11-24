@extends('backend.layouts.app')
@section('title')
    Quality Control
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quality Control</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Quality Control</li>
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
                                <h3 class="card-title">Quality Control</h3>

                              
                               
                                <?php

                                $permission = helperPermissionLink(url('project/qualityControl/create'), url('project/qualityControl'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>  
                            
                            @if(auth()->user()->user_group_id == 2)
                            <button type="button" class="btn btn-outline-primary btn-sm pull-right boxTopButton" data-toggle="modal" data-target="#quality_model">
                                QC Data
                            </button>
                            @include('project.layouts.qualityModel')
                            @endif
                                <!-- /.modal -->
                                
                            </div>
                               <div class="card-header">
                                    {!! Form::open(['method'=>'get','url'=>'/project/qualityControl', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                       <div class="form-group  pull-left col-md-3">
                                          {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                               'Select Project Name'])}}
       
                                         </div>
                                      <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if(!count($qc)<=0)
                                        <div class="col-md-12 topFilter">
                                            <table id="example1"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                        <th>Project</th>
                                                        <th style="width: 10px" ; class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php
                                                    $i = 1; ?>
                                                    
                                                    @foreach($qc as $key=>$value)
                                                    @foreach($value as $val)
                                                    @if($loop->first)
                                                    <tr>
                                                        <th scope=row>{{$i}}</th>                                                 
                                                        <td>{{$val->project->name}}</td>                                             
                                                        <td class="text-right row" style="margin-right: 0px;">
                                                            @if($allowEdit)
                                                                <a href="{{route('qualityControl.edit',[$val->project_id])}}"
                                                                class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                    <i class="fa fa-pencil-square-o"></i>
                                                                </a>&nbsp;
                                                            @endif
                                                        </td>
                                                    </tr>
                                                        <?php $i++; ?>
                                                        @endif
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
@section('js')
<script>
    function exportData() {
        var project_id = $('#project_id').val();
        // var url = baseurl + '/exports/qualitycontrolExport' + '?project_id=' + project_id;
        var url = baseurl + '/project/qualityControl' + '?project_id=' + project_id+'&export=export';
        window.location = url;
    }

</script>
@endsection