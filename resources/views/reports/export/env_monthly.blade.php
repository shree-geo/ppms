
    <div >
        <h3 style="text-align: center" class="pt-2 pb-2">Safeguard Monitoring Indicators </h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>
                     
                   </tr>
               </thead>
               <tbody>
                   @foreach($progress_data['empMonitoringLists'] as $empData)
                   <tr>
                       <th style="width: 290px;">{{$empData->title}}</th>
                       <td>{{(isset($progress_data['env_monthly'][$empData->id]) && $progress_data['env_monthly'][$empData->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$empData->id]) && $progress_data['env_monthly'][$empData->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                       <td>{{isset($progress_data['env_monthly'][$empData->id])?$progress_data['env_monthly'][$empData->id][0]['result']:''}}</td>
                       <td>{{isset($progress_data['env_monthly'][$empData->id])?$progress_data['env_monthly'][$empData->id][0]['remarks']:''}}</td>
                       
                   </tr>
                   @endforeach
               </tbody>
           </table>
   </div>

    <div >
        <h3 style="text-align: center" class="pt-2 pb-2">Environmental Monitoring Results </h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($progress_data['envMonitoringLists'] as $envData)
                   <tr>
                      
                        <th style="width: 290px;">{{$envData->title}}</th>
                        <td>{{(isset($progress_data['env_monthly'][$envData->id]) && $progress_data['env_monthly'][$envData->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$envData->id]) && $progress_data['env_monthly'][$envData->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                        <td>{{isset($progress_data['env_monthly'][$envData->id])?$progress_data['env_monthly'][$envData->id][0]['result']:''}}</td>
                        <td>{{isset($progress_data['env_monthly'][$envData->id])?$progress_data['env_monthly'][$envData->id][0]['remarks']:''}}</td>
                        
                   </tr>
                   @endforeach
           
               </tbody>

           </table>
   </div>

   
    <div >
        <h3 style="text-align: center" class="pt-2 pb-2">Risk assessment of various activities </h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($progress_data['riskLists'] as $risks)
                   <tr>
                    <th style="width: 290px;">{{$risks->title}}</th>
                    <td>{{(isset($progress_data['env_monthly'][$risks->id]) && $progress_data['env_monthly'][$risks->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$risks->id]) && $progress_data['env_monthly'][$risks->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                    <td>{{isset($progress_data['env_monthly'][$risks->id])?$progress_data['env_monthly'][$risks->id][0]['result']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$risks->id])?$progress_data['env_monthly'][$risks->id][0]['remarks']:''}}</td>
                   </tr>
                   @endforeach
           
               </tbody>

           </table>

   </div>


    <div >
        <h3 style="text-align: center" class="pt-2 pb-2" >The Safety and Health Facility</h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($progress_data['safetyLists'] as $safety)
                   <tr>
                    <th style="width: 290px;">{{$safety->title}}</th>
                    <td>{{(isset($progress_data['env_monthly'][$safety->id]) && $progress_data['env_monthly'][$safety->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$safety->id]) && $progress_data['env_monthly'][$safety->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                    <td>{{isset($progress_data['env_monthly'][$safety->id])?$progress_data['env_monthly'][$safety->id][0]['result']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$safety->id])?$progress_data['env_monthly'][$safety->id][0]['remarks']:''}}</td>
                   </tr>
                   @endforeach
           
               </tbody>

           </table>

   </div>


    <div >
        <h3 style="text-align: center" class="pt-2 pb-2">Community Safety</h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>

                   </tr>
               </thead>
               <tbody>
                   @foreach( $progress_data['communityLists'] as $community)
                   <tr>
                    <th style="width: 290px;">{{$community->title}}</th>
                    <td>{{(isset($progress_data['env_monthly'][$community->id]) && $progress_data['env_monthly'][$community->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$community->id]) && $progress_data['env_monthly'][$community->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                    <td>{{isset($progress_data['env_monthly'][$community->id])?$progress_data['env_monthly'][$community->id][0]['result']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$community->id])?$progress_data['env_monthly'][$community->id][0]['remarks']:''}}</td>
                   </tr>
                   @endforeach
           
               </tbody>

           </table>

   </div>


    <div>
        <h3 style="text-align: center" class="pt-2 pb-2">Issues and Corrective Actions</h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                    <th>Issue/Concern</th>
                    <th>Corrective Action</th>
                    <th>Responsible Body</th>
                    <th>Target Timeline</th>
                       <th>Status</th>
                       <th>Remarks</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                    <td>{{isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id])?$progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['issue']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id])?$progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['action']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id])?$progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['responsible_body']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id])?$progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['target_time']:''}}</td>
                    <td>{{(isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id]) && $progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id]) && $progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                    <td>{{isset($progress_data['env_monthly'][$progress_data['issuesLists'][0]->id])?$progress_data['env_monthly'][$progress_data['issuesLists'][0]->id][0]['remarks']:''}}</td>
                   </tr>
                 
           
               </tbody>

           </table>

   </div>
  

{{-- 
    <div>
        <h3 style="text-align: center" class="pt-2 pb-2">Safety and health Facility of workers</h3>
           <table class="table table-striped table-bordered table-hover table-responsive  " border="1px" style="width: 100%">
               <thead>
                   <tr>
                       <th></th>
                       <th>Status</th>
                       <th>Result</th>
                       <th>Remarks</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach($progress_data['safeguardLists'] as $safeguard)
                   <tr>
                    <th style="width: 290px;">{{$safeguard->title}}</th>
                    <td>{{(isset($progress_data['env_monthly'][$safeguard->id]) && $progress_data['env_monthly'][$safeguard->id][0]['status']=='y')?'Yes':((isset($progress_data['env_monthly'][$safeguard->id]) && $progress_data['env_monthly'][$safeguard->id][0]['status']=='n')?'No':'NA')}} </td>
                       
                    <td>{{isset($progress_data['env_monthly'][$safeguard->id])?$progress_data['env_monthly'][$safeguard->id][0]['result']:''}}</td>
                    <td>{{isset($progress_data['env_monthly'][$safeguard->id])?$progress_data['env_monthly'][$safeguard->id][0]['remarks']:''}}</td>
                    
                   </tr>
                   @endforeach
           
               </tbody>

           </table>

   </div> --}}
  
