@extends('backend.layouts.app')
@section('title')
    QC Test
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>QC Test</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">QC Test</li>
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
                               <h3 class="card-title">Quality Control Test</h3>
                                  
                              
                                <?php

                                $permission = helperPermissionLink(url('project/qcTest/create'), url('project/qcTest'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>                            

                            </div>
                            <div class="card-header">
                                  {!! Form::open(['method'=>'get','url'=>'/project/qcTest', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                       <div class="form-group  pull-left col-md-3">
                                          {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                               'Select Project Name'])}}
                                         </div>
                                    <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if(!count($qcTest)<=0)
                                        <div class="col-md-12 " style="overflow-x:auto;">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover ">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                        @if(auth()->user()->user_group_id!=2)
                                                        <th>Project</th>
                                                        @endif
                                                        <th>Year</th>
                                                        <th>Month</th>
                                                        <th>Material</th>
                                                        <th>Test Type</th>                                                     
                                                        <th>Test</th>
                                                        <th>Required Result</th>                                                    
                                                        <th>Obaserved Result</th>                                                    
                                                        <th>Result</th>                                                    
                                                        <th>Status</th>
                                                        <th style="width: 65px; !important" class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <?php
                                                    $i = 1; ?>
                                                    
                                                    @foreach($qcTest as $key=>$value)
                                                    @foreach($value as $val)
                                                    <tr>
                                                        <th scope=row>{{$i}}</th>   
                                                        @if(auth()->user()->user_group_id!=2)
                                                        <td>{{$val->project->name}}</td>
                                                        @endif
                                                        <td>{{$val->year}}</td>                                                    
                                                        <td>{{$monthList[$val->month]}}</td>
                                                        <td>{{$val->materials->material_name}}</td>                                                        
                                                        <td>{{$val->testType->test_name}}</td>                                                        
                                                        <td>
                                                            <span><b>Date:</b></span> {{$val->test_date}}<br>
                                                            <span><b>Address:</b></span> {{($val->test_location=='site')?'Site':'Laboratory'}}<br>
                                                        </td>
                                                        <td>{{$val->result}}</td>                                                         
                                                        <td>{{$val->obaserved_result}}</td>                                                         
                                                        <td>{{$val->output_result}}</td>                                                         
                                                       <td><span id="dynamicStatus_{{ $val->id }}" class="color-{{ $val->status == 'submitted' ? 'grey' : ($val->status == 'approved' ? 'green' : ($val->status == 'canceled' ? 'red' : 'peru')) }}">{{ ucfirst($val->status) }}</span>
                                                        </td>                                  
                                                        <td class="text-right row" style="margin-right: 0px;" id="action_{{ $val->id }}">
                                                            @if($val->status!='approved' || auth()->user()->user_group_id != 2 && auth()->user()->user_group_id != 3)
                                                            @if($allowEdit)
                                                                <a href="{{route('qcTest.edit',[$val->id])}}"
                                                                class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                data-placement="top" title="Edit">
                                                                    <i class="fa fa-pencil-square-o"></i>
                                                                </a>&nbsp;
                                                            @endif
                                                            
                                                            @if($allowDelete)
                                                                {!! Form::open(['method' => 'DELETE', 'route'=>['qcTest.destroy',
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
                                                             @if (auth()->user()->user_group_id == 3)
                                                                        <button type="button"
                                                                            class="btn btn-outline-primary btn-xs pull-right boxTopButton"
                                                                            data-toggle="modal"
                                                                            data-target="#status_{{ $val->id }}">
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
            function sendRequest(qc_test_id) {
                var status_id = 'statusdetail_' + qc_test_id;
                var comment_id = 'comments_' + qc_test_id;
                var status = document.getElementById(status_id).value;
                var comment = document.getElementById(comment_id).value;
                $('.modal').modal('hide');

                $.ajax({
                    type: 'post',
                    url: baseurl + '/project/qcTest/QcTestStatus',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'qc_test_id': qc_test_id,
                        'status': status,
                        'comment': comment,
                    },
                    success: function(data) {
                        var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                        document.getElementById(comment_id).value='';
                        $('#dynamicStatus_' + qc_test_id).html('');
                        $('#dynamicStatus_' + qc_test_id).html(status.charAt(0).toUpperCase()+status.slice(1));
                        $('#dynamicStatus_' + qc_test_id).removeClass().addClass('color-' + color);
                        if(status=='approved'){
                        $('#action_'+qc_test_id).hide();
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
                  var url = baseurl + '/project/qcTest' + '?project_id=' + project_id+'&export=export';
                window.location = url;
            }
        
        </script>
         {{-- <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "scrollX": true,
                });
            });
    
            </script> --}}

    @endsection
