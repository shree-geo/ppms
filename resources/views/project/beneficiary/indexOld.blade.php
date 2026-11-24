@extends('backend.layouts.app')
@section('title')
    Project Beneficiary
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Beneficiary </h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">beneficiary</li>
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
                                <h3 class="card-title">Projects Beneficiary</h3>
                                
                                <?php

                                $permission = helperPermissionLink(url('project/beneficiary/create'), url('project/beneficiary'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                             {!! Form::open(['method'=>'get','url'=>'/project/beneficiary', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group col-md-3 pull-left">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                            {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style=" height:42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if(!count($beneficiaries)<=0)
                                        <div class="col-md-12">
                                            <table id="example1"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                                <th>Sector</th>
                                                <th>Dalit </th>
                                                <th>Janajati</th>
                                                <th>Brahamin</th>
                                                <th>Muslim </th>
                                                <th>Others </th>
                                                <th>Status</th>
                                                <th style="width: 60px !important;"
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($beneficiaries as $key=>$beneficiary)
                                                @foreach($beneficiary as $val)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                   <td>{{($val->beneficiary_sector=='water_supply')?'Water Supply':(($val->beneficiary_sector=='sanitation')?'Sanitation':'Drainage')}}</td> 
                                                    <td><b>Male:</b> {{$val->dalit_m?$val->dalit_m:0}}<br>
                                                       <b>Female:</b> {{$val->dalit_f?$val->dalit_f:0}}
                                                    </td>
                                                    <td><b>Male:</b> {{$val->janjati_m?$val->janjati_m:0}}<br>
                                                       <b>Female:</b> {{$val->janjati_f?$val->janjati_f:0}}
                                                    </td>
                                                    <td><b>Male:</b> {{$val->bramin_m?$val->bramin_m:0}}<br>
                                                       <b>Female:</b> {{$val->bramin_f?$val->bramin_f:0}}
                                                    </td>
                                                    <td><b>Male:</b> {{$val->muslim_m?$val->muslim_m:0}}<br>
                                                       <b>Female:</b> {{$val->muslim_f?$val->muslim_f:0}}
                                                    </td>
                                                    <td><b>Male:</b> {{$val->other_m?$val->other_m:0}}<br>
                                                       <b>Female:</b> {{$val->other_f?$val->other_f:0}}
                                                    </td>
                                                    <td ><span id="dynamicStatus_{{$val->id}}" class="color-{{($val->status=='submitted')?'grey':(($val->status=='approved')?'green':(($val->status=='canceled')?'red':'peru'))}}">{{ucfirst($val->status)}}</span></td>
                                                   

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($val->status!='approved' || auth()->user()->user_group_id!=2)
                                                        @if($allowEdit)
                                                            <a href="{{route('beneficiary.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['beneficiary.destroy',
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
            function sendRequest(ben_id) {
                var status_id = 'statusdetail_' + ben_id;
                var comment_id = 'comments_' + ben_id;
                var status = document.getElementById(status_id).value;
                var comment = document.getElementById(comment_id).value;
                $('.modal').modal('hide');


                $.ajax({
                    type: 'post',
                    url: baseurl + '/project/beneficiary/beneficiaryStatus',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'beneficiary_id': ben_id,
                        'status': status,
                        'comment': comment,
                    },
                    success: function(data) {
                        var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                        document.getElementById(comment_id).value='';
                        $('#dynamicStatus_' + ben_id).html('');
                        $('#dynamicStatus_' + ben_id).html(status.charAt(0).toUpperCase()+status.slice(1));
                        $('#dynamicStatus_' + ben_id).removeClass().addClass('color-' + color);
                    },
                    error: function(err) {

                    },
                })
            }

        </script>

<script>
    function exportData() {
        var project_id = $('#project_id').val();
        // var url =  baseurl + '/exports/beneficiaryExport'+'?project_id='+project_id;
        var url =  baseurl + '/project/beneficiary'+'?project_id='+project_id+'&export=export';
        window.location = url;
    }

</script>

@endsection