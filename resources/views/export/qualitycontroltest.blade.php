
<table >
    <thead>
        <tr>
            <th colspan="12" style="font-weight: bold;text-align: center;">Quality Control Test Details</th>
        </tr>
        <tr>
            <th  style="font-weight: bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Year</th>
            <th style="font-weight: bold;">Month</th>
            <th>Material</th>
            <th>Test Type</th>   
            <th style="font-weight: bold;" colspan="2">Test</th>
            <th>Required Result</th>                                                    
            <th>Obaserved Result</th>                                                    
            <th>Result</th> 
            <th style="font-weight: bold;">Status</th>
        </tr>
        <tr>
            <?php $row=6; ?>
            @if(auth()->user()->user_group_id == 2)
            <?php $row=5; ?>
            @endif

            @for($i = 1; $i <=$row; $i++)
            <th></th>
            @endfor
            <th style="font-weight: bold;">Date</th>
            <th style="font-weight: bold;">Address</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>


    <tbody>

     
        @foreach ($qualitycontroltest as $key => $value)
            @foreach ($value as $val)
                <tr>
                    <th>{{ $loop->index + 1 }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td>{{ $val->year }}</td>
                    <td>{{ $list['monthslist'][$val->month] }}</td>
                    <td>{{$val->materials->material_name}}</td>                                                        
                    <td>{{$val->testType->test_name}}</td> 
                    <td>{{ $val->test_date }} </td>
                    <td>{{ $val->test_location == 'site' ? 'Site' : 'Laboratory' }}</td>
                    <td>{{$val->result}}</td>                                                         
                    <td>{{$val->obaserved_result}}</td>                                                         
                    <td>{{$val->output_result}}</td> 
                    <td>{{ ucfirst($val->status) }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>

</table>
