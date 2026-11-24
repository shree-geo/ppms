@extends('backend.layouts.app')
@section('title')
    Project Members
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Project Members</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Members</li>
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
                                <h3 class="card-title">Projects Members</h3>
                      
                                <?php

                                $permission = helperPermissionLink(url('project/member/create'), url('project/member'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-header">
                             {!! Form::open(['method'=>'get','url'=>'/project/member', 'autocomplete'=>'off', 'role'=>'form']) !!}
                                <div class="form-group  pull-left col-md-3">
                                   {{Form::select('project_id',$projects->pluck('name','id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>
                                        'Select Project Name'])}}
                                  </div>
                                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 5px; height:42px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>

                                {!! Form::close() !!}
                                <button class="btn btn-success pull-right" onclick="exportData()" style="height: 42px;"><i class="fa fa-file-excel-o"
                                    aria-hidden="true"></i> Export</button>
                            </div>
                            <div class="card-body">
                                @if(!count($members)<=0)
                                    {{-- <div class="table-responsive"> --}}
                                        <div class="col-md-12" style="overflow-x: auto">
                                            <table id="example"
                                                   class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                 <tr>
                                                <th style="width: 10px;">{{trans('app.sn')}}</th>
                                                @if(auth()->user()->user_group_id!=2)
                                                <th>Project</th>
                                                @endif
                                                <th>Samiti Year</th>
                                                <th>Member Name</th>
                                                <th>Position</th>
                                                <th>Cast</th>
                                                <th>Gender</th>
                                                <th style="width: 10px" ;
                                                    class="text-right">Action</th>
                                            </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i = 1; ?>
                                                @foreach($members as $key=>$member_info)
                                                @foreach($member_info as $member)
                                               <tr>
                                                    <th scope=row>{{$i}}</th>
                                                      @if(auth()->user()->user_group_id!=2)
                                                    <td>{{$member->project->name}}</td>
                                                    @endif
                                                    <td>{{$member->samiti_year}}</td>
                                                    <td>{{$member->member_name}}</td>
                                                    {{-- <td>{{ $positions[$member->position_id] }}</td> --}}
                                                    <td>{{(($member->position_id=='1')?'Chairperson':(($member->position_id=='2')?'Vice Chairperson':(($member->position_id=='3')?'Secretary':(($member->position_id=='4')?'':(($member->position_id=='5')?'Treasurer':(($member->position_id=='6')?'Member':''))))))}}</td>
                                                    <td>{{ $casts[$member->member_cast_id] }}</td>
                                                    {{-- <td>{{(($member->member_cast_id=='1')?'Brahmin/Chhetry':(($member->member_cast_id=='2')?'Janajati':(($member->member_cast_id=='3')?'Dalit':(($member->member_cast_id=='4')?'Others':(($member->member_cast_id=='5')?'Muslim':'')))))}}</td> --}}
                                                    <td>{{$member->member_gender=='male'?'Male':(($member->member_gender=='female')?'Female':'Other')}}</td>

                                                    <td class="text-right row" style="margin-right: 0px;">
                                                        @if($allowEdit)
                                                            <a href="{{route('member.edit',[$member->id])}}"
                                                               class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                               data-placement="top" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>&nbsp;
                                                        @endif

                                                        @if($allowDelete)
                                                            {!! Form::open(['method' => 'DELETE', 'route'=>['member.destroy',
                                                                $member->id],'class'=> 'inline']) !!}
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

                                    {{-- </div> --}}
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
@section('js')
<script>
    function exportData() {
        var project_id = $('#project_id').val();
        // var url = baseurl + '/exports/memberExport' + '?project_id=' + project_id;
        var url = baseurl + '/project/member' + '?project_id=' + project_id+'&export=export';
        window.location = url;
    }

</script>
@endsection