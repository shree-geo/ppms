@extends('backend.layouts.app')
@section('title')
    PMO
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Configuration</h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Configuration</li>
                            <li class="breadcrumb-item active">PMO</li>
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
                                  <div class="card-title row" >
                                    </div>
                                <?php

                                $permission = helperPermissionLink(url('configurations/pmo/create'), url('configurations/pmo'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="col-md-12 topFilter">
                                            <table id="example1"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5px;">{{trans('app.sn')}}</th>
                                                        <th>Project No.</th>
                                                        <th>Loan No.</th>
                                                        <th>Loan Amt</th>
                                                        <th>Interest Rate</th>
                                                        <th>Loan Aggrement Date</th>
                                                        <th>Loan Effective Date</th>
                                                        <th>Loan Closing Date</th>
                                                        <th style="width: 10px;"
                                                            class="text-right">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @if($pmo!=null && $pmo->count()>0)
                                                            <tr>
                                                                <th scope=row>1</th>
                                                                <td>{{$pmo->project_num}}</td>
                                                                <td>{{$pmo->loan_num}}</td>
                                                                <td>{{$pmo->loan_amount}}</td>
                                                                <td>{{$pmo->interest_rate}}</td>
                                                                <td>{{$pmo->loan_aggre_date}}</td>
                                                                <td>{{$pmo->loan_effective_date}}</td>
                                                                <td>{{$pmo->loan_closing_date}}</td>

                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if($allowEdit)
                                                                        <a href="{{route('pmo.edit',[$pmo->id])}}"
                                                                        class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                        data-placement="top" title="Edit" style="margin: 0px 5px;">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>
                                                                    @endif

                                                                    @if($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['pmo.destroy',
                                                                            $pmo->id],'class'=> 'inline']) !!}
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
                                                        @else
                                                        <tr>
                                                            <td colspan="9" class="text-danger text-center">Data Not Found!!</td>
                                                        </tr>
                                                        @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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