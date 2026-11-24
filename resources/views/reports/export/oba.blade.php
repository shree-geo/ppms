
             <table>
                 <thead>
                     <tr>
                         <th style="width: 10px; font-weight:bold;">{{ trans('app.sn') }}</th>
                         @if(auth()->user()->user_group_id != 2)
                             <th style="font-weight: bold;">Project</th>
                         @endif
                         <th style="font-weight: bold;">Type</th>
                         <th style="font-weight: bold;">District</th>
                         <th style="font-weight: bold;">Year</th>
                         <th style="font-weight: bold;">Month</th>
                         <th colspan="6" style="text-align: center; font-weight:bold;">Details</th>
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
                         <th style="font-weight: bold;">Owner Name</th>
                         <th style="font-weight: bold;">Cast</th>
                         <th style="font-weight: bold;">Family Size</th>
                         <th style="font-weight: bold;">Male</th>
                         <th style="font-weight: bold;">Female</th>
                         <th style="font-weight: bold;">Househead Women</th>
                     </tr>
                 </thead>
                 <tbody>
                     @if (count($obas) > 0)
                         <?php $i = 1; ?>
                         @foreach ($obas as $key => $val)
                         <?php $rowcount = count($val->details); ?>
                         @foreach($val->details as $key1=>$detail)
                             <tr>
                                 @if(!$key1)
                                 <th scope=row rowspan="{{$rowcount}}">{{ $key+1 }}</th>
                                 @if (auth()->user()->user_group_id != 2)
                                     <td rowspan="{{$rowcount}}">{{ $val->project->name }}</td>
                                 @endif
                                  <td rowspan="{{$rowcount}}">{{ $val->obaTypes->oba_type_name }}</td>
                                  <td rowspan="{{$rowcount}}">{{ $val->district->english_name }}</td>
                                 <td rowspan="{{$rowcount}}">{{ $val->year }}</td>
                                 <td rowspan="{{$rowcount}}">{{ $list['months'][$val->months] }}</td>
                                 @endif
                                 <td>{{$detail->owner_name}}</td>
                                 <td>{{$list['casts'][$detail->casts_id]}}</td>
                                 <td>{{$detail->family_size}}</td>
                                 <td>{{$detail->male_count}}</td>
                                 <td>{{$detail->female_count}}</td>
                                 <td>{{$detail->househead_women==1?'Yes':'No'}}</td>
                             </tr>
                             <?php $i++; ?>

                         @endforeach
                         @endforeach
                         @else
                         <tr>
                             <td colspan="12" class="text-danger text-center">No Data</td>
                         </tr>
                     @endif

                 </tbody>

             </table>
   
