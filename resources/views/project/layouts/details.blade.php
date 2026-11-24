<div class="card-body ">
    <div class="row">
        <div class="col-md-6 my-3">
            <h4 class="text-center text-bold m-3">Private Connection</h4>
            <div class="row mt-4 ">
                <div class="form-group col-md-6">
                    <label>Base Year </label>
                     {!! Form::number('details[base_year_pvt_connection]',null,['class'=>'form-control ','placeholder' => 'Base Year Pvt Connection']) !!}
                     {!! $errors->first('details.base_year_pvt_connection','<span class="text-danger">:message</span>') !!}
                </div> 
                <div class="form-group col-md-6">
                    <label>Design Year </label>
                     {!! Form::number('details[design_year_pvt_connection]',null,['class'=>'form-control ','placeholder' => 'Design Year Connection']) !!}
                     {!! $errors->first('details.design_year_pvt_connection','<span class="text-danger">:message</span>') !!}
                </div>
            </div>
        </div>
 <div class="col-md-6 my-3">
    <h4 class="text-center text-bold m-3">Water Demand</h4>
     <div class="row mt-4">
        <div class="form-group col-md-6">
            <label>Base Year</label>
             {!! Form::text('details[base_year_water_demand]',null,['class'=>'form-control ','placeholder' => 'Base Year Water Demand']) !!}
             {!! $errors->first('details.base_year_water_demand','<span class="text-danger">:message</span>') !!}
        </div> 
        <div class="form-group col-md-6">
            <label>Design Year </label>
             {!! Form::text('details[design_year_water_demand]',null,['class'=>'form-control ','placeholder' => 'Design Year Water Demand']) !!}
             {!! $errors->first('details.design_year_water_demand','<span class="text-danger">:message</span>') !!}
        </div>
    </div>
</div>

        <div class="col-md-12 ">
            <h4 class="text-center text-bold m-3">Treatment Unit</h4>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Water Discharge </label>
                        {!! Form::number('details[treated_water_dicharge]',null,['class'=>'form-control','placeholder' => 'Water Discharge Detail','min'=>"0"]) !!}
                        {!! $errors->first('details.treated_water_dicharge','<span class="text-danger">:message</span>') !!}
                    </div> 
                    <div class="form-group col-md-12 my-2">
                        <label>Existing </label>
                        {!! Form::textarea('details[existing_treatment_detail]',null,['class'=>'form-control ','placeholder' => 'Existing Treatment Detail']) !!}
                        {!! $errors->first('details.existing_treatment_detail','<span class="text-danger">:message</span>') !!}
                    </div> 
                    <div class="form-group col-md-12 my-2">
                        <label>Designed </label>
                        {!! Form::textarea('details[proposed_treatment_detail]',null,['class'=>'form-control ','placeholder' => 'Proposed Treatment Detail']) !!}
                        {!! $errors->first('details.proposed_treatment_detail','<span class="text-danger">:message</span>') !!}
                    </div> 
                   
                </div>
        </div>


    </div>
</div>