<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Models\EnvironmentalMonthlyRecord;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\DistrictRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\Configurations\ObaTypesRepository;
use App\Repository\Configurations\PmoRepository;
use App\Repository\Configurations\ProgramTypeRepository;
use App\Repository\Configurations\StructureRepository;
use App\Repository\Configurations\TestTypeRepository;
use App\Repository\EnvironmentalMonthlyRecordRepository;
use App\Repository\EnvironmentalMonthlyRepository;
use App\Repository\GrievanceRepository;
use App\Repository\IssueRepository;
use App\Repository\MemberRepository;
use App\Repository\ObaRepository;
use App\Repository\ProgramsRepository;
use App\Repository\ProgressDataRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectStructureProgressRepository;
use App\Repository\ProjectStructureRepository;
use App\Repository\QCTestRepository;
use App\Repository\SafeguardRepository;
use App\Repository\WorkerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{

    private $progressDataRepository;
    private $projectRepository;
    private $workerRepository;
    private $dataRepository;
    private $programsRepository;
    private $programTypeRepository;
    private $qCTestRepository;
    private $testTypeRepository;
    private $obaRepository;
    private $districtRepository;
    private $obaTypesRepository;
    private $pmoRepository;
    private $issueRepository;
    private $projectStructureProgressRepository;
    private $structureRepository;
    private $projectStructureRepository;
    private $envMonthlyRecordRepository;
    private $envMonthlyRepository;
    private $grievanceRepository;
    private $safeguardRepository;
    private $memberRepository;

    public function __construct(ProgressDataRepository $progressDataRepository, ProjectRepository $projectRepository, WorkerRepository $workerRepository,
    DataRepository $dataRepository, FiscalYearRepository $fiscalYearRepository, ProgramTypeRepository $programTypeRepository, ProgramsRepository $programsRepository, QCTestRepository $qCTestRepository,
    TestTypeRepository $testTypeRepository,ObaRepository $obaRepository,DistrictRepository $districtRepository, ObaTypesRepository $obaTypesRepository,PmoRepository $pmoRepository,
    IssueRepository $issueRepository,ProjectStructureProgressRepository $projectStructureProgressRepository, StructureRepository $structureRepository, ProjectStructureRepository $projectStructureRepository,
    EnvironmentalMonthlyRecordRepository $envMonthlyRecordRepository,EnvironmentalMonthlyRepository $envMonthlyRepository,GrievanceRepository $grievanceRepository,
    SafeguardRepository $safeguardRepository,MemberRepository $memberRepository
){
        $this->progressDataRepository=$progressDataRepository;
        $this->projectRepository=$projectRepository;
        $this->workerRepository=$workerRepository;
        $this->dataRepository=$dataRepository;
        $this->fiscalYearRepository=$fiscalYearRepository;
        $this->programsRepository=$programsRepository;
        $this->programTypeRepository=$programTypeRepository;
        $this->qCTestRepository= $qCTestRepository;
        $this->testTypeRepository= $testTypeRepository;
        $this->obaRepository= $obaRepository;
        $this->districtRepository= $districtRepository;
        $this->obaTypesRepository= $obaTypesRepository;
        $this->pmoRepository= $pmoRepository;
        $this->issueRepository= $issueRepository;
        $this->projectStructureProgressRepository= $projectStructureProgressRepository;
        $this->structureRepository= $structureRepository;
        $this->projectStructureRepository= $projectStructureRepository;
        $this->envMonthlyRecordRepository= $envMonthlyRecordRepository;
        $this->envMonthlyRepository= $envMonthlyRepository;
        $this->grievanceRepository= $grievanceRepository;
        $this->safeguardRepository= $safeguardRepository;
        $this->memberRepository= $memberRepository;

    }

    public function index(Request $request){
        return view('reports.index');
    }

    public function getProgressData(Request $request){
      $user_group=auth()->user()->user_group_id;
       $project_id= $request->project_id;
        if($user_group==2){
            $project_id=auth()->user()->project_id;
        }
        $status=false;
        if($project_id!=null){
            $status=true;
        }
        $progressData= $this->progressDataRepository->getTargetByProjectId($project_id);
        $allprogressData=$progressData->groupBy('year');
        $scurveData=$this->progressDataRepository->getScurveData($project_id);
        $projects= $this->projectRepository->all();
     return view ('reports.progressData',compact('progressData','allprogressData','projects','status','scurveData'));
    }


    public function getWorkerReport(Request $request)
    {
         $searchDetails= $request->all();
         $projects= $this->projectRepository->all();
         $months= $this->dataRepository->englishMonths();
        $workers=$this->workerRepository->searchData($searchDetails);
         if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
                $filename='workerDetails'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($workers,'workerReport',$months), $filename);

         }else{
             return view('reports.worker',compact('projects','workers','months'));
         }
    }
    public function getSamitiMemberReport(Request $request)
    {
        $searchDetails= $request->all();
         $projects= $this->projectRepository->all();
         $data['casts']=$this->dataRepository->casts();
         $data['position']=$this->dataRepository->samitiPosition();
       $temp=[];
        $members=$this->memberRepository->searchData($searchDetails);
        foreach($members['cast_male'] as $project_key=>$member){
          foreach($member as $cast_male){
           $temp['cast'][$project_key][$cast_male->member_cast_id]['name']=$cast_male->project->name;
           $temp['cast'][$project_key][$cast_male->member_cast_id]['member_cast_id']=$cast_male->member_cast_id;
           $temp['cast'][$project_key][$cast_male->member_cast_id]['male_count']=$cast_male->cast_total;
           $temp['cast'][$project_key][$cast_male->member_cast_id]['female_count']=0;
          }
        }
        foreach($members['cast_female'] as $project_key=>$member){
          foreach($member as $cast_female){
              if(isset($temp['cast'][$project_key][$cast_female->member_cast_id])){
                $temp['cast'][$project_key][$cast_female->member_cast_id]['female_count']=$cast_female->cast_total;
                // $temp['cast'][$project_key][$cast_female->member_cast_id]['male_count']=0;

              }else{

                  $temp['cast'][$project_key][$cast_female->member_cast_id]['name']=$cast_female->project->name;
                  $temp['cast'][$project_key][$cast_female->member_cast_id]['member_cast_id']=$cast_female->member_cast_id;
                  $temp['cast'][$project_key][$cast_female->member_cast_id]['female_count']=$cast_female->cast_total;
                $temp['cast'][$project_key][$cast_female->member_cast_id]['male_count']=0;

              }
          }
        }
        foreach($members['key_male'] as $project_key=>$member){
          foreach($member as $key_male){
           $temp['key_position'][$project_key][$key_male->position_id]['name']=$key_male->project->name;
           $temp['key_position'][$project_key][$key_male->position_id]['position_id']=$key_male->position_id;
           $temp['key_position'][$project_key][$key_male->position_id]['male_count']=$key_male->position_total;
           $temp['key_position'][$project_key][$key_male->position_id]['female_count']=0;
          }
        }
        foreach($members['key_female'] as $project_key=>$member){
          foreach($member as $key_female){
              if(isset($temp['key_position'][$project_key][$key_female->position_id])){
                $temp['key_position'][$project_key][$key_female->position_id]['female_count']=$key_female->position_total;
                // $temp['key_position'][$project_key][$key_female->position_id]['male_count']=0;

              }else{

                  $temp['key_position'][$project_key][$key_female->position_id]['name']=$key_female->project->name;
                  $temp['key_position'][$project_key][$key_female->position_id]['position_id']=$key_female->position_id;
                  $temp['key_position'][$project_key][$key_female->position_id]['female_count']=$key_female->position_total;
                  $temp['key_position'][$project_key][$key_female->position_id]['male_count']=0;
              }
          }
        }
        if(count($members['excluded_group_male'])>0){

            foreach($members['excluded_group_male'] as $project_key=>$member){
                foreach($member as $key_male){
                    // dd($key_male->excluded_group);
                 $temp['excluded_groups'][$project_key]['name']=$key_male->project->name;
                 $temp['excluded_groups'][$project_key]['male_count']=$key_male['excluded_group'];
                 $temp['excluded_groups'][$project_key]['female_count']=0;
                }
              }
        }else{
            $temp['excluded_groups']=null;
        }
        if(count($members['excluded_group_female'])>0){
        foreach($members['excluded_group_female'] as $project_key=>$exclude){
            foreach($exclude as $key_female){
              if(isset($temp['excluded_groups'][$project_key])){
                $temp['excluded_groups'][$project_key]['female_count']=$key_female->excluded_group;
                // $temp['excluded_groups'][$project_key]['male_count']=0;

              }else{

                  $temp['excluded_groups'][$project_key]['name']=$key_female->project->name;
                  $temp['excluded_groups'][$project_key]['female_count']=$key_female->excluded_group;
                  $temp['excluded_groups'][$project_key]['male_count']=0;
              }
          }
        }
    }else{
        $temp['excluded_groups']=null;
    }
         if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
                $filename='wuscDetails'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($temp,'memberReport',$data), $filename);

         }else{
             return view('reports.member',compact('projects','temp','data'));
         }
    }

    public function getProgramsData(Request $request)
    {
        $searchDetails= $request->all();
        $program_types=$this->programTypeRepository->all();
        $projects= $this->projectRepository->all();
        $programs= $this->programsRepository->searchData($searchDetails);
         if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
                $filename='programsDetails'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($programs,'programsReport'), $filename);

         }else{
             return view('reports.programs',compact('projects','program_types','programs'));
         }
        }

   public function getQCTestData(Request $request)
    {
        $searchDetails= $request->all();
        $projects= $this->projectRepository->all();
        $qc_types= $this->testTypeRepository->all();
         $months= $this->dataRepository->englishMonths();
         $qc_tests=$this->qCTestRepository->searchData($searchDetails);
         if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
                $filename='qcTestDetails'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($qc_tests,'qctestsReport',$months), $filename);


         }else{
             return view('reports.qc_test',compact('projects','qc_tests','qc_types','months'));
         }
    }

   public function getObasData(Request $request)
    {
        $searchDetails= $request->all();
        $projects= $this->projectRepository->all();
        $months= $this->dataRepository->englishMonths();
        $casts=$this->dataRepository->casts();
        $districts=$this->districtRepository->all();
        $oba_types= $this->obaTypesRepository->all();
        $data=$this->obaRepository->reportData($searchDetails);
        $target=$data['target']->mapWithKeys(function($item){
            return [$item['project_id']=>$item['project_count']];
        });
        $obas=['obas'=>$data['obas'],'target'=>$target];
         $list=[
             'months'=>$months,
             'casts'=>$casts,
            ];
         if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
                $filename='obaDetails'.'-'.$time.'.xlsx';
                ob_end_clean();
                ob_start();
                return Excel::download(new ProjectExport($obas,'obaReport',$list), $filename);
                // return view('reports.export.exportOba',compact('obas','list'));


         }else{
             return view('reports.obas',compact('projects','obas','list','districts','oba_types'));
         }
    }
    public function getMonthlyProgressData(Request $request)
    {
        
           $months= $this->dataRepository->englishMonths();
           $projects= $this->projectRepository->all();
           $years= $this->fiscalYearRepository->all();
           $searchDetails=$request->all();
          $progress_data=[];
           if(count($searchDetails)>0){
            $this->validate(request(),[
                'project_id'=>'required',
                'year'=>'required',
                'month'=>'required',
            ]);
               $progress_data['project']=$this->projectRepository->findById($searchDetails['project_id']);
               $progress_data['pmo']=$this->pmoRepository->all();
               $progress_data['progressData']= $this->progressDataRepository->getTargetByProjectId($searchDetails['project_id']);
              $progress_data['scurveData']=$this->progressDataRepository->getScurveData($searchDetails['project_id']);

               $progress_data['allprogressData']=$progress_data['progressData']->groupBy('year');
               $progress_data['issues']=$this->issueRepository->getIssueList($searchDetails);
               $progress_data['qc_test']=$this->qCTestRepository->getTestList($searchDetails);
               $progress_data['workers']=$this->workerRepository->getWorkerList($searchDetails);
               $progress_data['programs']=$this->programsRepository->getProgramList($searchDetails);
               $programs_type=$this->programTypeRepository->all();
               $progress_data['programs_type']=$programs_type->mapWithKeys(function($item) {
                return [$item['id'] => $item['type_name']];
            });
            $projectStrProgress=$this->projectStructureProgressRepository->getByProjectYearMonth($searchDetails['project_id'],$searchDetails['year'],$searchDetails['month']);
            $progress_data['structure_progress']= $projectStrProgress->groupBy('structure_id');
           
            $progress_data['structureName']=$this->structureRepository->parentList($progress_data['project']->sector);
            $projectStructures= $this->projectStructureRepository->getByProjectId($searchDetails['project_id']);
            $progress_data['structureEst']= $projectStructures->mapWithKeys(function($item){
                   return [$item['structure_id']=>$item['estimation']];
               });
               $progress_data['empMonitoringLists']= $this->envMonthlyRepository->getByGroupNameEmp();
               $progress_data['envMonitoringLists']= $this->envMonthlyRepository->getByGroupNameEnvironmental();
               $progress_data['riskLists']= $this->envMonthlyRepository->getByGroupNameRisk();
               $progress_data['safetyLists']= $this->envMonthlyRepository->getByGroupNameSafety();
               $progress_data['communityLists']= $this->envMonthlyRepository->getByGroupNameCommunity();
               $progress_data['issuesLists']= $this->envMonthlyRepository->getByGroupNameIssues();
            //    $progress_data['safeguardLists']= $this->envMonthlyRepository->getByGroupNameSafeguard();
               $progress_data['env_monthly']=$this->envMonthlyRecordRepository->getByprojectYear($searchDetails['project_id'],$searchDetails['year'],$searchDetails['month']);


           }
            if($request->has('export')){
                $time= Carbon::now()->toDateTimeString();
                $filename=$progress_data['project']['name'].'-'.$time.'.pdf';
                ob_end_clean();
                ob_start();
                $pdf = PDF::loadView('reports.export.monthly_progress',compact('progress_data','months','years'));
                return $pdf->download($filename);
  
  
           }else{
            return view('reports.monthly_progress',compact('projects','months','years','progress_data'));

           }

        
    }

    function getSummaryReportData(Request $request){

        $searchDetails=$request->all();
        $summary=[];
        $months= $this->dataRepository->englishMonths();
           $years= $this->fiscalYearRepository->all();
        if(count($searchDetails)>0){
          $summary['project']= $this->projectRepository->all();
          $summary['progress']=$this->progressDataRepository->findProgrssData($searchDetails);
          $summary['programs']=$this->programsRepository->getProgramsPerData($searchDetails);
          $programs=$this->programTypeRepository->all();
          $summary['programs_name']=$programs->mapWithKeys(function($item){
              
              return [$item['id']=>$item['type_name']];
          });
        $summary['grievance']=$this->grievanceRepository->findgrievanceRecord($searchDetails);
          $summary['safeguard']=$this->safeguardRepository->all();
          $summary['issues']=$this->issueRepository->searchData($searchDetails,'summary');
          $summary['programs_type_wise']=$this->programsRepository->searchData($searchDetails)->groupBy('program_type_id');
          $summary['workers']=$this->workerRepository->searchData($searchDetails,'summary')->groupBy('project_id');
          $members=$this->memberRepository->getSamitiCount();
        $summary['structure_progress']=$this->projectStructureProgressRepository->getProgress($searchDetails);
        $summary['members']=[];
        foreach($members as $key=>$member){
            $summary['members'][$key]=[];
            $summary['members'][$key]['total']=0;
            foreach($member as $val){
                $summary['members'][$key][$val->member_gender]=$val->gender_total;
                $summary['members'][$key]['total']+=$val->gender_total;
                
            }
        }
          
      
        }
        if($request->has('export')){
            $time1= Carbon::now()->toDateTimeString();
            $filename1='summary'.'-'.$time1.'.pdf';
            ob_end_clean();
            ob_start();
            $pdf = PDF::loadView('reports.export.summary',compact('summary','years','months'));
            return $pdf->download($filename1);

       }else{
        return view('reports.summary',compact('summary','years','months'));

       }
        
    }

    public function getPhysicalFinancialReportData(Request $request)
    {
        $months= $this->dataRepository->englishMonths();
        $years= $this->fiscalYearRepository->all();
        $summary=[];
        $searchDetails=$request->all();
        if(count($searchDetails)>0){

            $this->validate($request,[
                'year'=>'required',
                'month'=>'required',
            ]);
   
            $summary['project']=$this->projectRepository->all();
            
            $summary['progress']=$this->progressDataRepository->findFinancialProgressData($searchDetails);
        }

        return view('reports.physical_financial',compact('months','years','summary'));
    }
    public function getGeneralizedPFReport(Request $request)
    {
     
        $summary=[];
        $searchDetails=$request->all();
        if(count($searchDetails)>0){

            $summary['project']=$this->projectRepository->all();
            
            $summary['progress']=$this->progressDataRepository->findProgrssData($searchDetails);
        }

        return view('reports.summary_physical_financial',compact('summary'));
    }
    
}

