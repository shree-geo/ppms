@extends('backend.layouts.app')
@section('title')
    Safe Guard Indicator
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Safe Guard Indicator</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Safe Guard Indicator</li>
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

                        $permission = helperPermissionLink(url('project/safeguardindicators/create'), url('project/safeguardindicators'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/safeguardindicators', 'autocomplete'=>'off', 'role'=>'form', 'enctype' => 'multipart/form-data','file'=>true]) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('saf.project_id'))?'has-error':'' }}">
                                        <label>Subproject</label><label class="text-danger">*</label>
                                        {{Form::select('saf[project_id]',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('saf.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                              {{-- <div class="form-group col-md-4 {{ ($errors->has('saf.indicator_name'))?'has-error':'' }}">
                                    <label>Indicator Name </label><label class="text-danger"> *</label>
                                    <select id="indicator_name" name="saf[indicator_name]" class="form-control select2">
                                        <option value="" selected disabled>Select Indicator Name</option>
                                        <option value="compliances" >Compliances</option>
                                        <option value="land_record" >Land Record</option>
                                        <option value="third_party">Third party verification</option>
                                    </select>
                                    {!! $errors->first('saf.indicator_name','<span class="text-danger">:message</span>') !!}
                                </div> --}}
                                <div class="form-group col-md-4 {{ ($errors->has('saf.indicator_name'))?'has-error':'' }}">
                                    <label>Indicator Name</label><label class="text-danger"> *</label>
                                    {!! Form::text('saf[indicator_name]',null,['class'=>'form-control','placeholder' => 'Indicator Name']) !!}
                                    {!! $errors->first('saf.indicator_name','<span class="text-danger">:message</span>') !!}
                                     </div> 
                               
                                     <div class="form-group col-md-4 {{ ($errors->has('saf.indicator_value'))?'has-error':'' }}">
                                    <label>Indicator Value</label><label class="text-danger"> *</label>
                                    {!! Form::text('saf[indicator_value]',null,['class'=>'form-control','placeholder' => 'Indicator Value']) !!}
                                    {!! $errors->first('saf.indicator_value','<span class="text-danger">:message</span>') !!}
                                     </div> 
                                                    
                                </div> 
                                <div class="form-group col-md-12 {{ ($errors->has('saf.remarks'))?'has-error':'' }}">
                                    <label>Remarks</label>
                                    {!! Form::textarea('saf[remarks]',null,['class'=>'form-control']) !!}
                                    {!! $errors->first('saf.remarks','<span class="text-danger">:message</span>') !!}
                                     </div> 
                                     
                                     <div class="form-group col-md-6 {{ $errors->has('file.*') ? 'has-error' : '' }}">
                                        <label>Uplaod Files</label> <br>
                                       
                                        <input type="file" id="file_upload" name="file[]" multiple /><br/>
                                    </div>
                                    <div class="row" id="image_preview" style="width:100%;"></div>
                                    <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span><br/>
                                        {!! $errors->first('file.*', '<span class="text-danger">:message</span>') !!}                                            
                                   
                                </div>
                                                                   
                                         
                            <!-- /.form group -->
                            <div class="card-footer ">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/safeguardindicators')}}" class="btn btn-danger">Cancel</a>
                                </div>
                                
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
@endsection







