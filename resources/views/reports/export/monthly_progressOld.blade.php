<div>
    <h4 style="text-align: center">REPORTING INFORMATION </h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <tbody>
            <tr>
                <td>Project Name</td>
                <td>Urban Water Supply and Sanitation (Sector) Project (UWSSSP) </td>
            </tr>
            <tr>
                <td>Sub-project Name</td>
                <td>{{$progress_data['project']['name']}}</td>
            </tr>
            <tr>
                <td>Year</td>
                <td>{{Request::get('year')}}</td>
            </tr>
            <tr>
                <td>Month</td>
                <td>{{$months[Request::get('month')]}}</td>
            </tr>
            <tr>
                <td>Project No</td>
                <td>{{$progress_data['pmo']['project_num']}} </td>
            </tr>
            <tr>
                <td>Loan Number</td>
                <td>{{$progress_data['pmo']['loan_num']}}</td>
            </tr>
            <tr>
                <td>Consulting Package No</td>
                <td>{{$progress_data['project']['package_no']}} </td>
            </tr>
            <tr>
                <td>Report</td>
                <td>MPR of Construction supervision of {{$progress_data['project']['name']}} </td>
            </tr>
            <tr>
                <td>Report for</td>
                <td>Project Management Office ( PMO), Panipokhari, Kathmandu, Nepal  </td>
            </tr>
        </tbody>
    </table>
