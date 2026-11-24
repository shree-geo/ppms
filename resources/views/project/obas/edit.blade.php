@extends('backend.layouts.app')
@section('title')
    Projects Obas
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Project Obas</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">{{ trans('app.dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">Projects</li>
                            <li class="breadcrumb-item">Obas</li>
                            <li class="breadcrumb-item active">{{ trans('app.edit') }}</li>
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
                        <h3 class="card-title">{{ trans('app.edit') }}</h3>
                        <?php
                        $permission = helperPermissionLink(url('project/oba/create'), url('project/oba'));

                        $allowEdit = $permission['isEdit'];

                        $allowDelete = $permission['isDelete'];

                        $allowAdd = $permission['isAdd'];
                        ?>
                    </div>
                    <div class="card-body">
                        @if ($allowEdit)
                            {!! Form::model($edits, ['method' => 'put', 'route' => ['oba.update', $edits['obas']->id],
                            'autocomplete' => 'off', 'role' => 'form']) !!}

                            <div class="row">
                                @if (auth()->user()->user_group_id != 2)
                                    <div
                                        class="form-group col-md-4 {{ $errors->has('obas.project_id') ? 'has-error' : '' }}">
                                        <label>Subproject<label class="text-danger">*</label></label>
                                        {{ Form::select('obas[project_id]', $projects->pluck('name', 'id'), Request::get('obas.project_id'), ['class' => 'form-control  select2', 'id' => 'project_id', 'placeholder' => 'Select Project Name']) }}
                                        {!! $errors->first('obas.project_id', '<span class="text-danger">:message</span>')
                                        !!}
                                    </div>
                                @endif

                                <div class="form-group col-md-4 {{ $errors->has('obas.oba_types_id') ? 'has-error' : '' }}">
                                    <label>Oba Type <label class="text-danger"> *</label></label>
                                    {{ Form::select('obas[oba_types_id]', $oba_types->pluck('oba_type_name', 'id'), Request::get('obas[oba_types_id]'), ['class' => 'form-control  select2', 'id' => 'obaType_id', 'placeholder' => 'Select Oba Type']) }}
                                    {!! $errors->first('obas.oba_types_id', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>

                            <div class="row">

                                <div class="form-group col-md-3 {{ $errors->has('obas.dis_id') ? 'has-error' : '' }}">
                                    <label>District <label class="text-danger"> *</label></label>
                                    {{ Form::select('obas[dis_id]', $districts->pluck('english_name', 'id'), Request::get('obas[dis_id]'), ['class' => 'form-control  select2', 'id' => 'dis_id', 'placeholder' => 'Select District']) }}
                                    {!! $errors->first('obas.dis_id', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('obas.year') ? 'has-error' : '' }}">
                                    <label>Year <label class="text-danger"> *</label></label>
                                    <select class="form-control  select2" name="obas[year]">
                                        <option value="">Select Year</option>
                                        @foreach ($year as $yea)
                                            <option value="{{ $yea->fy_name }}" {{($edits['obas']->year==$yea->fy_name)?'selected':''}} >{{ $yea->fy_name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('obas.year', '<span class="text-danger">:message</span>') !!}
                                </div>

                                <div class="form-group col-md-3 {{ $errors->has('obas.months') ? 'has-error' : '' }}">
                                    <label> Month <label class="text-danger"> *</label></label>
                                    {{ Form::select('obas[months]', $month, Request::get('obas[months]'), ['class' => 'form-control  select2', 'id' => 'months', 'placeholder' => 'Select Month']) }}
                                    {!! $errors->first('obas.months', '<span class="text-danger">:message</span>') !!}
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12" style="overflow-x:auto;">
                                    <table class="table table-bordered" id="dynamicTable">
                                        <tr>
                                            <th>Owner Name</th>
                                            <th>Cast</th>
                                            <th>Family Size</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Women<br>Headed <br>House?</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        @if (Request::old('details')!=null)
                                              @foreach (Request::old('details') as $key => $data)
                                                <tr>
                                                    <input type="hidden" name="details[{{$key}}][oba_index_id]" value={{$data->id}}>
                                                    <td
                                                        class="{{ $errors->has("details.$key.owner_name") ? 'has-error' : '' }}">
                                                        {!! Form::text('details[' . $key . '][owner_name]', null, ['class'
                                                        => 'form-control obaTable', 'placeholder' => 'Name', 'required']) !!}
                                                        {!! $errors->first("details.$key.owner_name", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.casts_id") ? 'has-error' : '' }}">
                                                        {{ Form::select('details[' . $key . '][casts_id]', $casts, Request::get('casts_id'), ['class' => 'form-control obaTable select2', 'placeholder' => 'Select Casts', 'required']) }}
                                                        {!! $errors->first("details.$key.casts_id", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                  
                                                    <td
                                                        class="{{ $errors->has("details. $key.family_size") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][family_size]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Family Size','min'=>'0']) }}
                                                        {!! $errors->first("details.$key.family_size", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.male_count") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][male_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Male','min'=>'0','required']) }}
                                                        {!! $errors->first("details.$key.male_count", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.female_count") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][female_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Female', 'required','min'=>'0']) }}
                                                        {!! $errors->first("details.$key.female_count", '<span class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td><input type="checkbox" name="details[{{ $key }}][househead_women]" value="1" {{(isset($data['househead_women']) && $data['househead_women'] == 1) ? 'checked' : null }}></td>
                              
                                                        <td class="{{ ($errors->has("details.$key.oba_status"))?'has-error':'' }}">
                                                            @if($edits['obas']['oba_types_id']==1)
                                                        {{ Form::select('details[' . $key . '][oba_status]', $oba_status['toilet_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}
                                                            @else
                                                        {{ Form::select('details[' . $key . '][oba_status]', $oba_status['water_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}

                                                            @endif
                                                          
                                                       {!! $errors->first("details.$key.oba_status", '<span class="text-danger">:message</span>') !!}
           
                                                    </td> 
                                                    <td class="{{ ($errors->has("details.$key.date"))?'has-error':'' }}">
                                                       {{Form::date("details[$key][date]",null,['class'=>'form-control obaTable ','placeholder'=>
                                                            'Date'])}}
                                                       {!! $errors->first("details.$key.date", '<span class="text-danger">:message</span>') !!}
               
                                                    </td>
                                                    @if ($loop->first)
                                                        <td>
                                                          
                                                            <button type="button" name="add" id="add1"
                                                                class="btn  btn-sm btn-success"><i
                                                                    class="fas fa-plus"></i></button>
                                                        </td>
                                                    @else
                                                        <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i
                                                                    class="fas fa-trash"></i></button></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            @else
                                        
                                            @foreach ($edits['details'] as $key => $details)
                                          
                                            <input type="hidden" name="details[{{$key}}][oba_index_id]" value={{$details->id}}>
                                                <tr>
                                                    <td
                                                        class="{{ $errors->has("details.$key.owner_name") ? 'has-error' : '' }}">
                                                        {!! Form::text('details[' . $key . '][owner_name]', null, ['class'
                                                        => 'form-control obaTable', 'placeholder' => 'Name', 'required']) !!}
                                                        {!! $errors->first("details.$key.owner_name", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.casts_id") ? 'has-error' : '' }}">
                                                        {{ Form::select('details[' . $key . '][casts_id]', $casts, Request::get('casts_id'), ['class' => 'form-control obaTable select2', 'placeholder' => 'Select Casts', 'required']) }}
                                                        {!! $errors->first("details.$key.casts_id", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                  
                                                    <td
                                                        class="{{ $errors->has("details. $key.family_size") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][family_size]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Family Size','min'=>'0']) }}
                                                        {!! $errors->first("details.$key.family_size", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.male_count") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][male_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Male','min'=>'0','required']) }}
                                                        {!! $errors->first("details.$key.male_count", '<span
                                                            class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td
                                                        class="{{ $errors->has("details. $key.female_count") ? 'has-error' : '' }}">
                                                        {{ Form::number('details[' . $key . '][female_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Female', 'required','min'=>'0']) }}
                                                        {!! $errors->first("details.$key.female_count", '<span class="text-danger">:message</span>') !!}
                                                    </td>
                                                    <td><input type="checkbox"
                                                            name="details[{{ $key }}][househead_women]" value="1"
                                                            {{ $details['househead_women'] == 1 ? 'checked' : null }}></td>
                                                            <td class="{{ ($errors->has("details.$key.oba_status"))?'has-error':'' }}">
                                                                @if($edits['obas']['oba_types_id']==1)
                                                                {{ Form::select('details[' . $key . '][oba_status]', $oba_status['toilet_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}
                                                                    @else
                                                                {{ Form::select('details[' . $key . '][oba_status]', $oba_status['water_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}
        
                                                                    @endif
                                                           {!! $errors->first("details.$key.oba_status", '<span class="text-danger">:message</span>') !!}
               
                                                        </td> 
                                                        @php
                                                             if($details['oba_status']=='started' || $details['oba_status']=='connected'){
                                                                 $details['date']=$details['start_date'];
                                                             }elseif($details['oba_status']=='completed'){
                                                                 $details['date']=$details['complete_date'];
                                                             } elseif($details['oba_status']=='inuse'){
                                                                $details['date']=$details['inuse_date'];
                                                            } else{
                                                                $details['date']=null;
                                                            }
                                                            
                                                        @endphp

                                                        <td class="{{ ($errors->has("details.$key.date"))?'has-error':'' }}">
                                                           {{Form::date("details[$key][date]",null,['class'=>'form-control obaTable ','placeholder'=>
                                                                'Date'])}}
                                                           {!! $errors->first("details.$key.date", '<span class="text-danger">:message</span>') !!}
                   
                                                        </td> 
                                                    @if ($loop->first)
                                                        <td>
                                                            {{-- <button type="button" class="btn btn-sm btn-danger remove-tr"><i
                                                                    class="fas fa-trash"></i></button> --}}
                                                            <button type="button" name="add" id="add1"
                                                                class="btn  btn-sm btn-success"><i
                                                                    class="fas fa-plus"></i></button>
                                                        </td>
                                                    @else
                                                        <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i
                                                                    class="fas fa-trash"></i></button></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            @endif
                                       
                                    </table>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-12 {{ $errors->has('obas.remarks') ? 'has-error' : '' }}">
                                    <label>Remark</label>
                                    {{ Form::textarea('obas[remarks]', null, ['class' => 'form-control ', 'placeholder' => 'Remarks', 'rows' => '5']) }}
                                    {!! $errors->first('obas.remarks', '<span class="text-danger">:message</span>') !!}
                                </div>
                            </div>




                            <!-- /.form group -->
                            <div class="card-footer pull-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ url('/project/oba') }}" class="btn btn-danger">Cancel</a>

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
        var details = {!! json_encode($edits['details']) !!};
        var obas = {!! json_encode($edits['obas']) !!};
        var count_row = details.length;


        $('#add1').click(function() {
      var oba_type=$('#obaType_id').val();

            ++count_row;
            var temp=` <tr>
              <td class="{{ $errors->has('details.${count_row}.owner_name') ? 'has-error' : '' }}">
              {!!  Form::text('details[${count_row}][owner_name]', null, ['class' => 'form-control obaTable', 'placeholder' => 'Name']) !!}
               {!! $errors->first('details.${count_row}.owner_name', '<span class="text-danger">:message</span>') !!}
              </td>  
              <td class="{{$errors->has('details.${count_row}.casts_id')?'has-error': ''}}">
              {{ Form::select('details[${count_row}][casts_id]', $casts, Request::get('casts_id'), ['class' => 'form-control obaTable select2', 'placeholder' => 'Select Casts', 'required']) }}
               {!! $errors->first('details.${count_row}.casts_id', '<span class="text-danger">:message</span>') !!}
              </td> 
              <td class="{{$errors->has('details.${count_row}.family_size')?'has-error':''}}">
              {{ Form::number('details[${count_row}][family_size]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Family SIze', 'required','min'=>'0']) }}
               {!! $errors->first('details.${count_row}.family_size', '<span class="text-danger">:message</span>') !!}
              </td> 
               <td class="{{$errors->has('details.${count_row}.male_count')?'has-error':''}}">
               {{ Form::number('details[${count_row}][male_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Male', 'required','min'=>'0']) }}
                {!! $errors->first('details.${count_row}.male_count', '<span class="text-danger">:message</span>') !!}
               </td> 
                <td class="{{$errors->has('details.${count_row}.female_count')?'has-error':''}}">
                {{ Form::number('details[${count_row}][female_count]', null, ['class' => 'form-control obaTable ', 'placeholder' => 'Female', 'required','min'=>'0']) }}
                 {!! $errors->first('details.${count_row}.female_count', '<span class="text-danger">:message</span>') !!}
                </td> 
                <td><input type="checkbox" name="details[${count_row}][househead_women]" value="1"> </td>`;
                 if(oba_type==1){
                     
               temp+=`<td class="{{($errors->has('details.${count_row}.female_count'))?'has-error':'' }}">
                        {{ Form::select('details[${count_row}][oba_status]', $oba_status['toilet_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}
                       {!! $errors->first('details.${count_row}.oba_status', '<span class="text-danger">:message</span>') !!}
                       </td>`;

                 }else{
                     temp+=`<td class="{{($errors->has('details.${count_row}.female_count'))?'has-error':'' }}">
                             {{ Form::select('details[${count_row}][oba_status]', $oba_status['water_facility'], Request::get('oba_status'), ['class' => 'form-control obaTable select2 oba_status', 'placeholder' => 'Select Status', 'required']) }}
                              {!! $errors->first('details.${count_row}.oba_status', '<span class="text-danger">:message</span>') !!}
                              </td>`;

                 }
             temp+=` <td class="{{ ($errors->has('details.${count_row}.date'))?'has-error':'' }}">
                                        {{Form::date('details[${count_row}][date]',null,['class'=>'form-control obaTable ','placeholder'=>
                                             'Date'])}}
                                        {!! $errors->first('details.${count_row}.date', '<span class="text-danger">:message</span>') !!}
                        </td> 
                    <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td>
                        </tr>`;

             $("#dynamicTable").append(temp);
            $('.select2').select2();
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

    </script>


    <script>
        var oba_status={!!json_encode($oba_status)!!};
        var details = {!! json_encode($edits['details']) !!};

        $('#obaType_id').change(function(){
            var oba_type=$('#obaType_id').val();
            $('.oba_status').html('');
                $('.oba_status').append('<option value="">Select Status</option>');
            if(oba_type==1){
                for (const key in oba_status['toilet_facility']) {
                    $('.oba_status').append(`<option value="${key}">${oba_status['toilet_facility'][key]}</option>`);
                    
                }
            }else{
                for (const key in oba_status['water_facility']) {
                    $('.oba_status').append(`<option value="${key}">${oba_status['water_facility'][key]}</option>`);
                    
                }
            }
        })
    </script>

@endsection
