<div>
    <div class="row">
    <h5><b>From Date:</b>{{Request::get('from')}}</h5> &nbsp;&nbsp;&nbsp;
    <h5><b>To Date:</b>{{Request::get('to')}}</h5>
    </div>
    @if(count($summary['progress'])>0)
    <h4 style="text-align: center" class="pb-4">Summary of Project Progress Status during reporting Period</h4>
    @endif
    @foreach($summary['project'] as $key=>$projects)
    @if(isset($summary['progress'][$projects->id]))
    <div class="row">
       <h6><b>{{$projects->name}} ({{$projects->package_no}}) :</b><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        During the reporting period, the progress achieved is {{$summary['progress'][$projects->id][0]['progress_total']}} 
            against the planned target of {{$summary['progress'][$projects->id][0]['target_total']}} .</h6>

    </div>
@endif
    @endforeach
</div>
<div>
    <h4 style="text-align: center" class="pb-4 pt-4">GESI AP Implementation</h4>
    <table  class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
            <th>Project Name</th>
            <th>Program Type</th>
            <th>Female Total</th>
            <th>Male Total</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
            @if(count($summary['programs']))
            @foreach($summary['project'] as $key=>$projects)
            @if(isset($summary['programs'][$projects->id]))
            @foreach($summary['programs'][$projects->id] as $programs)
            <tr>
                <td>{{$projects->name}}</td>
                <td>{{$programs->programType->type_name }}</td>
                <td>{{$programs->female_total}}</td>
                <td>{{$programs->male_total}}</td>
                <td><b>{{$programs->total}}</b></td>
            </tr>

            @endforeach
            @endif
            @endforeach
            @else
            <tr>
                <td colspan="5" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif

        </tbody>

    </table>
</div>
<div style="overflow-x:auto;">
    <h4 style="text-align: center" class="pb-2 pt-5">Proportionate Representation in WUSC's Executive Committee</h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Project Name</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
        @endphp
            @if(count($summary['members'])>0)
            @foreach($summary['project'] as $project)
            @if(isset($summary['members'][$project->id]))
           
            <tr>
                <td>{{$i++}}</td>
                <th>{{$project->name}}</th>
                <td>{{isset($summary['members'][$project->id]['male'])??$summary['members'][$project->id]['male']}}</td>
                <td>{{isset($summary['members'][$project->id]['female'])??$summary['members'][$project->id]['female']}}</td>
                <td>{{isset($summary['members'][$project->id]['total'])??$summary['members'][$project->id]['total']}}</td>
               
            </tr>
            @endif
         
            @php
            $i+1;
        @endphp
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
    <h4 style="text-align: center" class="pb-4 pt-4"> Summary Grievances Status (Verbal/Registered)
    </h4>
    <table  class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
            <th>Project Name</th>
            <th>No.of Grievances received</th>
            <th>No.of resolved</th>
        </tr>
        </thead>
        <tbody>
            @foreach($summary['project'] as $key=>$projects)
          
            <tr>
                <td>{{$projects->name}}</td>
                <td>{{isset($summary['grievance']['total'][$projects->id])?$summary['grievance']['total'][$projects->id][0]['total']:0}}</td>
                <td>{{isset($summary['grievance']['solved'][$projects->id])?$summary['grievance']['solved'][$projects->id][0]['total']:0}}</td>
               
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
<div>
    <h4 style="text-align: center" class="pb-4 pt-4">Status of Grievances and Resolution
    </h4>
    <div style="overflow-x:auto;" ?>
    <table  class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
            <th>S.N</th>
            <th>Grievance Issues</th>
            <th>Grievance Level</th>
            <th>Complain By and Date</th>
            <th>Affected Site / Location</th>
            <th>Action Taken to Solution</th>
            <th>Status</th>
            <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
            @if(count($summary['grievance']['data'])>0)
            @foreach($summary['project'] as $key=>$projects)
            @if(isset($summary['grievance']['data'][$projects->id]))
            <?php $i = 1; ?>
            @foreach($summary['grievance']['data'][$projects->id] as $key=>$val)
          <tr><th colspan="8">{{$projects->name}}</th></tr>
            <tr>
                <th>{{$i}}</th>
                <td><div style=" word-wrap: break-word; white-space: normal;">{{$val->issue}}</div></td>
                <td>{{($val->grievance_level=='first')?'First Level':(($val->grievance_level=='second')?'Second Level':'Third Level')}}</td>
                <td>{{$val->complain_by}} /{{$val->complain_date}}</td>
                <td>{{$val->affected_site}}</td>
                <td><div style=" word-wrap: break-word; white-space: normal;">{{$val->action_taken}}</div></td>
                <td>{{$val->current_status}}</td>
                <td><div style=" word-wrap: break-word; white-space: normal;">{{$val->remarks}}</div></td>
               
            </tr>
            <?php $i++; ?>
            @endforeach
            @endif
            @endforeach
            @else
            <tr>
                <td colspan="8" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif

        </tbody>

    </table>