<div>
    <h4 style="text-align: center">Contract Details</h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <tbody>
            <tr>
                <td>Contractor</td>
                <td>{{$progress_data['project']['appro_contractor']}}</td>
            </tr>
            <tr>
                <td>Name of Contractor</td>
                <td>{{$progress_data['project']['appro_contractor']}}</td>
            </tr>
            <tr>
                <td>Date of Signing of Agreement (Contractor) </td>
                <td>{{$progress_data['project']['contract_signing_date']}}</td>
            </tr>
             <tr>
                <td>Intended Project Completion Date </td>
                <td>{{$progress_data['project']['latest_eot']}}</td>
            </tr>
             <tr>
                <td>Original Contract Amount including VAT  </td>
                <td>Nrs.{{$progress_data['project']['contract_amount']}}</td>
            </tr>
             <tr>
                <td> Contract Amount </td>
                <td>Nrs.{{$progress_data['project']['latest_revised_contract_amount']}}</td>
            </tr>
            
        </tbody>
    </table>
    <h4 style="text-align: center">Silent Feature of the Sub-project</h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <tbody>
            <tr>
                <th colspan="2">General Features</th>
             </tr>
            <tr>
                <td>Name of Project</td>
                <td>Urban Water Supply and Sanitation (Sector) Project (UWSSSP) </td>
            </tr>
            <tr>
                <td>Implementing Agency </td>
                <td>Government of Nepal (GoN), Ministry of Water Supply  </td>
            </tr>
            <tr>
                <td>Executing Agency</td>
                <td>Department of Water Supply and Sewerage Management</td>
            </tr>
            <tr>
                <td>Funding By</td>
                <td>Asian Development Bank & Government of Nepal</td>
            </tr>
            <tr>
                <td>Loan Number</td>
                <td>{{$progress_data['pmo']['loan_num']}}</td>
            </tr>
            <tr>
                <th colspan="2">Consultant</th>
             </tr>
            
             <tr>
                 <td>Constultant</td>
                 <td>Building Design Authority (P) Ltd. in association as subconsultant with JPZ Consulting (P) Ltd and Udaya 
                    Consultancy (P) Ltd </td>
             </tr>
             <tr>
                 <td>Location</td>
                 <td></td>
             </tr>
             {{-- <tr>
                 <td>Date of Signing of Agreement 
                    (Consultant) </td>
                 <td>{{$progress_data['project']['contract_signing_date']}}</td>
             </tr> --}}
             <tr>
                <td>Name of Contractor </td>
                <td>{{$progress_data['project']['appro_contractor']}}</td>
            </tr>
             <tr>
                <td>Date of Contract Sign</td>
                <td>{{$progress_data['project']['contract_signing_date']}}</td>
            </tr>
             <tr>
                <td>Original Completion Date</td>
                <td>{{$progress_data['project']['contract_completion_date']}}</td>
            </tr>
            @php
              $timeperiod=  \Carbon\Carbon::parse($progress_data['project']['contract_signing_date'])->diffInMonths($progress_data['project']['contract_completion_date']);
            @endphp
             <tr>
                <td>Contract Period</td>
                <td>{{$timeperiod}} Months</td>
            </tr>
            <tr><th colspan="2"> Major Design Features </th></tr>
            <tr>
                <td>Length of distribution pipeline</td>
                <td></td>
            </tr>
            <tr>
                <td>Length of transmission main</td>
                <td></td>
            </tr>
            <tr>
                <td>Present population ({{$progress_data['project']['survey_year']}}) </td>
                <td>{{$progress_data['project']['survey_total_population']}}</td>
            </tr>
            <tr>
                <td>Base Year population ({{$progress_data['project']['base_year']}}) </td>
                <td>{{$progress_data['project']['base_total_population']}}</td>
            </tr>
            <tr>
                <td>Design population</td>
                <td>{{$progress_data['project']['design_total_population']}}</td>
            </tr>
            <tr>
                <td>Design year</td>
                <td>{{$progress_data['project']['design_year']}}</td>
            </tr>
            <tr>
                <td>Total no. of household </td>
                <td>{{$progress_data['project']['base_total_household']}}</td>
            </tr>
            <tr>
                <td>Service area (ward no.) </td>
                <td>  @foreach($progress_data['project']->address as $value)
                    <span><b>District:</b></span> {{$value->district->english_name}}<br>
                    <span><b>Municipality:</b></span> {{$value->muni_id?$value->municipality->muni_name:''}}<br>
                    <span><b>Ward:</b>{{$value->ward_no}}</span><br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Reservoir capacity</td>
                <td>
                    @foreach($progress_data['project']->reservior as $value)
                    <span>RVT {{$value->capacity}} cum </span><br>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    <h4 style="text-align: center" class="pt-2 pb-2">Work Progress in the Reporting Year</h4>

    <div class=" table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive" border="1px"  style="width: 100%">
            <thead>
                <tr>
                    <th>Structure Name</th>
                    <th>Cordinate/Location</th>
                    <th>Units</th>
                    <th>Designed Total Capacity</th>
                    <th>Target</th>
                    <th>Progress</th>
                    <th>Target For Next Reporting</th>
                </tr>
            </thead>
            <tbody id="dynamicData">
                @if(count($progress_data['structure_progress'])>0)
                 <?php $i = 1; ?>
                @foreach($progress_data['structureName'] as $structure)
                @if(isset($progress_data['structureEst'][$structure->id]))
                <tr>
                    <td> {{ $i++ }}. {{$structure->structure_name}}</td>
                    <td>{{$structure->location}}</td>
                    <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                   <td id="estimation_{{$structure->id}}">{{isset($progress_data['structureEst'][$structure->id])?$progress_data['structureEst'][$structure->id]:'N/A'}}</td>
                  <td>{{isset( $progress_data['structure_progress'][$structure->id])? $progress_data['structure_progress'][$structure->id][0]['target']:0}}</td>
                   
                   <td>{{isset( $progress_data['structure_progress'][$structure->id])? $progress_data['structure_progress'][$structure->id][0]['progress']:0}}</td>
                   <td>{{isset( $progress_data['structure_progress'][$structure->id])? $progress_data['structure_progress'][$structure->id][0]['target_for_next_month']:0}}</td>
               </tr>
               @endif
                <?php $j = 1;?>
                @if(isset($structure->child))
                 <?php  $k= $i++; ?>
                 <tr>
                   <td> {{ $k }}. {{$structure->structure_name}}</td>
                   <td>{{$structure->location}}</td>
                   <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
               </tr>
                @foreach($structure->child as $child)
                @if(isset($progress_data['structureEst'][$child->id]))
                <tr>
                    <td><p style="padding-left: 25px;">{{ $k.'.'.$j++ }}. {{$child->structure_name}}</p></td>
                    <td>{{$child->location}}</td>
                    <td>{{$child->unit_id!=null?$child->unit->unit_name:''}}</td>
                    <td>{{isset($progress_data['structureEst'][$child->id])?$progress_data['structureEst'][$child->id]:'N/A'}}</td>
                    <td>{{isset( $progress_data['structure_progress'][$child->id])? $progress_data['structure_progress'][$child->id][0]['target']:0}}</td>
                    
                    <td>{{isset( $progress_data['structure_progress'][$child->id])? $progress_data['structure_progress'][$child->id][0]['progress']:0}}</td>
                    <td>{{isset( $progress_data['structure_progress'][$child->id])? $progress_data['structure_progress'][$child->id][0]['target_for_next_month']:0}}</td>
                    
                </tr>
                @endif
                @endforeach
                @endif
                @endforeach
                @else
                <tr>
                    <td colspan="7" style="text-align: center" class="text-danger">Data Not Found!!</td>
                </tr>
                @endif
            </tbody>

        </table>

   </div>
