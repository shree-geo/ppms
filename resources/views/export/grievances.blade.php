
<table>
    <thead>
        <tr>
            <th colspan="10" style="font-weight: bold;text-align: center;">Grievances Detail</th>
        </tr>
        <tr>
            <th style="width: 10px; font-weight:bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Grievance Issue</th>
            <th style="font-weight: bold;">Grievance Level</th>
            <th style="font-weight: bold;">Complain By</th>
            <th style="font-weight: bold;">Complain Date</th>
            <th style="font-weight: bold;">Complain Source</th>
            <th style="font-weight: bold;">Affected Site/Locarion</th>
            <th style="font-weight: bold;">Current Status</th>
            <th style="font-weight: bold;">Action Taken to solve</th>
            <th style="font-weight: bold;">Remarks</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($grievances as $key => $grievance)
            @foreach ($grievance as $val)
                <tr>
                    <th>{{ $loop->index + 1 }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td>{{ $val->issue }}</td>
                    <td>{{($val->grievance_level=='first')?'First Level':(($val->grievance_level=='second')?'Second Level':'Third Level')}}</td>
                    <td>{{ $val->complain_by }}</td>
                    <td>{{ $val->complain_date }}</td>
                    <td>{{ $val->complain_source=='verbal'?'Verbal':'Written' }}</td>
                    <td>{{ $val->affected_site }}</td>
                    {{-- <td>{{ $val->recorded_status }}</td> --}}
                    <td>{{ $val->current_status }}</td>
                    <td>{{ $val->action_taken }}</td>
                    <td>{{ $val->remarks }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