</div>
</div>
<div>
    <h4 style="text-align: center" class="pb-4 pt-4" > Status of RP/DDR/ IP</h4>
    <div style="overflow-x:auto;">
    <table  class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Package Number</th>
                <th>Sub Project Name</th>
                <th colspan="2" style="text-align: center">DDR</th>
                <th colspan="2" style="text-align: center">IR</th>
                <th colspan="2" style="text-align: center">IPP</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Type</td>
            <td>Status</td>
            <td>Type</td>
            <td>Status</td>
            <td>Type</td>
            <td>Status</td>
            
        </tr>
        </thead>
        <tbody> 
             @php
            $i=1;
        @endphp
        @if(count($summary['safeguard'])>0)
        
            @foreach($summary['project'] as $key=>$projects)
            @if(isset($summary['safeguard'][$projects->id]))
          
            @foreach($summary['safeguard'][$projects->id] as $safeguard)
          
            <tr>
                <th>{{$i++}}</th>
                <td>{{$projects->package_no}}</td>
                <td>{{$projects->name}}</td>
                <td>DDR</td>
                <td>{{$safeguard->ddr_status}}</td>

                <td>IR</td>
                <td>{{$safeguard->ir_status}}</td>
                
                <td>IPP</td>
                <td>{{$safeguard->ipp_status}}</td>
                
            </tr>
            @endforeach
            @endif
            @php
                $i+1;
            @endphp
            @endforeach
            @else
            <tr>
                <td colspan="9" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif

        </tbody>

    </table>
    </div>
</div>
@include('reports.export.bar')
<div>
    <h4 style="text-align: center" class="pb-2 pt-2">Key field level issues and Action taken to resolve
    </h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Sub Project</th>
                <th>Issues/Problems</th>
                <th>Reason/Contributing Factors</th>
                <th>Responsibility</th>
                <th>Action Taken</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
        @endphp
            @if(count($summary['issues']['issue'])>0)
            @foreach($summary['project'] as $project)
            @if( isset($summary['issues']['issue'][$project->id]))
            @foreach($summary['issues']['issue'][$project->id] as $key => $val)
            <tr>
                <td>{{$i++}}</td>
                <th>{{$project->name}}</th>
                <td>{{$val->issue}}</td>
                <td>{{$val->reason}}</td>
                <td>{{$val->responsibility}}</td>
                <td>{{$val->action}}</td>
                <td>{{$val->status}}</td>
               
            </tr>
            @endforeach
            @endif
            @php
            $i+1;
        @endphp
            @endforeach
            @else
            <tr>
                <td colspan="7" style="text-align: center; " class="text-danger">Data Not Found!!</td>
            </tr>
            @endif
         
        </tbody>
    </table>
    <h4 style="text-align: center" class="pb-2 pt-2">Meetings conducted during reporting period</h4>
    <table class="table table-striped table-bordered" border="1px" style="width: 100%">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Project Name</th>
                <th>Meeting Date</th>
                <th>Discussion/ Agenda</th>
                <th>Participation</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
        @endphp
            @if(count($summary['issues']['meeting'])>0)
            @foreach($summary['project'] as $project)
            @if(isset($summary['issues']['meeting'][$project->id]) )
            @foreach($summary['issues']['meeting'][$project->id] as $key => $val)
            <tr>
                <td>{{$i++}}</td>
                <th>{{$project->name}}</th>
                <td>{{$val->date}}</td>
                <td>{{$val->issue}}</td>
                <td>{{$val->participation}}</td>
               
            </tr>
            @endforeach
            @endif
            @php
            $i+1;
        @endphp
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
    @foreach($summary['programs_name'] as $key=>$val)
    @include('reports.export.programs_summary')
   @endforeach
