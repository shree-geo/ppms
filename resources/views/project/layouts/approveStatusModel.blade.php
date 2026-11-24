    <div class="modal fade" id="status_{{ $val->id }}">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'post', 'url' => '/project', 'autocomplete' => 'off',
                    'role' => 'form']) !!}

                    <div class="row ">
                        <div class="form-group col-md-12 ">
                            <label style="display: flex;">Status</label>
                            
                            <select class=" form-control" name="status_{{ $val->id }}" id="statusdetail_{{ $val->id }}" required>
                                <option value=""  >Select</option>
                                <option value="approved">Approved</option>                                                                       
                                <option value="revision">Revision</option>                
                                <option value="canceled">Canceled</option>                                                   
                            </select>
                            
                        </div>
                        <div class="form-group col-md-12 ">
                            <label class="pull-left">Comments</label> <br>
                            <textarea name="comment" class="form-control view" placeholder="Write comment "
                                id="comments_{{ $val->id }}" rows="5" cols="80" required="required"></textarea>

                        </div>

                    </div>
                </div>
                <!-- /.form group -->

                <div class="modal-footer  pull-right">
                    <button type="button" class="btn btn-primary"
                        onclick="sendRequest({{ $val->id }})">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->


