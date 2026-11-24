<?php

namespace App\Http\Controllers;

use App\Exports\MultipleSheet;
use App\Exports\ProjectExport;
use App\Http\Requests\EnvMonthlyRecordRequest;
use App\Models\EnvironmentalMonthly;
use App\Models\EnvironmentalMonthlyRecord;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\EnvironmentalMonthlyRecordRepository;
use App\Repository\EnvironmentalMonthlyRepository;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Models\EnvMonthlyLogs;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class EnvironmentalMonthlyRecordController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       private $envMonthlyRecordRepository;
       private $projectRepository;
       private $envMonthlyRepository;
       private $fiscalYearRepository;
       private $dataRepository;

     public function __construct(EnvironmentalMonthlyRecordRepository $envMonthlyRecordRepository, ProjectRepository $projectRepository, EnvironmentalMonthlyRepository $envMonthlyRepository,
                                  FiscalYearRepository $fiscalYearRepository, DataRepository $dataRepository){

        parent::__construct();
         $this->envMonthlyRecordRepository= $envMonthlyRecordRepository;
         $this->projectRepository= $projectRepository;
         $this->envMonthlyRepository= $envMonthlyRepository;
         $this->fiscalYearRepository= $fiscalYearRepository;
         $this->dataRepository= $dataRepository;
     }


      public function index(Request $request)
      {
        
        if ($request->project_id != null|| $request->from!=null|| $request->to!=null) {
            $records = $this->envMonthlyRecordRepository->searchData($request->all());
            $environment_records=$records->groupBy('project_id');
        } else {
            $environment_records = $this->envMonthlyRecordRepository->all();
        }
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->englishMonths();
        $year = $this->fiscalYearRepository->all();

        if($request->has('export')){
            $group_name=$this->envMonthlyRepository->getGroupName();
            $data= $this->envMonthlyRecordRepository->searchData($request->all());
            $environments_monthly=$data->groupBy('env_group_id');
            $time= Carbon::now()->toDateTimeString();
            $filename='environments_monthly'.'-'.$time.'.xlsx';
            $dateDetails['months']=$monthList;
            $dateDetails['year']=$year;
            ob_end_clean(); 
            ob_start();
            
            return Excel::download(new MultipleSheet($environments_monthly,$group_name,$dateDetails),$filename);
        }else{

            return view('project.environmentalRecord.index', compact('environment_records', 'projects','monthList'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $projects=$this->projectRepository->all();
       $empMonitoringLists= $this->envMonthlyRepository->getByGroupNameEmp();
       $envMonitoringLists= $this->envMonthlyRepository->getByGroupNameEnvironmental();
       $riskLists= $this->envMonthlyRepository->getByGroupNameRisk();
       $safetyLists= $this->envMonthlyRepository->getByGroupNameSafety();
       $communityLists= $this->envMonthlyRepository->getByGroupNameCommunity();
       $issuesLists= $this->envMonthlyRepository->getByGroupNameIssues();
    //    $safeguardLists= $this->envMonthlyRepository->getByGroupNameSafeguard();
       $year = $this->fiscalYearRepository->all();
       $month = $this->dataRepository->englishMonths();

        return view('project.environmentalRecord.add',compact('projects','empMonitoringLists','envMonitoringLists','riskLists','safetyLists','communityLists','issuesLists','year','month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnvMonthlyRecordRequest $request)
    {
       try {
            $envMonthlyData = $request->all();
            $user_group= auth()->user()->user_group_id;
            if($user_group==2){
              $envMonthlyData['project_id']=auth()->user()->project_id;
            }
            
          
            foreach($envMonthlyData['types'] as $key=>$monthlyRecord){
                $monthlyRecord['env_group_id']=$key;
                $monthlyRecord['project_id']=$envMonthlyData['project_id'];
                $monthlyRecord['year']=$envMonthlyData['year'];
                $monthlyRecord['month']=$envMonthlyData['month'];
                $monthlyRecord['approve_status']='submitted';
                $monthlyRecord['status_date']=Carbon::now();
                
                if($monthlyRecord['status']!=null){
                 if (isset($monthlyRecord['file'])&& $monthlyRecord['file']!=null) {
                    @unlink(storage_path('/app/public/uploads/environmental/' . $monthlyRecord['file']));
                    $image = $monthlyRecord['file'];
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/environmental');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/environmental');
                    }

                    $image->move(storage_path() . '/app/public/uploads/environmental/', $newName);


                    $monthlyRecord['file'] = $newName;
                }

                $create = EnvironmentalMonthlyRecord::create($monthlyRecord)->id;
                 $statusLog['user_id']=auth()->user()->id;
                 $statusLog['env_monthly_id']=$create;
                 $statusLog['status']=$monthlyRecord['approve_status'];
                 $statusLog['status_date']=$monthlyRecord['status_date'];
                 EnvMonthlyLogs::create($statusLog);
            }
            }
            if ($create) {
                session()->flash('success', 'Environmental Monthly Record successfully created!');
                return redirect(route('environmental_monthly_record.index'));
            } else {
                session()->flash('error', 'Environmental Monthly Record could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Exception' . $e->getMessage());
            return back();
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($proj_id,$year_id,$month_id)
    {
        $details=$this->envMonthlyRecordRepository->getByprojectYear($proj_id,$year_id,$month_id);
        $empMonitoringLists= $this->envMonthlyRepository->getByGroupNameEmp();
        $envMonitoringLists= $this->envMonthlyRepository->getByGroupNameEnvironmental();
        $riskLists= $this->envMonthlyRepository->getByGroupNameRisk();
        $safetyLists= $this->envMonthlyRepository->getByGroupNameSafety();
        $communityLists= $this->envMonthlyRepository->getByGroupNameCommunity();
        $issuesLists= $this->envMonthlyRepository->getByGroupNameIssues();
        // $safeguardLists= $this->envMonthlyRepository->getByGroupNameSafeguard();
        $year=$year_id;
         $monthList = $this->dataRepository->englishMonths();
         $month=$monthList[$month_id];
        return view('project.environmentalRecord.show',compact('details','empMonitoringLists','envMonitoringLists','riskLists','safetyLists','communityLists','issuesLists','year','month','proj_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$year_id,$month_name)
    {
        try {
            $proj_id = (int)$id;
            $edits = $this->envMonthlyRecordRepository->getByProject($proj_id,$year_id,$month_name);
            
            if ($edits != null ) {
                $projects = $this->projectRepository->all();
                $empMonitoringLists= $this->envMonthlyRepository->getByGroupNameEmp();
                $envMonitoringLists= $this->envMonthlyRepository->getByGroupNameEnvironmental();
                $riskLists= $this->envMonthlyRepository->getByGroupNameRisk();
                $safetyLists= $this->envMonthlyRepository->getByGroupNameSafety();
                $communityLists= $this->envMonthlyRepository->getByGroupNameCommunity();
                $issuesLists= $this->envMonthlyRepository->getByGroupNameIssues();
                $year = $this->fiscalYearRepository->all();
                $month = $this->dataRepository->englishMonths();
                $data=$this->envMonthlyRecordRepository->getByprojectYear($proj_id,$year_id,$month_name);
                // $safeguardLists= $this->envMonthlyRepository->getByGroupNameSafeguard();

                return view('project.environmentalRecord.edit', compact('edits', 'data','projects', 'year', 'month','issuesLists','communityLists','safetyLists','riskLists','envMonitoringLists','empMonitoringLists'));
            } else {
                session()->flash('error', 'Id could not be obtained!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION :' . $exception);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EnvMonthlyRecordRequest $request, $id)
    {
        $project_id= (int)$id;
        try {
            $envMonthlyData = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $envMonthlyData['project_id'] = auth()->user()->project_id;
            }
       
            $data = $this->envMonthlyRecordRepository->getByproject($project_id,$envMonthlyData['year'],$envMonthlyData['month']);
  
            if ($data) {
                   foreach($envMonthlyData['types'] as $key=>$monthlyRecord){
                         $monthlyRecord['approve_status']='submitted';
                        $monthlyRecord['status_date']=Carbon::now();
                        $monthlyRecord['env_group_id']=$key;
                        $monthlyRecord['project_id']=$envMonthlyData['project_id'];
                        $monthlyRecord['year']=$envMonthlyData['year'];
                        $monthlyRecord['month']=$envMonthlyData['month'];
                        $updateData=$this->envMonthlyRecordRepository->findByGroupId($monthlyRecord['project_id'],$key,$envMonthlyData['year'],$envMonthlyData['month']);
                          if (isset($monthlyRecord['file']) && $monthlyRecord['file']!=null) {
                                    @unlink(storage_path('/app/public/uploads/environmental/' . $monthlyRecord['file']));
                                    $image = $monthlyRecord['file'];
                                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                                    $directories = storage_path('/app/public/uploads/environmental');

                                    if (!file_exists($directories)) {
                                        Storage::makeDirectory('app/public/uploads/environmental');
                                    }

                                    $image->move(storage_path() . '/app/public/uploads/environmental/', $newName);


                                    $monthlyRecord['file'] = $newName;
                }
                        $statusLog['user_id']=auth()->user()->id;
                        $statusLog['status']=$monthlyRecord['approve_status'];
                        $statusLog['status_date']=$monthlyRecord['status_date'];
                        $statusLog['env_monthly_id']=$monthlyRecord['env_group_id'];
                 if($updateData!=null){
                            $updateData->fill($monthlyRecord)->save();

                        }else{

                            if($monthlyRecord['status']!=null){
            
                                $updateData = EnvironmentalMonthlyRecord::create($monthlyRecord);

                            EnvMonthlyLogs::create($statusLog);
                            }
                        }
            }
           
                session()->flash('success', 'Environmental Monthly Record updated successfully!');

                return redirect(route('environmental_monthly_record.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION:' . $exception);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id,$year,$month)
    {
        $id = (int)$project_id;
        try {
            $monthlyData = $this->envMonthlyRecordRepository->getByproject($id,$year,$month);
            foreach ($monthlyData as $key => $value) {
                if($value->file!=null){
                @unlink(storage_path('/app/public/uploads/environmental/' . $value->file));

                }
                $value->delete();
            }
            session()->flash('success', 'Environmental Monthly Record successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }


      public function deleteImage($id)
    {
        $environmental = $this->envMonthlyRecordRepository->findById($id);
        if ($environmental != null) {
            if ($environmental->file != null) {
                @unlink(storage_path('/app/public/uploads/environmental/' . $environmental->file));

                $environmental->update(['file' => null]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }

    public function updateStatus(Request $request){
     try {
           $statusDetails= $request->all();
           $month=$request->month;
           $proj_id=$request->proj_id;
           $year=$request->year;
           $statusLog['user_id']=auth()->user()->id;
           $data['status_date']=Carbon::now();
           foreach($statusDetails['details'] as $key=>$status){
               $statusLog['env_monthly_id']=$key;
               $value = $this->envMonthlyRecordRepository->findByGroupId($proj_id,$key,$year,$month);
               if($status['status']!=null){
                   $data['approve_status']=$status['status'];
                   $statusLog['status']=$status['status'];
                   $statusLog['status_date']=$data['status_date'];
                   $statusLog['comment']=isset($status['comment'])?$status['comment']:'';
                      $value->fill($data)->save();
                      EnvMonthlyLogs::create($statusLog);
               }
           }
           return redirect(route('environmental_monthly_record.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }

    }
}
