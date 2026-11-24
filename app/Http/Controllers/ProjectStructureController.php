<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStructureRequest;
use App\Models\ProjectStructures;
use App\Repository\Configurations\StructureRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectStructureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class ProjectStructureController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $projectStructureRepository;
    private $structureRepository;
    private $projectRepository;

    public function __construct(ProjectStructureRepository $projectStructureRepository, StructureRepository $structureRepository, ProjectRepository $projectRepository){
        parent::__construct();
        $this->projectStructureRepository=$projectStructureRepository;
        $this->structureRepository=$structureRepository;
        $this->projectRepository=$projectRepository;

    }
    public function index(Request $request)
    {
         $user_group=auth()->user()->user_group_id;
         $project_id= $request->project_id;
         $status=false;
         if($project_id!=null){
             $status=true;
         }
        if($user_group==2){
            $project_id=auth()->user()->project_id;
            $status=true;
        }
        $projectStructures= $this->projectStructureRepository->getByProjectId($project_id);
        $structureEst= $projectStructures->mapWithKeys(function($item){
            return [$item['structure_id']=>$item['estimation']];
        });

        $projects= $this->projectRepository->all();
        if($project_id!=null){
            $sectorDetail=$this->projectRepository->findById($project_id);
            $structureName=$this->structureRepository->parentList($sectorDetail->sector);
        }else{
            $structureName='';
        }
        
       return view('project.structureEstimation.add',compact('structureEst','structureName','projects','status','project_id'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectStructureRequest $request)
    {
        try {
            $structureDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $structureDetails['project_id'] = auth()->user()->project_id;
            }
        foreach($structureDetails['value'] as $key=>$val){
            if($val!=null){
                $data['structure_id']=$key;
                $data['estimation']=$val;
                $data['project_id']=$structureDetails['project_id'];
                $oldData= $this->projectStructureRepository->findByStructureId($structureDetails['project_id'],$key);
                if($oldData!=null){
                    $create=$oldData->fill($data)->save();
                }else{
                    $create = ProjectStructures::create($data);
                }
                
               
            }
        }
            if ($create) {
                session()->flash('success', 'Strcuture Estimation successfully created!');
                return redirect(route('structure_estimation.index'));
            } else {
                session()->flash('error', 'Strcuture Estimation  could not be created!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
