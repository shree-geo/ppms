@extends('backend.layouts.app')
@section('title')
 Salient Feature
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Salient Feature</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Projects</li>
                            <li class="breadcrumb-item active">Salient Feature</li>
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
                                {!! Form::open(['method' => 'get', 'url' => '/project/features_value', 'autocomplete' => 'off', 'role' => 'form']) !!}
                                <div class="form-group  pull-left {{ $errors->has('project_id') ? 'has-error' : '' }} ">
                                    {{ Form::select('project_id', $projects->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                    {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <button type="submit" class="btn btn-primary pull-right"
                                    style="margin-left: 5px; height:42px;">Search</button>

                                {!! Form::close() !!}
                            </div>
                        @else
                            <h3 class="card-title"> Salient Feature</h3>
                        @endif
                        <a href="#" class="pull-right" data-toggle="tooltip" title="Go Back"><i
                                class="fa fa-arrow-circle-left fa-2x"></i></a>
                    </div>
                    <div class="card-body">
                        @if ($status)
                     
                            {!! Form::open(['method' => 'post', 'url' => '/project/features_value', 'autocomplete' => 'off', 'role' => 'form']) !!}
                            <input type='hidden' value={{ $project_id }} name="project_id">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class=" table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Feature Name</th>
                                                    <th>Values/Units (Gairabari)</th>
                                                    <th>Values/Units (Jilu/Gaude)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($featureName)>0)
                                                <?php $i = 1; ?>
                                                @foreach ($featureName as $val)
                                                    <tr>
                                                        <th>{{$i}}</th>
                                                        <td>{{ $val->feature_name }}</td>
                                                       
                                                        <td>{!! Form::text('value[before]['.$val->id.']', isset($featureValue[$val->id])?$featureValue[$val->id][0]['before_value']:null, ['class'=>'form-control','placeholder'=>'Value']) !!}</td>
                                                        <td>{!! Form::text('value[after]['.$val->id.']', isset($featureValue[$val->id])?$featureValue[$val->id][0]['after_value']:null, ['class'=>'form-control','placeholder'=>'Value']) !!}</td>
                                                        <td></td>
                                                    </tr>
                                                 
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
                         @if(count($featureName)>0)

                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/features_value') }}" class="btn btn-danger">Cancel</a>

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
