@extends('backend.layouts.app')
@section('title')
    Project Obas
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Output Based Aid Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Obas</li>
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
                                <h3 class="card-title">Projects Obas</h3>

                                <?php
                                $permission = helperPermissionLink(url('project/oba/create'), url('project/oba'));
                                
                                $allowEdit = $permission['isEdit'];
                                
                                $allowDelete = $permission['isDelete'];
                                
                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                                {!! Form::open(['method' => 'get', 'url' => '/project/oba', 'role' => 'form']) !!}
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>SubProject Name</label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2','id' => 'project_id','placeholder' => 'Select Project Name']) }}

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Oba Type</label>
                                        {{                                         Form::select('oba_types_id', $oba_types->pluck('oba_type_name', 'id'), Request::get('oba_types_id'), ['class' => 'form-control select2', 'id' => 'oba_types_id', 'placeholder' => 'Select Oba Type']) }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>From</label>
                                        {!! Form::text('from', Request::get('from'), ['class' => 'form-control datepicker', 'placeholder' => 'Date', 'id' => 'from']) !!}

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>To</label>
                                        {!! Form::text('to', Request::get('to'), ['class' => 'form-control datepicker', 'placeholder' => 'Date', 'id' => 'to']) !!}

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right ml-1" style="height:42px;"><i
                                        class="fa fa-search" aria-hidden="true"></i> Search</button>

                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right ml-1" onclick="exportData()"
                                    style="height: 42px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                    Export</button>
                                <a class="btn btn-danger pull-right ml-1" href="{{ url('/project/oba') }}"
                                    style="height:42px;"><i class="fa fa-refresh"></i> Refresh</a>
                                <a class="btn btn-success pull-right ml-1"
                                    href="{{ asset('/uploads/obas_report_format.xlsx') }}" style="height:40px;"
                                    target="_blank"><i class="fa fa-download"></i> Download Template</a>

                            </div>
                            <div class="card-body">

                                @if (!count($obas) <= 0)
                                    <div class="col-md-12 topFilter">
                                        <table id="example1"
                                            class="table table-striped table-bordered table-hover table-responsive">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">{{ trans('app.sn') }}</th>
                                                    @if (auth()->user()->user_group_id != 2)
                                                        <th>Subproject Name</th>
                                                    @endif
                                                    <th>Oba Type</th>
                                                    <th>District</th>
                                                    <th>Year</th>
                                                    <th>Month</th>
                                                    <th>Status</th>
                                                    <th style="width: 60px; !important" class="text-right">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($obas as $key => $oba)
                                                    @foreach ($oba as $val)
                                                        <tr>
                                                            <th scope=row>{{ $i }}</th>
                                                            @if (auth()->user()->user_group_id != 2)
                                                                <td>{{ $val->project->name }}</td>
                                                            @endif
                                                            <td>{{ $val->obaTypes->oba_type_name }}</td>
                                                            <td>{{ $val->district->english_name }}</td>
                                                            <td>{{ $val->year }}</td>
                                                            <td>{{ $monthList[$val->months] }}</td>
                                                            <td><span id="dynamicStatus_{{ $val->id }}"
                                                                    class="color-{{ $val->status == 'submitted'? 'grey': ($val->status == 'approved'? 'green': ($val->status == 'canceled'? 'red': 'peru')) }}">{{ ucfirst($val->status) }}</span>
                                                            </td>

                                                            <td class="text-right row" style="margin-right: 0px;"
                                                                id="action_{{ $val->id }}">
                                                                @if ($val->status != 'approved' || (auth()->user()->user_group_id != 2 && auth()->user()->user_group_id != 3))
                                                                    @if ($allowEdit)
                                                                        <a href="{{ route('oba.edit', [$val->id]) }}"
                                                                            class="text-info btn btn-xs btn-default"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if ($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['oba.destroy', $val->id], 'class' => 'inline']) !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Delete"
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
        function sendRequest(oba_id) {
            var status_id = 'statusdetail_' + oba_id;
            var comment_id = 'comments_' + oba_id;
            var status = document.getElementById(status_id).value;
            var comment = document.getElementById(comment_id).value;
            $('.modal').modal('hide');


            $.ajax({
                type: 'post',
                url: baseurl + '/project/obas/obaStatus',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'oba_id': oba_id,
                    'status': status,
                    'comment': comment,
                },
                success: function(data) {
                    var color = status == 'approved' ? 'green' : status == 'canceled' ? 'red' : 'peru';
                    document.getElementById(comment_id).value = '';
                    $('#dynamicStatus_' + oba_id).html('');
                    $('#dynamicStatus_' + oba_id).html(status.charAt(0).toUpperCase() + status.slice(1));
                    $('#dynamicStatus_' + oba_id).removeClass().addClass('color-' + color);
                    if (status == 'approved') {
                        $('#action_' + oba_id).hide();
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
            var from = $('#from').val();
            var to = $('#to').val();
            var oba_types_id = $('#oba_types_id').val();
            var url = baseurl + '/project/oba' + '?project_id=' + project_id + '&oba_types_id' + oba_types_id + '&from=' +
                from + '&to=' + to + '&export=export';
            window.location = url;
        }
    </script>
@endsection
