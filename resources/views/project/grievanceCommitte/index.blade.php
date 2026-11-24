@extends('backend.layouts.app')
@section('title')
    Grievance Committe
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Grievance Committe Details </h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Grievance Committe</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="col-md-12" id="listing">
                        <div class="card card-default">
                            
                            <div class="card-header " >
                                <div class="card-title row">
                                            {!! Form::open(['method'=>'get','url'=>'/project/grievanceCommitte', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                            <div class="form-group  pull-left">
                                            {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                                    'Select Project Name'])}}
                                            </div>
                                            <button type="submit" class="btn btn-primary " style="margin-left: 5px; height:42px;">Search</button>

                                            {!! Form::close() !!}
                                            </div>
                                               <?php

                                        $permission = helperPermissionLink(url('project/grievanceCommitte/create'), url('project/grievanceCommitte'));

                                        $allowEdit = $permission['isEdit'];

                                        $allowDelete = $permission['isDelete'];

                                        $allowAdd = $permission['isAdd'];
                                        ?>
                            </div>

                            <nav class="nav nav-tabs">
                                <a class="nav-item nav-link active" href="#first_level" data-toggle="tab"><b>First Level Committe</b></a>
                                <a class="nav-item nav-link" href="#second_level" data-toggle="tab"><b>Second Level Committe</b></a>               
                            </nav>

                            <div class="tab-content">
                                <div class="tab-pane in active" id="first_level">
                                    <div class="card-body">
                                        @if(!count($grievance_committe)<=0)
                                                <div class="col-md-12 " style="overflow-x:auto;">
                                                    <table id="example1"
                                                        class="table table-striped table-bordered table-hover ">
                                                        <h3 class="text-center">First Level Committe Details</h3>
                                                        <thead>
                                                            
                                                            <tr>
                                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                                @if(auth()->user()->user_group_id!=2)
                                                                <th>Subproject Name</th>
                                                                @endif
                                                                <th>Name</th>
                                                                <th>Designation </th>
                                                                <th>Email </th>
                                                                <th>Contact No. </th>
                                                                <th style="width: 10px" ;
                                                                    class="text-right">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php
                                                        $i = 1; ?>

                                                        @foreach($grievance_committe as $key=>$grievance_committes)
                                                        @foreach($grievance_committes as $val)
                                                        @if ($val->level=='first')                                                           
                                                        <tr>
                                                                <th scope=row>{{$i}}</th>
                                                                @if(auth()->user()->user_group_id!=2)
                                                                <td>{{$val->project->name}}</td>
                                                                @endif
                                                                <td>{{$val->name}}</td>                                                      
                                                                {{-- <td>{{(($val->designation=='1')?'UC Chair':(($val->designation=='2')?'PMO Site Office':(($val->designation=='3')?'RPMO, Focal Person':(($val->designation=='4')?'DSMC Site Engineer ':(($val->designation=='5')?'Contractor Representative':(($val->designation=='6')?'Social Mobilizer':''))))))}}</td> --}}
                                                                <td>{{$val->designation}}</td>
                                                                <td>{{$val->email}}</td>
                                                                <td>{{$val->contact_no}}</td>
                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if($allowEdit)
                                                                        <a href="{{route('grievanceCommitte.edit',[$val->id])}}"
                                                                        class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                        data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['grievanceCommitte.destroy',
                                                                            $val->id],'class'=> 'inline']) !!}
                                                                        <button type="submit"
                                                                                class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top" title="Delete"
                                                                                onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>

                                                                        {!! Form::close() !!}
                                                                    @endif                                                               
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                            @endif

                                                        @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                        @else
                                            <div class="col-md-12">
                                                <label class="form-control label-danger">No records found</label>
                                            </div>
                                        @endif

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                
                                <div class="tab-pane fade" id="second_level">
                                    <div class="card-body">
                                        @if(!count($grievance_committe)<=0)
                                            {{-- <div class="table-responsive"> --}}
                                                <div class="col-md-12 " style="overflow-x:auto;">
                                                    <table id="example2"
                                                        class="table table-striped table-bordered table-hover">
                                                        <h3 class="text-center">Second Level Committe Details</h3>
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                                @if(auth()->user()->user_group_id!=2)
                                                                <th>Subproject Name</th>
                                                                @endif
                                                                <th>Name</th>                                                                
                                                                <th>Designation </th>
                                                                <th>Email </th>
                                                                <th>Contact No. </th>
                                                                <th style="width: 10px" ;
                                                                    class="text-right">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        <?php
                                                        $i = 1; ?>

                                                        @foreach($grievance_committe as $key=>$grievance_committes)
                                                        @foreach($grievance_committes as $val)
                                                        @if ($val->level=='second')
                                                        <tr>
                                                                <th scope=row>{{$i}}</th>
                                                                @if(auth()->user()->user_group_id!=2)
                                                                <td>{{$val->project->name}}</td>
                                                                @endif
                                                                <td>{{$val->name}}</td>
                                                                {{-- <td>{{(($val->designation=='1')?'Mayor of municipality':(($val->designation=='2')?'Regional Manager/RPMO':(($val->designation=='3')?'WUSC secretary':(($val->designation=='4')?'RPMO Engineer':(($val->designation=='5')?'RPMO Social/Envt Officer':(($val->designation=='6')?'DSMC SSS':(($val->designation=='7')?'Affected representative':(($val->designation=='8')?'CBO representative':(($val->designation=='9')?'Contractor representative':'')))))))))}}</td> --}}
                                                                <td>{{$val->designation}}</td>
                                                                <td>{{$val->email}}</td>
                                                                <td>{{$val->contact_no}}</td>
                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if($allowEdit)
                                                                        <a href="{{route('grievanceCommitte.edit',[$val->id])}}"
                                                                        class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                        data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['grievanceCommitte.destroy',
                                                                            $val->id],'class'=> 'inline']) !!}
                                                                        <button type="submit"
                                                                                class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top" title="Delete"
                                                                                onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>

                                                                        {!! Form::close() !!}
                                                                    @endif                                                               
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                            @endif

                                                        @endforeach
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <label class="form-control label-danger">No records found</label>
                                            </div>
                                        @endif

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>


                            
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection

{{-- @section('js')
 <script>
  $(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,

    });
  });
</script>   
@endsection --}}