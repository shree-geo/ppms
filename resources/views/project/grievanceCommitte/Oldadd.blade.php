@extends('backend.layouts.app')
@section('title')
    Grievance Committe
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Grievance Committe</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Grievance Committe</li>
                            <li class="breadcrumb-item active">{{ trans('app.add') }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @include('backend.message.flash')

            <div class="form">
                <div class="card card-default">
                    <div class="card-header with-border">
                        <h3 class="card-title">{{ trans('app.add') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/grievanceCommitte/create'),
                        url('project/grievanceCommitte'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowAdd)

                            {!! Form::open(['method' => 'post', 'url' => '/project/grievanceCommitte', 'autocomplete' => 'off', 'role' => 'form']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div class="form-group col-md-4 {{ $errors->has('project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('project_id', $project->pluck('name', 'id'), Request::get('project_id'), ['class' => 'form-control select2', 'style' => 'width:100%;', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('project_id', '<span class="text-danger">:message</span>') !!}
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-center">First Level Committe Details</h3>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id="dynamicTable1">
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 85px">Level</th>
                                            <th>Designation</th>
                                            <th>Contact Number</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
                                        </tr>
                                        @if(Request::old('grievance.ward'))
                                        @foreach(Request::old('grievance.ward') as $key=>$grievance)
                                        <tr>
                                            <td>
                                                {!! Form::text("grievance[ward][$key][name]", null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                {!! $errors->first("grievance.ward.$key.name", '<span class="text-danger">:message</span>') !!}
                                                
                                            </td>
                                            <td>
                                                {!! Form::text("grievance[ward][$key][level]", 'ward', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance.ward.$key.level", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {{ Form::select("grievance[ward][$key][designation_id]", $grievanceWard, Request::get('grievance[ward][designation_id]'), ['class' => 'form-control select2', 'id' => '', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance.ward.$key.designation_id", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::text("grievance[ward][$key][contact_no]", null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance.ward.$key.contact_no", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::email("grievance[ward][$key][email]", null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance.ward.$key.email", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                          
                                            <td>
                                                @if($loop->first)
                                                <button type="button" name="add" id="add1" class="btn btn-sm btn-success"><i
                                                        class="fas fa-plus"></i></button>
                                                        @else
                                            <button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                                             @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>
                                                {!! Form::text('grievance[ward][0][name]', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                {!! $errors->first("grievance.ward.0.name", '<span class="text-danger">:message</span>') !!}
                                                
                                            </td>
                                            <td>
                                                {!! Form::text('grievance[ward][0][level]', 'ward', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance.ward.0.level", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {{ Form::select('grievance[ward][0][designation_id]', $grievanceWard, Request::get('grievance[ward][designation_id]'), ['class' => 'form-control select2', 'id' => '', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance.ward.0.designation_id", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::text('grievance[ward][0][contact_no]', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance.ward.0.contact_no", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::email('grievance[ward][0][email]', null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance.ward.0.email", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                          
                                            <td><button type="button" name="add" id="add1" class="btn btn-sm btn-success"><i
                                                        class="fas fa-plus"></i></button></td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <h3 class="text-center">Second Level Committe Details</h3>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" id="dynamicTable2">
                                        <tr>
                                            <th>Name</th>
                                            <th style="width: 85px">Level</th>
                                            <th>Designation</th>
                                            <th>Contact Number</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
                                        </tr>
                                        @if(Request::old('grievance.muni'))
                                        @foreach(Request::old('grievance.muni') as $key=>$grievance)
                                        <tr>
                                            <td>
                                                {!! Form::text("grievance[muni][$key][name]", null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                {!! $errors->first("grievance.muni.$key.name", '<span class="text-danger">:message</span>') !!}
                                                
                                            </td>
                                            <td>
                                                {!! Form::text("grievance[muni][$key][level]", 'muni', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance.muni.$key.level", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {{ Form::select("grievance[muni][$key][designation_id]", $grievanceWard, Request::get('grievance[muni][designation_id]'), ['class' => 'form-control select2', 'id' => '', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance.muni.$key.designation_id", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::text("grievance[muni][$key][contact_no]", null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance.muni.$key.contact_no", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                            <td>
                                                {!! Form::email("grievance[muni][$key][email]", null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance.muni.$key.email", '<span class="text-danger">:message</span>') !!}

                                            </td>
                                          
                                            <td>
                                                @if($loop->first)
                                                <button type="button" name="add" id="add1" class="btn btn-sm btn-success"><i
                                                        class="fas fa-plus"></i></button>
                                                        @else
                                            <button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                                             @endif
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td>
                                                {!! Form::text('grievance[muni][0][name]', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                {!! $errors->first("grievance.muni.0.name", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>
                                            <td>
                                                {!! Form::text('grievance[muni][0][level]', 'muni', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance.muni.0.level", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>
                                            <td>
                                                {{ Form::select('grievance[muni][0][designation_id]', $grievanceMuni, Request::get('grievance[muni][designation_id]'), ['class' => 'form-control select2', 'id' => 'designation_id', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance.muni.0.designation_id", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>
                                            <td>
                                                {!! Form::text('grievance[muni][0][contact_no]', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance.muni.0.contact_no", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>
                                            <td>
                                                {!! Form::email('grievance[muni][0][email]', null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance.muni.0.email", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>
                    
                                            <td><button type="button" name="add" id="add2" class="btn btn-sm btn-success"><i
                                                        class="fas fa-plus"></i></button></td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>




                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/grievanceCommitte') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            {!! Form::close() !!}
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                </button>
                                You Cannot access this module Please Contact your Super Admin user to access this.
                            </div>

                        @endif

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection

@section('js')

    <script>
        var count_row2 = 0;
        $('#add1').click(function() {
            ++count_row2;
            $("#dynamicTable1").append(` <tr>
              <td>
                                                {!! Form::text('grievance[ward][${count_row2}][name]', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                                {!! $errors->first("grievance[ward][${count_row2}][name]", '<span class="text-danger">:message</span>') !!}

                                            </td>  
                                            <td>
                                                {!! Form::text('grievance[ward][${count_row2}][level]', 'ward', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance[ward][${count_row2}][level]", '<span class="text-danger">:message</span>') !!}

                                            </td> 
                                            <td>
                                                {{ Form::select('grievance[ward][${count_row2}][designation_id]', $grievanceWard, Request::get('grievance[ward][designation_id]'), ['class' => 'form-control select2', 'id' => 'designation_id', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance[ward][${count_row2}][designation_id]", '<span class="text-danger">:message</span>') !!}

                                            </td> 
                                            <td>
                                                {!! Form::text('grievance[ward][${count_row2}][contact_no]', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance[ward][${count_row2}][contact_no]", '<span class="text-danger">:message</span>') !!}

                                            </td> 
                                            <td>
                                                {!! Form::email('grievance[ward][${count_row2}][email]', null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance[ward][${count_row2}][email]", '<span class="text-danger">:message</span>') !!}

                                            </td> 
                                            
                                            <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                                            </tr> `);

                                            $('.datepicker').datepicker({
                                                format: 'yyyy-mm-dd',
                                                autoclose: true,
                                            });

                                            $('.select2').select2();

                                        });
                                        $(document).on('click', '.remove-tr', function() {
                                            $(this).parents('tr').remove();
                                        });

    </script>

    <script>
        var count_row1 = 0;
        $('#add2').click(function() {
            ++count_row1;
            $("#dynamicTable2").append(` <tr>
            <td>{!! Form::text('grievance[muni][${count_row1}][name]', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                {!! $errors->first("grievance[muni][${count_row1}][name]", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td>  
                                            <td>
                                                {!! Form::text('grievance[muni][${count_row1}][level]', 'muni', ['class' => 'form-control', 'placeholder' => 'Level', 'readonly']) !!}
                                                {!! $errors->first("grievance[muni][${count_row1}][level]", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td> 
                                            <td>
                                                {{ Form::select('grievance[muni][${count_row1}][designation_id]', $grievanceMuni, Request::get('grievance[muni][designation_id]'), ['class' => 'form-control select2', 'id' => 'designation_id', 'placeholder' => 'Select Designation']) }}
                                                {!! $errors->first("grievance[muni][${count_row1}][designation_id]", '<span class="text-danger">:message</span>') !!}
                                           
                                            </td> 
                                            <td>
                                                {!! Form::text('grievance[muni][${count_row1}][contact_no]', null, ['class' => 'form-control', 'placeholder' => 'Enter Contact No.']) !!}
                                                {!! $errors->first("grievance[muni][${count_row1}][contact_no]", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td> 
                                            <td>
                                                {!! Form::email('grievance[muni][${count_row1}][email]', null, ['class' => 'form-control', 'placeholder' => 'Enter Valid Email']) !!}
                                                {!! $errors->first("grievance[muni][${count_row1}][email]", '<span class="text-danger">:message</span>') !!}
                                            
                                            </td> 
                                           
                                            <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                                            </tr> `);

                                            $('.datepicker').datepicker({
                                                format: 'yyyy-mm-dd',
                                                autoclose: true,
                                            });

                                            $('.select2').select2();
                                        });
                                        $(document).on('click', '.remove-tr', function() {
                                            $(this).parents('tr').remove();
                                        });

    </script>

@endsection