</div>
@include('reports.export.env_monthly')
@if(count($progress_data['progressData']))
<h3 style="text-align: center" class="pt-2 pb-2">Work Schedule & Progress Achieved Bar Char</h3>
    <div class="table-responsive">
        <div class="col-md-12 topFilter">
          <figure class="highcharts-figure">
            <div id="container"></div>
            
            </figure>
        </div>

    </div> 

    <div class="table-responsive">
        <div class="col-md-12 topFilter">
         <table class="table table-striped table-bordered table-hover table-responsive" border="1px" style="width: 100%">
             <thead>
            <tr>
                 <th>Year</th>
                 @foreach($progress_data['allprogressData'] as $year=>$data)
                 <?php $datacount= count($data); ?>
                 <th colspan={{$datacount}} class="text-center">{{$year}}</th>
                 @endforeach
                 </tr>
                 <tr>
                     <th></th>
                     @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                     <th>{{$val->month}}</th>

                     @endforeach
                     @endforeach
                 </tr>
               
                </thead>
                <tbody>
                    <tr>
                    <th>Initital Target</th>
                    @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                        <td>{{$val->target?$val->target:0}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                    <?php $target_total=0;
                            $progress_total=0; ?>
                    <tr>
                    <th>Initital Target Cum</th>
                    @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                          <?php $target_total+=$val->target; ?>
                        <td>{{$target_total}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                    @foreach($progress_data['scurveData'] as $year => $scurve)
                    <tr>
                        <th>{{$year}}</th>
                        @foreach($scurve as $val)
                    <td>{{$val->progress!=null?$val->progress:0}}</td>
                    @endforeach
                        
                </tr>
                    @endforeach
                    <tr>
                    <th>Actual Progress</th>
                    @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                        <td>{{$val->progress?$val->progress:0}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                       <tr>
                    <th>Progress Cum</th>
                    @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                       <?php $progress_total+=$val->progress; ?>
                        <td>{{$progress_total}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                    <tr>
                    <th>Financial Progress</th>
                    @foreach($progress_data['allprogressData'] as $year=>$data)
                     @foreach($data as $val)
                        <td>{{$val->financial_progress?$val->financial_progress:0}}</td>
                        @endforeach
                        @endforeach
                    </tr>
                </tbody>

         </table>
        </div>

    </div>
@endif
<div>
    <h4 style="text-align: center" class="pb-2 pt-2">Problem/Issue, Action Taken & Decision Required from PMO/WUSC and other actors 
    </h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Issues/Problems</th>
                <th>Reason/Contributing Factors</th>
                <th>Responsibility</th>
                <th>Action Taken</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($progress_data['issues']['issue']) && count($progress_data['issues']['issue'])>0)
            @foreach($progress_data['issues']['issue'] as $key => $val)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$val->issue}}</td>
                <td>{{$val->reason}}</td>
                <td>{{$val->responsibility}}</td>
                <td>{{$val->action}}</td>
                <td>{{$val->status}}</td>
               
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif
         
        </tbody>
    </table>
    <h4 style="text-align: center" class="pb-2 pt-2">Meeting & Interaction </h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Meeting Date</th>
                <th>Discussion/ Agenda</th>
                <th>Discussion/ Decision</th>
                <th>Participation</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($progress_data['issues']['meeting']) && count($progress_data['issues']['meeting'])>0)
            @foreach($progress_data['issues']['meeting'] as $key => $val)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$val->date}}</td>
                <td>{{$val->issue}}</td>
                <td>{{$val->action}}</td>
                <td>{{$val->participation}}</td>
               
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif
         
        </tbody>
    </table>
