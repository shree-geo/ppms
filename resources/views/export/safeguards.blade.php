<table>
    <thead>
        <tr>
            <th colspan=7 style="font-weight: bold;text-align: center;">SafeGuards Detail</th>
        </tr>
        <tr>
            <th style="width: 10px; font-weight:bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th colspan="2" style="text-align: center; font-weight:bold;">DDR Report Submission </th>
            <th colspan="2" style="text-align: center; font-weight:bold;">IR </th>
            <th colspan="2" style="text-align: center; font-weight:bold;" >IPP </th>
        </tr>
    </thead>


    <tbody>
        <tr>
            
            <?php $row=2; ?>
            @if(auth()->user()->user_group_id == 2)
            <?php $row=1; ?>
            @endif

            @for($i = 1; $i <=$row; $i++)
            <th></th>
            @endfor
            @for ($i = 0; $i < 3; $i++)
            <th> <b>Status </b></th>
            <th> <b>Date</b></th>
        @endfor
        </tr>
        <?php $i=1; ?>
        @foreach($safeguards as $key=>$safeguard)
        @foreach($safeguard as $val)
       <tr>
            <th scope=row>{{$i}}</th>
          @if(auth()->user()->user_group_id!=2)
            <td>{{$val->project->name}}</td>
            @endif
            <td>{{$val->ddr_status}}</td>
            <td>{{$val->ddr_date}}</td>
            <td>{{$val->ir_status}}</td>
            <td>{{$val->ir_date}}</td>
            <td>{{$val->ipp_status}}</td>
            <td>{{$val->ipp_date}}</td>
                </tr>
            <?php $i++ ?>
            @endforeach
        @endforeach
    </tbody>
</table>
