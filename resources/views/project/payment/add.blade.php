@extends('backend.layouts.app')
@section('title')
    Projects Payment
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Payment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Payment</li>
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
                        $permission = helperPermissionLink(url('project/payment/create'), url('project/payment'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/payment', 'autocomplete' => 'off','role' => 'form']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('payment.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('payment[project_id]', $projects->pluck('name', 'id'), Request::get('payment.project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('payment.project_id', '<span class="text-danger">:message</span>')
                                        !!}
                                    </div>
                                @endif

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('payment.payment_date') ? 'has-error' : '' }}">
                                    <label>Payment Date<label class="text-danger">*</label></label>
                                    {!! Form::text('payment[payment_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Payemnt Date'])
                                    !!}
                                    {!! $errors->first('payment.payment_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('payment.release_date') ? 'has-error' : '' }}">
                                    <label>Release Date<label class="text-danger">*</label></label>
                                    {!! Form::text('payment[release_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Release Date'])
                                    !!}
                                    {!! $errors->first('payment.release_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('payment.type') ? 'has-error' : '' }}">
                                    <label>Type<label class="text-danger">*</label></label>
                                    {!! Form::text('payment[type]', null, ['class' => 'form-control', 'placeholder' => 'Type'])
                                    !!}
                                    {!! $errors->first('payment.type', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ $errors->has('payment.amount') ? 'has-error' : '' }}">
                                    <label>Amount<label class="text-danger">*</label></label>
                                    {!! Form::text('payment[amount]', null, ['class' => 'form-control', 'placeholder' => 'Amount'])
                                    !!}
                                    {!! $errors->first('payment.amount', '<span class="text-danger">:message</span>') !!}
                                </div>


                            </div>
                         
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/payment') }}" class="btn btn-danger">cancel</a>

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