</div>
<div style="overflow-x:auto;">
<h4 style="text-align: center" class="pb-2 pt-5">Laborers/Workers by Sex and Ethnicity</h4>

    @include('reports.export.worker_summary')
</div>


<div>
    @if(count($summary['structure_progress'])>0)
    <h4 style="text-align: center" class="pt-2 pb-2">Work Progress in the Reporting Year</h4>
    @endif
    @foreach($summary['project'] as $projects)
    @if(isset($summary['structure_progress'][$projects->id]))
    <h5 style="text-align: center" class="pt-2 pb-2">{{$projects->name}}</h5>


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
            @php
                $summary['structureName']=StructureParentList($projects->sector);
                $summary['structureEst']= getByProjectId($projects->id);
              
      
            @endphp
            <tbody id="dynamicData">
                <?php $i = 1; ?>
                @foreach($summary['structureName'] as $structure)
                @if(isset($summary['structureEst'][$structure->id]))
                <tr>
                    <th> {{ $i++ }}. {{$structure->structure_name}}</th>
                    <th>{{$structure->location}}</th>
                    <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                    <td id="estimation_{{$structure->id}}">{{isset($summary['structureEst'][$structure->id])?$summary['structureEst'][$structure->id]:'N/A'}}</td>
                    <td>{{isset( $summary['structure_progress'][$projects->id][$structure->id]) && $summary['structure_progress'][$projects->id][$structure->id][0]['target_total']!=null? $summary['structure_progress'][$projects->id][$structure->id][0]['target_total']:0}}</td>
                   
                   <td>{{isset( $summary['structure_progress'][$projects->id][$structure->id]) && $summary['structure_progress'][$projects->id][$structure->id][0]['progress_total']!=null? $summary['structure_progress'][$projects->id][$structure->id][0]['progress_total']:0}}</td>
                   <td>{{isset( $summary['structure_progress'][$projects->id][$structure->id]) && $summary['structure_progress'][$projects->id][$structure->id][0]['target_for_next_month']!=null? $summary['structure_progress'][$projects->id][$structure->id][0]['target_for_next_month']:0}}</td>
               </tr>
               @endif
                <?php $j = 1;?>
                @if(isset($structure->child))
                 <?php  $k= $i++; ?>
                 <tr>
                   <th> {{ $k }}. {{$structure->structure_name}}</th>
                   <th>{{$structure->location}}</th>
                   <td>{{$structure->unit_id!=null?$structure->unit->unit_name:''}}</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
               </tr>
                @foreach($structure->child as $child)
                @if(isset($summary['structureEst'][$child->id]))
                <tr>
                    <th><p style="padding-left: 25px;">{{ $k.'.'.$j++ }}. {{$child->structure_name}}</p></th>
                    <th> {{$child->location}}</th>
                    <td>{{$child->unit_id!=null?$child->unit->unit_name:''}}</td>
                    <td>{{isset($summary['structureEst'][$child->id])?$summary['structureEst'][$child->id]:'N/A'}}</td>
                    <td>{{isset( $summary['structure_progress'][$projects->id][$child->id]) && $summary['structure_progress'][$projects->id][$child->id][0]['target_total']!=null? $summary['structure_progress'][$projects->id][$child->id][0]['target_total']:0}}</td>
                    
                    <td>{{isset( $summary['structure_progress'][$projects->id][$child->id]) && $summary['structure_progress'][$projects->id][$child->id][0]['progress_total']!=null ? $summary['structure_progress'][$projects->id][$child->id][0]['progress_total']:0}}</td>
                    <td>{{isset( $summary['structure_progress'][$projects->id][$child->id]) && $summary['structure_progress'][$projects->id][$child->id][0]['target_for_next_month']!=null? $summary['structure_progress'][$projects->id][$child->id][0]['target_for_next_month']:0}}</td>
                    
                </tr>
                @endif
                @endforeach
                @endif
                @endforeach
            </tbody>
            
        </table>
        
    </div>
    @endif
    @endforeach
</div>
