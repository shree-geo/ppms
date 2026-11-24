@extends('backend.layouts.app')
@section('title')
    Projects
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Details</li>
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
                                <h3 class="card-title">Projects</h3>
                                <?php

                                $permission = helperPermissionLink(url('project/details/create'), url('project/details'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            

                            </div>
                            <div class="card-header">
                                <button class="btn btn-success pull-right" onclick="exportData()" style="height: 42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>

                            </div>
                            <div class="card-body">
                                @if(!count($projects)<=0)
                                        <div class="col-md-12" style="overflow-x:auto;">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                <th>Region</th>
                                                <th>Project Details</th>
                                                <th>Address</th>
                                                <th>Sector</th>
                                                <th style="width: 40px !important" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($projects as $key=>$project)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                    <td>{{$project->region->region_name}}</td>
                                                    <td>
                                                    <span><b>Sub Project Name:</b></span> {{$project->name}}<br>
                                                    <span><b>Package Number:</b></span> {{$project->package_no}}
                                                </td>
                                                    <td>
                                                        
                                                        @foreach($project->address as $value)
                                                        <span><b>District:</b></span> {{$value->district->english_name}}<br>
                                                        <span><b>Municipality:</b></span> {{$value->muni_id?$value->municipality->muni_name:''}}<br>
                                                        <span><b>Ward:</b>{{$value->ward_no}}</span><br>
                                                        @endforeach
                                                    </td>
                                                    
                                                    <td>{{($project->sector=='water_supply')?'Water Supply':(($project->sector=='sanitation')?'Sanitation':'Drainage')}} </td>

                                                    <td class="text-right row" >
                                                        @if($allowEdit)
                                                            <a href="{{route('details.edit',[$project->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif
                                                    <a href="{{url('project/details/'.$project->id)}}" class="text-info btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Show" target="_blank"><i class="fa fa-eye"></i></a>&nbsp;
                                                          
                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['details.destroy',
                                                                $project->id],'class'=> 'inline']) !!}
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
                var url =  baseurl + '/project/details'+'?export=export';
                window.location = url;
            }
        
        </script>
               
             
@endsection