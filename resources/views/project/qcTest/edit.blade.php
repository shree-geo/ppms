@extends('backend.layouts.app')
@section('title')
    QC Test
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>QC Test</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                          <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">QC Test</li>
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
                        <?php

                        $permission = helperPermissionLink(url('project/qcTest/create'), url('project/qcTest'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                
                    </div>

                    <div class="card-body">
                        @if($allowEdit)
                        
                        {!! Form::model($edits,['method'=>'put','route'=>['qcTest.update',$edits['qcTest']->id], 'autocomplete'=>'off', 'role'=>'form','files'=>'true','enctype' => 'multipart/form-data']) !!}
                                                  
                        
                            <div class="row">
                                @if (auth()->user()->user_group_id!=2)
                                <div class="form-group col-md-3 {{ $errors->has('qcTest.project_id') ? 'has-error' : '' }}">
                                    <label>Project<label class="text-danger"> *</label></label>
                                    {{ Form::select('qcTest[project_id]', $projects->pluck('name', 'id'), Request::get('qcTest.project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                    {!! $errors->first('qcTest.project_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                                @endif
                                  <div class="form-group col-md-3 {{ ($errors->has('qcTest.year'))?'has-error':''}}">
                                    <label>Year <label class="text-danger"> *</label></label>
                                        <select class="form-control select2" name="qcTest[year]">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yea)
                                            <option value="{{$yea->fy_name}}" {{$edits['qcTest']->year==$yea->fy_name?'selected':''}}>{{$yea->fy_name}}</option>
                                            @endforeach
                                        </select>
                                    {!! $errors->first('qcTest.year', '<span class="text-danger">:message</span>') !!}
                                    </div> 
                                    <div class="form-group col-md-3 {{ ($errors->has('qcTest.month'))?'has-error':''}}">
                                    <label> Month <label class="text-danger"> *</label></label>
                                    {{Form::select('qcTest[month]',$month,Request::get('qcTest.month'),['class'=>'form-control select2','id'=>'month','placeholder'=>'Select Month'])}}
                                    {!! $errors->first('qcTest.month', '<span class="text-danger">:message</span>') !!}
                                    </div>

                                    <div class="form-group col-md-3 {{ $errors->has('qcTest.material_id') ? 'has-error' : '' }}">
                                        <label>Material Name<label class="text-danger"> *</label></label>
                                        {{ Form::select('qcTest[material_id]', $materials->pluck('material_name', 'id'), Request::get('qcTest.material_id'), ['class' => 'form-control select2', 'id' => 'material_id', 'placeholder' => 'Select Material']) }}
                                        {!! $errors->first('qcTest.material_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-3 {{ $errors->has('qcTest.test_type_id') ? 'has-error' : '' }}">
                                        <label>Test Type<label class="text-danger"> *</label></label>
                                        <select class="form-control select2" name="qcTest[test_type_id]" id="test_type_id">
                                            <option vlaue="">Select Test Type</option>
                                        </select>
                                        {!! $errors->first('qcTest.test_type_id', '<span class="text-danger">:message</span>') !!}
                                    </div>

                                
                
                               
                               
                                <div class="form-group col-md-3 {{ $errors->has('qcTest.test_by') ? 'has-error' : '' }}">
                                    <label>Tested By
                                        <label class="text-danger"> *</label>
                                    </label>
                                    {!! Form::text('qcTest[test_by]', null, ['class' => 'form-control', 'placeholder' => 'Tested By']) !!}
                                    {!! $errors->first('qcTest.test_by', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('qcTest.test_date') ? 'has-error' : '' }}">
                                    <label>Test Date
                                        <label class="text-danger"> *</label>
                                    </label>
                                    {!! Form::text('qcTest[test_date]', null, ['class' => 'form-control datepicker', 'placeholder' => 'Example: 2021-01-01']) !!}
                                    {!! $errors->first('qcTest.test_date', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-3 {{ $errors->has('qcTest.followed_code') ? 'has-error' : '' }}">
                                    <label>Code Followed<label class="text-danger"> *</label></label>
                                    {!! Form::text('qcTest[followed_code]', null, ['class' => 'form-control', 'placeholder' => 'Code Followed']) !!}
                                    {!! $errors->first('qcTest.followed_code', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 {{ ($errors->has('qcTest.test_location'))?'has-error':'' }}">
                                        <label>Test Location<label class="text-danger"> *</label></label>
                                        <select id="test_location" name="qcTest[test_location]" class="form-control select2">
                                            <option value="" selected>Select</option>
                                            <option value="site" {{$edits['qcTest']->test_location=='site'?'selected':''}}>Site</option>
                                            <option value="lab" {{$edits['qcTest']->test_location=='lab'?'selected':''}}>Laboratory</option>
                                        </select>
                                        {!! $errors->first('qcTest.test_location','<span class="text-danger">:message</span>') !!}
                                </div>
                                
                                <div class="form-group col-md-3 {{ ($errors->has('qcTest.result'))?'has-error':'' }}">
                                        <label>Required Result <label class="text-danger"> *</label></label>
                                        {{Form::text('qcTest[result]',null,['class'=>'form-control','placeholder'=>'Required Result'])}}

                                        {!! $errors->first('qcTest.result','<span class="text-danger">:message</span>') !!}
                                </div>

                            
                          
                            <div class="form-group col-md-3 {{ ($errors->has('qcTest.obaserved_result'))?'has-error':''}}">
                                <label>Observed Result<label class="text-danger"> *</label></label>
                                {{Form::text('qcTest[obaserved_result]',null,['class'=>'form-control','placeholder'=>'Observed Result'])}}
                                {!! $errors->first('qcTest.obaserved_result', '<span class="text-danger">:message</span>') !!}
                            </div> 
                            <div class="form-group col-md-3 {{ ($errors->has('qcTest.output_result'))?'has-error':''}}">
                                <label>Result<label class="text-danger"> *</label></label>
                                {{Form::text('qcTest[output_result]',null,['class'=>'form-control','placeholder'=>'Result'])}}
                                {!! $errors->first('qcTest.output_result', '<span class="text-danger">:message</span>') !!}
                            </div> 
                        </div>

                            <div class="row">
                                <div class="form-group col-md-12 {{ ($errors->has('qcTest.remarks'))?'has-error':''}}">
                                    <label>Remarks</label>
                                    {{Form::textarea('qcTest[remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'5'])}}
                                    {!! $errors->first('qcTest.remarks', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('qcTest.report_file') ? 'has-error' : '' }}">
                                    <label>Files</label> <br>
                                    <input type="file" class="" id="report_file" name="report_file[]" multiple/><br/>
                                    <span class="help-block"> Only jpg, jpeg and pdf files are supported</span>
                                        {!! $errors->first('qcTest.report_file', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                            <div class="row" id="image_preview" style="width:100%;"></div><br>
                            @if($edits['qcTest']->report_file!=null)
                                <?php $files = json_decode($edits['qcTest']->report_file);  ?>
                                <div class="row">
                                    @foreach($files as $key=>$val)
                                    <?php $extension = explode('.', $val); ?>
                                    @if ($extension[1] == 'pdf')
                                        <a href="{{asset('/storage/uploads/qcTestReport/' . $val) }}" target="_blank"><iframe frameborder="0" scrolling="no" src="{{asset('/storage/uploads/qcTestReport/'. $val)}}" style="height:100px; width:150px;overflow:hidden;pointer-events: none; "></iframe><br>{{$val}}</a>&nbsp;
                                        <a href="{{url('delete/qcTest/'.$edits['qcTest']->id.'/'.$val)}}" id="x-edit">
                                            <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                        </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    @else
                                        <div class="col-md-2" >
                                            <img src="{{asset('/storage/uploads/qcTestReport' . '/' . $val)}}" style="height:100px; width:100px;">
                                            <a href="{{url('delete/qcTest/'.$edits['qcTest']->id.'/'.$val)}}" id="x-edit">
                                            <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                             @else
                                No File Available
                             @endif
                            <!-- /.form group -->
                                               
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/project/qcTest')}}" class="btn btn-danger">cancel</a>                                
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
     $(document).ready(function() {
  var fileArr = [];
   $("#report_file").change(function(){
       if (fileArr.length > 0) fileArr = [];
     
        $('#image_preview').html("");
        var total_file = document.getElementById("report_file").files;
        if (!total_file.length) return;
        for (var i = 0; i < total_file.length; i++) {
          if (total_file[i].size > 1048576) {
            return false;
          } else {
            fileArr.push(total_file[i]);
            $('#image_preview').append("<div class='img-div' id='img-div"+i+"'><div class='pull-right'><button id='action-icon' value='img-div"+i+"' class='btn btn-danger btn-sm' role='"+total_file[i].name+"'><i class='fa fa-close'></i></button>&nbsp;&nbsp;</div><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive' title='"+total_file[i].name+"' style='width: 100px;height: 100px;' width='100' height='100'></div>");
          }
        }
   });
  
  $('body').on('click', '#action-icon', function(evt){
      var divName = this.value;
      var fileName = $(this).attr('role');
      $(`#${divName}`).remove();
    
      for (var i = 0; i < fileArr.length; i++) {
        if (fileArr[i].name === fileName) {
          fileArr.splice(i, 1);
        }
      }
    document.getElementById('report_file').files = FileListItem(fileArr);
      evt.preventDefault();
  });
  
   function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }
});
 </script>

<script>
    var parentlist= {!! json_encode($test_types)!!};
   
   $(document).ready(function () {
       var edits= {!! json_encode($edits) !!};
       var parentColl= parentlist[edits['qcTest']['material_id']];
        $('#test_type_id').html('');
        $('#test_type_id').append('<option value="" selected disabled>Select Test Type</option>');
        for(var key in parentColl){
            if(edits['qcTest']['test_type_id']==parentColl[key]['id']){
              $('#test_type_id').append(`<option value="${parentColl[key]['id']}" selected>${parentColl[key]['test_name']}</option>`); 
            }else{
                 $('#test_type_id').append(`<option value="${parentColl[key]['id']}">${parentColl[key]['test_name']}</option>`);
            }

        }
   });
</script>
<script>
    $('#material_id').change(function(){
        var material_id= $('#material_id').val();
        var parentColl= parentlist[material_id];
        $('#test_type_id').html('');
        $('#test_type_id').append('<option value="" selected disabled>Select Test Type</option>');
        for(var key in parentColl){
            $('#test_type_id').append(`<option value="${parentColl[key]['id']}">${parentColl[key]['test_name']}</option>`);

        }
    })
</script>
@endsection






