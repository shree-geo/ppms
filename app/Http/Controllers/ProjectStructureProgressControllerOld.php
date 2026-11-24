<?php

namespace App\Http\Controllers;

use App\Http\Requests\StructureProgressRequest;
use App\Models\StructureProgress;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\Configurations\StructureRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectStructureProgressRepository;
use App\Repository\ProjectStructureRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Units;

class ProjectStructureProgressControllerOld extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        private $projectStructureProgressRepository;
        private $projectRepository;
        private $structureRepository;
        private $projectStructureRepository;
        private $fiscalYearRepository;
        private $dataRepository;

     public function __construct(ProjectStructureProgressRepository $projectStructureProgressRepository,ProjectRepository $projectRepository, StructureRepository $structureRepository
     ,ProjectStructureRepository $projectStructureRepository,FiscalYearRepository $fiscalYearRepository, DataRepository $dataRepository)
     {
        parent::__construct();

         $this->projectStructureProgressRepository= $projectStructureProgressRepository;
         $this->projectRepository= $projectRepository;
         $this->structureRepository= $structureRepository;
         $this->projectStructureRepository= $projectStructureRepository;
         $this->fiscalYearRepository= $fiscalYearRepository;
         $this->dataRepository= $dataRepository;
     }


    public function index(Request $request)
    {
         if ($request->project_id != null) {
            $progressData = $this->projectStructureProgressRepository->getByProjectId($request->project_id, 'search');
        } else {
            $progressData = $this->projectStructureProgressRepository->all();
        }
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->englishMonths();
        return view('project.structureProgress.index', compact('progressData', 'projects','monthList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $user_group=auth()->user()->user_group_id;
         $project_id= $request->project_id;
         
        if($user_group==2){
            $project_id=auth()->user()->project_id;
            $projectStructures= $this->projectStructureRepository->getByProjectId($project_id);
            $structureEst= $projectStructures->mapWithKeys(function($item){
                return [$item['structure_id']=>$item['estimation']];
            });
            $secrtorDetail=$this->projectRepository->findById($project_id);
          $structureName=$this->structureRepository->parentList($secrtorDetail->sector);

        }else{
            $projectStructures= $this->projectStructureRepository->all();
             $structureEst=$projectStructures->groupBy('project_id');
             $structureName=[];
        }
        $projectStrProgress= $this->projectStructureProgressRepository->getByProjectId($project_id);
        $structureProgress= $projectStrProgress->groupBy('structure_id');
        $projects= $this->projectRepository->all();
        $year = $this->fiscalYearRepository->all();
        $month = $this->dataRepository->englishMonths();
        // dd($structureName);
       return view('project.structureProgress.add',compact('structureEst','structureName','projects','project_id','year','month','structureProgress'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StructureProgressRequest $request)
    {
      try {
            $progressDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $progressDetails['project_id'] = auth()->user()->project_id;
            }
        foreach($progressDetails['value'] as $key=>$val){

            if($val['target']!=null){
                $data['structure_id']=$key;
                $data['year']=$request->year;
                $data['month']=$request->month;
                $data['project_id']=$progressDetails['project_id'];
                $data['target']=$val['target'];
                $data['progress']=$val['progress'];
                $data['target_for_next_month']=$val['target_for_next_month'];
                $data['status']='submitted';
                $data['status_date']=Carbon::now();
                $oldData=$this->projectStructureProgressRepository->getByProjectYearMonthStrcuture($progressDetails['project_id'],$data['structure_id'],$request->year,$request->month);
                if($oldData!=null){
                    session()->flash('error', 'Data Already saved for this year and month!');
                    return back();
                }else{

                    $create = StructureProgress::create($data);

                }
               
           
            }
        }
            if ($create) {
                session()->flash('success', 'Strcuture Progress successfully created!');
                return redirect(route('structure_progress.index'));
            } else {
                session()->flash('error', 'Strcuture Progress could not be created!');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($proj_id,$year_id,$month_id)
    {
        try {
            $proj_id=(int)$proj_id;
            $edits=$this->projectStructureProgressRepository->getByProjectYearMonth($proj_id,$year_id,$month_id);
            if($edits!=null){
                 $year = $this->fiscalYearRepository->all();
                 $month = $this->dataRepository->englishMonths();
                 $projects= $this->projectRepository->all();
                 $secrtorDetail=$this->projectRepository->findById($proj_id);
                 $structureName=$this->structureRepository->parentList($secrtorDetail->sector);
                 $projectStructures= $this->projectStructureRepository->getByProjectId($proj_id);
                 $structureEst= $projectStructures->mapWithKeys(function($item){
                        return [$item['structure_id']=>$item['estimation']];
                    });
                $projectStrProgress= $this->projectStructureProgressRepository->getByProjectYearMonth($proj_id,$year_id,$month_id);
                $structureProgress= $projectStrProgress->groupBy('structure_id');
                 return view('project.structureProgress.edit',compact('edits','year','month','projects','structureEst','structureName','structureProgress'));
            }else{
                 session()->flash('error', 'Id could not be obtained!');
                  return back();
            }
            
        } catch (\Exception $e) {
            session()->flash('error','Exception:'.$e->getMessage());
          
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StructureProgressRequest $request, $id)
    {
        // dd($request->all());
       $proj_id = (int)$id;
        try {
          $progressDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $progressDetails['project_id'] = auth()->user()->project_id;
            }
       
            // $data = $this->projectStructureProgressRepository->getByProjectYearMonth($proj_id,$progressDetails['year'],$progressDetails['month']);
        foreach($progressDetails['value'] as $key=>$val){
            if($val['target']!=null){
                $data['structure_id']=$key;
                $data['year']=$request->year;
                $data['month']=$request->month;
                $data['project_id']=$progressDetails['project_id'];
                $data['target']=$val['target'];
                $data['progress']=$val['progress'];
                $data['target_for_next_month']=$val['target_for_next_month'];
                $data['status']='submitted';
                $data['status_date']=Carbon::now();
                $oldData= $this->projectStructureProgressRepository->getByProjectYearMonthStrcuture($progressDetails['project_id'],$key,$progressDetails['year'],$progressDetails['month']);
                if($oldData!=null){
                    $create=$oldData->fill($data)->save();
                }else{
                    $create = StructureProgress::create($data);
                }
           
            }
        }
            if ($create) {
                session()->flash('success', 'Strcuture Progress successfully updated!');
                return redirect(route('structure_progress.index'));
            } else {
                session()->flash('error', 'Strcuture Progress could not be updated!');
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
            $monthlyData = $this->projectStructureProgressRepository->getByProjectYearMonth($id,$year,$month);
            foreach ($monthlyData as  $value) {
               
                $value->delete();
            }
            session()->flash('success', 'Structure Progress Record successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function getEstimationValue(Request $request){
         $project_id=$request->project_id;
         $projectStructures= $this->projectStructureRepository->getByProjectId($project_id);
         $sectorDetail=$this->projectRepository->findById($project_id);
         $structureName=$this->structureRepository->parentList($sectorDetail->sector);
         $structureEst= $projectStructures->mapWithKeys(function($item){
             return [$item['structure_id']=>$item['estimation']];
            });
            $units=Units::all();
            $unit= $units->mapWithKeys(function($item){
                return [$item['id']=>$item['unit_name']];
            });
            $data=['structureEst'=>$structureEst,
            'unit'=>$unit,'structureName'=>$structureName];
            return $data;
            //  return redirect(route('structure_progress.create'));
    }
}
