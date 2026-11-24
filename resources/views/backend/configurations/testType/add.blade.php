<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">{{trans('app.add')}}&nbsp;</h3>

    </div>
    <div class="card-body">
    {!! Form::open(['method'=>'post','url'=>'configurations/test_type']) !!}

    <div class="form-group {{ ($errors->has('material_id'))?'has-error':'' }}">
        <label>Material Name</label>
        {{Form::select('material_id',$materials->pluck('material_name','id'),Request::get('material_id'),['class'=>'form-control select2','style'=>'width:100%;','id'=>'material_id','placeholder'=>
        'Select Material Name'])}}
        {!! $errors->first('material_id', '<span class="text-danger">:message</span>') !!}
    </div>
    <!-- /.input group -->
        <div class="form-group {{ ($errors->has('test_name'))?'has-error':'' }}">
            <label>Name
                <label class="text-danger"> *</label>
            </label>
            {!! Form::text('test_name',null,['class'=>'form-control']) !!}
            {!! $errors->first('test_name', '<span class="text-danger">:message</span>') !!}

        <!-- /.input group -->
        </div>
        <!-- /.form group -->
        <div class="card-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">{{trans('app.save')}}&nbsp;</button>
            </div>
            <!-- /.card-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

