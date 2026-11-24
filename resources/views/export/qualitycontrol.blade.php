
<table>
    <thead>
        <tr> 
            <th colspan="4" style="font-weight: bold;text-align: center;">Quality Control Details</th>
        </tr>
            <tr>
                <th style="width: 10px; font-weight:bold;">S.n</th>
                @if (auth()->user()->user_group_id != 2)
                    <th style="font-weight: bold;">Subproject Name</th>
                @endif
                <th style="font-weight: bold;">QC Type Id</th>
                <th style="font-weight: bold;">Target</th>
        </thead>


    <tbody>
        @foreach($qualitycontrol as $key=>$value)
        @foreach($value->sortBy('qc_type_id') as $val)
            <tr>
                <th>{{$loop->index+1}}</th>
                @if (auth()->user()->user_group_id != 2)
                    <td>{{ $val->project->name }}</td>
                @endif
                <td>{{$val->qc_type_id}}</td>
                <td>{{$val->target}}</td>
            </tr>
            @endforeach
            @endforeach
    </tbody>
 </table>