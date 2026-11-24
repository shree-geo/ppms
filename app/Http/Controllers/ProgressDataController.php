<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProgressDataRepository;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use App\Models\ProgressData;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ProgressDataRequest;
use App\Models\Scurve;
use App\Revision;
use Illuminate\Support\Facades\DB;

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


      public function store(ProgressDataRequest $request){
        // dd($request->all());
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
              
                  foreach($details['initial_target'] as $year_key=>$target){
                    foreach ($target as $month_key => $val) {
                    $progressData=$this->progressDataRepository->getProgressData($data['project_id'],$year_key,$month_key);
                      $data['revision']=0;
                      $data['year']=$year_key;
                      $data['month']=$month_key;
                      $data['month_code']=$month_code[$month_key];
                      $data['target']=$val;
                      $data['progress']=isset($details['progress'])?$details['progress'][$year_key][$month_key]:null;
                      // $data['financial_progress']=isset($details['financial'])?$details['financial'][$year_key][$month_key]:null;
                      // $data['dispercement']=isset($details['dispercement'])?$details['dispercement'][$year_key][$month_key]:null;
                      $create=$progressData->fill($data)->save();

                }

              }
              if(isset($details['financial'])){
                foreach($details['financial'] as $year_key=>$financial){
                  foreach ($financial as $month_key => $val) {
                      $progressData= ProgressData::where('project_id',$data['project_id'])->where('year',$year_key)->where('month',$month_key)->first();
                        $data1['financial_progress']=$val;
                      $progressData->fill($data1)->save();
                    }

              } 
              }
              if(isset($details['dispercement'])){
               foreach($details['dispercement'] as $year_key=>$dispercement){
                    foreach ($dispercement as $month_key => $val) {

                        $progressData= ProgressData::where('project_id',$data['project_id'])->where('year',$year_key)->where('month',$month_key)->first();
                        $data2['dispercement']=$val;
                        $create=$progressData->fill($data2)->save();

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

      public function destroy($id)
      {
          $id = (int)$id;
          try {
            DB::beginTransaction();
              $value = ProgressData::where('project_id',$id)->delete();
              Scurve::where('project_id',$id)->delete();
              
              Revision::where('project_id',$id)->delete();
           
              if ($value) {
                DB::commit();
                session()->flash('success', 'Progress Data successfully deleted!');
                return redirect(route('progressData.index'));
            } else {
              DB::rollback();

                session()->flash('error', 'ProgressData could not be deleted!');
                return back();
            }
          } catch (\Exception $e) {
            DB::rollback();

              session()->flash('error', 'EXCEPTION' . $e->getMessage());
              return back();
          }
          catch (\DBTransactionException $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 'failed'
            ]);
        }
      }




}
