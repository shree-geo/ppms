@extends('backend.layouts.app')
@section('title')
    Projects Progress Data
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Progress Data</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Progress Data</li>
                            <li class="breadcrumb-item active">{{trans('app.add')}}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="form">
                <div class="card card-default">
                    <div class="card-header with-border">
                        <h3 class="card-title">{{trans('app.add')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('project/progressData/create'), url('project/progressData'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                       
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::open(['method'=>'post','url'=>'/project/progressData', 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                            <div class="row">
                                @if(auth()->user()->user_group_id!=2)
                                <div class="form-group col-md-6 {{ ($errors->has('project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                 @endif
                            </div>
                                <div class="row">
                                   
                                <div class="form-group col-md-6 {{ ($errors->has('contract_start_date'))?'has-error':'' }}">
                                    <label>Contract Start Date</label>
                                    {!! Form::text('contract_start_date',$data['contract_signing_date'],['class'=>'form-control','placeholder' => 'Start Date','id'=>'contract_start_date','readonly']) !!}
                                    {!! $errors->first('contract_start_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('contract_end_date'))?'has-error':'' }}">
                                    <label>Contract End Date</label>
                                    {!! Form::text('contract_end_date',$data['latest_eot'],['class'=>'form-control','placeholder' => 'End Date','id'=>'contract_end_date','readonly']) !!}
                                    {!! $errors->first('contract_end_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                 <table class="table table-bordered table-hover" id="hideTable"  >
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th>Month</th>
                                                    <th>Initial Target</th>
                                                </tr>
                                            </thead>
                                            <tbody id="progressTable">
                                             @foreach($target as $year=>$val)
                                             <tr>
                                                 <td>{{$val->year}}</td>
                                                 <td>{{$val->month}}</td>
                                                <td>{{ Form::text('total[0]['.$val->year.']['.$val->month.']', $val->target, ['class' => 'form-control', 'style'=>'width:100%;']) }}</td>
                                              
                                             </tr>
                                             @endforeach
                                            </tbody>
                                        </table>
                                 
                                    </div>

                                </div>
                                
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/progressData')}}" class="btn btn-danger">Cancel</a>
                                
                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;
                                </button>
                                You Cannot access this module Please Contact your Super Admin user to access this.
                            </div>

                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
@section('js')
<script>
     $('#project_id').change(function(){
        var project_id = $('#project_id').val();
          var url = baseurl + '/project/progressDataProjectId' + '?project_id=' + project_id;
        window.location = url;
    });

</script>
@endsection








