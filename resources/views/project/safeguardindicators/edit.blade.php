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

                        {!! Form::model($edits,['method'=>'put','route'=>['safeguardindicators.update',$edits['saf']->id], 'autocomplete'=>'off', 'role'=>'form', 'enctype' => 'multipart/form-data','file'=>true]) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('saf.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('saf[project_id]',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('saf.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                         <div class="form-group col-md-4 {{ ($errors->has('saf.indicator_name'))?'has-error':'' }}">
                                            <label>Indicator Name <label class="text-danger"> *</label></label>
                                            {!! Form::text('saf[indicator_name]',null,['class'=>'form-control','placeholder' => 'Indicator Value']) !!}
                                            {!! $errors->first('saf.indicator_name','<span class="text-danger">:message</span>') !!}
                                        </div> 
                                    <div class="form-group col-md-4 {{ ($errors->has('saf.indicator_value'))?'has-error':'' }}">
                                        <label>Indicator Value <label class="text-danger"> *</label></label>
                                        {!! Form::text('saf[indicator_value]',null,['class'=>'form-control','placeholder' => 'Indicator Value']) !!}
                                        {!! $errors->first('saf.indicator_value','<span class="text-danger">:message</span>') !!}
                                    </div> 
                                    
                                                    
                                </div> 
                                <div class="form-group col-md-12 {{ ($errors->has('saf.remarks'))?'has-error':'' }}">
                                    <label>Remarks</label>
                                    {!! Form::textarea('saf[remarks]',null,['class'=>'form-control']) !!}
                                    {!! $errors->first('saf.remarks','<span class="text-danger">:message</span>') !!}
                                     </div> 
                                     <div class="form-group col-md-12 {{ ($errors->has('file'))?'has-error':'' }}">
                                        <label>Upload File</label> <br>                                        
                                        <input type="file" class="" id="file_upload" name="file[]" multiple onchange="preview_images();"/><br/>
                                        <span class="help-block text-danger font-italic text-bold mt-2"> Only jpg, jpeg and pdf files are supported</span> <br/>
                                            {!! $errors->first('saf.file', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                        <div class="row" id="image_preview" style="width:100%;"></div>
                                        @if($edits['saf']->file!=null)
                                        <?php $files = json_decode($edits['saf']->file);  ?>
                                        <div class="row">
                                            @foreach($files as $key=>$val)
                                            <?php $extension = explode('.', $val); ?>
                                            <div class="col-md-2 m-3" >
                                            
                                                @if ($extension[1] == 'pdf')
                                                
                                                <a href="{{url('delete/safeguard/'.$edits['saf']->id.'/'.$val)}}" id="x-edit">
                                                    <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                                </a>&nbsp;&nbsp;
                                                <a href="{{asset('/storage/uploads/safeguardindicator/file/' . $val) }}">{{$val}}</a>&nbsp;
                                            @else                                          
                                          
                                                <a href="{{url('delete/safeguard/'.$edits['saf']->id.'/'.$val)}}" id="x-edit">
                                                <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                            </a>
                                                <img src="{{asset('/storage/uploads/safeguardindicator/file/'. $val)}}" style="height:140px; object-fit: cover;">
                                            </div>
                                            @endif
                                            @endforeach
                                          
                                        </div>
                                     @else
                                        No Photo Available
                                     @endif
                                    </div>
                            <!-- /.form group -->
                            <div class="card-footer col-md-12">
                                <div class=" pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/safeguardindicators')}}" class="btn btn-danger">Cancel</a>
                                </div
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








