<div class="card-body ">
    <div class="row">
 

        <div class="col-md-12 ">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>Contract Date</label>
                        {!! Form::date('project[oba_contract_date]',null,['class'=>'form-control','placeholder' => 'Contract date']) !!}
                        {!! $errors->first('project.oba_contract_date','<span class="text-danger">:message</span>') !!}
                    </div> 
                    <div class="form-group col-md-12 my-2">
                        <label>Details </label>
                        {!! Form::textarea('project[oba_contract_details]',null,['class'=>'form-control ','placeholder' => 'Details']) !!}
                        {!! $errors->first('project.oba_contract_details','<span class="text-danger">:message</span>') !!}
                    </div> 
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('project.oba_file') ? 'has-error' : '' }}">
                            <label>Files</label><br/>
                            <input type="file" class="" id="file_upload" name="files" multiple /><br/>
                            <span class="help-block text-danger"> Only jpg, jpeg, png and pdf files are supported</span> <br/>
                                {!! $errors->first('project.oba_file', '<span class="text-danger">:message</span>') !!}                                            
                            </div>
                            <div class="row mb-4" id="image_preview" style="width:100%;"></div>
                    </div>
                    
                    @if($edits['project']->oba_file!=null)
                    <?php $extension = explode('.', $edits['project']->oba_file); ?>
                    @if ($extension[1] == 'pdf')
                    <a href="{{url('delete/project/'.$edits['project']->id.'/'.$edits['project']->oba_file)}}" id="x-edit">
                        <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                    </a>&nbsp;
                    <a href="{{ asset('storage/uploads/oba/' . $edits['project']->oba_file) }}" target="_blank">{{ $edits['project']->oba_file }}</a>&nbsp;&nbsp;&nbsp;
                    @else                                          
                    
                    <div class="row">
                        <div class="col-md-4" >
                            <a href="{{url('delete/project/'.$edits['project']->id.'/'.$edits['project']->oba_file)}}" id="x-edit">
                            <i class="fa fa-close" style="color: red;" onclick="return confirm('Do you want to delete?')"></i>
                        </a>
                            <img src="{{asset('/storage/uploads/oba/'. $edits['project']->oba_file)}}" style="height:180px; ">
                        </div>
                    </div>
                        @endif
                 @endif
                   
                </div>
        </div>


    </div>
</div>


