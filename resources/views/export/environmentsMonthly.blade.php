<table>
    <thead>
         <tr>
            <th colspan="14" style="font-weight: bold;text-align: center;">{{$sheetName}} Details</th>
        </tr>
        <tr>
            <td style="font-weight: bold;">S.N</td>
            @if(auth()->user()->user_group_id!=2)
            <td style="font-weight: bold;">Project Name</td>
            @endif
            <td style="font-weight: bold;">Year</td>
            <td style="font-weight: bold;">Month</td>
            <td style="font-weight: bold;">Title</td>
            <td style="font-weight: bold;">Status</td>
            <td style="font-weight: bold;">Result</td>
            <td style="font-weight: bold;">Remarks</td>
        </tr>
    </thead>
    <tbody>
        @foreach($group_detail as $key=>$group_name)
        @if(isset($environments_monthly[$group_name['id']]))
        @foreach($environments_monthly[$group_name['id']] as $key1=>$record)
        <tr>
            <td>{{$key+1}}</td>
            @if(auth()->user()->user_group_id!=2)
            <td>{{$record->project->name}}</td>
            @endif
            <td>{{$record->year}}</td>
            <td>{{$date_details['months'][$record->month]}}</td>
            <td>{{$group_name->title}}</td>
            <td>{{$record->status}}</td>
            <td>{{$record->result}}</td>
            <td>{{$record->remarks}}</td>
        </tr>
        @endforeach
        @endif
        @endforeach
    </tbody>
</table>