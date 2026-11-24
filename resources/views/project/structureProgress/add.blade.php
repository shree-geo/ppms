@extends('backend.layouts.app')
@section('title')
    Strutcure Progress
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
                            <li class="breadcrumb-item active">Strcuture Progress</li>
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

                        <h3 class="card-title">Strutcure Progress</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/structure_progress/create'), url('project/structure_progress'));
                        
                        $allowEdit = $permission['isEdit'];
                        
                        $allowDelete = $permission['isDelete'];
                        
                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-header">
                        {!! Form::open(['method' => 'get', 'url' => '/project/structure_progress/create', 'autocomplete' => 'off', 'role' => 'form']) !!}
                        <input type='hidden' value='search' name="search">

                        <div class="row">
                            @if($status)
                            @if(auth()->user()->user_group_id!=2)
                            <div class="form-group col-md-3 {{ ($errors->has('project_id'))?'has-error':''}}">
                                <label>SubProejct Name <label class="text-danger"> *</label></label>
                                {{ Form::text('project_id',$projectDetails->name,['class'=>'form-control ','readonly'])}}
    
                                {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                            </div>
                            @endif
                            <div class="form-group col-md-3 {{ ($errors->has('year'))?'has-error':''}}">
                                <label>Year <label class="text-danger"> *</label></label>
                                {{ Form::text('year',$recent_year,['class'=>'form-control ','readonly'])}}
    
                                {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3 {{ ($errors->has('month'))?'has-error':''}}">
                                <label> Month <label class="text-danger"> *</label></label>
                               
                                {{ Form::text('month',$month[$recent_month] ,['class'=>'form-control ','readonly'])}}
                                {!! $errors->first('month', '<span class="text-danger">:message</span>') !!}
                            </div>
                            @else
                            @if (auth()->user()->user_group_id != 2)
                                <div class="form-group col-md-3 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                    <label>SubProejct Name <label class="text-danger"> *</label></label>
                                    {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select SubProject','required']) }}
                                </div>
                            @endif
                            <div class="form-group col-md-3 {{ $errors->has('year') ? 'has-error' : '' }}">
                                <label>Year <label class="text-danger"> *</label></label>
                                <select class="form-control select2" name="year" required>
                                    <option value="">Select Year</option>
                                    @foreach ($year as $yea)
                                        <option value="{{ $yea->fy_name }}"{{ Request::old('year') ||$recent_year == $yea->fy_name ? 'selected' : '' }}>
                                            {{ $yea->fy_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 {{ $errors->has('month') ? 'has-error' : '' }}">
                                <label> Month <label class="text-danger"> *</label></label>
                                {{ Form::select('month', $month, Request::get('month'), ['class' => 'form-control select2', 'id' => 'month', 'placeholder' => 'Select Month','required']) }}
                            </div>
                            @endif
                        </div>
                        <a href="{{ url('/project/structure_progress/create') }}" class="btn btn-danger pull-right ml-2">Reset</a>
                        <button type="submit" class="btn  btn-primary pull-right ">Search</button>
                        {!! Form::close() !!}
                    
                </div>
                @if($status)
                
                <div class="card-body">
                    {!! Form::open(['method' => 'post', 'url' => '/project/structure_progress', 'autocomplete' => 'off', 'role' => 'form']) !!}
                    <input type='hidden' name='project_id' value="{{ $recent_project }}">
                    <input type='hidden' name='year' value="{{ $recent_year }}">
                    <input type='hidden' name='month' value="{{ $recent_month }}">

                    {{-- <div class="row"> --}}
                            <div class="col-md-12" style="overflow-x: auto">
                            <table class="table table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Structure Name</th>
                                        <th>Location</th>
                                        <th>Units</th>
                                        <th>Designed Total Capacity</th>
                                        <th>Target</th>
                                        <th>Progress</th>
                                        <th>Target For Next Reporting</th>
                                    </tr>
                                </thead>
                               
                                <tbody id="dynamicData">

                                    <?php $i = 1; ?>
                                        @foreach ($structureName as $structure)
                                            @if (isset($structureEst[$structure->id]))
                                                <tr id="parent_{{ $structure->id }}">
                                                    <td> {{ $i++ }}. {{ $structure->structure_name }}
                                                    </td>
                                                    <td>{{ $structure->location }}</td>
                                                    <td>{{ $structure->unit_id != null ? $structure->unit->unit_name : '' }}
                                                    </td>
                                                    <td id="estimation_{{ $structure->id }}">
                                                        {{ isset($structureEst[$structure->id]) ? $structureEst[$structure->id] : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('value[' . $structure->id . '][target]',  isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['target']:null , ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "target_$structure->id", !isset($structureEst[$structure->id]) ? 'disabled' : '']) !!}
                                                        {!! $errors->first("value.$structure->id.target", '<span class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td>
                                                        {!! Form::text('value[' . $structure->id . '][progress]', isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['progress']:null, ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "progress_$structure->id", !isset($structureEst[$structure->id]) ? 'disabled' : '']) !!}
                                                        {!! $errors->first("value.$structure->id.progress", '<span class="text-danger">:message</span>') !!}

                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("value.$structure->id.target_for_next_month") ? 'has-error' : '' }}">
                                                        {!! Form::text('value[' . $structure->id . '][target_for_next_month]', isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['target_for_next_month']:null, ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "target_for_next_month_$structure->id"]) !!}
                                                        {!! $errors->first("value.$structure->id.target_for_next_month", '<span class="text-danger">:message</span>') !!}

                                                    </td>
                                                </tr>
                                            @endif

                                            <?php $j = 1; ?>
                                            @if (isset($structure->child))
                                                <?php $l = $i++; ?>
                                                <tr>
                                                    <td> {{ $l }}. {{ $structure->structure_name }}
                                                    </td>
                                                    <td>{{ $structure->location }}</td>
                                                    <td>{{ $structure->unit_id != null ? $structure->unit->unit_name : '' }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @foreach ($structure->child as $child)

                                                    @if (isset($structureEst[$child->id]))
                                                        <tr>
                                                            <td>
                                                                <p style="padding-left: 25px;">
                                                                    {{ $l . '.' . $j++ }}.
                                                                    {{ $child->structure_name }}</p>
                                                            </td>
                                                            <td>{{ $child->location }}</td>
                                                            <td>{{ $child->unit_id != null ? $child->unit->unit_name : '' }}
                                                            </td>
                                                            <td id="estimation_{{ $child->id }}">
                                                                {{ isset($structureEst[$child->id]) ? $structureEst[$child->id] : 'N/A' }}
                                                            </td>

                                                            <td>
                                                                {!! Form::text('value[' . $child->id . '][target]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['target']:null, ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "target_$child->id", !isset($structureEst[$child->id]) ? 'disabled' : '']) !!}
                                                                {!! $errors->first("value.$child->id.target", '<span class="text-danger">:message</span>') !!}</td>
                                                            <td>
                                                                {!! Form::text('value[' . $child->id . '][progress]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['progress']:null, ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "progress_$child->id", !isset($structureEst[$child->id]) ? 'disabled' : '']) !!}
                                                                {!! $errors->first("value.$child->id.progress", '<span class="text-danger">:message</span>') !!}

                                                            </td>
                                                            <td>
                                                                {!! Form::text('value[' . $child->id . '][target_for_next_month]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['target_for_next_month']:null, ['class' => 'form-control', 'placeholder' => 'Value', 'id' => "progress_$child->id"]) !!}
                                                                {!! $errors->first("value.$child->id.target_for_next_month", '<span class="text-danger">:message</span>') !!}

                                                            </td>

                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                </tbody>

                            </table>

                        </div>


                    {{-- </div> --}}
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('/project/structure_progress') }}" class="btn btn-danger">Cancel</a>
    
                    </div>
                    {!! Form::close() !!}
                </div>
                @endif

            </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
@endsection
