@extends('backend.layouts.app')
@section('title')
    Project Environment
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Environment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Environment</li>
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
                                <h3 class="card-title">Project Environment</h3>

                            
                                <?php

                                $permission = helperPermissionLink(url('project/environment_detail/create'), url('project/environment_detail'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header" >
                             {!! Form::open(['method'=>'get','url'=>'/project/environment_detail', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left col-md-3">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                             <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                        </div>
                            <div class="card-body">
                                @if(!count($environments)<=0)
                                        <div class="col-md-12 topFilter">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                                <th>TOR Approval</th>
                                                <th>IIE Approval</th>
                                                <th>Approval by ADB</th>
                                                <th>Report Disclosed</th>
                                              
                                                <th style="width: 30px" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($environments as $key=>$environment)
                                                @foreach($environment as $val)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->gon_tor_approval}}</td>
                                                    <td>{{$val->gon_approval_iee}}</td>
                                                    <td>{{$val->adb_final_approval}}</td>
                                                    <td>{{$val->adb_report_disclosed}}</td>
                                                

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($allowEdit)
                                                            <a href="{{route('environment_detail.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif
                                                        
                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['environment_detail.destroy',
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
@section('js')

<script>
    function exportData() {
        var project_id = $('#project_id').val();
        var url =  baseurl + '/project/environment_detail'+'?project_id='+project_id+'&export=export';
        window.location = url;
    }

</script>

@endsection