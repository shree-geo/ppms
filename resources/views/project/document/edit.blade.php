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
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Document</li>
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

                        $permission = helperPermissionLink(url('project/document/create'), url('project/document'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowEdit)

                            {!! Form::model($edits,['method'=>'put','route' => ['document.update',$edits['doc']->id], 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                            {{-- {{dd($edits)}} --}}
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-6 {{ ($errors->has('doc.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('doc[project_id]',$projects->pluck('name','id'),Request::get('doc.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('doc.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                     <div class="form-group col-md-6 {{ ($errors->has('doc.cat_id'))?'has-error':'' }}">
                                        <label>Category<label class="text-danger">*</label></label>
                                        {{Form::select('doc[cat_id]',$categories->pluck('cat_name','id'),Request::get('doc.cat_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'cat_id','placeholder'=>
                                        'Select Category Name'])}}
                                        {!! $errors->first('doc.cat_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 {{ ($errors->has('doc.doc_title'))?'has-error':'' }}">
                                    <label>Title<label class="text-danger">*</label></label>
                                    {!! Form::text('doc[doc_title]',null,['class'=>'form-control','placeholder' => 'Title']) !!}
                                    {!! $errors->first('doc.doc_title','<span class="text-danger">:message</span>') !!}
                                    </div>

                                    <div class="form-group col-md-6 {{ ($errors->has('doc.external_link'))?'has-error':'' }}">
                                        <label>External <label>Links</label></label>
                                        {!! Form::text('doc[external_link]',null,['class'=>'form-control','placeholder' => 'Enter External Link']) !!}
                                        {!! $errors->first('doc.external_link','<span class="text-danger">:message</span>') !!}
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-4"{{($errors->has('doc.signed_date'))?'has-error':''}}>
                                    <label>Signed Date</label>
                                    {{ Form::date('doc[signed_date]',null,['class'=>'form-control','placeholder'=>'Enter Signed Date'])}}
                                      {!! $errors->first('doc.signed_date', '<span class="text-danger">:message</span>') !!}
                                    </div>

                                    <div class="form-group col-md-4"{{($errors->has('doc.approved_date'))?'has-error':''}}>
                                    <label>Approved Date</label>
                                    {{ Form::date('doc[approved_date]',null,['class'=>'form-control','placeholder'=>'Enter Approved Date'])}}
                                      {!! $errors->first('doc.approved_date', '<span class="text-danger">:message</span>') !!}
                                    </div>

                                    <div class="form-group col-md-4"{{($errors->has('doc.clearance_date'))?'has-error':''}}>
                                    <label>Clearance Date</label>
                                    {{ Form::date('doc[clearance_date]',null,['class'=>'form-control','placeholder'=>'Enter Clearance Date'])}}
                                      {!! $errors->first('doc.clearance_date', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                </div>

                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('doc.file') ? 'has-error' : '' }}">
                                        <label>Files</label>
                                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                                        <span class="help-block text-danger"> Only pdf, jpg, jpeg and png files are supported</span>

                                        {!! $errors->first('doc.file', '<span class="text-danger">:message</span>') !!}

                                    </div>
                                </div>
                            </div>
                            <?php
                            $files=json_decode($edits['doc']->file);
                            ?>

                        @if($files)
                                @foreach ($files as  $doc_file)
                            <div class="row">
                                <a href="{{ asset('storage/uploads/' . $edits['doc']->cat_id. '/'. $edits['doc']->project_id. '/document'.'/'. $doc_file) }}"
                                    target="_blank">{{ $doc_file }}</a>
                                </div>
                                @endforeach
                            @endif
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/document')}}" class="btn btn-danger">cancel</a>
                                
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
 <script>
     var previewimage={!! json_encode($edits) !!};
      
      var imageloaded=JSON.parse(previewimage.doc.file);
      var id=0;
      var src=0;
 var preloaded=[];

 for (const key in imageloaded) {
    
         var arrayImage={
             id:key,
             src: `${baseurl}/storage/uploads/${previewimage.doc.cat_id}/${previewimage.doc.project_id}/document/${imageloaded[key]}`,

         };
        preloaded.push(arrayImage);
         
         
    
 }


$('.input-images-2').imageUploader({
    preloaded: preloaded,
    imagesInputName: 'photos',
    preloadedInputName: 'old',
    maxSize: 20 * 1024 * 1024,
    maxFiles: 10,
    extensions: [".jpg", ".jpeg", ".png", ".pdf"],
    mimes: ["image/jpeg", "image/png", "application/pdf"],
});





    </script>
  @endsection  







