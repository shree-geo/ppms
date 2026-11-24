@extends('backend.layouts.app')
@section('title')
    Project Documents
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Documents</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Documents</li>
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
                                <h3 class="card-title">Projects Documents</h3>


                                <?php

                                $permission = helperPermissionLink(url('project/document/create'), url('project/document'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                                {!! Form::open(['method'=>'get','url'=>'/project/document', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left col-md-3">
                                    {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                         'Select Project Name'])}}

                                </div>
                                <div class="form-group  pull-left col-md-3">
                                    {{Form::select('category_id',$category->pluck('cat_name','id'),Request::get('category_id'),['class'=>'form-control select2','id'=>'category_id','placeholder'=>
                                         'Select Category'])}}

                                </div>
                                <button type="submit" class="btn btn-primary pull-right"
                                        style="margin-left: 5px; height:42px;"><i class="fa fa-search"
                                                                                  aria-hidden="true"></i> Search
                                </button>

                                {!! Form::close() !!}
                            </div>
                            <div class="card-body">
                                @if(!count($documents)<=0)
                                    <div class="col-md-12">
                                        <table id="example"
                                               class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                            <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                    <th>Subproject</th>
                                                @endif
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>External Link</th>
                                                <th>Signed Date</th>
                                                <th>Approved Date</th>
                                                <th>Clearance Date</th>
                                                <th>Document</th>
                                                <th style="width: 10px" ;
                                                    class="text-right">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1; ?>
                                            @foreach($documents as $key=>$document)
                                                @foreach($document as $val)
                                                        <?php
                                                        $files = json_decode($val->file);
                                                        ?>
                                                    <tr>
                                                        <th scope=row>{{$i}}</th>
                                                        @if(auth()->user()->user_group_id!=2)
                                                            <td>{{$val->project->name}}</td>
                                                        @endif
                                                        <td>{{$val->doc_title}}</td>
                                                        <td>{{$val->category->cat_name}}</td>
                                                        <td>{{$val->external_link}}</td>
                                                        <td>{{$val->signed_date}}</td>
                                                        <td>{{$val->approved_date}}</td>
                                                        <td>{{$val->clearance_date}}</td>
                                                        @if( $files[0])
                                                            <td>
                                                                <a href="{{ asset('storage/uploads/' . $val->cat_id. '/'. $val->project_id. '/document'.'/'. $files[0]) }}"
                                                                   target="_blank">File</a></td>
                                                        @else
                                                            <td>No File</td>
                                                        @endif
                                                        <td class="text-right row" style="margin-right: 0px;">
                                                            @if($allowEdit)
                                                                <a href="{{route('document.edit',[$val->id])}}"
                                                                   class="text-info btn btn-xs btn-default"
                                                                   data-toggle="tooltip"
                                                                   data-placement="top" title="Edit">
                                                                    <i class="fa fa-pencil-square-o"></i>
                                                                </a>&nbsp;
                                                            @endif

                                                            @if($allowDelete)
                                                                {!! Form::open(['method' => 'DELETE', 'route'=>['document.destroy',
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