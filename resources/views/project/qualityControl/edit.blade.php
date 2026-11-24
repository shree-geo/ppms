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
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Quality Control</li>
                            <li class="breadcrumb-item active">{{ trans('app.add') }}</li>
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
                        <h3 class="card-title">{{ trans('app.add') }}</h3>
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
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)
                        {!! Form::model($edits[0],['method'=>'put','route'=>['qualityControl.update',$edits[0]->project_id], 'autocomplete'=>'off', 'role'=>'form']) !!}

                        @if (auth()->user()->user_group_id!=2)
                            <div class="row">
                                <div class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                    <label>Project<label class="text-danger"> *</label></label>
                                    {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                    {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                        @endif

                           
                            <div class="row">
                                    <div class="col-md-12">                                        
                                         <table class="table table-bordered table-hover" id="hideTable"  style="width: 100%" >
                                            <thead>
                                                <tr>
                                                    <th>Material Name</th>
                                                    <th>QC Type</th>
                                                    <th>Target</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($qc_types as $qc_type)
                                                <tr>
                                                    <td>{{$qc_type->materials->material_name}}</td>
                                                    <td><input name="qc_type_id[]" type="hidden" value="{{$qc_type->id}}">{{$qc_type->test_name}}</td>
                                                    <td>{!! Form::number('target[]', isset($qualityData[$qc_type->id])?$qualityData[$qc_type->id]:'', ['class' => 'form-control', 'placeholder' => 'Enter Target', 'min'=>'0', 'oninput'=>'this.value = 
 !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null']) !!}</td>
                                                </tr>
                                               @endforeach                                             
                                            </tbody>
                                        </table>
                                        
                                    </div>

                                </div>
                            <!-- /.form group -->

                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/qualityControl') }}" class="btn btn-danger">cancel</a>

                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
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
 
@endsection
