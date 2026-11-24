<table>
    <thead>
        <tr>
            <th colspan=7 style="font-weight: bold;text-align: center;">SafeGuards Indicator Detail</th>
        </tr>
        <tr>
            <th style="width: 10px; font-weight:bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Indicator Name </th>
            <th style="font-weight: bold;">Indicator Value </th>
            <th style="font-weight: bold;">Remarks</th>
        </tr>
    </thead>


    <tbody>
        <?php $i=1; ?>
        @foreach ($safeguardindicators as $key => $safeguardindicator)
            @foreach ($safeguardindicator as $val)
                <tr>
                    <th>{{ $i}}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td>{{ $val->indicator_name == 'land_record' ? 'Land Record' : ($val->indicator_name == 'third_party' ? 'Third Party Verification' : 'Compliances') }}
                    </td>
                    <td>{{ $val->indicator_value }}</td>
                    <td>{{ $val->remarks }}</td>
                </tr>
                <?php $i++ ?>
            @endforeach
        @endforeach
    </tbody>
</table>
