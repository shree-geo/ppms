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
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
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

                <div class="card-body">
                    {!! Form::model($edits[0],['method'=>'put','route'=>['structure_progress.update',$edits[0]->project_id], 'autocomplete'=>'off', 'role'=>'form']) !!}
                    <div class="row">
                        @if(auth()->user()->user_group_id!=2)
                        <div class="form-group col-md-3 {{ ($errors->has('project_id'))?'has-error':''}}">
                            <label>SubProejct Name <label class="text-danger"> *</label></label>
                            {{Form::select('project_id',$projects->pluck('name', 'id'),Request::get('project_id'),['class'=>'form-control select2','id'=>'project_id','placeholder'=>'Select SubProject','readonly'])}}
                            {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                        </div>
                        @endif
                        <div class="form-group col-md-3 {{ ($errors->has('year'))?'has-error':''}}">
                            <label>Year <label class="text-danger"> *</label></label>
                            <select class="form-control select2" name="year" readonly="readonly">
                                <option value="">Select Year</option>
                                @foreach($year as $yea)
                                <option value="{{$yea->fy_name}}" {{$edits[0]->year==$yea->fy_name?'selected':''}}>{{$yea->fy_name}}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('year', '<span class="text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group col-md-3 {{ ($errors->has('month'))?'has-error':''}}">
                            <label> Month <label class="text-danger"> *</label></label>
                            {{Form::select('month',$month,Request::get('month'),['class'=>'form-control select2','id'=>'month','placeholder'=>'Select Month','readonly'])}}
                            {!! $errors->first('month', '<span class="text-danger">:message</span>') !!}
                        </div>

                        <div class="col-lg-12">
                            <div class=" table-responsive">
                                <table class="table table-striped table-hover">
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
                                        @foreach($structureName as $structure)
                                        @if(isset($structureEst[$structure->id]))
                                        <tr>
                                            <td> {{ $i++ }}. {{$structure->structure_name}}</td>
                                            <td>{{$structure->location}}</td>
                                            <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                                            <td id="estimation_{{$structure->id}}">{{isset($structureEst[$structure->id])?$structureEst[$structure->id]:'N/A'}}</td>

                                            <td>
                                                {!! Form::text('value['.$structure->id.'][target]', isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['target']:null, ['class'=>'form-control','placeholder'=>'Value','id'=>"target_$structure->id",(!isset($structureEst[$structure->id])?'disabled':'')]) !!}
                                                {!! $errors->first("value.$structure->id.target", '<span class="text-danger">:message</span>') !!}
                                            </td>
                                            <td>
                                                {!! Form::text('value['.$structure->id.'][progress]', isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['progress']:null, ['class'=>'form-control','placeholder'=>'Value','id'=>"progress_$structure->id",(!isset($structureEst[$structure->id])?'disabled':'')]) !!}
                                                {!! $errors->first("value.$structure->id.target", '<span class="text-danger">:message</span>') !!}


                                            </td>
                                            <td>
                                                {!! Form::text('value['.$structure->id.'][target_for_next_month]', isset($structureProgress[$structure->id])?$structureProgress[$structure->id][0]['target_for_next_month']:null, ['class'=>'form-control','placeholder'=>'Value','id'=>"progress_$structure->id",(!isset($structureEst[$structure->id])?'disabled':'')]) !!}
                                                {!! $errors->first("value.$structure->id.target", '<span class="text-danger">:message</span>') !!}


                                            </td>
                                        </tr>
                                        @endif
                                        <?php $j = 1;?>
                                        @if(isset($structure->child))
                                        <?php  $k= $i++; ?>
                                        <tr>
                                            <td> {{ $k }}. {{$structure->structure_name}}</td>
                                            <td> {{$structure->location}}</td>
                                            <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @foreach($structure->child as $child)
                                        @if(isset($structureEst[$child->id]))
                                        <tr>
                                            <td>
                                                <p style="padding-left: 25px;">{{ $k.'.'.$j++ }}. {{$child->structure_name}}</p>
                                            </td>
                                            <td>{{$child->location}}</td>
                                            <td>{{$child->unit_id!=null?$child->unit->unit_name:''}}</td>
                                            <td>{{isset($structureEst[$child->id])?$structureEst[$child->id]:'N/A'}}</td>
                                            <td>
                                                {!! Form::text('value['.$child->id.'][target]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['target']:null, ['class'=>'form-control','placeholder'=>'Value', (!isset($structureEst[$child->id])?'disabled':'')]) !!}
                                                {!! $errors->first("value.$child->id.target", '<span class="text-danger">:message</span>') !!}

                                            </td>

                                            <td>
                                                {!! Form::text('value['.$child->id.'][progress]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['progress']:null, ['class'=>'form-control','placeholder'=>'Value',(!isset($structureEst[$child->id])?'disabled':'')]) !!}
                                                {!! $errors->first("value.$child->id.progress", '<span class="text-danger">:message</span>') !!}


                                            </td>
                                            <td>
                                                {!! Form::text('value['.$child->id.'][target_for_next_month]', isset($structureProgress[$child->id])?$structureProgress[$child->id][0]['target_for_next_month']:null, ['class'=>'form-control','placeholder'=>'Value',(!isset($structureEst[$child->id])?'disabled':'')]) !!}
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


                        </div>


                    </div>
                    <div class="card-footer pull-right">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{url('/project/structure_progress')}}" class="btn btn-danger">Cancel</a>

                    </div>
                    {!!Form::close() !!}



                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('js')
@include('project.layouts.loading-overlay')
<script src="{{asset('/plugins/spinner/loading.js')}}"></script>

<script>
    $('#project_id').change(function() {
        var projectId = document.getElementById('project_id').value;
        var progress = {
            !!json_encode($structureProgress) !!
        };
        $('#dynamicData').html('');
        // overlayOn();
        $.loading.start('Loading...');
        $.ajax({
            type: 'get'
            , data: {
                'project_id': projectId
            }
            , url: baseurl + '/project/estimationValue/',

            success: function(data) {
                var structure = data.structureEst;
                var unit = data.unit;
                var strtName = data.structureName;
                //  overlayOff();
                $.loading.end();


                var i = 1;
                if (Object.keys(data.structureEst).length > 0) {
                    for (var key2 in strtName) {
                        var name_id = strtName[key2]['id'];
                        if (structure[strtName[key2]['id']] != undefined) {
                            console.log(structure[strtName[key2]]);
                            var row = `  <tr id="parent_${strtName[key2]['id']}">
                        <td> ${i++}. ${strtName[key2]['structure_name']}</td>
                        <td>${strtName[key2]['location']?strtName[key2]['location']:''}</td>
                          <td>${strtName[key2]['unit_id']?unit[strtName[key2]['unit_id']]:''}</td>
                                                <td>${structure[strtName[key2]['id']]?structure[strtName[key2]['id']]:''}</td>
                                                <td>
                                                         {!! Form::text('value[${name_id}][target]', null, ['class' => 'form-control', 'placeholder' => 'Value']) !!}
                                                         {!! $errors->first('value.${name_id}.target', '<span class="text-danger">:message</span>') !!}</td>
                                                     <td>
                                                         {!! Form::text('value[${name_id}][progress]', null, ['class' => 'form-control', 'placeholder' => 'Value']) !!}
                                                         {!! $errors->first('value.${name_id}.progress', '<span class="text-danger">:message</span>') !!}

                                                        </td>
                                                     <td>
                                                         {!! Form::text('value[${name_id}][target_for_next_month]', null, ['class' => 'form-control', 'placeholder' => 'Value']) !!}
                                                         {!! $errors->first('value.${name_id}.target_for_next_month', '<span class="text-danger">:message</span>') !!}

                                                        </td>
                                    </tr>`;
                        }

                        if ('child' in strtName[key2]) {
                            var j = 1;
                            var l = i++;
                            var row = `  <tr id="parent_${strtName[key2]['id']}">
                        <td> ${l}. ${strtName[key2]['structure_name']}</td>
                            <td>${strtName[key2]['location']?strtName[key2]['location']:''}</td>
                                                <td>${strtName[key2]['unit_id']?unit[strtName[key2]['unit_id']]:''}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                    </tr>`;
                            for (var key3 in strtName[key2]['child']) {
                                if (structure[strtName[key2]['child'][key3]['id']] !== undefined) {
                                    var id = strtName[key2]['child'][key3]['id'];
                                    var target = progress[strtName[key2]['child'][key3]['id']] ? progress[strtName[key2]['child'][key3]['id']][0]['target'] : '';
                                    var progressValue = progress[strtName[key2]['child'][key3]['id']] ? progress[strtName[key2]['child'][key3]['id']][0]['progress'] : '';
                                    var next_month_targetValue = progress[strtName[key2]['child'][key3]['id']] ? progress[strtName[key2]['child'][key3]['id']][0]['target_for_next_month'] : '';
                                    row = row + `<tr> 
                              <td><p style="padding-left: 25px;">${l}.${j}. ${strtName[key2]['child'][key3]['structure_name']}</p></td>
                              <td>${strtName[key2]['child'][key3]['location']?strtName[key2]['child'][key3]['location']:''}</td>
                                                <td>${unit[strtName[key2]['child'][key3]['unit_id']]!=null?unit[strtName[key2]['child'][key3]['unit_id']]:''}</td>
                                                 <td>${structure[strtName[key2]['child'][key3]['id']]}</td>
                                                   <td>
                                                     <input type="text" name="value[${id}][target]" value="${target}" class="form-control">
                                                     {!! $errors->first('value.${id}.target', '<span class="text-danger">:message</span>') !!}
                                                 <td>
                                                     <input type="text" name="value[${id}][progress]" value="${progressValue}" class="form-control">
                                                     {!! $errors->first('value.${id}.target', '<span class="text-danger">:message</span>') !!}
                                                     
                                                </td>
                                                <td>
                                                     <input type="text" name="value[${id}][target_for_next_month]" value="${next_month_targetValue}" class="form-control">
                                                     {!! $errors->first('value.${id}.target_for_next_month', '<span class="text-danger">:message</span>') !!}
                                                     
                                                </td>
                                               
                                             </tr>`;
                                }

                            }
                            j++;
                        }
                        $('#dynamicData').append(row);
                    }
                } else {
                    $('#dynamicData').append('<tr><td colspan="7" class="text-danger center">Data Not Found !!</td></tr>');

                }
            }
            , error: function(err) {

            }
        , })

    });

</script>


@endsection
<link rel="stylesheet" type="text/css" href="{{url('plugins/spinner/loading.css')}}">
