@extends('backend.layouts.app')
@section('title')
   Safe Guard Indicator
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Safe Guard Indicator </h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Safe Guard Indicator</li>
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
                                <h3 class="card-title">Projects Safe Guard Indicator</h3>
                               
                                <?php

                                $permission = helperPermissionLink(url('project/safeguardindicators/create'), url('project/safeguardindicators'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                                    {!! Form::open(['method'=>'get','url'=>'/project/safeguardindicators', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                       <div class="form-group col-md-3 pull-left">
                                          {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                               'Select Project Name'])}}
       
                                         </div>
                                         <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
       
                                       {!! Form::close() !!}
                                       <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                
                                @if(!count($safeguardindicators)<=0)
                                        <div class="col-md-12 topFilter">
                                            <table id="example1"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif                                                
                                                <th>Indicator Name </th>                                               
                                                <th>Indicator Value </th>
                                                <th style="width: 10px" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($safeguardindicators as $key=>$safeguardindicator)
                                                @foreach($safeguardindicator as $val)
                                               
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                  <td>{{$val->indicator_name}}</td>
                                                    <td>{{$val->indicator_value}}</td>
                                                   

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($allowEdit)
                                                            <a href="{{route('safeguardindicators.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['safeguardindicators.destroy',
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
                                                        {{-- <a href="{{url('project/beneficiary/'.$val->id)}}" class="text-info btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="Show" target="_blank"><i class="fa fa-eye"></i></a>&nbsp; --}}

                                                        

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
        var from = $('#from').val();
        var to = $('#to').val();
        var url = baseurl + '/project/safeguardindicators' + '?project_id='+project_id+'&from=' +from +'&to='+to+'&export=export';
        window.location = url;
    }

</script>
@endsection