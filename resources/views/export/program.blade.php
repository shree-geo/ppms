<table>
    <thead>
        <tr>
            <th colspan="19" style="text-align: center; font-weight:bold; ">Programs Details</th>
        </tr>
        <tr>
            <th style="font-weight: bold;">S.N</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Project Name</th>
            @endif
            <th style="font-weight: bold;">Program Type</th>
            <th style="font-weight: bold;">Title</th>
            <th style="font-weight: bold;">Start Date</th>
            <th style="font-weight: bold;">End Date</th>
            <th style="font-weight: bold;">Status</th>
            <th colspan="3" style="font-weight: bold;">Bramin/chhetri</th>
            <th colspan="3" style="font-weight: bold;">Dalit</th> 
             <th colspan="3" style="font-weight: bold;">Janajati</th>
             <th colspan="3" style="font-weight: bold;">Others</th>
             <th colspan="3" style="font-weight: bold;">Muslim</th>
             <th colspan="3" style="font-weight: bold;">Total</th> 
        </tr>
        <tr>
            <th></th>
             @if (auth()->user()->user_group_id != 2)
            <th></th>
            @endif
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            @for ($i = 0; $i <= 5; $i++)
            <th style="font-weight: bold;">M</th>
            <th style="font-weight: bold;">F</th>
            <th style="font-weight: bold;">Total</th>
            @endfor
          
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total_female_r = 0;
        $total_male_r = 0;
        $total_t_r = 0;
        $total_bramin_f = 0;
        $total_bramin_m = 0;
        $total_bramin_t = 0;
        $total_dalit_f = 0;
        $total_dalit_m = 0;
        $total_dalit_t = 0;
        $total_janjati_f = 0;
        $total_janjati_m = 0;
        $total_janjati_t = 0;
        $total_others_f = 0;
        $total_others_m = 0;
        $total_others_t = 0;
        $total_muslim_f = 0;
        $total_muslim_m = 0;
        $total_muslim_t = 0;
        ?>
        @foreach ($programs as $key => $program)
            @foreach ($program as $val)
                <tr>
                    <?php
                    $bramin_t = $val->bramin_m + $val->bramin_f;
                    $dalit_t = $val->dalit_m + $val->dalit_f;
                    $janjati_t = $val->janjati_m + $val->janjati_f;
                    $others_t = $val->others_m + $val->others_f;
                    $muslim_t = $val->muslim_m + $val->muslim_f;
                    $total_m = $val->bramin_m + $val->dalit_m + $val->janjati_m + $val->others_m +
                    $val->muslim_m;
                    $total_f = $val->bramin_f + $val->dalit_f + $val->janjati_f + $val->others_f +
                    $val->muslim_f;
                    $total_t = $bramin_t + $dalit_t + $janjati_t + $others_t + $muslim_t;
                    $total_female_r += $total_f;
                    $total_male_r += $total_m;
                    $total_t_r += $total_t;
                    $total_bramin_f += $val->bramin_f;
                    $total_bramin_m += $val->bramin_m;
                    $total_bramin_t += $bramin_t;
                    $total_janjati_f += $val->janjati_f;
                    $total_janjati_m += $val->janjati_m;
                    $total_janjati_t += $janjati_t;
                    $total_others_f += $val->others_f;
                    $total_others_m += $val->others_m;
                    $total_others_t += $others_t;
                    $total_muslim_f += $val->muslim_f;
                    $total_muslim_m += $val->muslim_m;
                    $total_muslim_t += $muslim_t;
                    $total_dalit_f += $val->dalit_f;
                    $total_dalit_m += $val->dalit_m;
                    $total_dalit_t += $dalit_t;
                    ?>
                    <th scope=row>{{ $i }}</th>
                    @if (auth()->user()->user_group_id != 2)
                        <td>{{ $val->project->name }}</td>
                    @endif
                    <td>{{ $val->programType->type_name }}</td>
                    <td>{{ $val->program_title }}</td>
                    <td>{{ $val->start_date }}</td>
                    <td>{{ $val->end_date }}</td>
                    <td>{{ ucfirst($val->status) }}</td>
                    <td>{{ $val->bramin_m }}</td>
                    <td>{{ $val->bramin_f }}</td>
                    <td style="font-weight: bold;">{{ $bramin_t }}</td>
                    <td>{{ $val->dalit_m }}</td>
                    <td>{{ $val->dalit_f }}</td>
                    <td style="font-weight: bold;">{{ $dalit_t }}</td>
                    <td>{{ $val->janjati_m }}</td>
                    <td>{{ $val->janjati_f }}</td>
                    <td style="font-weight: bold;">{{ $janjati_t }}</td>
                    <td>{{ $val->others_m }}</td>
                    <td>{{ $val->others_f }}</td>
                    <td style="font-weight: bold;">{{ $others_t }}</td>
                    <td>{{ $val->muslim_m }}</td>
                    <td>{{ $val->muslim_f }}</td>
                    <td style="font-weight: bold;">{{ $muslim_t }}</td>
                    <td style="font-weight: bold;">{{ $total_m }}</td>
                    <td style="font-weight: bold;">{{ $total_f }}</td>
                    <td style="font-weight: bold;">{{ $total_t }}</td>

                </tr>
                <?php $i++; ?>
            @endforeach
        @endforeach
        <tr>
            <td colspan="{{auth()->user()->user_group_id!=2?7:6}}"  style="text-align: center; font-weight:bold;">Total</td>
            <td style="font-weight: bold;">{{ $total_bramin_m }}</td>
            <td style="font-weight: bold;">{{ $total_bramin_f }}</td>
            <td style="font-weight: bold;">{{ $total_bramin_t }}</td>
            <td style="font-weight: bold;">{{ $total_dalit_m }}</td>
            <td style="font-weight: bold;">{{ $total_dalit_f }}</td>
            <td style="font-weight: bold;">{{ $total_dalit_t }}</td>
            <td style="font-weight: bold;">{{ $total_janjati_m }}</td>
            <td style="font-weight: bold;">{{ $total_janjati_f }}</td>
            <td style="font-weight: bold;">{{ $total_janjati_t }}</td>
            <td style="font-weight: bold;">{{ $total_others_m }}</td>
            <td style="font-weight: bold;">{{ $total_others_f }}</td>
            <td style="font-weight: bold;">{{ $total_others_t }}</td>
            <td style="font-weight: bold;">{{ $total_muslim_m }}</td>
            <td style="font-weight: bold;">{{ $total_muslim_f }}</td>
            <td style="font-weight: bold;">{{ $total_muslim_t }}</td>
            <td style="font-weight: bold;">{{ $total_male_r }}</td>
            <td style="font-weight: bold;">{{ $total_female_r }}</td>
            <td style="font-weight: bold;">{{ $total_t_r }}</td>
        </tr>
    </tbody>
</table>
