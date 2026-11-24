<div class="row">
     <div class="form-group col-md-4 {{ ($errors->has('programs.program_type_id'))?'has-error':'' }}">
     <label>Program Type <label class="text-danger"> *</label></label>
     {{Form::select('programs[program_type_id]',$program_types->pluck('type_name','id'),Request::get('programs[program_type_id]'),['class'=>'form-control select2','id'=>'program_type_id','placeholder'=>
                                          'Select Program Type'])}}
      {!! $errors->first('programs.program_type_id', '<span class="text-danger">:message</span>') !!}

    </div>
     <div class="form-group col-md-4 {{ ($errors->has('programs.program_title'))?'has-error':'' }}">
     <label>Program Title <label class="text-danger"> *</label></label>
     {{Form::text('programs[program_title]',null,['class'=>'form-control ','id'=>'program_title','placeholder'=>
                                          'Program Title'])}}
      {!! $errors->first('programs.program_title', '<span class="text-danger">:message</span>') !!}

    </div>
</div>
<div class="row">
    <div class="form-group  {{ ($errors->has('programs.program_details'))?'has-error':''}}"  style="width:100%;">
    <label>Program Details<label class="text-danger"> *</label></label>
    {{Form::textarea('programs[program_details]',null,['class'=>'form-control ','id'=>'program_details','placeholder'=>
                                          'Program Details','rows'=>'5'])}}
      {!! $errors->first('programs.program_details', '<span class="text-danger">:message</span>') !!}
    </div>
</div>
<div class="row">
      <div class="form-group col-md-4"{{($errors->has('programs.start_date'))?'has-error':''}}>
        <label>Start Date</label>
         {{ Form::date('programs[start_date]',null,['class'=>'form-control','placeholder'=>'date'])}}
         {!! $errors->first('programs.start_date', '<span class="text-danger">:message</span>') !!}

        </div>
         <div class="form-group col-md-4"{{($errors->has('programs.end_date'))?'has-error':''}}>
         <label>End Date</label>
         {{ Form::date('programs[end_date]',null,['class'=>'form-control','placeholder'=>'date'])}}
         {!! $errors->first('programs.end_date', '<span class="text-danger">:message</span>') !!}

        </div>
</div>
  <div class="row">
        <div class="form-group col-md-6 {{ ($errors->has('programs.bramin_f'))?'has-error':'' }}">
            <label>Braman/Chhetri Female</label>
            {!! Form::number('programs[bramin_f]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Female']) !!}
            {!! $errors->first('programs.bramin_f','<span class="text-danger">:message</span>') !!}
         </div>
          <div class="form-group col-md-6 {{ ($errors->has('programs.bramin_m'))?'has-error':'' }}">
                <label>Braman/Chhetri Male</label>
                {!! Form::number('programs[bramin_m]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Male']) !!}
                {!! $errors->first('programs.bramin_m','<span class="text-danger">:message</span>') !!}
             </div>
            <div class="form-group col-md-6 {{ ($errors->has('programs.dalit_f'))?'has-error':'' }}">
                <label>Dalit Female</label>
                {!! Form::number('programs[dalit_f]',null,['class'=>'form-control','placeholder' => 'Dalit Female']) !!}
                {!! $errors->first('programs.dalit_f','<span class="text-danger">:message</span>') !!}
            </div>
            <div class="form-group col-md-6 {{ ($errors->has('programs.dalit_m'))?'has-error':'' }}">
                <label>Dalit Male</label>
                {!! Form::number('programs[dalit_m]',null,['class'=>'form-control','placeholder' => 'Dalit Male']) !!}
                {!! $errors->first('programs.dalit_m','<span class="text-danger">:message</span>') !!}
             </div>
            <div class="form-group col-md-6 {{ ($errors->has('programs.janjati_f'))?'has-error':'' }}">
                <label>Janajati Female</label>
                {!! Form::number('programs[janjati_f]',null,['class'=>'form-control','placeholder' => 'Janajati Female']) !!}
                {!! $errors->first('programs.janjati_f','<span class="text-danger">:message</span>') !!}
            </div>
             <div class="form-group col-md-6 {{ ($errors->has('programs.janjati_m'))?'has-error':'' }}">
                <label>Janajati Male</label>
                    {!! Form::number('programs[janjati_m]',null,['class'=>'form-control','placeholder' => 'Janajati Male']) !!}
                    {!! $errors->first('programs.janjati_m','<span class="text-danger">:message</span>') !!}
            </div>
                                 
             <div class="form-group col-md-6 {{ ($errors->has('programs.muslim_f'))?'has-error':'' }}">
                <label>Muslim Female</label>
                {!! Form::number('programs[muslim_f]',null,['class'=>'form-control','placeholder' => 'Muslim Female']) !!}
                {!! $errors->first('programs.muslim_f','<span class="text-danger">:message</span>') !!}
             </div>
            <div class="form-group col-md-6 {{ ($errors->has('programs.muslim_m'))?'has-error':'' }}">
               <label>Muslim Male</label>
                {!! Form::number('programs[muslim_m]',null,['class'=>'form-control','placeholder' => 'Muslim Male']) !!}
                {!! $errors->first('programs.muslim_m','<span class="text-danger">:message</span>') !!}
            </div>
                                
             <div class="form-group col-md-6 {{ ($errors->has('programs.others_f'))?'has-error':'' }}">
                <label>Others Female</label>
                {!! Form::number('programs[others_f]',null,['class'=>'form-control','placeholder' => 'Others Female']) !!}
                 {!! $errors->first('programs.others_f','<span class="text-danger">:message</span>') !!}
            </div>
            <div class="form-group col-md-6 {{ ($errors->has('programs.others_m'))?'has-error':'' }}">
                <label>Others Male</label>
                {!! Form::number('programs[others_m]',null,['class'=>'form-control','placeholder' => 'Others Male']) !!}
                {!! $errors->first('programs.others_m','<span class="text-danger">:message</span>') !!}
            </div>
    </div>