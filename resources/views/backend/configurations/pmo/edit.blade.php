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
                        <h1>PMO</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Configuration</li>
                            <li class="breadcrumb-item active">PMO</li>
                            <li class="breadcrumb-item active">{{trans('app.edit')}}</li>
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
                        <h3 class="card-title">{{trans('app.edit')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('configurations/pmo/create'), url('configurations/pmo'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)
                        {!! Form::model($edits,['method'=>'PUT','route'=>['pmo.update',$edits->id]]) !!}
                            <!-- /.input group -->
                            <div class="row">
                                <div class="form-group col-md-6 {{ ($errors->has('project_num'))?'has-error':'' }}">
                                    <label>Project No.
                                        <label class="text-danger"> *</label>
                                    </label>
                                    {!! Form::text('project_num',null,['class'=>'form-control','placeholder' => 'Enter Project Number']) !!}
                                    {!! $errors->first('project_num', '<span class="text-danger">:message</span>') !!}

                                <!-- /.input group -->
                                </div>

                                <div class="form-group col-md-6 {{ ($errors->has('loan_num'))?'has-error':'' }}">
                                    <label>Loan No.<label class="text-danger"> *</label></label>
                                    {!! Form::text('loan_num',null,['class'=>'form-control','placeholder' => 'Enter Loan Number']) !!}
                                    {!! $errors->first('loan_num', '<span class="text-danger">:message</span>') !!}
                                    <!-- /.input group -->
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6 {{ ($errors->has('loan_amount'))?'has-error':'' }}">
                                    <label>Loan Amount<label class="text-danger">*</label></label>
                                    {!! Form::text('loan_amount',null,['class'=>'form-control','placeholder' => 'Loan Amount']) !!}
                                    {!! $errors->first('loan_amount','<span class="text-danger">:message</span>') !!}
                                </div>
                                
                                <div class="form-group col-md-6 {{ ($errors->has('interest_rate'))?'has-error':'' }}">
                                    <label>Interest Rate<label class="text-danger">*</label></label>
                                    {!! Form::text('interest_rate',null,['class'=>'form-control','placeholder' => 'Interest Rate']) !!}
                                    {!! $errors->first('interest_rate','<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="form-group col-md-4 {{ ($errors->has('loan_aggre_date'))?'has-error':'' }}">
                                    <label>Loan Aggrement Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan_aggre_date',null,['class'=>'form-control','placeholder' => 'Loan Aggrement Date']) !!}
                                    {!! $errors->first('loan_aggre_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                
                                <div class="form-group col-md-4 {{ ($errors->has('loan_effective_date'))?'has-error':'' }}">
                                    <label>Loan Effective Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan_effective_date',null,['class'=>'form-control','placeholder' => 'Loan Effective Date']) !!}
                                    {!! $errors->first('loan_effective_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                                            
                                <div class="form-group col-md-4 {{ ($errors->has('loan_closing_date'))?'has-error':'' }}">
                                    <label>Loan Closing Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan_closing_date',null,['class'=>'form-control','placeholder' => 'Loan Closing Dates']) !!}
                                    {!! $errors->first('loan_closing_date','<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>       
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <div >
                                    <button type="submit" class="btn btn-primary">{{trans('app.save')}}&nbsp;</button>
                                    <a href="{{url('/configurations/pmo')}}" class="btn btn-danger">cancel</a>
                                </div>
                                <!-- /.card-footer -->
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