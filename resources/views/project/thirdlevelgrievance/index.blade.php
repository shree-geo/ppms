@extends('backend.layouts.app')
@section('title')
    Third Level Grievance Details
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Third Level Grievance Details </h1>
                 
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item active">Third Level Grievance Details</li>
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
                                <h3 class="card-title">Third Level Grievance Details</h3>                            

                               
                                               <?php

                                        $permission = helperPermissionLink(url('project/thirdlevelgrievance/create'), url('project/thirdlevelgrievance'));

                                        $allowEdit = $permission['isEdit'];

                                        $allowDelete = $permission['isDelete'];

                                        $allowAdd = $permission['isAdd'];
                                        ?>
                            </div>

                           
                                    <div class="card-body">
                                        @if(!count($thirdlevelgrievances)<=0)
                                                <div class="col-md-12 topFilter">
                                                    <table id="example1"
                                                        class="table table-striped table-bordered table-hover table-responsive">
                                                        <thead>
                                                            
                                                            <tr>
                                                                <th style="width: 10px;">{{trans('app.sn')}}</th>                                                              
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

                                                        @foreach($thirdlevelgrievances as $key=>$val)
                                                                                                          
                                                        <tr>
                                                                <th scope=row>{{$i}}</th>                                                             
                                                                <td>{{$val->name}}</td>                                                      
                                                                {{-- <td>{{(($val->designation_id=='1')?'Mayor of municipality':(($val->designation_id=='2')?'Regional Manager/RPMO':(($val->designation_id=='3')?'WUSC secretary':(($val->designation_id=='4')?'RPMO Engineer':(($val->designation_id=='5')?'RPMO Social/Envt Officer':(($val->designation_id=='6')?'DSMC SSS':(($val->designation_id=='7')?'Affected representative':(($val->designation_id=='8')?'CBO representative':(($val->designation_id=='9')?'Contractor representative':'')))))))))}}</td> --}}

                                                                <td>{{$val->designation}}</td>
                                                                <td>{{$val->email}}</td>
                                                                <td>{{$val->contact_no}}</td>
                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if($allowEdit)
                                                                        <a href="{{route('thirdlevelgrievance.edit',[$val->id])}}"
                                                                        class="text-info btn btn-xs btn-default" data-toggle="tooltip"
                                                                        data-placement="top" title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route'=>['thirdlevelgrievance.destroy',
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

@section('js')
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
@endsection