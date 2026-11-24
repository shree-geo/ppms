@extends('backend.layouts.app')
@section('title')
    Structures
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                         <h1>{{trans('app.configuration')}}</h1>

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                          <li class="breadcrumb-item">{{trans('app.configuration')}}</li>
                            <li class="breadcrumb-item active">Structure</li>
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
                                <h3 class="card-title"><i class="fa fa-list"></i> Structures</h3>
                               
                             
                                <?php
                                 $permission = helperPermissionLink(url('/configurations/structure/create'), url('/configurations/structure'));

                                $allowEdit = $permission['isEdit'];

                                $allowDelete = $permission['isDelete'];

                                $allowAdd = $permission['isAdd'];
                                ?>
                            </div>
                            <div class="card-body">
                                @if (!count($structures) <= 0)
                                    <div class="table-responsive">
                                        <div class="col-md-12 topFilter">
                                            <table id="example1"
                                                class="table table-striped table-bordered table-hover table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px;">{{ trans('app.sn') }}</th>
                                                       
                                                        <th> Sector Name</th>
                                                        <th> Structure Name</th>
                                                        <th>Parent</th>
                                                        <th>Units</th>
                                                        <th>Location</th>
                                                       
                                                        <th style="width: 10px" ; class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    @foreach ($structures as $key => $structure)
                                                            <tr>
                                                                <th scope=row>{{ $i }}</th>
                                                                <td>{{($structure->sector_name=='water_supply')?'Water Supply':(($structure->sector_name=='sanitation')?'Sanitation':'Drainage')}}</td>
                                                                <td>{{$structure->structure_name}}</td>
                                                                <td>{{$structure->parent_id!=null?$structure->parent->structure_name:''}}</td>
                                                                <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                                                                <td>{{$structure->location}}</td>



                                                                <td class="text-right row" style="margin-right: 0px;">
                                                                    @if ($allowEdit)
                                                                        <a href="{{ route('structure.edit', [$structure->id]) }}"
                                                                            class="text-info btn btn-xs btn-default"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit">
                                                                            <i class="fa fa-pencil-square-o"></i>
                                                                        </a>&nbsp;
                                                                    @endif

                                                                    @if ($allowDelete)
                                                                        {!! Form::open(['method' => 'DELETE', 'route' =>
                                                                        ['structure.destroy', $structure->id], 'class' => 'inline']) !!}
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-xs deleteButton actionIcon"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Delete"
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
