<table>
    <thead>
          <tr>
            <th colspan="18" style="font-weight: bold;text-align: center;">Workmanship Details</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Skilled Manpower</th>
            <th style="font-weight: bold;">Unskilled Manpower</th>
            <th style="font-weight: bold;">High Income</th>
            <th style="font-weight: bold;">Average Income</th>
            <th style="font-weight: bold;">Low Income</th>
            <th style="font-weight: bold;">BPL</th>
            <th style="font-weight: bold;">Family Size</th>
            <th colspan="3" style="font-weight: bold;">Survey/Present Year</th>
            <th colspan="3" style="font-weight: bold;">Base Year</th>
            <th colspan="3" style="font-weight: bold;">Design Year</th>
        </tr>
        <tr>
            <?php $row=9; ?>
            @if(auth()->user()->user_group_id == 2)
            <?php $row=8; ?>
            @endif

            @for($i = 1; $i <=$row; $i++)
            <th></th>
            @endfor
            @for($i = 1; $i <4; $i++)
                <th style="font-weight: bold;">Year</th>
                <th style="font-weight: bold;">HouseHold Number</th>
                <th style="font-weight: bold;">Population</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        @foreach ($projects as $key => $project)
            <tr>
                <th scope=row>{{ $i }}</th>
                @if (auth()->user()->user_group_id != 2)
                    <td>{{ $project->name }}</td>
                @endif
                <td>{{$project->skilled_manpower ? $project->skilled_manpower : 0 }}</td>
                <td>{{$project->unskilled_manpower ? $project->unskilled_manpower : 0 }}</td>
                <td>{{$project->aff_high_income ? $project->aff_high_income: 0}}</td>
                <td>{{$project->aff_avg_income ? $project->aff_avg_income: 0}}</td>
                <td>{{$project->aff_low_income? $project->aff_low_income : 0}}</td>
                <td>{{$project->aff_bpl_income ? $project->aff_bpl_income :0}}</td>
                <td>{{$project->survey_family_size ? $project->survey_family_size :0}}</td>
                <td>{{$project->survey_year? $project->survey_year: 0}}</td>
                <td>{{$project->survey_total_household? $project->survey_total_household: 0}}</td>
                <td>{{$project->survey_total_population? $project->survey_total_population :0}}</td>
                <td>{{$project->base_year? $project->base_year : 0}}</td>
                <td>{{$project->base_total_household? $project->base_total_household :0}}</td>
                <td>{{$project->base_total_population ? $project->base_total_population :0}}</td>
                <td>{{$project->design_year? $project->design_year: 0}}</td>
                <td>{{$project->design_total_household? $project->design_total_household: 0}}</td>
                <td>{{$project->design_total_population? $project->design_total_population: 0}}</td>
            </tr>
            <?php $i++;?>
            @endforeach

    </tbody>
</table>
