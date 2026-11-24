<div class="field_reservoir">
    @if (count($edits['reservoirs']) == 0)
        <div class="card-body">
            <div class=" card "
                style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;margin-bottom: 1rem;">
                <div class="col-md-12" style="padding-top: 15px; padding-right: 15px;">
                    <a href="javascript:void(0);" class="add_reservoir btn btn-success pull-right"
                        onclick="reservoirfield()" title="Add More"><i class="fa fa-plus" aria-hidden="true"></i> Add
                        More</a>
                </div>
                <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                    <div class="form-group col-md-3">
                        <label> Reservoir Name </label>
                        {!! Form::text('reservoirs[0][reservoir_name]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Name']) !!}
                        {!! $errors->first('reservoirs.0.reservoir_name', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Capacity </label>
                        {!! Form::number('reservoirs[0][capacity]', null, ['class' => 'form-control', 'placeholder' => 'Capacity']) !!}
                        {!! $errors->first('reservoirs.0.capacity', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Location </label>
                        {!! Form::text('reservoirs[0][reservoir_location]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Location']) !!}
                        {!! $errors->first('reservoirs.0.reservoir_location', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Latitude </label>
                        {!! Form::text('reservoirs[0][reservoir_lat]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Latitude']) !!}
                        {!! $errors->first('reservoirs.0.reservoir_lat', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Longitude </label>
                        {!! Form::text('reservoirs[0][reservoir_lang]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Longitude']) !!}
                        {!! $errors->first('reservoirs.0.reservoir_lang', '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Type</label>
                        {!! Form::select('reservoirs[0][reservoirs_type]', ['overhead' => 'Overhead', 'ground' => 'Ground'], null, ['class' => 'form-control', 'placeholder' => 'Pick a Type...']) !!}
                        {!! $errors->first('reservoirs.0.reservoirs_type', '<span class="text-danger">:message</span>') !!}

                    </div>
                </div>
            </div>
        </div>
        @elseif(Request::old('reservoirs')!=null)
        
            @foreach (Request::old('reservoirs') as $key => $reservoirs)
        <div class="col">
            <div class=" card "
                style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;margin-bottom: 1rem;">
                <div class="col-md-12" style="padding-top: 15px; padding-right: 15px;">
                    @if ($loop->index + 1 == 1)
                        <a href="javascript:void(0);" class="add_reservoir btn btn-success pull-right"
                            onclick="reservoirfield()" title="Add More"><i class="fa fa-plus"
                                aria-hidden="true"></i> Add More</a>

                    @else
                        <a href="javascript:void(0);" class=" remove_button btn btn-danger pull-right mt-2"
                            onclick="removefunction({{ $key }})" title="Remove"
                            id="removeDiv_{{ $key }}"> <i class="fa fa-times" aria-hidden="true"></i>
                            Remove </a>

                    @endif

                </div>
                <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                    <div class="form-group col-md-3">
                        <label> Reservoir Name </label>
                        {!! Form::text('reservoirs[' . $key . '][reservoir_name]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Name']) !!}
                        {!! $errors->first("reservoirs.$key.reservoir_name", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Capacity </label>
                        {!! Form::number('reservoirs[' . $key . '][capacity]', null, ['class' => 'form-control', 'placeholder' => 'Capacity']) !!}
                        {!! $errors->first("reservoirs.$key.capacity", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Location </label>
                        {!! Form::text('reservoirs[' . $key . '][reservoir_location]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Location']) !!}
                        {!! $errors->first("reservoirs.$key.reservoir_location", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Latitude </label>
                        {!! Form::text('reservoirs[' . $key . '][reservoir_lat]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Latitude']) !!}
                        {!! $errors->first("reservoirs.$key.reservoir_lat", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Longitude </label>
                        {!! Form::text('reservoirs[' . $key . '][reservoir_lang]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Longitude']) !!}
                        {!! $errors->first("reservoirs.$key.reservoir_lang", '<span class="text-danger">:message</span>') !!}

                    </div>
                    <div class="form-group col-md-3">
                        <label> Reservoir Type</label>
                        {!! Form::select('reservoirs[' . $key . '][reservoirs_type]', ['overhead' => 'Overhead', 'ground' => 'Ground'], null, ['class' => 'form-control', 'placeholder' => 'Pick a Type...']) !!}
                        {!! $errors->first("reservoirs.$key.reservoirs_type", '<span class="text-danger">:message</span>') !!}

                    </div>
                </div>
            </div>
        </div>

    @endforeach
    @else
        @foreach ($edits['reservoirs'] as $key => $reservoirs)
            <div class="col">
                <div class=" card "
                    style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;margin-bottom: 1rem;">
                    <div class="col-md-12" style="padding-top: 15px; padding-right: 15px;">
                        @if ($loop->index + 1 == 1)
                            <a href="javascript:void(0);" class="add_reservoir btn btn-success pull-right"
                                onclick="reservoirfield()" title="Add More"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Add More</a>

                        @else
                            <a href="javascript:void(0);" class=" remove_button btn btn-danger pull-right mt-2"
                                onclick="removefunction({{ $key }})" title="Remove"
                                id="removeDiv_{{ $key }}"> <i class="fa fa-times" aria-hidden="true"></i>
                                Remove </a>

                        @endif

                    </div>
                    <div class="card-body row" style="padding-top: 15px;padding-right: 20px;">
                        <div class="form-group col-md-3">
                            <label> Reservoir Name </label>
                            {!! Form::text('reservoirs[' . $key . '][reservoir_name]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Name']) !!}
                            {!! $errors->first("reservoirs.$key.reservoir_name", '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="form-group col-md-3">
                            <label> Capacity </label>
                            {!! Form::number('reservoirs[' . $key . '][capacity]', null, ['class' => 'form-control', 'placeholder' => 'Capacity']) !!}
                            {!! $errors->first("reservoirs.$key.capacity", '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="form-group col-md-3">
                            <label> Reservoir Location </label>
                            {!! Form::text('reservoirs[' . $key . '][reservoir_location]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Location']) !!}
                            {!! $errors->first("reservoirs.$key.reservoir_location", '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="form-group col-md-3">
                            <label> Reservoir Latitude </label>
                            {!! Form::text('reservoirs[' . $key . '][reservoir_lat]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Latitude']) !!}
                            {!! $errors->first("reservoirs.$key.reservoir_lat", '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="form-group col-md-3">
                            <label> Reservoir Longitude </label>
                            {!! Form::text('reservoirs[' . $key . '][reservoir_lang]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Longitude']) !!}
                            {!! $errors->first("reservoirs.$key.reservoir_lang", '<span class="text-danger">:message</span>') !!}

                        </div>
                        <div class="form-group col-md-3">
                            <label> Reservoir Type</label>
                            {!! Form::select('reservoirs[' . $key . '][reservoirs_type]', ['overhead' => 'Overhead', 'ground' => 'Ground'], null, ['class' => 'form-control', 'placeholder' => 'Pick a Type...']) !!}
                            {!! $errors->first("reservoirs.$key.reservoirs_type", '<span class="text-danger">:message</span>') !!}

                        </div>
                    </div>
                </div>
            </div>

        @endforeach
    @endif
</div>
