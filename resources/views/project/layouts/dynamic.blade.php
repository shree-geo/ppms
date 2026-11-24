{{-- <script type="text/javascript">
   
    $(document).ready(function () {
        var data = {!! json_encode($edits) !!};
        var municipality = {!! json_encode($municipalities) !!};
       if(data.project.muni_id!=null){
        var collection = municipality[data.project.district_id];
        for (var key in collection) {
            if(data.project.muni_id==collection[key]['id']){
              $('#muni_id').append(`<option value="${collection[key]['id']}" selected>${collection[key]['muni_name']}</option>`); 
            }else{
                 $('#muni_id').append(`<option value="${collection[key]['id']}">${collection[key]['muni_name']}</option>`);
            }
                   
               }
           }
    });
</script>
 <script type="text/javascript">
       var municipality = {!! json_encode($municipalities) !!};
        $('#district_id').change(function(){
            var m_district= $('#district_id').val();
            $('#muni_id').html('');
            var muniData = municipality[m_district];
            $('#muni_id').append(`<option value="0" selected disabled>Select Municipality</option>`);
            for (var key in muniData) {
                $('#muni_id').append(`<option value="${muniData[key]['id']}">${muniData[key]['muni_name']}</option>`);
            }


        });
    </script> --}}
{{-- Ajax Method Dymanic Type Calling
    $(document).ready(function ()
    {
     $('#sector').on('change',function(){
                        var sector = $(this).val();
                          $.ajax({
                             url : baseurl+'/project/getBySector',
                             type : "GET",
                           data:{'sector':sector},
                            success:function(data)
                            {
                             $('#type_name').html('');
                               $('#type_name').append('<option value="">Select Type Name</option>');
                               for(var key in data){
                                     $('#type_name').append(`<option value='${data[key]['id']}'>${data[key]['type_name']}</option>`)
                              }
                         });
                    
                  });
           }); --}}

{{-- Normal Method Dymanic Type Calling --}}
<script type="text/javascript">
    $(document).ready(function() {
        var sectorName = {!! json_encode($projectType) !!}
        // var editName = {!! json_encode($edits) !!}
        // var editsector=editName.project.sector
        // // console.log(editsector);
        // if (editsector == 'water_supply') {
        //         $('#detailsource').show();
        //         $('#detail').show();
        //         $('#detailreservoir').show();
        //     } else {
        //         $('#detail').remove();
        //         $('#detailsource').remove();
        //         $('#detailreservoir').remove();
        //     }
        $('#sector').on('change', function() {
            var sector = $(this).val();
            if (sector == 'water_supply') {
                $('#detailsource').show();
                $('#detail').show();
                $('#detailreservoir').show();
            } else {
                $('#detail').hide();
                $('#detailsource').hide();
                $('#detailreservoir').hide();

            }
            $('#type_name').html('');
            $('#type_name').append('<option value="">Select Type Name</option>');
            for (var key in sectorName[sector]) {
                $('#type_name').append(
                    `<option value='${sectorName[sector][key]['id']}'>${sectorName[sector][key]['type_name']}</option>`
                    )
            }
        });
    });

</script>

<script type="text/javascript">
    // var municipality = { !! json_encode($municipalities) !! };
    var municipality = {!! json_encode($municipalities) !!};

    function changeMuni() {
        var dis_id = event.target.id.split('-');
        var index = dis_id[1].split('_');
        var m_district = $('#' + dis_id[1]).val();
        $('#muni_id_' + index[2]).html('');
        var collection = municipality[m_district];
        $('#muni_id_' + index[2]).append(`<option value="0" selected disabled>Select Local Government</option>`);
        for (var key in collection) {
            $('#muni_id_' + index[2]).append(
                `<option value="${collection[key]['id']}">${collection[key]['muni_name']}</option>`);
        }
    }

    var details = {!! json_encode($edits['address']) !!};
    var address= {!! json_encode(Request::old('address')) !!};
    var row_count = address!=null?address.length:details.length;
    $('#add1').click(function() {
        ++row_count;
        $("#dynamicTable").append(
            `<tr>
                    <td  class="{{ $errors->has('address.${row_count}.district_id') ? 'has-error' : '' }}">
                    {{ Form::select('address[${row_count}][district_id]', $districts->pluck('english_name', 'id'), Request::get('district_id'), ['class' => 'form-control select2', 'id' => 'district_id_${row_count}', 'placeholder' => 'Select District', 'onchange=changeMuni()', 'style' => 'width:100%;', 'required']) }}
                    {!! $errors->first('address[${row_count}][district_id]', '<span class="text-danger">:message</span>') !!}
                    </td>
                    <td class="{{ $errors->has('address.${row_count}.muni_id') ? 'has-error' : '' }}">
                    <select name="address[${row_count}][muni_id]" id="muni_id_${row_count}" class="form-control select2" style="width: 100%;">
                        <option value="">Select Local Government</option>
                        </select>
                        {!! $errors->first('address[${row_count}][muni_id]', '<span class="text-danger">:message</span>') !!}
                    </td>
                    <td class="{{ $errors->has('address.${row_count}.ward_no') ? 'has-error' : '' }}">
                        {{ Form::text('address[${row_count}][ward_no]', null, ['class' => 'form-control', 'placeholder' => 'Ward Number', 'style' => 'width:100%;']) }}
                    {!! $errors->first('address[${row_count}][ward_no]', '<span class="text-danger">:message</span>') !!}
                    </td>
                <td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="fas fa-trash"></i></button></td></tr>`);
        $('.select2').select2();
    });
    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });

