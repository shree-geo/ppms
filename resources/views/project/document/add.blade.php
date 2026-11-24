@extends('backend.layouts.app')
@section('title')
    Projects Document
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Documents</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Document</li>
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
                        $permission = helperPermissionLink(url('project/document/create'), url('project/document'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/document', 'autocomplete' => 'off', 'role' => 'form', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-6 {{ $errors->has('doc.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('doc[project_id]', $projects->pluck('name', 'id'), Request::get('doc.project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('doc.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif
                                <div class="form-group col-md-6 {{ $errors->has('doc.cat_id') ? 'has-error' : '' }}">
                                    <label>Category<label class="text-danger">*</label></label>
                                    {{ Form::select('doc[cat_id]', $categories->pluck('cat_name', 'id'), Request::get('doc.cat_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'cat_id', 'placeholder' => 'Select Category Name']) }}
                                    {!! $errors->first('doc.cat_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('doc.doc_title') ? 'has-error' : '' }}">
                                    <label>Title<label class="text-danger">*</label></label>
                                    {!! Form::text('doc[doc_title]', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    {!! $errors->first('doc.doc_title', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-6 {{ $errors->has('doc.external_link') ? 'has-error' : '' }}">
                                    <label>External <label>Links</label></label>
                                    {!! Form::text('doc[external_link]', null, ['class' => 'form-control', 'placeholder' => 'Enter External Link']) !!}
                                    {!! $errors->first('doc.external_link', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4" {{ $errors->has('doc.signed_date') ? 'has-error' : '' }}>
                                    <label>Signed Date</label>
                                    {{ Form::text('doc[signed_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Date Format - 2021-03-11']) }}
                                    {!! $errors->first('doc.signed_date', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4" {{ $errors->has('doc.approved_date') ? 'has-error' : '' }}>
                                    <label>Approved Date</label>
                                    {{ Form::text('doc[approved_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Date Format - 2021-03-11']) }}
                                    {!! $errors->first('doc.approved_date', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-4" {{ $errors->has('doc.clearance_date') ? 'has-error' : '' }}>
                                    <label>Clearance Date</label>
                                    {{ Form::text('doc[clearance_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Date Format - 2021-03-11']) }}
                                    {!! $errors->first('doc.clearance_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('doc.file') ? 'has-error' : '' }}">
                                        <label>Files</label>
                                       
                                        <div class="input-images-1" style="padding-top: .5rem;"></div>
                                 
                                        
                                        <span class="help-block text-danger"> Only pdf, jpg, jpeg and png files are
                                            supported</span>
                                        {!! $errors->first('doc.file', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                </div>
                            </div>





                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/document') }}" class="btn btn-danger">cancel</a>

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
    {{-- <script>
        function preview_images() {
            var total_file = document.getElementById("images").files.length;

            for (var i = 0; i < total_file; i++) {
                // var id='img_'+i;
                // var start_div=`<div class='col-md-2' id=${id}><a href='#' ><i class='fa fa-close' onclick='deleteImage(${i})'></i></a>`;
                // var end_div= "<img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "' style='width: 100px;height: 100px;' width='100' height='100'></div>";
                $('#image_preview').append("<div class='col-md-2'><img class='img-responsive' src='" + URL.createObjectURL(
                        event.target.files[i]) +
                    "' style='width: 100px;height: 100px;' width='100' height='100'></div>");
            }
        }

        // function deleteImage(id){
        //     var image_id='img_'+id;
        //     var div= document.getElementById(image_id);
        //     var parent= document.getElementById('image_preview');
        //     parent.removeChild(div); 
        // }

    </script> --}}
    <script>
        $('.input-images-1').imageUploader({
            imagesInputName: 'images',
    maxSize: 20 * 1024 * 1024,
    maxFiles: 10,
    extensions: [".jpg", ".jpeg", ".png", ".pdf"],
    mimes: ["image/jpeg", "image/png", "application/pdf"],

        });
      
        </script>
   @endsection
