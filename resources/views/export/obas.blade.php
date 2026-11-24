<table class="table">
    <thead>

        <tr>
            <th colspan="15" style="font-weight: bold;text-align: center;">Obas Detail</th>
        </tr>


        <tr>
            <th style="font-weight: bold;">S.n</th>
            @if (auth()->user()->user_group_id != 2)
                <th style="font-weight: bold;">Subproject Name</th>
            @endif
            <th style="font-weight: bold;">Oba Type</th>
            <th style="font-weight: bold;">District</th>
            <th style="font-weight: bold;">Year</th>
            <th style="font-weight: bold;">Month</th>
            <th style="font-weight: bold;">Status</th>
            <th style="font-weight: bold;">Owner Name</th>
            <th style="font-weight: bold;">Cast</th>
            <th style="font-weight: bold;">Family Size</th>
            <th style="font-weight: bold;">Male</th>
            <th style="font-weight: bold;">Female</th>
            <th  style="font-weight: bold;">HouseHold Women?</th>
            <th  style="font-weight: bold;">Status</th>
            <th  style="font-weight: bold;">Date</th>
        </tr>
    </thead>
    <tbody style="vertical-align: middle;">
        <?php $i = 1; ?>
        @foreach ($obas as $key => $data)
            @foreach ($data as $key => $val)
                <?php $rowcount = count($val->details); ?>
                @foreach ($val->details as $key1 => $detail)
                    <tr>
                        @if (!$key1)
                            <td rowspan="{{ $rowcount }}">
                                {{ $i }}
                            </td>
                            @if (auth()->user()->user_group_id != 2)
                                <td rowspan="{{ $rowcount }}">{{ $val->project->name }}</td>
                            @endif
                            <td rowspan="{{ $rowcount }}">{{ $val->obaTypes->oba_type_name }}</td>
                            <td rowspan="{{ $rowcount }}">{{ $val->district->english_name }}</td>
                            <td rowspan="{{ $rowcount }}">{{ $val->year }}</td>
                            <td rowspan="{{ $rowcount }}">{{ $list['monthslist'][$val->months] }}</td>
                            <td rowspan="{{ $rowcount }}">{{ ucfirst($val->status) }}</td>
                            <?php $i++; ?>
                        @endif


                        <td>

                            <p>{{ $detail->owner_name }} </p>

                        </td>
                        <td>

                            <p>{{ $list['castlist'][$detail->casts_id] }}

                        </td>
                        <td>
                            <p>{{ $detail->family_size }}
                        </td>
                        <td>
                            <p>{{ $detail->male_count }}</p>
                        </td>
                        <td>
                            <p>{{ $detail->female_count }}</p>
                        </td> 
                        <td >
                            <p>
                                {{ $detail->househead_women == 1 ? 'Yes' : 'No' }}
                            </p>
                        </td>
                        <td>
                            <p> {{($detail->oba_status=='started')?'Started':(($detail->oba_status=='not_started')?'Not Started':(($detail->oba_status=='inuse'?'In-Use':'Completed')))}}
                            </p>
                        </td> 
                        @php
                        if($detail['oba_status']=='started' || $detail['oba_status']=='connected'){
                            $detail['date']=$detail['start_date'];
                        }elseif($detail['oba_status']=='completed'){
                            $detail['date']=$detail['complete_date'];
                        } elseif($detail['oba_status']=='inuse'){
                           $detail['date']=$detail['inuse_date'];
                       } else{
                           $detail['date']=null;
                       }
                       
                   @endphp 
                        <td>
                            <p>{{ $detail->date }}</p>
                        </td>
                    </tr>
                 
                @endforeach
            @endforeach
        @endforeach
    </tbody>

</table>
