@extends('backend.layouts.app')
@section('title')
    Project Vo Details
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Projects Vo Details</h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Vo</li>
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
                            <div class="card-header with-border">
                                {{-- <h3 class="card-title">Projects Beneficiary</h3> --}}
                                  <div class="card-title row" >
                             {!! Form::open(['method'=>'get','url'=>'/project/vo', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}

                                  </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;">Search</button>

                                {!! Form::close() !!}
                        </div>
                                <?php

                                $permission = helperPermissionLink(url('project/vo/create'), url('project/vo'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-body">
                                @if(!count($vos)<=0)
                                        <div class="col-md-12 " style="overflow-x:auto;">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover ">
                                                <thead>
                                                 <tr>
                                                <th style="width: 5px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Subproject Name</th>
                                                @endif
                                                <th>Vo Number</th>
                                                <th>Variation Percentage</th>
                                                <th>Variation Amount</th>
                                                <th>Revised Contract Amount</th>
                                                <th>Revised Cost Amount</th>
                                                {{-- <th>Approved Date</th>
                                                <th>Approved By</th> --}}
                                                <th style="width: 80px !important;"
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i = 1; ?>
                                                @foreach($vos as $key=>$data)
                                                @foreach($data as $val)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                  @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$val->project->name}}</td>
                                                    @endif
                                                    <td>{{$val->serial_no}}</td>
                                                    <td>{{$val->variation_per}}</td>
                                                    <td>{{$val->variation_amount}}</td>
                                                    <td>{{$val->revised_contract_amount}}</td>
                                                    <td>{{$val->revised_cost_estimated}}</td>
                                                    {{-- <td>{{$val->approved_date}}</td>
                                                    <td>{{$val->approved_by}}</td> --}}
                                                   

                                                    <td class="text-right row" style="width: 80px !important;">
                                                        @if($allowEdit)
                                                            <a href="{{route('vo.edit',[$val->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif
                                                         @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['vo.destroy',
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
                        <!-- /.card -->
                    </div>


                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->

@endsection

