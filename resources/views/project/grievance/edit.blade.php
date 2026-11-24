@extends('backend.layouts.app')
@section('title')
    Projects Grievance
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Grievance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Grievance</li>
                            <li class="breadcrumb-item active">{{ trans('app.edit') }}</li>
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
                        <h3 class="card-title">{{ trans('app.edit') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/grievance_detail/create'), url('project/grievance_detail'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)

                            {!! Form::model($edits,['method' => 'put', 'route' => ['grievance_detail.update',$edits->id], 'autocomplete' => 'off',
                            'role' => 'form','enctype' => 'multipart/form-data','file'=>true]) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>')!!}
                                    </div>
                                @endif

                            </div>
                           
                            <div class="row">
                                 <div class="form-group col-md-12  {{ $errors->has('issue') ? 'has-error' : '' }}">
                                    <label>Issues<label class="text-danger">*</label></label>
                                       {!! Form::textarea('issue', null, ['class' => 'form-control', 'placeholder'=> 'Issues', 'rows' => '5']) !!}
                                       {!! $errors->first('issue', '<span class="text-danger">:message</span>') !!}
                                  
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('grievance_level') ? 'has-error' : '' }}">
                                    <label>Grievance Level</label>
                                    {!! Form::select('grievance_level', ['first' => 'First Level', 'second' => 'Second Level','third'=>'Third Level'], null, ['class'=>'form-control select2','placeholder' => 'Select Grievance Level']) !!}

                                    {!! $errors->first('grievance_level', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('complain_by') ? 'has-error' : '' }}">
                                    <label>Complain By</label><label class="text-danger">*</label>
                                    {!! Form::text('complain_by', null, ['class' => 'form-control ', 'placeholder' => 'Name'])!!}
                                    {!! $errors->first('complain_by', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('complain_date') ? 'has-error' : '' }}">
                                    <label>Complain Date</label><label class="text-danger">*</label>
                                    {!! Form::text('complain_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Complain Date'])!!}
                                    {!! $errors->first('complain_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('complain_source') ? 'has-error' : '' }}">
                                    <label>Complain Source <label class="text-danger"> *</label></label>                                
                                    {!! Form::select('complain_source', ['verbal' => 'Verbal', 'written' => 'Written'], null, ['class'=>'form-control select2','placeholder' => 'Select a Complain Source']) !!}
                                    {!! $errors->first('complain_source','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('affected_site') ? 'has-error' : '' }}">
                                    <label>Affected Site/Location</label><label class="text-danger">*</label>
                                    {!! Form::text('affected_site', null, ['class' => 'form-control ', 'placeholder' => 'Affected Site/Location'])!!}
                                    {!! $errors->first('affected_site', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-4 {{ $errors->has('current_status') ? 'has-error' : '' }}">
                                    <label>Current Status</label>
                                    {!! Form::select('current_status', ['pending'=>'Pending','in_process'=>'In Process','solved'=>'Solved','discard'=>'Discard'],null, ['class' => 'form-control ', 'placeholder' => 'Current Status'])!!}
                                    {!! $errors->first('current_status', '<span class="text-danger">:message</span>') !!}
                                </div>
                                 <div class="form-group col-md-6  {{ $errors->has('action_taken') ? 'has-error' : '' }}">
                                    <label>Action Taken to solve</label>
                                       {!! Form::textarea('action_taken', null, ['class' => 'form-control', 'placeholder'=> 'Action taken to solve', 'rows' => '5']) !!}
                                       {!! $errors->first('action_taken', '<span class="text-danger">:message</span>') !!}
                                  
                                </div>
                                 <div class="form-group col-md-6  {{ $errors->has('remarks') ? 'has-error' : '' }}">
                                    <label>Remarks</label>
                                       {!! Form::textarea('remarks', null, ['class' => 'form-control', 'placeholder'=> 'Remarks', 'rows' => '5']) !!}
                                       {!! $errors->first('remarks', '<span class="text-danger">:message</span>') !!}
                                  
                                </div>
                                <div class="form-group col-md-12 {{ ($errors->has('files'))?'has-error':'' }}">
                                    <label>Upload File</label> <br>                                        
                                    <input type="file" class="" id="file_upload" name="files[]" multiple onchange="preview_images();"/><br/>
                                    <span class="help-block text-danger font-italic text-bold mt-2"> Only jpg, jpeg and pdf files are supported</span> <br/>
                                        {!! $errors->first('files', '<span class="text-danger">:message</span>') !!}
                                </div>
                                    <div class="row" id="image_preview" style="width:100%;"></div>
                                    @if($edits->files!=null)
                                    <?php $files = json_decode($edits->files);  ?>
                                    <div class="row">
                                        @foreach($files as $key=>$val)
                                        <?php $extension = explode('.', $val); ?>
                                        <div class="col-md-12" >
                                        
                                            @if ($extension[1] == 'pdf')
                                            
                                            <a href="{{url('delete/grievances/'.$edits->id.'/'.$val)}}" id="x-edit">
                                                <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                            </a>
                                            <a href="{{asset('/storage/uploads/grievance/file/' . $val) }}"> {{$val}}</a>&nbsp;
                                        @else                                          
                                      
                                            <a href="{{url('delete/grievances/'.$edits->id.'/'.$val)}}" id="x-edit">
                                            <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                        </a>
                                            <img src="{{asset('/storage/uploads/grievance/file/'. $val)}}" style="height:140px; object-fit: cover;">
                                        </div>
                                        @endif
                                        @endforeach
                                      
                                    </div>
                                 @else
                                    No Photo Available
                                 @endif

                            </div>
                    </div>
                          
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/grievance_detail') }}" class="btn btn-danger">Cancel</a>

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

@section('js')
<script src={{url("js/pdfpreview.js")}}>  </script>
@endsection