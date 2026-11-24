<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProgressDataRepository;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use App\Models\ProgressData;
use App\Repository\EotRepository;
use App\Http\Controllers\BaseController;

class ProgressDataController extends BaseController
{

    private $projectRepository;
    private $progressDataRepository;
    private $eotRepository;

    public function __construct(ProgressDataRepository $progressDataRepository, ProjectRepository $projectRepository, EotRepository $eotRepository){
        parent::__construct();
        $this->progressDataRepository = $progressDataRepository;
        $this->projectRepository = $projectRepository;
        $this->eotRepository = $eotRepository;

      }

      public function index(Request $request){

        $user_group= auth()->user()->user_group_id;
        
        if($user_group==2){
          $project_id=auth()->user()->project_id;
            $eotData= $this->eotRepository->all();
            $project= $this->projectRepository->findById($project_id);
            $status=true;
            if($eotData->count()>=1){
              foreach($eotData[$project_id] as $key=>$val){
                $key++;
                $status=false;
                $month_list[$key]= $this->getMonthName($project['contract_signing_date'],$project['latest_eot'],$status);
                $target[$key]=$this->progressDataRepository->getByRevision($key,$project_id,true);
                
              }
            }else{
              $month_list[0]= $this->getMonthName($project['contract_signing_date'],$project['latest_eot'],$status);
              $target[0]=$this->progressDataRepository->getByRevision(0,$project_id,true);


            }
            return view('project.progress.add',compact('target','month_list','project'));
      }else{
        if($request->project_id!=null){
          $progressData=$this->progressDataRepository->getByProjectId($request->project_id);

        }else{
          $progressData=$this->progressDataRepository->all();
        }
        $projects=$this->projectRepository->all();
        return view('project.progress.index',compact('progressData','projects'));
      }
    
        
       
      }

      public function create(){

          $projects=$this->projectRepository->all();
          $target=[];
          $month_list=[];
          $project=['contract_signing_date'=>'','contract_end_date'=>'','completion_date_stage1'=>'','latest_eot'=>''];
          return view('project.progress.add',compact('target','month_list','project','projects'));

      }

      function getProgressData(Request $request){

       $project_id= $request->project_id;
        $projects=$this->projectRepository->all();
        $eotData= $this->eotRepository->all();
        $project= $this->projectRepository->findById($project_id);
        $status=true;
        if($eotData->count()>=1){
          foreach($eotData[$project_id] as $key=>$val){
            $key++;
            $status=false;
            $month_list[$key]= $this->getMonthName($project['contract_signing_date'],$project['latest_eot'],$status);
            $target[$key]=$this->progressDataRepository->getByRevision($key,$project_id,true);
            
            
          }
        }else{
          $target[0]=$this->progressDataRepository->getByRevision(0,$project_id,true);
           $month_list[0]= $this->getMonthName($project['contract_signing_date'],$project['latest_eot'],$status);

        }
        return view('project.progress.add',compact('target','month_list','project','projects'));

      }

      public function getMonthName($signing, $completion,$status){
        $start_date= new Carbon($signing);
        $end_date= new Carbon($completion);
        $end=$end_date->format('Y-m');

        $diff= $start_date->diffInMonths($end_date);
        $month_list=[];
        $year=explode('-',$start_date);
        if($status==true){

          if(!isset($month_list[$year[0]])){
             $month_list[$year[0]]=[];
          }
          array_push($month_list[$year[0]],$start_date->shortEnglishMonth);
        }
        for($i=0;$i<=$diff;++$i){
            $start_date->addMonth(1);
            $start=$start_date->format('Y-m');
            if($start<=$end){
                $year=explode('-',$start_date);
                if(!isset($month_list[$year[0]])){
                  $month_list[$year[0]]=[];
                }
               array_push($month_list[$year[0]],$start_date->shortEnglishMonth);
                }
              }
              return $month_list;
      }


      public function store(Request $request){
          try {
              $details= $request->all();
              $month_code = [
                 'Jan'=>'1',
                 'Feb'=>'2',
                 'Mar'=>'3',
                 'Apr'=>'4',
                 'May'=>'5',
                 'Jun'=>'6',
                 'Jul'=>'7',
                 'Aug'=>'8',
                 'Sep'=>'9',
                 'Oct'=>'10',
                 'Nov'=>'11',
                 'Dec'=>'12',
            ];
              $user_group= auth()->user()->user_group_id;
              if($user_group==2){
                $data['project_id']=auth()->user()->project_id;
              }else{
                  $data['project_id']=$details['project_id'];
              }
              foreach($details['total'] as $revision_key=>$target){
                $deleteData=$this->progressDataRepository->getByRevision($revision_key,$data['project_id']);
                if($deleteData!=null){
                    foreach($deleteData as $del){
                        $del->delete();
                    }
                }
                  foreach ($target as $year_key => $value) {
                  foreach ($value as $month_key => $val) {
                      $data['revision']=$revision_key;
                      $data['year']=$year_key;
                      $data['month']=$month_key;
                      $data['month_code']=$month_code[$month_key];
                      $data['target']=$val;
                      $data['progress']=isset($details['progress'])?$details['progress'][$revision_key][$year_key][$month_key]:null;
                      $data['financial_progress']=isset($details['financial'])?$details['financial'][$revision_key][$year_key][$month_key]:null;
                      $data['dispercement']=isset($details['dispercement'])?$details['dispercement'][$revision_key][$year_key][$month_key]:null;
                      $create= ProgressData::create($data);

                  }
                }

              }
               if ($create) {
                session()->flash('success', 'ProgressData successfully created!');
                return redirect(route('progressData.index'));
            } else {
                session()->flash('error', 'ProgressData could not be created!');
                return back();
            }

          } catch (\Exception $e) {
               session()->flash('error', 'Exception' . $e->getMessage());
            return back();
          }
      }



}
