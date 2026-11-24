@extends('backend.layouts.app')
@section('title')
    Project Eot Details
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Eot Details</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Eot</li>
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
                                {{-- <h3 class="card-title">Projects Beneficiary</h3>
                                --}}
                                <div class="card-title row">
                                    {!! Form::open(['method' => 'get', 'url' => '/project/eot', 'autocomplete' => 'off',
                                    'role' => 'form']) !!}
                                    <div class="form-group  pull-left">
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2',  'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}

                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right"
                                        style="margin-left: 5px; height:42px;">Search</button>

                                    {!! Form::close() !!}
                                </div>
                                <?php
                                $permission = helperPermissionLink(url('project/eot/create'), url('project/eot'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-body">
                                @if (!count($eots) <= 0)
                                        <div class="col-md-12 topFilter">
                                            <table id="example"
                                                class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;">{{ trans('app.sn') }}</th>
                                                        @if (auth()->user()->user_group_id != 2)
                                                            <th>Subproject</th>
                                                        @endif
                                                        <th>Eot Number</th>
                                                        <th>Revised Stage1 Completion Date</th>
                                                        <th>Revised Stage2 Completion Date</th>
                                                        <th>Approved Date</th>
                                                        <th style="width: 10px" ; class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($eots as $key => $eot)
                                                        @foreach ($eot as $val)
                                                            <tr>
                                                                <th scope=row>{{ $i }}</th>
                                                                @if (auth()->user()->user_group_id != 2)
                                                                    <td>{{ $val->project->name }}</td>
                                                                @endif
                                                                <th>{{$val->serial_no}}</th>
                                                                <td>{{ $val->revised_stage1_completion_date }}</td>
                                                                <td>{{ $val->revised_stage2_completion_date }}</td>
                                                                <td>{{ $val->approved_date }}</td>


                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if ($allowEdit)
                                                                        <a href="{{ route('eot.edit', [$val->id]) }}"
                                                                            class="text-info btn btn-xs btn-default"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if ($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                                        ['eot.destroy', $val->id], 'class' => 'inline']) !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Delete"
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
