<div class="row">
     <div class="form-group col-md-4 {{ ($errors->has('obas.oba_types_id'))?'has-error':'' }}">
     <label>Oba Type <label class="text-danger"> *</label></label>
     {{Form::select('obas[oba_types_id]',$oba_types->pluck('oba_type_name','id'),Request::get('obas[oba_types_id]'),['class'=>'form-control select2','id'=>'oba_types_id','placeholder'=>
                                          'Select Oba Type'])}}
      {!! $errors->first('obas.oba_types_id', '<span class="text-danger">:message</span>') !!}

    </div>
    <div class="form-group col-md-4 {{ ($errors->has('obas.dis_id'))?'has-error':'' }}">
    <label>District <label class="text-danger"> *</label></label>
    {{Form::select('obas[dis_id]',$districts->pluck('nepali_name','id'),Request::get('obas[dis_id]'),['class'=>'form-control select2','id'=>'dis_id','placeholder'=>
                                          'Select District'])}}
     {!! $errors->first('obas.dis_id', '<span class="text-danger">:message</span>') !!}

    </div>
     <div class="form-group col-md-4 {{ ($errors->has('obas.base_year'))?'has-error':''}}">
    <label>Number of Total HH's (Base year) <label class="text-danger"> *</label></label>
     {{Form::number('obas[base_year]',null,['class'=>'form-control','placeholder'=>'Base Year'])}}
      {!! $errors->first('obas.base_year', '<span class="text-danger">:message</span>') !!}
     </div>
     <div class="form-group col-md-4 {{ ($errors->has('obas.hhs_selected'))?'has-error':''}}">
    <label> Number of HH's Selected <label class="text-danger"> *</label></label>
     {{Form::number('obas[hhs_selected]',null,['class'=>'form-control','placeholder'=>'Selected'])}}
      {!! $errors->first('obas.hhs_selected', '<span class="text-danger">:message</span>') !!}
     </div>
                                
</div>