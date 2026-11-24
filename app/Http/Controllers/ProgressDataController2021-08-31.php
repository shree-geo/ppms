<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProgressDataRepository;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use App\Models\ProgressData;
use App\Http\Controllers\BaseController;

class ProgressDataController extends BaseController
{

    private $projectRepository;
    private $progressDataRepository;

    public function __construct(ProgressDataRepository $progressDataRepository, ProjectRepository $projectRepository){
        parent::__construct();
        $this->progressDataRepository = $progressDataRepository;
        $this->projectRepository = $projectRepository;

      }

      public function index(Request $request){

        $user_group= auth()->user()->user_group_id;
        
        if($user_group==2){
          $project_id=auth()->user()->project_id;
            $project= $this->projectRepository->findById($project_id);
            $status=true;
              $target=$this->progressDataRepository->getByRevision(0,$project_id,true);
            return view('project.progress.add',compact('target','project'));
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
          $project=['contract_signing_date'=>'','contract_end_date'=>'','completion_date_stage1'=>'','latest_eot'=>''];
          return view('project.progress.add',compact('target','project','projects'));

      }

      function getProgressData(Request $request){

        $project_id= $request->project_id;
        $projects=$this->projectRepository->all();
        $project= $this->projectRepository->findById($project_id);
        $status=true;
        $target=$this->progressDataRepository->getByRevision(0,$project_id,true);

        return view('project.progress.add',compact('target','project','projects'));

      }


      public function store(Request $request){
          try {
              $details= $request->all();
              $month_code = [
                 'January'=>'1',
                 'February'=>'2',
                 'March'=>'3',
                 'April'=>'4',
                 'May'=>'5',
                 'June'=>'6',
                 'July'=>'7',
                 'August'=>'8',
                 'September'=>'9',
                 'October'=>'10',
                 'November'=>'11',
                 'December'=>'12',
            ];
              $user_group= auth()->user()->user_group_id;
              if($user_group==2){
                $data['project_id']=auth()->user()->project_id;
              }else{
                  $data['project_id']=$details['project_id'];
              }
              $deleteData=$this->progressDataRepository->getByRevision(0,$data['project_id']);
              if($deleteData!=null){
                  foreach($deleteData as $del){
                      $del->delete();
                  }
              }
              foreach($details['initial_target'] as $year_key=>$target){
                  foreach ($target as $month_key => $val) {
                      $data['revision']=0;
                      $data['year']=$year_key;
                      $data['month']=$month_key;
                      $data['month_code']=$month_code[$month_key];
                      $data['target']=$val;
                      $data['progress']=isset($details['progress'])?$details['progress'][$year_key][$month_key]:null;
                      $data['financial_progress']=isset($details['financial'])?$details['financial'][$year_key][$month_key]:null;
                      $data['dispercement']=isset($details['dispercement'])?$details['dispercement'][$year_key][$month_key]:null;
                      $create= ProgressData::create($data);

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
