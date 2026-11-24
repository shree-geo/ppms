@foreach ($obas['obas'] as $project_key => $oba)
    @foreach ($oba as $type_key => $types)

        @if ($loop->first)
            <div class="row pt-3 pb-2">
                <div class="form-group col-md-4">
                    <span>Project:  </span> <b>{{ $types[0]->project->name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
                <div class="form-group col-md-4">
                    <span>Target:  </span ><b>{{ $obas['target'][$types[0]->project_id] }}</b>
                </div>

            </div>
        @endif

        <h4 style="text-align: center; !important" >{{ $type_key == 1 ? 'HouseHold Toilet Facility' : 'Free Piped Water Connection' }}</h4>
        <table>
            <thead>
                <tr>
                    <th style="width: 10px; font-weight:bold;">{{ trans('app.sn') }}</th>
                    <th style="font-weight: bold;">Owner Name</th>
                    <th style="font-weight: bold;">Cast</th>
                    <th style="font-weight: bold;">Family Size</th>
                    <th style="font-weight: bold;">Male</th>
                    <th style="font-weight: bold;">Female</th>
                    <th style="font-weight: bold;">Househead Women</th>
                    @if ($type_key == 1)
                        <th style="font-weight: bold;">Not Started</th>
                        <th style="font-weight: bold;">Started</th>
                        <th style="font-weight: bold;">Completed</th>
                        <th style="font-weight: bold;">Inuse</th>
                    @else
                        <th style="font-weight: bold;">Connected</th>
                        <th style="font-weight: bold;">Not Connected</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($types as $val)
                    <tr>
                        <th>{{ $i }}</th>
                        <td>{{ $val->owner_name }}</td>
                        <td>{{ $list['casts'][$val->casts_id] }}</td>
                        <td>{{ $val->family_size }}</td>
                        <td>{{ $val->male_count }}</td>
                        <td>{{ $val->female_count }}</td>
                        <td>{{ $val->househead_women == 1 ? 'Yes' : 'No' }}</td>
                        @if ($type_key == 1)
                            <td>{{ $val->start_status == 'no' && $val->inuse_status == 'no' && $val->complete_status == 'no' ? 'yes' : 'no' }}
                            </td>
                            <td>{{ $val->start_status }}</td>
                            <td>{{ $val->complete_status }}</td>
                            <td>{{ $val->inuse_status }}</td>
                        @else
                            <td>{{ $val->start_status }}</td>
                            <td>{{ $val->start_status == 'no' ? 'yes' : 'no' }}</td>

                        @endif

                    </tr>
                    <?php $i++; ?>
                @endforeach

            </tbody>

        </table>

    @endforeach
@endforeach
