@extends('backend.layouts.app')
@section('title')
    Projects Obas
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Obas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Obas</li>
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
                        {{-- <a class="btn btn-success pull-right ml-1" href="{{url('project/oba/import')}}" style="height:40px;"><i class="fa fa-import"></i> Import</a> --}}
                        <?php
                        
                        $permission = helperPermissionLink(url('project/oba/create'), url('project/oba'));
                        
                        $allowEdit = $permission['isEdit'];
                        
                        $allowDelete = $permission['isDelete'];
                        
                        $allowAdd = $permission['isAdd'];
                        $previous_month = Session::get('month_name');
                        $current_year = Session::get('year');
                        
                        ?>
                    </div>
                    <div class="card-body">

                            {!! Form::open(['method' => 'post', 'url' => '/project/oba/import', 'autocomplete' => 'off', 'role' => 'form','enctype' => 'multipart/form-data', 'file' => true]) !!}

                            <div class="row">
                               
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name' ,'required']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                

                                <div class="form-group col-md-4 {{ $errors->has('oba_types_id') ? 'has-error' : '' }}">
                                    <label>Oba Type <label class="text-danger"> *</label></label>
                                    {{ Form::select('oba_types_id', $oba_types->pluck('oba_type_name', 'id'), Request::get('oba_types_id'), ['class' => 'form-control select2', 'id' => 'obaType_id', 'placeholder' => 'Select Oba Type', 'required']) }}
                                    {!! $errors->first('oba_types_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>


                            <div class="row">

                                <div class="form-group col-md-3 {{ $errors->has('dis_id') ? 'has-error' : '' }}">
                                    <label>District <label class="text-danger"> *</label></label>
                                    {{ Form::select('dis_id', $districts->pluck('english_name', 'id'), Request::get('dis_id'), ['class' => 'form-control select2', 'id' => 'dis_id', 'placeholder' => 'Select District', 'required']) }}
                                    {!! $errors->first('dis_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('year') ? 'has-error' : '' }}">
                                    <label>Year <label class="text-danger"> *</label></label>
             
                                    <select class="form-control select2" name="year" required>
                                        <option value="">Select Year</option>
                                        @foreach ($year as $yea)
                                            <option value="{{ $yea->fy_name }}" {{ $yea->fy_name  == $current_year ? 'selected' : '' }}>{{ $yea->fy_name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('months') ? 'has-error' : '' }}">
                                    <label> Month <label class="text-danger"> *</label></label>
                                  
                                    <select class="form-control  select2" name="months" required>
                                        <option value="">Select Month</option>
                                        @foreach ($month as $key => $val)
                                            <option value="{{ $key }}" {{ $val == $previous_month ? 'selected' : '' }}>
                                                {{ $val }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('months', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Files</label><br/>
                                    <input type="file" class="" id="file_upload" required name="file" accept=".csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel" /><br/>
                                  </div>

                            </div>
                         

                           

                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Import</button>

                            </div>
                            {!! Form::close() !!}
                     

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection
