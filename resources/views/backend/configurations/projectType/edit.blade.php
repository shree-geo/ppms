<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">{{trans('app.edit')}}&nbsp;</h3>

    </div>
    <div class="card-body">
        {!! Form::model($edits,['method'=>'PUT','route'=>['projecttype.update',$edits->id]]) !!}

    <div class="form-group {{ ($errors->has('project_sector'))?'has-error':'' }}">
        <label > Project Sector
            <label class="text-danger"> *</label>
        </label>
        {!! Form::select('project_sector', ['water_supply' => 'Water Supply', 'sanitation' => 'Sanitation', 'drainage' => 'Drainage'], null, ['class'=>'form-control','placeholder' => 'Pick a Type...']) !!}  
        {!! $errors->first('project_sector', '<span class="text-danger">:message</span>') !!}
        </div>

    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('type_name'))?'has-error':'' }}">
            <label>Type Name
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('type_name',null,['class'=>'form-control','placeholder' => 'Example: Main']) !!}
            {!! $errors->first('type_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="card-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('app.update')}}&nbsp;</button>
            </div>
            <!-- /.card-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