</script>

<script type="text/javascript">
    var x_sources = 1;
    var detailssources = {!! json_encode($edits['sources']) !!};
    var row_countsource = detailssources.length;

    function sourcefield() {
        var addButton = $('.add_source'); //Add button selector
        var wrapper = $('.field_source'); //Input field wrapper 
        html =
            '<div class="card removeItem" style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important;margin-bottom: 1rem;">';
        html +=
            `<div style="padding-right: 20px;"><a href="javascript:void(0);" onclick="removefunctionSource(${x_sources})" id="removeDiv1_${x_sources}" class="remove_button btn btn-danger pull-right mt-4" title="Remove"> <i class="fa fa-times" aria-hidden="true"></i> Remove </a></div><div class="addfiled ">`;
        html +=
            `<div class="card-body row" ><div class="form-group col-md-3"><label > Source Name </label>{!! Form::text('sources[${row_countsource}][source_name]', null, ['class' => 'form-control', 'placeholder' => 'Source Name']) !!} {!! $errors->first('sources.${row_countsource}.source_name', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Source Type </label>{!! Form::text('sources[${row_countsource}][source_type]', null, ['class' => 'form-control', 'placeholder' => 'Source Type']) !!} {!! $errors->first('sources.${row_countsource}.source_type', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Source Location </label>{!! Form::text('sources[${row_countsource}][source_location]', null, ['class' => 'form-control', 'placeholder' => 'Source Location']) !!} {!! $errors->first('sources.${row_countsource}.source_location', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Source Latitude </label>{!! Form::text('sources[${row_countsource}][source_lat]', null, ['class' => 'form-control', 'placeholder' => 'Source Latitude']) !!} {!! $errors->first('sources.${row_countsource}.source_lat', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Source Longitude </label>{!! Form::text('sources[${row_countsource}][source_lan]', null, ['class' => 'form-control', 'placeholder' => 'Source Longitude']) !!} {!! $errors->first('sources.${row_countsource}.source_lan', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label> Proposed Intake </label>{!! Form::textarea('sources[${row_countsource}][proposed_intake]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Proposed Intake']) !!} {!! $errors->first('sources.${row_countsource}.proposed_intake', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Discharge</label>{!! Form::textarea('sources[${row_countsource}][discharge]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Discharge']) !!} {!! $errors->first('sources.${row_countsource}.discharge', '<span class="text-danger">:message</span>') !!}</div>`;
        html +=
            `<div class="form-group col-md-3"><label > Remarks</label>   {!! Form::textarea('sources[${row_countsource}][remarks]', null, ['class' => 'form-control textarea1', 'placeholder' => 'Remarks']) !!}  {!! $errors->first('sources.${row_countsource}.remarks', '<span class="text-danger">:message</span>') !!}</div>`;
        html += `</div></div></div> </div>`;
        row_countsource++;

        x_sources++; //Increment field counter                   
        $(wrapper).append(html); //Add field html                        
    }

    function removefunctionSource(id) {

        var wrapper = $('.field_source');
        $('#removeDiv1_' + id).parent('div').parent('div').remove(); //Remove field html
        x_sources--;
    }

