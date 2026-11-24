@extends('backend.layouts.app')
@section('title')
    Projects Members
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Members</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Members</li>
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

                        $permission = helperPermissionLink(url('project/member/create'), url('project/member'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                      @if($allowAdd)

                     {!! Form::open(['method'=>'post','url'=>'/project/member', 'autocomplete'=>'off', 'role'=>'form']) !!}
                            
                    <div class="row">
                     @if(auth()->user()->user_group_id!=2)
                       <div class="form-group col-md-4 {{ ($errors->has('project_id'))?'has-error':'' }}">
                        <label>Projects <label class="text-danger"> *</label></label>
                        {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                          'Select Project Name'])}}
                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}

                        </div>
                     @endif
                    <div class="form-group col-md-4 {{ ($errors->has('samiti_year'))?'has-error':'' }}">
                    <label>Samiti Year<label class="text-danger">*</label></label>
                    {!! Form::number('samiti_year',null,['class'=>'form-control','placeholder' => 'year']) !!}
                    {!! $errors->first('samiti_year', '<span class="text-danger">:message</span>') !!}

                </div>

                    </div>
                    <div class="row">
                     <div class="col-md-12">
                         <table class="table table-bordered">  
									<tr>
										<th>Member Name</th>
										<th>Position</th>
										<th>Casts</th>
										<th>Gender</th>
										<th>Is Excluded?</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4">Key Position</th>
                                    </tr>
                                    @for($i=0;$i<=9; $i++)
                                    <tr>
										<td>{!! Form::text('members['. $i.'][member_name]',null,['class'=>'form-control','placeholder' => 'Name','required']) !!}</td>  
										
                                         <td>
                                             <select class="form-control select2" name="members[{{$i}}][position_id]" id="position_id_{{$i}}" style='width:100%;'>
                                                @if($i<=5)
                                             <option value="{{$i+1}}">{{$positions[$i+1]}}</option>
                                             @elseif($i>=6)
                                             <option value="6">{{$positions[6]}}</option>
                                             @endif
                                            </select>
                                            </td>
                                         <td>{{Form::select('members['. $i.'][member_cast_id]',$casts,Request::get('member_cast_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'member_cast_id_'.$i,'placeholder'=>
                                          'Select Casts','required'])}}</td> 
                                            <td>
                                            <select id="member_gender_{{$i}}" name="members[{{$i}}][member_gender]" class="form-control select2 " required  style="width: 100%;">
                                            <option value="" selected>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="members[{{$i}}][excluded_group]" value="1">
                                        </td>
                                    </tr> 
                                    @if($i==4)
                                    <tr>
                                        <th colspan="4">Members</th>
                                    </tr>
                                    @endif
                                    @endfor
                           
                         </table>
                     </div>
                    </div>
                    <h6 style="color: red"><i class="fa fa-warning"></i> Samiti must contain 9 member in which 3 must be female and 1 female at key position.</h6>
                      <div class="card-footer pull-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{url('/project/member')}}" class="btn btn-danger">cancel</a>
                                
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
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection








