@extends('backend.layouts.app')
@section('title')
    Projects Beneficiary
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Beneficiary</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Beneficiary</li>
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

                        $permission = helperPermissionLink(url('project/beneficiary/create'), url('project/beneficiary'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if($allowAdd)

                            {!! Form::open(['method'=>'post','url'=>'/project/beneficiary', 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                                 <div class="row">
                                     @if(auth()->user()->user_group_id!=2)
                                     <div class="form-group col-md-4 {{ ($errors->has('ben.project_id'))?'has-error':'' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{Form::select('ben[project_id]',$projects->pluck('name','id'),Request::get('ben.project_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                        {!! $errors->first('ben.project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                    @endif
                             <div class="form-group col-md-4 {{ ($errors->has('ben.beneficiary_sector'))?'has-error':'' }}">
                                    <label>Beneficiary <label class="text-danger"> *</label></label>
                                    <select id="beneficiary_sector" name="ben[beneficiary_sector]" class="form-control select2">
                                        <option value="" selected>Select Beneficiary</option>
                                        <option value="water_supply" >Water Supply</option>
                                        <option value="sanitation" >Sanitation</option>
                                        <option value="drainage">Drainage</option>
                                    </select>
                                    {!! $errors->first('ben.beneficiary_sector','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <div class="row">
                                    <table class="table table-bordered col-md-12">
                                     <thead>
                                         <th></th>
                                         <th>Brahmin/Chetri</th>
                                         <th>Janjati</th>
                                        <th>Dalit</th>
                                        <th>Muslim</th>
                                        <th>Others</th>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th>Male</th>
                                               <td class="{{ ($errors->has('ben.bramin_m'))?'has-error':'' }}">  
                                                   {!! Form::number('ben[bramin_m]',null,['class'=>'form-control','placeholder' => 'Braman/Chetri Male','min'=>'0']) !!}
                                                  {!! $errors->first('ben.bramin_m','<span class="text-danger">:message</span>') !!}
                                                </td>
                                                <td class="{{ ($errors->has('ben.janjati_m'))?'has-error':'' }}">
                                                    {!! Form::number('ben[janjati_m]',null,['class'=>'form-control','placeholder' => 'Janajati Male','min'=>'0']) !!}
                                                    {!! $errors->first('ben.janjati_m','<span class="text-danger">:message</span>') !!}
                                               </td>
                                             <td class="{{ ($errors->has('ben.dalit_m'))?'has-error':'' }}"> 
                                                  {!! Form::number('ben[dalit_m]',null,['class'=>'form-control','placeholder' => 'Dalit Male','min'=>'0']) !!}
                                                  {!! $errors->first('ben.dalit_m','<span class="text-danger">:message</span>') !!}
                                             </td>
                                             <td class="{{ ($errors->has('ben.muslim_m'))?'has-error':'' }}"> 
                                                 {!! Form::number('ben[muslim_m]',null,['class'=>'form-control','placeholder' => 'Muslim Male','min'=>'0']) !!}
                                                 {!! $errors->first('ben.muslim_m','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('ben.other_m'))?'has-error':'' }}">  
                                                {!! Form::number('ben[other_m]',null,['class'=>'form-control','placeholder' => 'Others Male','min'=>'0']) !!}
                                                {!! $errors->first('ben.other_m','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             
                                           </tr>
                                           <tr>
                                               <th>Female</th>
                                               <td class="{{ ($errors->has('ben.bramin_f'))?'has-error':'' }}"> 
                                                {!! Form::number('ben[bramin_f]',null,['class'=>'form-control','placeholder' => 'Braman/Chetri Female','min'=>'0']) !!}
                                                 {!! $errors->first('ben.bramin_f','<span class="text-danger">:message</span>') !!}
                                           </td>
                                           <td class="{{ ($errors->has('ben.janjati_f'))?'has-error':'' }}">
                                            {!! Form::number('ben[janjati_f]',null,['class'=>'form-control','placeholder' => 'Janajati Female','min'=>'0']) !!}
                                            {!! $errors->first('ben.janjati_f','<span class="text-danger">:message</span>') !!}
                                          </td>
                                              <td class="{{ ($errors->has('ben.dalit_f'))?'has-error':'' }}">
                                                 {!! Form::number('ben[dalit_f]',null,['class'=>'form-control','placeholder' => 'Dalit Female','min'=>'0']) !!}
                                                  {!! $errors->first('ben.dalit_f','<span class="text-danger">:message</span>') !!}
                                             </td>
                                           
                                            
                                             <td class="{{ ($errors->has('ben.muslim_f'))?'has-error':'' }}">
                                                    {!! Form::number('ben[muslim_f]',null,['class'=>'form-control','placeholder' => 'Muslim Female','min'=>'0']) !!}
                                                     {!! $errors->first('ben.muslim_f','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('ben.other_f'))?'has-error':'' }}">
                                                {!! Form::number('ben[other_f]',null,['class'=>'form-control','placeholder' => 'Others Female','min'=>'0']) !!}
                                                {!! $errors->first('ben.other_f','<span class="text-danger">:message</span>') !!}
                                              </td>
                                           
                                           </tr>
                                           <tr>
                                               <th>House Hold</th>
                                               <td class="{{ ($errors->has('ben.bramin_hh'))?'has-error':'' }}"> 
                                                {!! Form::number('ben[bramin_hh]',null,['class'=>'form-control','placeholder' => 'Braman/Chetri House Hold','min'=>'0']) !!}
                                                 {!! $errors->first('ben.bramin_hh','<span class="text-danger">:message</span>') !!}
                                           </td>
                                           <td class="{{ ($errors->has('ben.janjati_hh'))?'has-error':'' }}">
                                            {!! Form::number('ben[janjati_hh]',null,['class'=>'form-control','placeholder' => 'Janajati House Hold','min'=>'0']) !!}
                                            {!! $errors->first('ben.janjati_hh','<span class="text-danger">:message</span>') !!}
                                          </td>
                                              <td class="{{ ($errors->has('ben.dalit_hh'))?'has-error':'' }}">
                                                 {!! Form::number('ben[dalit_hh]',null,['class'=>'form-control','placeholder' => 'Dalit House Hold','min'=>'0']) !!}
                                                  {!! $errors->first('ben.dalit_hh','<span class="text-danger">:message</span>') !!}
                                             </td>
                                           
                                            
                                             <td class="{{ ($errors->has('ben.muslim_hh'))?'has-error':'' }}">
                                                    {!! Form::number('ben[muslim_hh]',null,['class'=>'form-control','placeholder' => 'Muslim House Hold','min'=>'0']) !!}
                                                     {!! $errors->first('ben.muslim_hh','<span class="text-danger">:message</span>') !!}
                                              </td>
                                             <td class="{{ ($errors->has('ben.other_hh'))?'has-error':'' }}">
                                                {!! Form::number('ben[other_hh]',null,['class'=>'form-control','placeholder' => 'Others House Hold','min'=>'0']) !!}
                                                {!! $errors->first('ben.other_hh','<span class="text-danger">:message</span>') !!}
                                              </td>
                                           
                                           </tr>
                                    </tbody>
                                    </table>
                                </div>
                          
                           
                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/beneficiary')}}" class="btn btn-danger">cancel</a>
                                
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







