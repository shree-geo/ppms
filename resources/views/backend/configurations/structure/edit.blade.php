@extends('backend.layouts.app')
@section('title')
    Strcutures
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Structures</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Configurations</li>
                            <li class="breadcrumb-item">Structure</li>
                            <li class="breadcrumb-item active">{{ trans('app.edit') }}</li>
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
                        <h3 class="card-title">{{ trans('app.edit') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('configurations/structure/create'), url('configurations/structure'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)

                            {!! Form::model($edits,['method' => 'put', 'route' => ['structure.update',$edits->id], 'autocomplete' => 'off',
                            'role' => 'form']) !!}

                            <div class="row">
                                <div class="form-group col-md-6 {{ $errors->has('sector_name') ? 'has-error' : '' }}">
                                    <label>Sector Name</label><label class="text-danger">*</label>
                                    <select class="form-control select2" name="sector_name" id="sector_name" >
                                        <option value="">Select Sector</option>
                                        <option value="water_supply" {{$edits->sector_name=='water_supply'?'selected':''}}>Water Supply</option>
                                        <option vlaue="sanitation" {{$edits->sector_name=='sanitation'?'selected':''}}>Sanitation</option>
                                        <option value="drainage" {{$edits->sector_name=='drainage'?'selected':''}}>Drainage</option>
                                        </select>                                    
                                    {!! $errors->first('sector_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                                
                                <div class="form-group col-md-6 {{ $errors->has('parent_id')?'has-error': ''}}">
                                    <label>Parent</label>
                                    <select class="form-control select2" name="parent_id" id="parent_id">
                                        <option vlaue="">Select Parent</option>
                                    </select>
                                    {!! $errors->first('parent_id', '<span class="text-danger">:message</span>') !!}

                                </div>
                                <div  class="form-group col-md-6 {{ $errors->has('structure_name') ? 'has-error' : '' }}">
                                    <label> Structure Name</label><label class="text-danger">*</label>
                                    {!! Form::text('structure_name', null, ['class'=>'form-control','placeholder'=>'Structure Name']) !!}
                                    {!! $errors->first('structure_name', '<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{$errors->has('unit_id')?'has-error': ''}}">
                                    <label>Units</label>
                                    {!! Form::select('unit_id', $unitsList->pluck('unit_name','id'),null , ['class'=>'form-control select2','placeholder'=>'Select Units']) !!}
                                    {!! $errors->first('unit_id','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div  class="form-group col-md-6 {{ $errors->has('location') ? 'has-error' : '' }}">
                                    <label>Location</label>
                                    {!! Form::text('location', null, ['class'=>'form-control','placeholder'=>'Location']) !!}
                                    {!! $errors->first('location', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>
                           


                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/configurations/structure') }}" class="btn btn-danger">cancel</a>

                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                You Cannot access this module Please Contact your Super Admin user to access this.
                            </div>

                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection

@section('js')
<script>
    var parentlist= {!! json_encode($structureList)!!};
   
   $(document).ready(function () {
       var edits= {!! json_encode($edits) !!};
       var parentColl= parentlist[edits['sector_name']];
        $('#parent_id').html('');
        $('#parent_id').append('<option value="" selected disabled>Select Parent</option>');
        for(var key in parentColl){
            if(edits.parent_id==parentColl[key]['id']){
              $('#parent_id').append(`<option value="${parentColl[key]['id']}" selected>${parentColl[key]['structure_name']}</option>`); 
            }else{
                 $('#parent_id').append(`<option value="${parentColl[key]['id']}">${parentColl[key]['structure_name']}</option>`);
            }

        }
   });
</script>
<script>
    $('#sector_name').change(function(){
        var sector_name= $('#sector_name').val();
        var parentColl= parentlist[sector_name];
        $('#parent_id').html('');
        $('#parent_id').append('<option value="" selected disabled>Select Parent</option>');
        for(var key in parentColl){
            $('#parent_id').append(`<option value="${parentColl[key]['id']}">${parentColl[key]['structure_name']}</option>`);

        }
    })
</script>
@endsection

