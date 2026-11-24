<div class="field_source">
    @if (count($edits['sources']) == 0)
        <div class="col ">
            <div class=" card "
                style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;margin-bottom: 1rem;">
                <div class="col-md-12" style="padding-right: 15px;padding-top: 20px;">
                    <a href="javascript:void(0);" class="add_source btn btn-success pull-right" onclick="sourcefield()"
                        title="Add More"><i class="fa fa-plus" aria-hidden="true"></i> Add More</a>
                </div>
                <div class="card-body row" style="padding-top: 15px; padding-right: 20px;">

                    <div class="form-group col-md-3">
                        <label> Source Name </label>
                        {!! Form::text('sources[0][source_name]', null, ['class' => 'form-control', 'placeholder' => 'Source Name']) !!}
                        {!! $errors->first('sources.0.source_name', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Type </label>
                        {!! Form::text('sources[0][source_type]', null, ['class' => 'form-control', 'placeholder' => 'Source Type']) !!}
                        {!! $errors->first('sources.0.source_type', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Location </label>
                        {!! Form::text('sources[0][source_location]', null, ['class' => 'form-control', 'placeholder' => 'Source Location']) !!}
                        {!! $errors->first('sources.0.source_location', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Latitude </label>
                        {!! Form::text('sources[0][source_lat]', null, ['class' => 'form-control', 'placeholder' => 'Source Latitude']) !!}
                        {!! $errors->first('sources.0.source_lat', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Longitude </label>
                        {!! Form::text('sources[0][source_lan]', null, ['class' => 'form-control', 'placeholder' => 'Source Longitude']) !!}
                        {!! $errors->first('sources.0.source_lan', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Proposed Intake </label>
                        {!! Form::textarea('sources[0][proposed_intake]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Proposed Intake']) !!}
                        {!! $errors->first('sources.0.proposed_intake', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Discharge</label>
                        {!! Form::textarea('sources[0][discharge]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Discharge']) !!}
                        {!! $errors->first('sources.0.discharge', '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Remarks</label>
                        {!! Form::textarea('sources[0][remarks]', null, ['class' => 'form-control  textarea1', 'placeholder' => 'Remarks']) !!}
                        {!! $errors->first('sources.0.remarks', '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
    @elseif(Request::old('sources')!=null)
        
            @foreach (Request::old('sources') as $key => $sources)
        <div class="col ">
            <div class="card" style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;">
                <div class="col-md-12" style="padding-top: 15px; padding-right: 15px;">

                    @if ($loop->index + 1 == 1)
                        <a href="javascript:void(0);" class="add_source btn btn-success pull-right"
                            onclick="sourcefield()" title="Add More"><i class="fa fa-plus" aria-hidden="true"></i>
                            Add More</a>
                    @else
                        <a href="javascript:void(0);" onclick="removefunctionSource({{ $key }})"
                            id="removeDiv1_{{ $key }}" class="remove_button btn btn-danger pull-right mt-2"
                            title="Remove"> <i class="fa fa-times" aria-hidden="true"></i> Remove </a>
                    @endif
                </div>
                <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                    <div class="form-group col-md-3">

                        <label> Source Name </label>
                        {!! Form::text('sources[' . $key . '][source_name]', null, ['class' => 'form-control', 'placeholder' => 'Source Name']) !!}
                        {!! $errors->first("sources.$key.source_name", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Type </label>
                        {!! Form::text('sources[' . $key . '][source_type]', null, ['class' => 'form-control', 'placeholder' => 'Source Type']) !!}
                        {!! $errors->first("sources.$key.source_type", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Location </label>
                        {!! Form::text('sources[' . $key . '][source_location]', null, ['class' => 'form-control', 'placeholder' => 'Source Location']) !!}
                        {!! $errors->first("sources.$key.source_location", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Latitude </label>
                        {!! Form::text('sources[' . $key . '][source_lat]', null, ['class' => 'form-control', 'placeholder' => 'Source Latitude']) !!}
                        {!! $errors->first("sources.$key.source_lat", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Source Longitude </label>
                        {!! Form::text('sources[' . $key . '][source_lan]', null, ['class' => 'form-control', 'placeholder' => 'Source Longitude']) !!}
                        {!! $errors->first("sources.$key.source_lan", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Proposed Intake </label>
                        {!! Form::textarea('sources[' . $key . '][proposed_intake]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Proposed Intake']) !!}
                        {!! $errors->first("sources.$key.proposed_intake", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Discharge</label>
                        {!! Form::textarea('sources[' . $key . '][discharge]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Discharge']) !!}
                        {!! $errors->first("sources.$key.discharge", '<span class="text-danger">:message</span>') !!}
                    </div>
                    <div class="form-group col-md-3">
                        <label> Remarks</label>
                        {!! Form::textarea('sources[' . $key . '][remarks]', null, ['class' => 'form-control  textarea1', 'placeholder' => 'Remarks']) !!}
                        {!! $errors->first("sources.$key.remarks", '<span class="text-danger">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    @else
        
            @foreach ($edits['sources'] as $key => $sources)
                <div class="col ">
                    <div class="card"
                        style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;">
                        <div class="col-md-12" style="padding-top: 15px; padding-right: 15px;">

                            @if ($loop->index + 1 == 1)
                                <a href="javascript:void(0);" class="add_source btn btn-success pull-right"
                                    onclick="sourcefield()" title="Add More"><i class="fa fa-plus"
                                        aria-hidden="true"></i>
                                    Add More</a>
                            @else
                                <a href="javascript:void(0);" onclick="removefunctionSource({{ $key }})"
                                    id="removeDiv1_{{ $key }}"
                                    class="remove_button btn btn-danger pull-right mt-2" title="Remove"> <i
                                        class="fa fa-times" aria-hidden="true"></i> Remove </a>
                            @endif
                        </div>
                        <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                            <div class="form-group col-md-3">

                                <label> Source Name </label>
                                {!! Form::text('sources[' . $key . '][source_name]', null, ['class' => 'form-control', 'placeholder' => 'Source Name']) !!}
                                {!! $errors->first("sources.$key.source_name", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Source Type </label>
                                {!! Form::text('sources[' . $key . '][source_type]', null, ['class' => 'form-control', 'placeholder' => 'Source Type']) !!}
                                {!! $errors->first("sources.$key.source_type", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Source Location </label>
                                {!! Form::text('sources[' . $key . '][source_location]', null, ['class' => 'form-control', 'placeholder' => 'Source Location']) !!}
                                {!! $errors->first("sources.$key.source_location", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Source Latitude </label>
                                {!! Form::text('sources[' . $key . '][source_lat]', null, ['class' => 'form-control', 'placeholder' => 'Source Latitude']) !!}
                                {!! $errors->first("sources.$key.source_lat", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Source Longitude </label>
                                {!! Form::text('sources[' . $key . '][source_lan]', null, ['class' => 'form-control', 'placeholder' => 'Source Longitude']) !!}
                                {!! $errors->first("sources.$key.source_lan", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Proposed Intake </label>
                                {!! Form::textarea('sources[' . $key . '][proposed_intake]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Proposed Intake']) !!}
                                {!! $errors->first("sources.$key.proposed_intake", '<span class="text-danger">:message</span>') !!}

                            </div>
                            <div class="form-group col-md-3">
                                <label> Discharge</label>
                                {!! Form::textarea('sources[' . $key . '][discharge]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Discharge']) !!}
                                {!! $errors->first("sources.$key.discharge", '<span class="text-danger">:message</span>') !!}
                            </div>
                            <div class="form-group col-md-3">
                                <label> Remarks</label>
                                {!! Form::textarea('sources[' . $key . '][remarks]', null, ['class' => 'form-control  textarea1', 'placeholder' => 'Remarks']) !!}
                                {!! $errors->first("sources.$key.remarks", '<span class="text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            
        @endif

</div>
