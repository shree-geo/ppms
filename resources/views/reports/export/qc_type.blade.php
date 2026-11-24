     
             <table id="tabledemo" class="table table-striped table-bordered table-hover table-responsive">
                 <thead>
                     <tr>
                         <th style="width: 10px; font-weight:bold;">{{ trans('app.sn') }}</th>
                         @if (auth()->user()->user_group_id != 2)
                             <th style="font-weight: bold;">Project</th>
                         @endif
                         <th style="font-weight: bold;">Year</th>
                         <th style="font-weight: bold;">Month</th>
                         <th style="font-weight: bold;">QC Type</th>
                         <th style="font-weight: bold;">Code Followed</th>
                         <th style="font-weight: bold;">Tested By</th>
                         <th style="font-weight: bold;">Test Date</th>
                         <th style="font-weight: bold;">Test Location</th>
                        <th style="font-weight: bold;">Required Result</th>                                                    
                        <th style="font-weight: bold;">Obaserved Result</th>                                                    
                        <th style="font-weight: bold;">Result</th> 
                         <th style="font-weight: bold;">Remarks</th>
                         <th style="font-weight: bold;">Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     @if (count($qc_tests) > 0)
                         <?php $i = 1; ?>
                         @foreach ($qc_tests as $key => $val)
                             <tr>
                                 <th scope=row>{{ $i }}</th>
                                 @if (auth()->user()->user_group_id != 2)
                                     <td>{{ $val->project->name }}</td>
                                 @endif
                                 <td>{{ $val->year }}</td>
                                 <td>{{ $months[$val->month] }}</td>
                                 <td>{{ $val->testType->test_name }}</td>
                                 <td>{{$val->followed_code}}</td>
                                 <td>{{$val->test_by}}</td>
                                 <td>{{$val->test_date}}</td>
                                 <td>{{($val->test_location=='site')?'Lab Test at Site':'Lab Test at Public/Approved Lab'}}</td>
                                 <td>{{$val->result}}</td>                                                         
                                 <td>{{$val->obaserved_result}}</td>                                                         
                                 <td>{{$val->output_result}}</td> 
                                 <td>{{$val->remarks}}</td>
                                 <td>{{ ucfirst($val->status) }}</td>
                             </tr>
                             <?php $i++; ?>

                         @endforeach
                         @else
                         <tr>
                             <td colspan="14" class="text-danger text-center">No Data</td>
                         </tr>
                     @endif

                 </tbody>

             </table>
     
