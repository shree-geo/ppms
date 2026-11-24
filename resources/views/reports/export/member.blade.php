
             <table id="example" class="table table-striped table-bordered table-hover" >
                 <thead>
                     <tr>
                         <th style="width: 10px; font-weight:bold;">{{ trans('app.sn') }}</th>
                         @if (auth()->user()->user_group_id != 2)
                             <th style="font-weight: bold;">Project</th>
                         @endif
                         <th colspan="18" style="font-weight: bold;">Sex and Caste/Ethnicity</th>
                        
                     </tr>
                     <tr>
                         <th></th>
                           @if (auth()->user()->user_group_id != 2)
                         <th></th>
                         @endif
                       @foreach($data['casts'] as $caste)
                         <th colspan="3" style="font-weight: bold;">{{$caste}}</th>                            
                     @endforeach
                     <th colspan="3" style="font-weight: bold;">Total</th>                            

                       @foreach($data['position'] as $position)
                       @if($position!='Member')
                         <th colspan="3" style="font-weight: bold;">{{$position}}</th>   
                         @endif                         
                     @endforeach
                     <th colspan="3" style="font-weight: bold;">Key Post</th>
                     <th colspan="3" style="font-weight: bold;">Representation from Excluded/Vulnerable</th>

                     </tr>
                     <tr>
                         <th></th>
                          @if (auth()->user()->user_group_id != 2)
                         <th></th>
                         @endif
                         @for($i = 1; $i <=12; $i++)
                             <th style="font-weight: bold;">M</th>
                             <th style="font-weight: bold;">F</th>
                             <th style="font-weight: bold;">T</th>
                         @endfor
                    

                     </tr>
                 </thead>
                 <tbody>
                     @if (count($temp) > 0 && isset($temp['cast']))
                         <?php $i = 1; 
                             foreach ($data['casts'] as $key => $casts) {
                            $row_male[$key]=0; 
                                 $row_female[$key]=0; 
                                 $row_total[$key]=0; 
                                }
                             foreach ($data['position'] as $key => $position) {
                                  $row_position_male[$key]=0; 
                                 $row_position_female[$key]=0; 
                                 $row_position_total[$key]=0; 
                                }
                                $row_t_male=0; 
                                $row_t_female=0; 
                                $row_t_total=0; 
                                $row_t_posi_male=0; 
                                $row_t_posi_female=0; 
                                $row_t_posi_total=0; 
                                $row_t_vul_male=0;
                                $row_t_vul_female=0;
                                $row_t_vul_total=0;
                         ?>
                      

                         @foreach ($temp['cast'] as $proj_key => $member)
                         <?php 
                         $col_m=0;
                         $col_f=0;
                         $col_total=0;
                         $col_posi_male=0;
                                 $col_posi_female=0;
                                 $col_posi_total=0;
                     
                         
                
                         ?>
                         <tr>
                             <th scope=row>{{ $i }}</th>
                             @foreach($data['casts'] as $key=>$casts)
                             @if(isset($member[$key]))
                             @if (auth()->user()->user_group_id != 2)
                             @if($loop->first)<th>{{ $member[$key]['name'] }}</th>@endif
                             @endif
                                 <td>{{isset($member[$key]['male_count'])?$member[$key]['male_count']:0}}</td>
                                 <td>{{isset($member[$key]['female_count'])?$member[$key]['female_count']:0}}</td>
                                 <?php 
                                
                                 $col_t[$key]=$member[$key]['male_count'] + $member[$key]['female_count'];
                                 $col_m +=$member[$key]['male_count'];
                                 $col_f +=$member[$key]['female_count'];
                                 $col_total +=$col_t[$key];
                                 $row_male[$key]+=$member[$key]['male_count']; 
                                 $row_female[$key]+=$member[$key]['female_count']; 
                                 $row_total[$key]+=$col_t[$key]; 
                                
                                 
                                 ?>
                                 <td style="font-weight: bold">{{$col_t[$key]}}</td>
                                 @else
                                 <td>0</td>
                                 <td>0</td>
                                 <td style="font-weight: bold">0</td>
                                 @endif
               

                                 @endforeach
                                 <?php 
                                   $row_t_male+=$col_m; 
                                 $row_t_female+=$col_f; 
                                 $row_t_total+=$col_total;

                                 ?>

                                 <td style="font-weight: bold">{{$col_m}}</td>
                                 <td style="font-weight: bold">{{$col_f}}</td>
                                 <td style="font-weight: bold">{{$col_total}}</td>

                             @foreach($data['position'] as $key=>$position)
                             @if($position!='Member')
                             @if(isset($temp['key_position'][$proj_key][$key]))
                                 <?php 
                               
                                 $col_posi_t[$key]=$temp['key_position'][$proj_key][$key]['male_count']+$temp['key_position'][$proj_key][$key]['female_count'];

                                  $col_posi_male+=$temp['key_position'][$proj_key][$key]['male_count'];
                                  $col_posi_female+=$temp['key_position'][$proj_key][$key]['female_count'];
                                  $col_posi_total=$col_posi_male+$col_posi_female;

                                  $row_position_male[$key]+=$temp['key_position'][$proj_key][$key]['male_count']; 
                                 $row_position_female[$key]+=$temp['key_position'][$proj_key][$key]['female_count']; 
                                 $row_position_total[$key]+=$col_posi_t[$key]; 
                                  ?>
                                 <td>{{isset($temp['key_position'][$proj_key][$key]['male_count'])?$temp['key_position'][$proj_key][$key]['male_count']:0}}</td>
                                 <td>{{isset($temp['key_position'][$proj_key][$key]['female_count'])?$temp['key_position'][$proj_key][$key]['female_count']:0}}</td>
                                 <td style="font-weight: bold">{{$col_posi_t[$key]}}</td>
                                 
                                 @else
                                 <td>0</td>
                                 <td>0</td>
                                 <td style="font-weight: bold" >0</td>
                                 @endif
                                 @endif
                                 
                                 
                                 
                                 @endforeach
                                 <?php    
                                  $row_t_posi_male+=$col_posi_male; 
                                 $row_t_posi_female+=$col_posi_female; 
                                 $row_t_posi_total+=$col_posi_total; 
                                 ?>
                                 <td>{{$col_posi_male}}</td>
                                 <td>{{$col_posi_female}}</td>
                                 <td>{{$col_posi_total}}</td>


                                 <td>{{$temp['excluded_groups']!=null && isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['male_count']:0}}</td>
                                 <td>{{$temp['excluded_groups']!=null && isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['female_count']:0}}</td>
                                 <?php $col_vul_t[$proj_key]= ($temp['excluded_groups']!=null && isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['male_count']:0) + ($temp['excluded_groups']!=null && isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['female_count']:0) ;?>
                                 <?php 
                                   $row_t_vul_male+=$temp['excluded_groups']!=null&& isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['male_count']:0; 
                                 $row_t_vul_female+=$temp['excluded_groups']!=null&& isset($temp['excluded_groups'][$proj_key])?$temp['excluded_groups'][$proj_key]['female_count']:0; 
                                 $row_t_vul_total+=$col_vul_t[$proj_key]; 
                                 ?>
                                 <td>{{$col_vul_t[$proj_key]}}</td>
                            
                                 
                             </tr>
                            
                             <?php $i++; ?>

                         @endforeach
                         <tr>
                             <td style="font-weight: bold ;text-align: center;" colspan="{{auth()->user()->user_group_id!=2?2:1}}">Total</td>

                             @foreach($data['casts'] as $key=>$casts)
                             <td >{{ $row_male[$key]}}</td>
                             <td >{{ $row_female[$key]}}</td>
                             <td >{{ $row_total[$key]}}</td>

                             @endforeach
                             <td >{{$row_t_male}}</td>
                               <td > {{$row_t_female}}</td>
                            <td >{{$row_t_total }}</td>

                            @foreach($data['position'] as $key=>$position)
                            @if($position!='Member')
                            <td >{{ $row_position_male[$key]}}</td>
                            <td >{{ $row_position_female[$key]}}</td>
                            <td >{{ $row_position_total[$key]}}</td>
                            @endif
                            @endforeach
                            <td >{{ $row_t_posi_male}} </td>
                                <td >{{$row_t_posi_female}}</td>
                                <td >{{$row_t_posi_total}}</td>
                                <td >{{$row_t_vul_male}} </td>
                               <td >{{ $row_t_vul_female}}</td>
                                <td >{{$row_t_vul_total}}</td>
                         </tr>
                         <tr>
                            <td  colspan="{{auth()->user()->user_group_id!=2?2:1}}"  style="text-align: center; font-weight:bold;">Percentage</td>
                      
                            @foreach($data['casts'] as $key=>$casts)
                            <td >{{ round(($row_male[$key]/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_female[$key]/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_total[$key]/$row_t_total)*100,2)}}</td>
                            
                            @endforeach

                            <td >{{ round(($row_t_male/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_t_female/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_t_total/$row_t_total)*100,2)}}</td>
                            @foreach($data['position'] as $key=>$position)
                            @if($position!='Member')
                            <td >{{ round(($row_position_male[$key]/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_position_female[$key]/$row_t_total)*100,2)}}</td>
                            <td >{{ round(($row_position_total[$key]/$row_t_total)*100,2)}}</td>
                            @endif
                            @endforeach

                            <td >{{ round(($row_t_posi_male/$row_t_total)*100,2)}} </td>
                            <td >{{round(($row_t_posi_female/$row_t_total)*100,2)}}</td>
                            <td >{{round(($row_t_posi_total/$row_t_total)*100,2)}}</td>
                            <td >{{round(($row_t_vul_male/$row_t_total)*100,2)}} </td>
                           <td >{{ round(($row_t_vul_female/$row_t_total)*100,2)}}</td>
                            <td >{{round(($row_t_vul_total/$row_t_total)*100,2)}}</td>
                         </tr>
                        
                         @else
                         <tr>
                             <td colspan="38" class="text-danger text-center">No Data</td>
                         </tr>
                     @endif

                 </tbody> 

             </table>
