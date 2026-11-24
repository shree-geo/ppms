
<h4 class="text-center pb-2">{{$type_key==1?'HouseHold Toilet Facility':'Free Piped Water Connection'}}</h4>
             <table id="tabledemo" class="table table-striped table-bordered table-hover table-responsive">
                 <thead>
                        <tr>
                         <th style="width: 10px; font-weight:bold;">{{ trans('app.sn') }}</th>
                         <th style="font-weight: bold;">Owner Name</th>
                         <th style="font-weight: bold;">Cast</th>
                         <th style="font-weight: bold;">Family Size</th>
                         <th style="font-weight: bold;">Male</th>
                         <th style="font-weight: bold;">Female</th>
                         <th style="font-weight: bold;">Househead Women</th>
                         @if($type_key==1)
                         <th style="font-weight: bold;">Not Started</th>
                         <th style="font-weight: bold;">Started</th>
                         <th style="font-weight: bold;">Completed</th>
                         <th style="font-weight: bold;">Inuse</th>
                         @else
                         <th style="font-weight: bold;">Connected</th>
                         <th style="font-weight: bold;">Not Connected</th>
                         @endif
                     </tr>
                 </thead>
                 <tbody>
                         <?php $i = 1; ?>
                    @foreach($types as $val)
                         
                             <tr>
                                 <th scope=row>{{ $i }}</th>
                                
                                 <td>{{$val->owner_name}}</td>
                                 <td>{{$list['casts'][$val->casts_id]}}</td>
                                 <td>{{$val->family_size}}</td>
                                 <td>{{$val->male_count}}</td>
                                 <td>{{$val->female_count}}</td>
                                 <td>{{$val->househead_women==1?'Yes':'No'}}</td>
                                 @if($type_key==1)
                                 @if($val->start_status=='no' && $val->inuse_status=='no' && $val->complete_status=='no')
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                @if($val->start_status=='yes')
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                 @if($val->complete_status=='yes')
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                 @if($val->inuse_status=='yes' )
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                
                                 @else
                                 @if($val->start_status=='yes')
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                 @if($val->start_status=='no')
                                 <td><i class="fa fa-check"></i></td>
                                 @else
                                 <td></td>
                                 @endif
                                 @endif
                               
                             </tr>
                             <?php $i++; ?>
                             @endforeach

                        

                 </tbody>

             </table>
       
   
