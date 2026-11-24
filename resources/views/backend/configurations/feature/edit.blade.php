<div class="card card-default">
    <div class="card-header with-border">
        <h3 class="card-title">{{ trans('app.edit') }}&nbsp;</h3>

    </div>
    <div class="card-body">
     {!! Form::model($edits,['method'=>'PUT','route'=>['sailent_feature.update',$edits->id]]) !!}

        <div class="form-group {{ $errors->has('sector_name') ? 'has-error' : '' }}">
            <label>Sector Name</label><label class="text-danger">*</label>
            <select class="form-control select2" name="sector_name">
              <option value="">Select Sector</option>
               <option value="water_supply" {{$edits->sector_name=='water_supply'?'selected':''}}>Water Supply</option>
               <option vlaue="sanitation" {{$edits->sector_name=='sanitation'?'selected':''}}>Sanitation</option>
                <option value="drainage" {{$edits->sector_name=='drainage'?'selected':''}}>Drainage</option>
                  </select>  
            {!! $errors->first('sector_name', '<span class="text-danger">:message</span>') !!}
        </div>
         <div  class="form-group  {{ $errors->has('feature_name') ? 'has-error' : '' }}">
                                    <label> Feature Name</label><label class="text-danger">*</label>
                                    {!! Form::text('feature_name', null, ['class'=>'form-control','placeholder'=>'Feature Name']) !!}
                                    {!! $errors->first('feature_name', '<span class="text-danger">:message</span>') !!}
                                </div>
        <!-- /.form group -->
        <div class="card-footer pull-left">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <button type="submit" class="btn btn-primary">{{ trans('app.update') }}&nbsp;</button>
            </div>
            <!-- /.card-footer -->

        </div>
        {!! Form::close() !!}

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