</div>
<div>
    <h4 style="text-align: center" class="pb-2 pt-2">Lab Test at Public/Approved Lab
    </h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th style="font-weight: bold;">QC Type</th>
                <th style="font-weight: bold;">Code Followed</th>
                <th style="font-weight: bold;">Tested By</th>
                <th style="font-weight: bold;">Test Date</th>
                <th style="font-weight: bold;">Test Location</th>
                <th style="font-weight: bold;">Result</th>
                <th style="font-weight: bold;">Remarks</th>
                <th style="font-weight: bold;">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($progress_data['qc_test']['lab']) && count($progress_data['qc_test']['lab'])>0)
            @foreach($progress_data['qc_test']['lab'] as $key => $val)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $val->qcType->type_name }}</td>
                <td>{{$val->followed_code}}</td>
                <td>{{$val->test_by}}</td>
                <td>{{$val->test_date}}</td>
                <td>{{($val->test_location=='site')?'Lab Test at Site':'Lab Test at Public/Approved Lab'}}</td>
                <td>{{ $val->result=='y'?'Yes':'No' }}</td>
                <td>{{$val->remarks}}</td>
                <td>{{ ucfirst($val->status) }}</td>
               
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif
         
        </tbody>
    </table>
    <h4 style="text-align: center" class="pb-2 pt-2"> Lab Test at Site</h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th style="font-weight: bold;">QC Type</th>
                <th style="font-weight: bold;">Code Followed</th>
                <th style="font-weight: bold;">Tested By</th>
                <th style="font-weight: bold;">Test Date</th>
                <th style="font-weight: bold;">Test Location</th>
                <th style="font-weight: bold;">Result</th>
                <th style="font-weight: bold;">Remarks</th>
                <th style="font-weight: bold;">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($progress_data['qc_test']['site']) && count($progress_data['qc_test']['site'])>0)
            @foreach($progress_data['qc_test']['site'] as $key => $val)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{ $val->qcType->type_name }}</td>
                <td>{{$val->followed_code}}</td>
                <td>{{$val->test_by}}</td>
                <td>{{$val->test_date}}</td>
                <td>{{($val->test_location=='site')?'Lab Test at Site':'Lab Test at Public/Approved Lab'}}</td>
                <td>{{ $val->result=='y'?'Yes':'No' }}</td>
                <td>{{$val->remarks}}</td>
                <td>{{ ucfirst($val->status) }}</td>
               
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif
         
        </tbody>
    </table>
</div>
{{-- <div>
<h4 style="text-align: center" class="pb-2 pt-2">Status of Workforce at Site </h4>
<table class="table table-striped table-bordered" border="1px" style="width: 100%">
    <thead>
        <tr>
            <th>S.N</th>
            <th style="font-weight: bold;">Material</th>
            <th style="font-weight: bold;">Unit</th>
            <th style="font-weight: bold;">Quantity</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Skilled Labour</td>
            <td>No</td>
            <td>{{ count($progress_data['workers'])>0?$progress_data['workers'][0]->skilled_total:0}}</td>
           
        </tr>
        <tr>
            <td>2</td>
            <td>UnSkilled Labour</td>
            <td>No</td>
            <td>{{count($progress_data['workers'])>0?$progress_data['workers'][0]->unskilled_total:0}}</td>
           
        </tr>
  
     
    </tbody>
</table>
</div> --}}
<div>
    @foreach($progress_data['programs_type'] as $key=>$val)
    @include('reports.export.programs_monthly')
   @endforeach


<script src="{{url('lib\HighCharts\code\highcharts.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/series-label.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/exporting.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/export-data.js')}}"></script>
<script src="{{url('lib\HighCharts\code\modules/accessibility.js')}}"></script>

<script>
var progress={!! json_encode($progress_data['progressData']) !!};
var revisionData={!! json_encode($progress_data['scurveData']) !!};
var targetArr=[];
var target_total=0.0;
var target_cum=[];
var progress_total=0.0;
var progress_cum=[];
var progressArr=[];
var financialArr=[];
var monthArr=[];

for(var key in progress ){
   target_total=(parseFloat(target_total)+parseFloat(progress[key].target)).toFixed(3);
    targetArr.push(parseFloat(progress[key].target));
    target_cum.push(parseFloat(target_total));

    progress_total=(parseFloat(progress_total)+parseFloat(progress[key].progress)).toFixed(3);
    progressArr.push(parseFloat(progress[key].progress));
    progress_cum.push(parseFloat(progress_total));

    financialArr.push(parseFloat(progress[key].financial_progress));
    monthArr.push(progress[key].month);
    
}
var revisionArr=[];
for (var key in revisionData) {
    revisionArr[key]=[];
for (var key1 in revisionData[key]) {
    revisionArr[key].push(revisionData[key][key1].progress!=null?parseFloat(revisionData[key][key1].progress):0);
    
}
}
datachart=[];

datachart.push({ 
        name: 'Initial Target',
        data: targetArr
        });
datachart.push({ 
       name: 'Initial Target Cum',
        data: target_cum
        });

for( key in revisionArr){
datachart.push({                        
    name: key,
    data: revisionArr[key]
});

}

datachart.push({ 
       name: 'Progress',
        data: progressArr
        });

datachart.push({ 
        name: 'Progress Cum',
        data: progress_cum
        });

datachart.push({ 
       name: 'Financial Progress',
        data: financialArr
        });

    Highcharts.chart('container', {
        
    chart: {
        type: 'line'
    },
    title: {
        text: 'Project Monitoring S-curve'
    },

    yAxis: {
        title: {
            text: ''
        }
    },

    xAxis: {
            categories: monthArr
      
    },

    legend: {
        layout: 'horizontal',
        align: 'center',
        verticalAlign: 'bottom'
    },

  plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },

    series: datachart,

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>

