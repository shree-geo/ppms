@extends('backend.layouts.app')
@section('title')
    Strutcure Estimation
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Structure</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Projects</li>
                            <li class="breadcrumb-item active">Strcuture Estimation</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header with-border">
                        <?php $user_group = auth()->user()->user_group_id; ?>
                        @if ($user_group != 2)
                            <div class="card-title row">
                                {!! Form::open(['method' => 'get', 'url' => '/project/structure_estimation', 'autocomplete' => 'off', 'role' => 'form']) !!}
                                <div class="form-group  pull-left {{ $errors->has('project_id') ? 'has-error' : '' }} ">
                                    {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                    {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <button type="submit" class="btn btn-primary pull-right"
                                    style="margin-left: 5px; height:42px;">Search</button>

                                {!! Form::close() !!}
                            </div>
                        @else
                            <h3 class="card-title">Strutcure Estimation</h3>
                        @endif
                        <a href="#" class="pull-right" data-toggle="tooltip" title="Go Back"><i
                                class="fa fa-arrow-circle-left fa-2x"></i></a>
                    </div>
                    <div class='loader'></div>
                    <div class="card-body">
                        @if ($status)
                            {!! Form::open(['method' => 'post', 'url' => '/project/structure_estimation', 'autocomplete' => 'off', 'role' => 'form']) !!}
                            <input type='hidden' value={{ $project_id }} name="project_id">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class=" table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Structure Name</th>
                                                    <th>Location</th>
                                                    <th>Units</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($structureName)>0)
                                                <?php $i = 1; ?>
                                                @foreach ($structureName as $structure)
                                                    <tr>
                                                        <td> {{ $i }}. {{ $structure->structure_name }}</td>
                                                        <td>{{ $structure->location }} </td>
                                                        <td>{{ $structure->unit_id != null ? $structure->unit->unit_name : '' }} </td>
                                                        <td>
                                                            {!! Form::text('value['.$structure->id.']',isset($structureEst[$structure->id]) ? $structureEst[$structure->id] : null, ['class'=>'form-control','placeholder'=>'Value']) !!}
                                                            {!! $errors->first("value.$structure->id", '<span class="text-danger">:message</span>') !!}
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <?php $j = 1; ?>
                                                    @if (isset($structure->child))
                                                        @foreach ($structure->child as $child)
                                                            <tr>
                                                                <td>
                                                                    <p style="padding-left: 25px;">{{ $i . '.' . $j++ }}.
                                                                        {{ $child->structure_name }}</p>
                                                                </td>
                                                                <td>{{$child->location}}</td>
                                                                <td>{{ $child->unit_id != null ? $child->unit->unit_name : '' }}</td>
                                                                <td class="{{ $errors->has('value.' . $child->id) ? 'has-error' : '' }}">
                                                                    {!! Form::text('value[' . $child->id . ']', isset($structureEst[$child->id]) ? $structureEst[$child->id] : null, ['class' => 'form-control', 'placeholder' => 'Value']) !!}
                                                                    {!! $errors->first("value.$child->id", '<span class="text-danger">:message</span>') !!}

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    <?php $i++; ?>
                                                @endforeach

                                                @else
                                                <tr>
                                                    <td colspan="4" class="text-danger text-center">No Data!!</td>
                                                </tr>
                                                @endif
                                            </tbody>

                                        </table>

                                    </div>


                                </div>


                            </div>
                      @if(count($structureName)>0)

                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/structure_estimation') }}" class="btn btn-danger">Cancel</a>

                            </div>
                            @endif
                            {!! Form::close() !!}
                            @else
                            <div class="callout callout-info">
                                        Please select the Sub Project name from above drop down.
                             </div>

                        @endif


                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection

