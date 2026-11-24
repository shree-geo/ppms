@extends('backend.layouts.app')
@section('title')
    Projects Loan Status
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Loan Status</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Loan Status</li>
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

                        $permission = helperPermissionLink(url('project/loanStatus/create'), url('project/loanStatus'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route'=>['loanStatus.update',$edits['loan']->id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('loan.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('loan[project_id]',$projects->pluck('name','id'),Request::get('loan.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('ben.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                              
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 {{ ($errors->has('loan.loan_aggre_date'))?'has-error':'' }}">
                                    <label>Loan Aggrement Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan[loan_aggre_date]',null,['class'=>'form-control','placeholder' => 'Loan Aggrement Date']) !!}
                                    {!! $errors->first('loan.loan_aggre_date','<span class="text-danger">:message</span>') !!}
                                   </div>
                                <div class="form-group col-md-6 {{ ($errors->has('loan.loan_amount'))?'has-error':'' }}">
                                    <label>Loan Amount<label class="text-danger">*</label></label>
                                    {!! Form::number('loan[loan_amount]',null,['class'=>'form-control','placeholder' => 'Loan Amount']) !!}
                                    {!! $errors->first('loan.loan_amount','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('loan.interest_rate'))?'has-error':'' }}">
                                    <label>Interest Rate<label class="text-danger">*</label></label>
                                    {!! Form::text('loan[interest_rate]',null,['class'=>'form-control','placeholder' => 'Interest Rate']) !!}
                                    {!! $errors->first('loan.interest_rate','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('loan.loan_effective_date'))?'has-error':'' }}">
                                    <label>Loan Effective Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan[loan_effective_date]',null,['class'=>'form-control','placeholder' => 'Loan Effective Date']) !!}
                                    {!! $errors->first('loan.loan_effective_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('loan.loan_closing_date'))?'has-error':'' }}">
                                    <label>Loan Closing Date<label class="text-danger">*</label></label>
                                    {!! Form::date('loan[loan_closing_date]',null,['class'=>'form-control','placeholder' => 'Loan Closing Dates']) !!}
                                    {!! $errors->first('loan.loan_closing_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                   
                                </div>
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/loanStatus')}}" class="btn btn-danger">cancel</a>
                                
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







