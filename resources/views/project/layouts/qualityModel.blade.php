    <div class="modal fade" id="quality_model">
                                    <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">QC Data</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        {!! Form::open(['method' => 'post', 'url' => '/project/qcModel', 'autocomplete' => 'off', 'role'
                                            => 'form']) !!}

                                            <div class="row">
                                                <div class="form-group col-md-6 {{ $errors->has('qc_plan') ? 'has-error' : '' }}">
                                                    <label>QC and Quality assurance plan</label> <br>
                                                    {{ Form::radio('qc_plan', 'yes') }} Yes &nbsp;{{ Form::radio('qc_plan', 'no', true) }} No
                                                    {!! $errors->first('qc_plan', '<span class="text-danger">:message</span>') !!}
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('qc_plan_submitted') ? 'has-error' : '' }}">
                                                    <label>QC and Quality Assurance Plan submitted</label> <br>
                                                    {!! Form::text('qc_plan_submitted', null, ['class' => 'form-control datepicker', 'placeholder' => 'Example: 2021-01-01']) !!}
                                                    {!! $errors->first('qc_plan_submitted', '<span class="text-danger">:message</span>') !!}
                                                </div> 
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 {{ $errors->has('qc_calibiration_test') ? 'has-error' : '' }}">
                                                    <label>Calibration of testing machines</label> <br>
                                                    {{ Form::radio('qc_calibiration_test', 'yes') }} Yes &nbsp;{{ Form::radio('qc_calibiration_test', 'no', true) }} No
                                                    {!! $errors->first('qc_calibiration_test', '<span class="text-danger">:message</span>') !!}
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('qc_calibiration_test_submitted') ? 'has-error' : '' }}">
                                                    <label>Calibration records of testing machines submitted</label> <br>
                                                    {!! Form::text('qc_calibiration_test_submitted', null, ['class' => 'form-control datepicker', 'placeholder' => 'Example: 2021-01-01']) !!}
                                                    {!! $errors->first('qc_calibiration_test_submitted', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 {{ $errors->has('qc_third_party') ? 'has-error' : '' }}">
                                                    <label>Third Party Inspection</label><br>
                                                    {{ Form::radio('qc_third_party', 'yes') }} Yes &nbsp;{{ Form::radio('qc_third_party', 'no', true) }} No
                                                    {!! $errors->first('qc_third_party', '<span class="text-danger">:message</span>') !!}
                                                </div>

                                                <div class="form-group col-md-6 {{ $errors->has('qc_third_party_submitted') ? 'has-error' : '' }}">
                                                    <label>Third Party Inspection Report submitted</label> <br>
                                                    {!! Form::text('qc_third_party_submitted', null, ['class' => 'form-control datepicker', 'placeholder' => 'Example: 2021-01-01']) !!}
                                                    {!! $errors->first('qc_third_party_submitted', '<span class="text-danger">:message</span>') !!}
                                                </div>
                                            </div>
                                            <!-- /.form group -->

                                            <div class="modal-footer justify-content-between pull-right">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                                <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        {!! Form::close() !!}
                                        </div>
                                        <!-- /.modal-body -->
                                    </div>
                                    <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>