</script>

<script type="text/javascript">
    var x_reservois = 1;
    var detailsreservoir = {!! json_encode($edits['reservoirs']) !!};
    var row_countreservoir = detailsreservoir.length;

    function reservoirfield() {
        var addButton = $('.add_reservoir'); //Add button selector
        var wrapper = $('.field_reservoir'); //Input field wrapper     


        html =
            '<div class="card " style="box-shadow: 0 0 30px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%) !important; margin-bottom: 1rem; ">';
        html +=
            `<div style="padding-right: 20px;"><a href="javascript:void(0);" class=" remove_button btn btn-danger pull-right mt-4" onclick="removefunction(${x_reservois})" title="Remove" id="removeDiv_${x_reservois}"> <i class="fa fa-times" aria-hidden="true"></i> Remove </a></div><div class="addfiled ">`;
        html +=                        
            `<div class="card-body row" ><div class="form-group col-md-3"><label > Reservoir Name </label>{!! Form::text('reservoirs[${row_countreservoir}][reservoir_name]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Name']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.reservoir_name', '<span class="text-danger">:message</span>') !!} </div>`;
        html += `<div class="form-group col-md-3"><label > Capacity </label>{!! Form::number('reservoirs[${row_countreservoir}][capacity]', null, ['class' => 'form-control', 'placeholder' => 'Capacity']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.capacity', '<span class="text-danger">:message</span>') !!} </div>`;
        html += `<div class="form-group col-md-3"><label > Reservoir Location </label>{!! Form::text('reservoirs[${row_countreservoir}][reservoir_location]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Location']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.reservoir_location', '<span class="text-danger">:message</span>') !!} </div>`;
        html += `<div class="form-group col-md-3"><label > Reservoir Latitude </label>{!! Form::text('reservoirs[${row_countreservoir}][reservoir_lat]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Latitude']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.reservoir_lat', '<span class="text-danger">:message</span>') !!} </div>`;
        html +=
            `<div class="form-group col-md-3"><label > Reservoir Longitude </label>   {!! Form::text('reservoirs[${row_countreservoir}][reservoir_lang]', null, ['class' => 'form-control', 'placeholder' => 'Reservoir Longitude']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.reservoir_lang', '<span class="text-danger">:message</span>') !!}  </div>`;
        html += `<div class="form-group col-md-3"><label > Reservoir Type</label>{!! Form::select('reservoirs[${row_countreservoir}][reservoirs_type]', ['overhead' => 'Overhead', 'ground' => 'Ground'], null, ['class' => 'form-control', 'placeholder' => 'Pick a Type...']) !!} {!! $errors->first('reservoirs.${row_countreservoir}.reservoirs_type', '<span class="text-danger">:message</span>') !!} </div>`;
        html += `<div></div></div> </div>`;
        row_countreservoir++;

        x_reservois++; //Increment field counter
        $(wrapper).append(html); //Add field html
    }

    function removefunction(id) {
        var wrapper = $('.field_reservoir');
        $('#removeDiv_' + id).parent('div').parent('div').remove(); //Remove field html
        x_reservois--; //Decrement field counter

    }

</script>
