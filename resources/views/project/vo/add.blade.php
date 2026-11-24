@extends('backend.layouts.app')
@section('title')
    Projects VO Details
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects Vo Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">vo</li>
                            <li class="breadcrumb-item active">{{trans('app.add')}}</li>
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
                        <h3 class="card-title">{{trans('app.add')}}</h3>
                        <?php

                        $permission = helperPermissionLink(url('project/vo/create'), url('project/vo'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                       
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/vo', 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('vo.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('vo[project_id]',$projects->pluck('name','id'),Request::get('vo.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('vo.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                              
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 ">
                                    <label>Original Contract Amount</label>
                                    {!! Form::number('vo[contract_amount]',$data['contract_amount'],['class'=>'form-control','placeholder' => 'Original Contract Amount','id'=>'contract_amount','readonly']) !!}
                                </div>
                                <div class="form-group col-md-6" >
                                    <label>Original Cost Estimated</label>
                                    {!! Form::number('vo[estimated_amount]',$data['estimated_amount'],['class'=>'form-control','placeholder' => 'Original Cost Estimated','id'=>'estimated_amount',' readonly']) !!}
                                </div>
                                  <div class="form-group col-md-6 {{ ($errors->has('vo.revised_contract_amount'))?'has-error':'' }} ">
                                    <label>Revised Contract Amount<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[revised_contract_amount]',null,['class'=>'form-control','placeholder' => 'Revised Contract Amount','id'=>'revised_contract_amount']) !!}
                                    {!! $errors->first('vo.revised_contract_amount','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('vo.revised_cost_estimated'))?'has-error':'' }}" >
                                    <label>Revised Cost Estimated<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[revised_cost_estimated]',null,['class'=>'form-control','placeholder' => 'Revised Cost Estimated','id'=>'revised_cost_estimated']) !!}
                                    {!! $errors->first('vo.revised_cost_estimated','<span class="text-danger">:message</span>') !!}

                                </div>
                                <div class="form-group col-md-4 {{ ($errors->has('vo.serial_no'))?'has-error':'' }}">
                                    <label>Vo Number<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[serial_no]',null,['class'=>'form-control','placeholder' => 'Vo Number']) !!}
                                    {!! $errors->first('vo.serial_no','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ ($errors->has('vo.variation_amount'))?'has-error':'' }}">
                                    <label>Variation Amount<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[variation_amount]',null,['class'=>'form-control','placeholder' => 'Variation Amount']) !!}
                                    {!! $errors->first('vo.variation_amount','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ ($errors->has('vo.variation_per'))?'has-error':'' }}">
                                    <label>Variation Percentage<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[variation_per]',null,['class'=>'form-control','placeholder' => 'Variation Percentage']) !!}
                                    {!! $errors->first('vo.variation_per','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('vo.approved_date'))?'has-error':'' }}">
                                    <label>Approved Date<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[approved_date]',null,['class'=>'form-control datepicker','placeholder' => 'Approved Date',]) !!}
                                    {!! $errors->first('vo.approved_date','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('vo.approved_by'))?'has-error':'' }}">
                                    <label>Approved By<label class="text-danger">*</label></label>
                                    {!! Form::text('vo[approved_by]',null,['class'=>'form-control','placeholder' => 'Approved By']) !!}
                                    {!! $errors->first('vo.approved_by','<span class="text-danger">:message</span>') !!}
                                </div>
                                   
                                    <div class="form-group col-md-12 {{ ($errors->has('vo.remarks'))?'has-error':'' }}" style="width: 100%;">
                                    <label>Remarks</label>
                                    {!! Form::textarea('vo[remarks]',null,['class'=>'form-control','placeholder' => 'Remarks','rows'=>'5']) !!}
                                    {!! $errors->first('vo.remarks','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                                        <label>Files</label>
                                        <input type="file" class="" id="file_upload" name="file" /><br/>
                                        <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                        {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="row mb-4" id="image_preview" style="width:100%;"></div>

                                </div>
                            
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/vo')}}" class="btn btn-danger">cancel</a>
                                
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
@section('js')
<script src={{url("js/pdfpreview.js")}}>  </script>

     <script>
        $('#project_id').change(function(){
            var proj_id= $('#project_id').val();
            $.ajax({
                type:'get',
                url:baseurl + '/projectDetails/' + proj_id,
                success:function(res){
                         $('#contract_amount').val(res.contract_amount);
                         $('#estimated_amount').val(res.estimated_amount);
                }
            })
        })
    </script>

    @endsection







