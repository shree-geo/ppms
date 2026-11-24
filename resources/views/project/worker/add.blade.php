@extends('backend.layouts.app')
@section('title')
    Projects Worker
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Worker</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Worker</li>
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

                        $permission = helperPermissionLink(url('project/worker/create'), url('project/worker'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/worker', 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('worker.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('worker[project_id]',$projects->pluck('name','id'),Request::get('worker.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('worker.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                                    <div class="form-group col-md-3 {{ ($errors->has('worker.year'))?'has-error':''}}">
                                        <label>Year <label class="text-danger"> *</label></label>
                                            <select class="form-control select2" name="worker[year]">
                                                <option value="">Select Year</option>
                                                @foreach($year as $yea)
                                                <option value="{{$yea->fy_name}}" {{ Request::old('worker.year') == $yea->fy_name ? 'selected' : '' }}>{{$yea->fy_name}}</option>
                                                @endforeach
                                            </select>
                                        {!! $errors->first('worker.year', '<span class="text-danger">:message</span>') !!}
                                        </div>
                                         <div class="form-group col-md-3 {{ ($errors->has('worker.month'))?'has-error':''}}">
                                        <label> Month <label class="text-danger"> *</label></label>
                                        {{Form::select('worker[month]',$month,Request::get('worker.month'),['class'=>'form-control select2','id'=>'month','placeholder'=>'Select Month'])}}
                                        {!! $errors->first('worker.month', '<span class="text-danger">:message</span>') !!}
                                        </div>
                            
                                </div>
                                <h3 class="text-center"> Worker Details</h3>

                                <div class="row">
                                    <table class="table table-bordered col-md-12">
                                     <thead>
                                         <th></th>
                                         <th>Braman/Chetri</th>
                                         <th>Janjati</th>
                                      <th>Dalit</th>
                                      <th>Muslim</th>
                                      <th>Others</th>
                                      <th>Local</th>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th>Male</th>
                                               <td class="{{ ($errors->has('worker.bramin_m'))?'has-error':'' }}">  
                                                   {!! Form::number('worker[bramin_m]',null,['class'=>'form-control','placeholder' => 'Braman/Chetri Male','min'=>'0']) !!}
                                                  {!! $errors->first('worker.bramin_m','<span class="text-danger">:message</span>') !!}
                                                </td>
                                                <td class="{{ ($errors->has('worker.janjati_m'))?'has-error':'' }}">
                                                    {!! Form::number('worker[janjati_m]',null,['class'=>'form-control','placeholder' => 'Janajati Male','min'=>'0']) !!}
                                                    {!! $errors->first('worker.janjati_m','<span class="text-danger">:message</span>') !!}
                                               </td>
                                             <td class="{{ ($errors->has('worker.dalit_m'))?'has-error':'' }}"> 
                                                  {!! Form::number('worker[dalit_m]',null,['class'=>'form-control','placeholder' => 'Dalit Male','min'=>'0']) !!}
                                                  {!! $errors->first('worker.dalit_m','<span class="text-danger">:message</span>') !!}
                                             </td>
                                             <td class="{{ ($errors->has('worker.muslim_m'))?'has-error':'' }}"> 
                                                 {!! Form::number('worker[muslim_m]',null,['class'=>'form-control','placeholder' => 'Muslim Male','min'=>'0']) !!}
                                                 {!! $errors->first('worker.muslim_m','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('worker.others_m'))?'has-error':'' }}">  
                                                {!! Form::number('worker[others_m]',null,['class'=>'form-control','placeholder' => 'Others Male','min'=>'0']) !!}
                                                {!! $errors->first('worker.others_m','<span class="text-danger">:message</span>') !!}
                                              </td>
                                              <td class="{{ ($errors->has('worker.local_m'))?'has-error':'' }}">
                                                {!! Form::number('worker[local_m]',null,['class'=>'form-control','placeholder' => 'Local Male','min'=>'0']) !!}
                                                {!! $errors->first('worker.local_m','<span class="text-danger">:message</span>') !!}
                                              </td>
                                           </tr>
                                           <tr>
                                               <th>Female</th>
                                               <td class="{{ ($errors->has('worker.bramin_f'))?'has-error':'' }}"> 
                                                {!! Form::number('worker[bramin_f]',null,['class'=>'form-control','placeholder' => 'Braman/Chetri Female','min'=>'0']) !!}
                                                 {!! $errors->first('worker.bramin_f','<span class="text-danger">:message</span>') !!}
                                           </td>
                                           <td class="{{ ($errors->has('worker.janjati_f'))?'has-error':'' }}">
                                            {!! Form::number('worker[janjati_f]',null,['class'=>'form-control','placeholder' => 'Janajati Female','min'=>'0']) !!}
                                            {!! $errors->first('worker.janjati_f','<span class="text-danger">:message</span>') !!}
                                          </td>
                                              <td class="{{ ($errors->has('worker.dalit_f'))?'has-error':'' }}">
                                                 {!! Form::number('worker[dalit_f]',null,['class'=>'form-control','placeholder' => 'Dalit Female','min'=>'0']) !!}
                                                  {!! $errors->first('worker.dalit_f','<span class="text-danger">:message</span>') !!}
                                             </td>
                                           
                                            
                                             <td class="{{ ($errors->has('worker.muslim_f'))?'has-error':'' }}">
                                                    {!! Form::number('worker[muslim_f]',null,['class'=>'form-control','placeholder' => 'Muslim Female','min'=>'0']) !!}
                                                     {!! $errors->first('worker.muslim_f','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('worker.others_f'))?'has-error':'' }}">
                                                {!! Form::number('worker[others_f]',null,['class'=>'form-control','placeholder' => 'Others Female','min'=>'0']) !!}
                                                {!! $errors->first('worker.others_f','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('worker.local_f'))?'has-error':'' }}">
                                                {!! Form::number('worker[local_f]',null,['class'=>'form-control','placeholder' => 'Local Female','min'=>'0']) !!}
                                                {!! $errors->first('worker.local_f','<span class="text-danger">:message</span>') !!}
                                              </td>
                                           </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <h3 class="text-center"> Worker Details</h3>

                                <div class="row">
                                    <table class="table table-bordered col-md-12">
                                     <thead>
                                         <th></th>
                                      <th>Skill</th>
                                      <th>Unskill</th>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th>Male</th>
                                             <td class="{{ ($errors->has('worker.skill_male'))?'has-error':'' }}"> 
                                                  {!! Form::number('worker[skill_male]',null,['class'=>'form-control','placeholder' => 'Skill Male','min'=>'0']) !!}
                                                  {!! $errors->first('worker.skill_male','<span class="text-danger">:message</span>') !!}
                                             </td>
                                             <td class="{{ ($errors->has('worker.unskill_male'))?'has-error':'' }}">
                                                 {!! Form::number('worker[unskill_male]',null,['class'=>'form-control','placeholder' => 'Unskill Male','min'=>'0']) !!}
                                                 {!! $errors->first('worker.unskill_male','<span class="text-danger">:message</span>') !!}
                                            </td>
                                             
                                           </tr>
                                           <tr>
                                               <th>Female</th>
                                              <td class="{{ ($errors->has('worker.skill_female'))?'has-error':'' }}">
                                                 {!! Form::number('worker[skill_female]',null,['class'=>'form-control','placeholder' => 'Skill Female','min'=>'0']) !!}
                                                  {!! $errors->first('worker.skill_female','<span class="text-danger">:message</span>') !!}
                                             </td>
                                             <td class="{{ ($errors->has('worker.unskill_female'))?'has-error':'' }}">
                                                  {!! Form::number('worker[unskill_female]',null,['class'=>'form-control','placeholder' => 'Unskill Female','min'=>'0']) !!}
                                                  {!! $errors->first('worker.unskill_female','<span class="text-danger">:message</span>') !!}
                                                </td>
                                             
                                           </tr>
                                    </tbody>
                                    </table>
                                </div>
                               
                             
                          
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/worker')}}" class="btn btn-danger">cancel</a>
                                
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







