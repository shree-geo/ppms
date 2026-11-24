<table>
    <thead>
        <tr> 
            <th colspan=7 style="font-weight: bold;text-align: center;">Institution Detail</th>
        </tr>
            <tr>
                <th style="width: 10px; font-weight:bold;">S.n</th>
                @if (auth()->user()->user_group_id != 2)
                    <th style="font-weight: bold;">Subproject Name</th>
                @endif
                <th style="font-weight: bold;">Institution Name</th>
                <th style="font-weight: bold;">Institution Type</th>
                <th style="font-weight: bold;">Male</th>
                <th style="font-weight: bold;">Female</th>
                <th style="font-weight: bold;">Status</th>
            </tr>
        </thead>


    <tbody>
        <?php $i=1; ?> 
        @foreach ($institutions as $key => $institution)
        @foreach ($institution as $val)
            <tr>
                <th>{{$i}}</th>
                @if (auth()->user()->user_group_id != 2)
                    <td>{{ $val->project->name }}</td>
                @endif
                <td>{{ $val->institution_name }}</td>
                <td>{{ $val->institution_type == 'school' ? 'School' : ($val->institution_type == 'healthpost' ? 'Health Post' : 'Others') }}
                </td>
                <td>{{ $val->total_male }}</td>
                <td>{{ $val->total_female }}</td>
                <td>{{ ucfirst($val->status) }}</td>
            </tr>
            <?php $i++ ?>
            @endforeach
            @endforeach
    </tbody>
 </table>