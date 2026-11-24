@extends('backend.layouts.app')
@section('title')
    Project Environmental Record 
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Environmental Record</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">EnvironmentalRecord</li>
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
                                <h3 class="card-title">Project Environmental Record</h3>

                           
                                <?php

                                $permission = helperPermissionLink(url('project/environmental_monthly_record/create'), url('project/environmental_monthly_record'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                             <div class="card-header" >
                             {!! Form::open(['method'=>'get','url'=>'/project/environmental_monthly_record', 'autocomplete'=>'off', 'role'=>'form']) !!}
                             <div class="row">
                                <div class="form-group  col-md-4">
                                    <label>Projects</label>
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                              
                              <div class="form-group col-md-4">
                                    <label>From</label>
                                  {!! Form::text('from', Request::get('from'),['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'from' ]) !!}

                                  </div>
                                   <div class="form-group col-md-4">
                                    <label>To</label>
                                  {!! Form::text('to', Request::get('to'),['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'to' ]) !!}

                                  </div>
                                    </div>
                               <button type="submit" class="btn btn-primary pull-right ml-1" style="height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                            <button class="btn btn-success pull-right ml-1" onclick="exportData()" style="height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            <a class="btn btn-danger pull-right ml-1" href="{{url('project/environmental_monthly_record')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                        </div>
                            <div class="card-body">
                                @if(!count($environment_records)<=0)
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
                                                @foreach($environment_records as $key=>$environment_record)
                                                @foreach($environment_record as $key=>$environment)
                                                @foreach($environment as $key=>$datas)
                                                @foreach($datas as $val)
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
                                                            <a  href="{{ url('project/environmental_monthly_record/editData/'.$val->project_id.'/'.$val->year.'/'.$val->month) }}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif
                                                        <a  href="{{ url('project/environmental_monthly_record/show/'.$val->project_id.'/'.$val->year.'/'.$val->month) }}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Show" target="_blank">
                                                                <i class="fa fa-eye"></i>
                                                            </a>&nbsp;
                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'url'=>'/project/environmental_monthly_record/deleteData/'.$val->project_id.'/'.$val->year.'/'.$val->month,'class'=> 'inline']) !!}
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
@section('js')
<script>
     $(document).ready(function(){
        localStorage.setItem('activeTab','#safeguard');
     });
</script>
<script>
    function exportData() {
        var project_id = $('#project_id').val();
        var from = $('#from').val();
        var to = $('#to').val();
        var url =  baseurl + '/project/environmental_monthly_record'+'?project_id='+project_id+'&from='+from+'&to='+to+'&export=export';
        window.location = url;
    }

</script>
@endsection