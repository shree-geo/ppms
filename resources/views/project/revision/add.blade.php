@extends('backend.layouts.app')
@section('title')
    Revision
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Revision</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Revision</li>
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
                        $permission = helperPermissionLink(url('project/revision/create'), url('project/revision'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                        
                    </div>
                    <div class="card-header">

                        {!! Form::open(['method' => 'post', 'url' => '/project/revision', 'autocomplete' => 'off', 'role'
                        => 'form', 'files'=>'true','enctype' => 'multipart/form-data']) !!}

                        <div class="row">
                            @if (auth()->user()->user_group_id!=2)
                            <div class="form-group col-md-6 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                <label>Project<label class="text-danger"> *</label></label>
                                {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                            </div>
                            @endif
                            <div class="form-group col-md-6 {{ $errors->has('revision_name') ? 'has-error' : '' }}">
                                <label>Revision
                                    <label class="text-danger"> *</label>
                                </label>
                                {!! Form::text('revision_name', null, ['class' => 'form-control', 'placeholder' => 'Revision']) !!}
                                {!! $errors->first('revision_name', '<span class="text-danger">:message</span>') !!}
                            </div>  
                            
                        </div>
                        
                        <div class=" pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ url('/project/progressData') }}" class="btn btn-danger">cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="card-body">
                        <div class="col-md-12"  style="overflow-x:auto;">
                         <table class="table table-striped table-bordered table-hover">
                             <thead>
                            <tr>
                                 <th>Year</th>
                                 @foreach($allprogressData as $year=>$data)
                                 <?php $datacount= count($data); ?>
                                 <th colspan={{$datacount}} class="text-center">{{$year}}</th>
                                 @endforeach
                                 </tr>
                                 <tr>
                                     <th></th>
                                     @foreach($allprogressData as $year=>$data5)
                                     @foreach($data5 as $val)
                                     <th>{{$val->month}}</th>

                                     @endforeach
                                     @endforeach
                                 </tr>
                               
                                </thead>
                               
                                <tbody>
                                    @foreach($scurveData as  $revision_id=>$scurve)
                                    <tr>
                                        
                                        <td>{{$revisions[$revision_id]}} Target</td>
                                        @foreach($scurve as  $data1)
                                        <td>{{$data1->target}}</td>
                                    
                                        @endforeach
                                    </tr>
                                    @endforeach
                                    <tr>
                                      
                                        @foreach($progressData as $rev_id => $value)
                                        
                                       {{-- @if($loop->first) <td>{{$revisions[$value->rid+1]}}  Target</td>@endif --}}
                                       {{-- @if($loop->first) <td> {{$value->rid==null?'Initial Target':$revisions[$value->rid+1]}}</td>@endif --}}
                                       @if($loop->first) <td> {{$value->rid==null?'Initial Target':$revisions[$value->rid]}}</td>@endif
                                        <td>{{$value->target}}</td>
                                        @endforeach
                                        
                                    </tr>
                                  
                                      <tr>
                                          <td>Actual progress</td>
                                        @foreach($progressData as $rev_id => $value)
                                      
                                        <td>{{$value->progress?$value->progress:0.00}}</td>
                                  
                                        @endforeach
                                    </tr>
                                   
                                      {{-- <tr>
                                          <td>Financial progress</td>
                                        @foreach($progressData as $rev_id => $value)
                                        <td>{{$value->financial_progress?$value->financial_progress:0.00}}</td>
                                  
                                        @endforeach
                                    </tr> --}}
                                    
                                </tbody>

                         </table>
                        </div>

                    </div>
                

            </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection

