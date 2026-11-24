@extends('backend.layouts.app')
@section('title')
    Projects Environmental Record
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Environment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Environmental Record</li>
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
                        {{-- <h3 class="card-title">{{trans('app.add')}}</h3> --}}
                      
                        <?php

                        $permission = helperPermissionLink(url('project/environmental_monthly_record/create'), url('project/environmental_monthly_record'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                          <nav class="nav nav-tabs">
                            <a class="nav-item nav-link active" href="#safeguard" data-toggle="tab"><b>Safeguard</b></a>
                            <a class="nav-item nav-link" href="#env" data-toggle="tab"><b>Environmental</b></a>
                            <a class="nav-item nav-link" href="#risk" data-toggle="tab"><b>Risk Assessment</b></a>
                            <a class="nav-item nav-link" href="#safety" data-toggle="tab"><b>Safety and Health Facility</b></a>
                            <a class="nav-item nav-link" href="#community" data-toggle="tab"><b>Community Safety</b></a>
                            <a class="nav-item nav-link" href="#issue" data-toggle="tab"><b> Issues and Corrective Actions</b></a>
                            

                        </nav>
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/environmental_monthly_record', 'autocomplete'=>'off', 'role'=>'form', 'files'=>'true','enctype' => 'multipart/form-data']) !!}
                            
                              
                                <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                <div class="form-group col-md-4 {{ ($errors->has('year'))?'has-error':''}}">
                                    <label>Year <label class="text-danger"> *</label></label>
                                        <select class="form-control select2" name="year">
                                            <option value="">Select Year</option>
                                            @foreach($year as $yea)
                                            <option value="{{$yea->fy_name}}">{{$yea->fy_name}}</option>
                                            @endforeach
                                        </select>
                                    {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    <div class="form-group col-md-4 {{ ($errors->has('month'))?'has-error':''}}">
                                        <label> Month <label class="text-danger"> *</label></label>
                                        {{Form::select('month',$month,Request::get('month'),['class'=>'form-control select2','placeholder'=>
                                                                        'Select Month'])}}
                                    {!! $errors->first('month', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>
                                
                            <div class="tab-content">
                            <div class="tab-pane in active" id="safeguard">
                                 <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Safeguard Monitoring Indicators</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($empMonitoringLists as $empData)
                                                <tr>
                                                    <th style="width: 290px;">{{$empData->title}}</th>
                                                    <td>
                                                    <select class="form-control select2" name="types[{{$empData->id}}][status]" style="width: 100px;">
                                                               <option value='' > Status</option>
                                                                <option value="y">Yes</option>
                                                                <option value="n">No</option>
                                                                <option value="na">NA</option>
                                                              
                                                    </select>
                                                    </td>
                                                    <td>{{Form::text('types['.$empData->id.'][result]',null,['class'=>'form-control','placeholder'=>'Result'])}}</td>
                                                    <td>{{Form::textarea('types['.$empData->id.'][remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'])}}</td>
                                                    <td>
                                                       <input type="file" class="" id="images_{{$empData->id}}" name="types[{{$empData->id}}][file]" onchange="preview_images({{$empData->id}});" /><br/>
                                                       <span class="help-block text-danger" > Only jpg, jpeg, png and pdf files are supported</span>

                                                        <div class="row" id="image_preview_{{$empData->id}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                           
                            <div class="tab-pane fade" id="env">

                                 <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Environmental Monitoring Results </strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($envMonitoringLists as $envData)
                                                <tr>
                                                    <th style="width: 290px;">{{$envData->title}} </th>
                                                    <td>
                                                    <select class="form-control select2" name="types[{{$envData->id}}][status]">
                                                               <option value='' selected> Status</option>
                                                                <option value="y">Yes</option>
                                                                <option value="n">No</option>
                                                                <option value="na">NA</option>
                                                    </select>
                                                    </td>
                                                    <td>{{Form::text('types['.$envData->id.'][result]',null,['class'=>'form-control','placeholder'=>'Result'])}}</td>
                                                    <td>{{Form::textarea('types['.$envData->id.'][remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'])}}</td>
                                                    <td>
                                                       <input type="file" class="" id="images_{{$envData->id}}" name="types[{{$envData->id}}][file]" onchange="preview_images({{$envData->id}});" /><br/>
                                                       <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                                        <div class="row" id="image_preview_{{$envData->id}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="risk">
                                
                                 <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Risk assessment of various activities</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($riskLists as $risks)
                                                <tr>
                                                    <th style="width: 290px;">{{$risks->title}} </th>
                                                    <td>
                                                           <select class="form-control select2" name="types[{{$risks->id}}][status]">
                                                               <option value='' selected> Status</option>
                                                                <option value="y">Yes</option>
                                                                <option value="n">No</option>
                                                                <option value="na">NA</option>
                                                              
                                                    </select>
                                                    </td>
                                                    <td>{{Form::text('types['.$risks->id.'][result]',null,['class'=>'form-control','placeholder'=>'Result'])}}</td>
                                                    <td>{{Form::textarea('types['.$risks->id.'][remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'])}}</td>
                                                    <td>
                                                       <input type="file" class="" id="images_{{$risks->id}}" name="types[{{$risks->id}}][file]" onchange="preview_images({{$risks->id}});" /><br/>
                                                       <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                                        <div class="row" id="image_preview_{{$risks->id}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="safety">

                                 <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>The Safety and Health Facility</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($safetyLists as $safety)
                                                <tr>
                                                    <th style="width: 290px;">{{$safety->title}} </th>
                                                    <td>
                                                    <select class="form-control select2" name="types[{{$safety->id}}][status]">
                                                               <option value='' selected> Status</option>
                                                                <option value="y">Yes</option>
                                                                <option value="n">No</option>
                                                                <option value="na">NA</option>
                                                              
                                                    </select>
                                                    </td>
                                                    <td>{{Form::text('types['.$safety->id.'][result]',null,['class'=>'form-control','placeholder'=>'Result'])}}</td>
                                                    <td>{{Form::textarea('types['.$safety->id.'][remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'])}}</td>
                                                    <td>
                                                       <input type="file" class="" id="images_{{$safety->id}}" name="types[{{$safety->id}}][file]" onchange="preview_images({{$safety->id}});" /><br/>
                                                       <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                                        <div class="row" id="image_preview_{{$safety->id}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="community">

                                 <div class="row">
                                     <h3 class="col-md-12">
                                        <p style="text-align: center;font-size: 18px;">
                                            <strong>Community Safety</strong>
                                        </p>
                                    </h3>
                                        <table class="table table-striped table-bordered table-hover table-responsive ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Status</th>
                                                    <th>Result</th>
                                                    <th>Remarks</th>
                                                    <th>Files</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($communityLists as $community)
                                                <tr>
                                                    <th style="width: 290px;">{{$community->title}} </th>
                                                    <td>
                                                    <select class="form-control select2" name="types[{{$community->id}}][status]">
                                                               <option value='' selected> Status</option>
                                                                <option value="y">Yes</option>
                                                                <option value="n">No</option>
                                                                <option value="na">NA</option>
                                                              
                                                    </select>
                                                    </td>
                                                    <td>{{Form::text('types['.$community->id.'][result]',null,['class'=>'form-control','placeholder'=>'Result'])}}</td>
                                                    <td>{{Form::textarea('types['.$community->id.'][remarks]',null,['class'=>'form-control','placeholder'=>'Remarks','rows'=>'2'])}}</td>
                                                    <td>
                                                       <input type="file" class="" id="images_{{$community->id}}" name="types[{{$community->id}}][file]" onchange="preview_images({{$community->id}});" /><br/>
                                                       <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                                        <div class="row" id="image_preview_{{$community->id}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                        
                                            </tbody>

                                        </table>
 
                                </div>
                            </div>
                            <div class="tab-pane fade" id="issue">
                                 <div class="row">
                               
                                        <div class="form-group col-md-12 ">
                                           <label>Major Issues/Concern</label>
                                              {!! Form::textarea('types['.$issuesLists[0]['id'].'][issue]', null, ['class' => 'form-control', 'placeholder'=> 'Issues', 'rows' => '5']) !!}
                                         
                                       </div>
                                        <div class="form-group col-md-12">
                                           <label>Corrective Action</label>
                                              {!! Form::textarea('types['.$issuesLists[0]['id'].'][action]', null, ['class' => 'form-control', 'placeholder'=> 'Actions', 'rows' => '5']) !!}
                                             {!! $errors->first('action', '<span class="text-danger">:message</span>') !!}
                                         
                                       </div>
                                        <div class="form-group col-md-4  {{ $errors->has('responsible_body') ? 'has-error' : '' }}">
                                           <label>Responsible Body</label>
                                              {!! Form::text('types['.$issuesLists[0]['id'].'][responsible_body]', null, ['class' => 'form-control', 'placeholder'=> 'Responsible Body']) !!}
                                             {!! $errors->first('responsible_body', '<span class="text-danger">:message</span>') !!}
                                         
                                       </div>
                                        <div class="form-group col-md-4  {{ $errors->has('target_time') ? 'has-error' : '' }}">
                                           <label>Target Timeline</label>
                                              {!! Form::text('types['.$issuesLists[0]['id'].'][target_time]', null, ['class' => 'form-control', 'placeholder'=> 'Target Timeline']) !!}
                                             {!! $errors->first('target_time', '<span class="text-danger">:message</span>') !!}
                                         
                                       </div>
                                        <div class="form-group col-md-4  {{ $errors->has('result') ? 'has-error' : '' }}">
                                           <label>Status</label>
                                           <select class="form-control select2" name="types[{{$issuesLists[0]->id}}][status]">
                                            <option value='' selected> Status</option>
                                             <option value="y">Yes</option>
                                             <option value="n">No</option>
                                             <option value="na">NA</option>
                                           
                                 </select>
                                         
                                       </div>
                                       <div class="form-group col-md-12  {{ $errors->has('remarks') ? 'has-error' : '' }}">
                                        <label>Remarks</label>
                                           {!! Form::textarea('types['.$issuesLists[0]['id'].'][remarks]', null, ['class' => 'form-control', 'placeholder'=> 'Remarks', 'rows' => '5']) !!}
                                          {!! $errors->first('remarks', '<span class="text-danger">:message</span>') !!}
                                      
                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="file" class="" id="images_{{$issuesLists[0]->id}}" name="types[{{$issuesLists[0]->id}}][file]" onchange="preview_images({{$issuesLists[0]->id}});" /><br/>
                                        <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span>

                                         <div class="row" id="image_preview_{{$issuesLists[0]->id}}">
                                         </div>
                                       

                                </div>
                            </div>
                         
                        </div>
                        <div class="card-footer pull-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{url('/project/environmental_monthly_record')}}" class="btn btn-danger">cancel</a>
                        
                    </div>

                            <!-- /.form group -->
                            
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
       function preview_images(id) {
           var div_id= 'images_'+id;
            var total_file = document.getElementById(div_id).files.length;

            for (var i = 0; i < total_file; i++) {
                if(event.target.files[i].type=='application/pdf'){
                    $('#image_preview_'+id).append("<div class='col-md-2'><embed src='"+URL.createObjectURL(event.target.files[i])+"' class='img-responsive' title=''  style='height:140px; width:140px;'></div>");

                }else{

                $('#image_preview_'+id).append("<div class='col-md-2'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "' style='width: 100px;height: 100px;' width='100' height='100'></div>");
                }
            }
        }
    </script>
  @endsection  







