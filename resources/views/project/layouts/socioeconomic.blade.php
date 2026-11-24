
                            <h4 style="margin-left:450px;"><b>Beneficiary Details</b></h4>

                             <div class="row">
                             <div class="form-group col-md-4 {{ ($errors->has('ben.beneficiary_sector'))?'has-error':'' }}">
                                    <label>Beneficiary <label class="text-danger"> *</label></label>
                                    <select id="beneficiary_sector" name="ben[beneficiary_sector]" class="form-control select2">
                                        <option value="" selected>Select Beneficiary</option>
                                        <option value="water_supply" {{($edits['ben']!=null && $edits['ben']->beneficiary_sector=='water_supply')?'selected':''}}>Water Supply</option>
                                        <option value="sanitation" {{( $edits['ben']!=null && $edits['ben']->beneficiary_sector=='sanitation')?'selected':''}}>Sanitation</option>
                                        <option value="drainage" {{( $edits['ben']!=null && $edits['ben']->beneficiary_sector=='drainage')?'selected':''}}>Drainage</option>
                                    </select>
                                    {!! $errors->first('ben.beneficiary_sector','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <div class="row">
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.dalit_f'))?'has-error':'' }}">
                                    <label>Dalit Female</label>
                                    {!! Form::number('ben[dalit_f]',null,['class'=>'form-control','placeholder' => 'Dalit Female']) !!}
                                    {!! $errors->first('ben.dalit_f','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.dalit_m'))?'has-error':'' }}">
                                    <label>Dalit Male</label>
                                    {!! Form::number('ben[dalit_m]',null,['class'=>'form-control','placeholder' => 'Dalit Male']) !!}
                                    {!! $errors->first('ben.dalit_m','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.janjati_f'))?'has-error':'' }}">
                                    <label>Janajati Female</label>
                                    {!! Form::number('ben[janjati_f]',null,['class'=>'form-control','placeholder' => 'Janajati Female']) !!}
                                    {!! $errors->first('ben.janjati_f','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.janjati_m'))?'has-error':'' }}">
                                    <label>Janajati Male</label>
                                    {!! Form::number('ben[janjati_m]',null,['class'=>'form-control','placeholder' => 'Janajati Male']) !!}
                                    {!! $errors->first('ben.janjati_m','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.bramin_f'))?'has-error':'' }}">
                                    <label>Braman/Chhetri Female</label>
                                    {!! Form::number('ben[bramin_f]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Female']) !!}
                                    {!! $errors->first('ben.bramin_f','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.bramin_m'))?'has-error':'' }}">
                                    <label>Braman/Chhetri Male</label>
                                    {!! Form::number('ben[bramin_m]',null,['class'=>'form-control','placeholder' => 'Braman/Chhetri Male']) !!}
                                    {!! $errors->first('ben.bramin_m','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.muslim_f'))?'has-error':'' }}">
                                    <label>Muslim Female</label>
                                    {!! Form::number('ben[muslim_f]',null,['class'=>'form-control','placeholder' => 'Muslim Female']) !!}
                                    {!! $errors->first('ben.muslim_f','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('ben.muslim_m'))?'has-error':'' }}">
                                    <label>Muslim Male</label>
                                    {!! Form::number('ben[muslim_m]',null,['class'=>'form-control','placeholder' => 'Muslim Male']) !!}
                                    {!! $errors->first('ben.muslim_m','<span class="text-danger">:message</span>') !!}
                                </div>
                                
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.other_f'))?'has-error':'' }}">
                                    <label>Others Female</label>
                                    {!! Form::number('ben[other_f]',null,['class'=>'form-control','placeholder' => 'Others Female']) !!}
                                    {!! $errors->first('ben.other_f','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-6 {{ ($errors->has('ben.other_m'))?'has-error':'' }}">
                                    <label>Others Male</label>
                                    {!! Form::number('ben[other_m]',null,['class'=>'form-control','placeholder' => 'Others Male']) !!}
                                    {!! $errors->first('ben.other_m','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                            <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Institutional Details</b></h4>

                            <div class="row">
                             <div class="form-group col-md-4 {{ ($errors->has('insti.type'))?'has-error':'' }}">
                                <label>Institutional <label class="text-danger"> *</label></label>
                                    <select id="type" name="insti[type]" class="form-control select2">
                                        <option value="" selected>Select</option>
                                        <option value="fixed" {{($edits['insti']!=null &&$edits['insti']->type=='fixed')?'selected':''}}>Fixed </option>
                                        <option value="floating" {{($edits['insti']!=null &&$edits['insti']->type=='floating')?'selected':''}}>Floating</option>
                                    </select>
                                    {!! $errors->first('insti.type','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                <div class="row">
                                 <div class="form-group col-md-6 {{ ($errors->has('insti.institution_name'))?'has-error':'' }}">
                                    <label>Institution Name</label>
                                    {!! Form::text('insti[institution_name]',null,['class'=>'form-control','placeholder' => 'Institution Name']) !!}
                                    {!! $errors->first('insti.institution_name','<span class="text-danger">:message</span>') !!}
                                </div>
                                 <div class="form-group col-md-6 {{ ($errors->has('insti.institution_type'))?'has-error':'' }}">
                                    <label>Institution Type</label>
                                    {!! Form::text('insti[institution_type]',null,['class'=>'form-control','placeholder' => 'Institution Type']) !!}
                                    {!! $errors->first('insti.institution_type','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('insti.total_female'))?'has-error':'' }}">
                                    <label>Female</label>
                                    {!! Form::number('insti[total_female]',null,['class'=>'form-control','placeholder' => 'Female']) !!}
                                    {!! $errors->first('insti.total_female','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('insti.total_male'))?'has-error':'' }}">
                                   <label>Male</label>
                                   {!! Form::number('insti[total_male]',null,['class'=>'form-control','placeholder' => 'Male']) !!}
                                   {!! $errors->first('insti.total_male','<span class="text-danger">:message</span>') !!}
                               </div>
                                </div>
                            <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Workmanship Skill Details</b></h4>

                                <div class="row">
                                     <div class="form-group col-md-6 {{ ($errors->has('project.skilled_manpower'))?'has-error':'' }}">
                                    <label>Skilled Manpower</label>
                                    {!! Form::number('project[skilled_manpower]',null,['class'=>'form-control','placeholder' => 'Skilled']) !!}
                                    {!! $errors->first('project.skilled_manpower','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.unskilled_manpower'))?'has-error':'' }}">
                                    <label>Unskilled Manpower</label>
                                    {!! Form::number('project[unskilled_manpower]',null,['class'=>'form-control','placeholder' => 'Unskilled']) !!}
                                    {!! $errors->first('project.unskilled_manpower','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.total_household'))?'has-error':'' }}">
                                    <label>Household Number</label>
                                    {!! Form::number('project[total_household]',null,['class'=>'form-control','placeholder' => 'Household Number']) !!}
                                    {!! $errors->first('project.total_household','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.total_population'))?'has-error':'' }}">
                                    <label>Population</label>
                                    {!! Form::number('project[total_population]',null,['class'=>'form-control','placeholder' => 'Population']) !!}
                                    {!! $errors->first('project.total_population','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.survey_year'))?'has-error':'' }}">
                                    <label>Survey Year</label>
                                    {!! Form::number('project[survey_year]',null,['class'=>'form-control','placeholder' => 'Survey Year']) !!}
                                    {!! $errors->first('project.survey_year','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.base_year'))?'has-error':'' }}">
                                    <label>Base Year</label>
                                    {!! Form::number('project[base_year]',null,['class'=>'form-control','placeholder' => 'Base Year']) !!}
                                    {!! $errors->first('project.base_year','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.design_year'))?'has-error':'' }}">
                                    <label>Design Year</label>
                                    {!! Form::number('project[design_year]',null,['class'=>'form-control','placeholder' => 'Design Year']) !!}
                                    {!! $errors->first('project.design_year','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.projected_year'))?'has-error':'' }}">
                                    <label>Projected Year</label>
                                    {!! Form::number('project[projected_year]',null,['class'=>'form-control','placeholder' => 'Projected Year']) !!}
                                    {!! $errors->first('project.projected_year','<span class="text-danger">:message</span>') !!}
                                </div>
                                <div class="form-group col-md-6 {{ ($errors->has('project.average_family_size'))?'has-error':'' }}">
                                    <label>Family Size</label>
                                    {!! Form::number('project[average_family_size]',null,['class'=>'form-control','placeholder' => 'Family Size']) !!}
                                    {!! $errors->first('project.average_family_size','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                 <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Affordability  of Population   for  UWSSP services</b></h4>

                                <div class="row">
                                     <div class="form-group col-md-4 {{ ($errors->has('project.aff_avg_income'))?'has-error':'' }}">
                                    <label>Average Income</label>
                                    {!! Form::number('project[aff_avg_income]',null,['class'=>'form-control','placeholder' => 'Average income']) !!}
                                    {!! $errors->first('project.aff_avg_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-4 {{ ($errors->has('project.aff_low_income'))?'has-error':'' }}">
                                    <label>Low Income</label>
                                    {!! Form::number('project[aff_low_income]',null,['class'=>'form-control','placeholder' => 'Low income']) !!}
                                    {!! $errors->first('project.aff_low_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-4 {{ ($errors->has('project.aff_poor_income'))?'has-error':'' }}">
                                    <label>Poor Income</label>
                                    {!! Form::number('project[aff_poor_income]',null,['class'=>'form-control','placeholder' => 'Poor income']) !!}
                                    {!! $errors->first('project.aff_poor_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                                 <h4 style="margin-bottom: 45px; margin-left:450px; margin-top:45px;"><b>Average  Monthly Income</b></h4>

                                <div class="row">
                                     <div class="form-group col-md-4 {{ ($errors->has('project.monthly_high_income'))?'has-error':'' }}">
                                    <label>High Income</label>
                                    {!! Form::number('project[monthly_high_income]',null,['class'=>'form-control','placeholder' => 'High income']) !!}
                                    {!! $errors->first('project.monthly_high_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-4 {{ ($errors->has('project.monthly_avg_income'))?'has-error':'' }}">
                                    <label>Average Income</label>
                                    {!! Form::number('project[monthly_avg_income]',null,['class'=>'form-control','placeholder' => 'Average income']) !!}
                                    {!! $errors->first('project.monthly_avg_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-4 {{ ($errors->has('project.monthly_low_income'))?'has-error':'' }}">
                                    <label>Low Income</label>
                                    {!! Form::number('project[monthly_low_income]',null,['class'=>'form-control','placeholder' => 'Low income']) !!}
                                    {!! $errors->first('project.monthly_low_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                     <div class="form-group col-md-4 {{ ($errors->has('project.monthly_bpl_income'))?'has-error':'' }}">
                                    <label>BPL</label>
                                    {!! Form::number('project[monthly_bpl_income]',null,['class'=>'form-control','placeholder' => 'BPL']) !!}
                                    {!! $errors->first('project.monthly_bpl_income','<span class="text-danger">:message</span>') !!}
                                </div>
                                </div>
                       