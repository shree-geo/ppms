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
                                
                                        <div class="col-md-12 " style="overflow-x:auto;" >
                                            <table  class="table  table-striped table-bordered table-hover" >
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
                                              
                                                <th colspan="3" style="font-weight: bold;">Bramin/chhetri</th>
                                                <th colspan="3" style="font-weight: bold;">Dalit</th> 
                                                 <th colspan="3" style="font-weight: bold;">Janajati</th>
                                                 <th colspan="3" style="font-weight: bold;">Others</th>
                                                 <th colspan="3" style="font-weight: bold;">Muslim</th>
                                                 <th colspan="3" style="font-weight: bold;">Total</th> 
                                                <th>Status</th>

                                                <th style="width: 80px !important;"
                                                    class="text-right">Action</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                 @if (auth()->user()->user_group_id != 2)
                                                <th></th>
                                                @endif
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                @for ($i = 0; $i <= 5; $i++)
                                                <th style="font-weight: bold;">M</th>
                                                <th style="font-weight: bold;">F</th>
                                                <th style="font-weight: bold;">Total</th>
                                                @endfor
                                                <th></th>
                                                <th></th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $total_female_r = 0;
                                                    $total_male_r = 0;
                                                    $total_t_r = 0;
                                                    $total_bramin_f = 0;
                                                    $total_bramin_m = 0;
                                                    $total_bramin_t = 0;
                                                    $total_dalit_f = 0;
                                                    $total_dalit_m = 0;
                                                    $total_dalit_t = 0;
                                                    $total_janjati_f = 0;
                                                    $total_janjati_m = 0;
                                                    $total_janjati_t = 0;
                                                    $total_others_f = 0;
                                                    $total_others_m = 0;
                                                    $total_others_t = 0;
                                                    $total_muslim_f = 0;
                                                    $total_muslim_m = 0;
                                                    $total_muslim_t = 0;
                                                    ?>
                                                @foreach($programs as $key=>$program)
                                                @foreach($program as $val)

                                                   <tr>
                                                    <?php
                                                    $bramin_t = $val->bramin_m + $val->bramin_f;
                                                    $dalit_t = $val->dalit_m + $val->dalit_f;
                                                    $janjati_t = $val->janjati_m + $val->janjati_f;
                                                    $others_t = $val->others_m + $val->others_f;
                                                    $muslim_t = $val->muslim_m + $val->muslim_f;
                                                    $total_m = $val->bramin_m + $val->dalit_m + $val->janjati_m + $val->others_m +
                                                    $val->muslim_m;
                                                    $total_f = $val->bramin_f + $val->dalit_f + $val->janjati_f + $val->others_f +
                                                    $val->muslim_f;
                                                    $total_t = $bramin_t + $dalit_t + $janjati_t + $others_t + $muslim_t;
                                                    $total_female_r += $total_f;
                                                    $total_male_r += $total_m;
                                                    $total_t_r += $total_t;
                                                    $total_bramin_f += $val->bramin_f;
                                                    $total_bramin_m += $val->bramin_m;
                                                    $total_bramin_t += $bramin_t;
                                                    $total_janjati_f += $val->janjati_f;
                                                    $total_janjati_m += $val->janjati_m;
                                                    $total_janjati_t += $janjati_t;
                                                    $total_others_f += $val->others_f;
                                                    $total_others_m += $val->others_m;
                                                    $total_others_t += $others_t;
                                                    $total_muslim_f += $val->muslim_f;
                                                    $total_muslim_m += $val->muslim_m;
                                                    $total_muslim_t += $muslim_t;
                                                    $total_dalit_f += $val->dalit_f;
                                                    $total_dalit_m += $val->dalit_m;
                                                    $total_dalit_t += $dalit_t;
                                                    ?>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->programType->type_name }}</td>
                                                    <td>{{$val->program_title}}</td>
                                                    <td>{{$val->start_date}}</td>
                                                    <td>{{$val->end_date}}</td>
                                                   
                                                        <td>{{ $val->bramin_m }}</td>
                                                        <td>{{ $val->bramin_f }}</td>
                                                        <td style="font-weight: bold;">{{ $bramin_t }}</td>
                                                        <td>{{ $val->dalit_m }}</td>
                                                        <td>{{ $val->dalit_f }}</td>
                                                        <td style="font-weight: bold;">{{ $dalit_t }}</td>
                                                        <td>{{ $val->janjati_m }}</td>
                                                        <td>{{ $val->janjati_f }}</td>
                                                        <td style="font-weight: bold;">{{ $janjati_t }}</td>
                                                        <td>{{ $val->others_m }}</td>
                                                        <td>{{ $val->others_f }}</td>
                                                        <td style="font-weight: bold;">{{ $others_t }}</td>
                                                        <td>{{ $val->muslim_m }}</td>
                                                        <td>{{ $val->muslim_f }}</td>
                                                        <td style="font-weight: bold;">{{ $muslim_t }}</td>
                                                        <td style="font-weight: bold;">{{ $total_m }}</td>
                                                        <td style="font-weight: bold;">{{ $total_f }}</td>
                                                        <td style="font-weight: bold;">{{ $total_t }}</td>
                                                        <td ><span id="dynamicStatus_{{$val->id}}" class="color-{{($val->status=='submitted')?'grey':(($val->status=='approved')?'green':(($val->status=='canceled')?'red':'peru'))}}">
                                                            {{ucfirst($val->status)}}</span></td>

                                                    <td class="text-right row" style="width: 80px !important;" id="action_{{ $val->id }}">
                                                        @if($val->status!='approved' || auth()->user()->user_group_id!=2 && auth()->user()->user_group_id != 3)
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
                                                <tr>
                                                    <td colspan="{{auth()->user()->user_group_id!=2?6:5}}"  style="text-align: center; font-weight:bold;">Total</td>
                                                    <td style="font-weight: bold;">{{ $total_bramin_m }}</td>
                                                    <td style="font-weight: bold;">{{ $total_bramin_f }}</td>
                                                    <td style="font-weight: bold;">{{ $total_bramin_t }}</td>
                                                    <td style="font-weight: bold;">{{ $total_dalit_m }}</td>
                                                    <td style="font-weight: bold;">{{ $total_dalit_f }}</td>
                                                    <td style="font-weight: bold;">{{ $total_dalit_t }}</td>
                                                    <td style="font-weight: bold;">{{ $total_janjati_m }}</td>
                                                    <td style="font-weight: bold;">{{ $total_janjati_f }}</td>
                                                    <td style="font-weight: bold;">{{ $total_janjati_t }}</td>
                                                    <td style="font-weight: bold;">{{ $total_others_m }}</td>
                                                    <td style="font-weight: bold;">{{ $total_others_f }}</td>
                                                    <td style="font-weight: bold;">{{ $total_others_t }}</td>
                                                    <td style="font-weight: bold;">{{ $total_muslim_m }}</td>
                                                    <td style="font-weight: bold;">{{ $total_muslim_f }}</td>
                                                    <td style="font-weight: bold;">{{ $total_muslim_t }}</td>
                                                    <td style="font-weight: bold;">{{ $total_male_r }}</td>
                                                    <td style="font-weight: bold;">{{ $total_female_r }}</td>
                                                    <td style="font-weight: bold;">{{ $total_t_r }}</td>
                                                </tr>
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
                        if(status=='approved'){
                        $('#action_'+program_id).hide();
                    }
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
        
   

    @endsection