<table border="1">
    <thead>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            @if (auth()->user()->user_group_id != 2)
            <th style="font-weight: bold;">Project Name</th>
            @endif
            <th colspan="4" style="text-align: center; font-weight: bold;">Government of Nepal's Standard</th>
            <th colspan="4" style="text-align: center; font-weight: bold;">ADB's Standard</th>
        </tr>
        <tr>
            <th></th>
            <th></th>            
            <th colspan="2" style="font-weight: bold;">TOR Approval</th>
            <th colspan="2" style="font-weight: bold;">IIE Approval</th>
            <th colspan="2" style="font-weight: bold;">Approval by ADB</th>
            <th colspan="2" style="font-weight: bold;">Report Disclosed</th>
        </tr>
        <tr>
            <th></th>
            @if (auth()->user()->user_group_id != 2)
            <th></th>
            @endif
            @for($i = 1; $i <=4; $i++)
            <th style="font-weight: bold;">Status</th>
            <th style="font-weight: bold;">Date</th>
            @endfor
           
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
        @foreach ($environments as $key => $environment)
            @foreach ($environment as $val)
                <tr>
                    <th scope=row>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{$val->project->name}}</td>
                    @endif

                    <td>{{$val->gon_tor_approval}}</td>
                    <td>{{$val->gon_tor_approval_date}}</td>

                    <td>{{$val->gon_approval_iee}}</td>
                    <td>{{$val->gon_approval_iee_date}}</td>

                    <td>{{$val->adb_final_approval}}</td>
                    <td>{{$val->adb_final_approval_date}}</td>

                    <td>{{$val->adb_report_disclosed}}</td>
                    <td>{{$val->adb_report_disclosed_date}}</td>
                </tr>
                <?php $i++; ?>
            @endforeach
        @endforeach
    </tbody>
</table>
