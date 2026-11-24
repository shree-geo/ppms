@extends('backend.layouts.app')
@section('title')
    Project Programs
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Programs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Programs</li>
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
                                <h3 class="card-title">Projects Programs</h3>
                          
                                <?php

                                $permission = helperPermissionLink(url('project/programs/create'), url('project/programs'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                             <div class="card-header">
                             {!! Form::open(['method'=>'get','url'=>'/project/programs', 'autocomplete'=>'off', 'role'=>'form']) !!}
                             <div class="row">
                                <div class="form-group   col-md-3">
                                    <label>Sub Project Name</label>
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                  </div>
                                  <div class="form-group col-md-3">
                                    <label>Program Type</label>
                                   {{Form::select('program_type_id',$program_types->pluck('type_name','id'),Request::get('program_type_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'program_type_id','placeholder'=>
                                        'Select Program Type'])}}

                                  </div>
                                <div class="form-group col-md-3">
                                    <label>From</label>
                                  {!! Form::text('from', Request::get('from'),['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'from' ]) !!}

                                  </div>
                                <div class="form-group col-md-3">
                                    <label>To</label>
                                  {!! Form::text('to', Request::get('to'), ['class'=>'form-control datepicker','placeholder'=>'Date','id'=>'to' ]) !!}

                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right ml-1" onclick="exportData()" style="height: 42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                                <a class="btn btn-danger pull-right ml-1" href="{{url('/project/programs')}}" style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>

                            </div>
                            <div class="card-body">
                                @if(!count($programs)<=0)
                                
                                        <div class="col-md-12 "  >
                                            <table id="example" class="table  table-striped table-bordered table-hover table-responsive " >
                                                <thead>
                                                 <tr>
                                                <th style="width: 5px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                                <th>Program Type</th>
                                                <th>Program Title</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Bramin</th>
                                                <th>Dalit</th>
                                                <th>Janajati</th>
                                                <th>Muslim</th>
                                                <th>Others</th>
                                                <th>Status</th>
                                                <th style="width: 80px !important;"
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($programs as $key=>$program)
                                                @foreach($program as $val)
                                                   <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->programType->type_name }}</td>
                                                    <td>{{$val->program_title}}</td>
                                                    <td>{{$val->start_date}}</td>
                                                    <td>{{$val->end_date}}</td>
                                                    <td><strong>Male:</strong> {{$val->bramin_m}}<br>
                                                        <strong>Female:</strong> {{$val->bramin_f}}
                                                    </td>
                                                    <td><strong>Male:</strong> {{$val->dalit_m}}<br>
                                                       <strong>Female:</strong> {{$val->dalit_f}}
                                                    </td>
                                                    <td><strong>Male:</strong> {{$val->janjati_m}}<br>
                                                        <strong>Female:</strong> {{$val->janjati_f}}
                                                    </td>
                                                    <td><strong>Male:</strong> {{$val->muslim_m}}<br>
                                                        <strong>Female:</strong> {{$val->muslim_f}}
                                                    </td>
                                                    <td><strong>Male:</strong> {{$val->others_m}}<br>
                                                        <strong>Female:</strong> {{$val->others_f}}
                                                    </td>
                                                    <td ><span id="dynamicStatus_{{$val->id}}" class="color-{{($val->status=='submitted')?'grey':(($val->status=='approved')?'green':(($val->status=='canceled')?'red':'peru'))}}">
                                                        {{ucfirst($val->status)}}</span></td>

                                                    <td class="text-right row" style="width: 80px !important;">
                                                        @if($val->status!='approved' || auth()->user()->user_group_id!=2)
                                                        @if($allowEdit)
                                                            <a href="{{route('programs.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['programs.destroy',
                                                                $val->id],'class'=> 'inline']) !!}
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                    data-toggle="tooltip"
                                                                    data-placement="top" title="Delete"
                                                                    onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                <i class="fa fa-trash"></i>
                                                            </button>&nbsp;

                                                            {!! Form::close() !!}
                                                        @endif
                                                        @if(auth()->user()->user_group_id==3)
                                                            <button type="button" class="btn btn-outline-primary btn-xs pull-right boxTopButton" data-toggle="modal" data-target="#status_{{$val->id}}">
                                                                 <i class="fa fa-eye"></i>
                                                            </button>
                                                        
                                                         @include('project.layouts.approveStatusModel')
                                                         @endif
                                                         @endif

                                                    </td>
                                                </tr>
                                                    <?php $i++; ?>

                                                @endforeach
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

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
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection
@section('js')
        <script>
            function sendRequest(program_id) {
                var status_id = 'statusdetail_' + program_id;
                var comment_id = 'comments_' + program_id;
                var status = document.getElementById(status_id).value;
                var comment = document.getElementById(comment_id).value;
                $('.modal').modal('hide');


                $.ajax({
                    type: 'post',
                    url: baseurl + '/project/programs/programsStatus',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'program_id': program_id,
                        'status': status,
                        'comment': comment,
                    },
                    success: function(data) {
                        var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                         document.getElementById(comment_id).value='';
                        $('#dynamicStatus_' + program_id).html('');
                        $('#dynamicStatus_' + program_id).html(status.charAt(0).toUpperCase()+status.slice(1));
                        $('#dynamicStatus_' + program_id).removeClass().addClass('color-' + color);
                    },
                    error: function(err) {

                    },
                })
            }

        </script>
        <script>
            function exportData() {
                var project_id = $('#project_id').val();
                var program_type_id = $('#program_type_id').val();
                var from = $('#from').val();
                var to = $('#to').val();
                var url =  baseurl + '/project/programs'+'?project_id='+project_id+'&program_type_id='+program_type_id+'&from='+from+'&to='+to+'&export=export';
                window.location = url;
            }
        
        </script>
        
        <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true,
            });
        });

        </script>

    @endsection