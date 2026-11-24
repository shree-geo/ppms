<?php

namespace App\Http\Controllers;

use App\Models\FeaturesValue;
use App\Repository\Configurations\FeatureRepository;
use App\Repository\ProjectRepository;
use App\Repository\SalientfeatureValueRepository;
use Illuminate\Http\Request;

class SalientFeatureValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $featureRepository;
    private $projectRepository;
    private $salientfeatureValueRepository;

     public function __construct(FeatureRepository $featureRepository, ProjectRepository $projectRepository,SalientfeatureValueRepository $salientfeatureValueRepository){
      $this->featureRepository=$featureRepository;
      $this->projectRepository=$projectRepository;
      $this->salientfeatureValueRepository=$salientfeatureValueRepository;
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
        $feature= $this->salientfeatureValueRepository->getByProjectId($project_id);
        $featureValue= $feature->groupBy('sailent_feature_id');
        $projects= $this->projectRepository->all();
        if($project_id!=null){

            $sectorDetail=$this->projectRepository->findById($project_id);
            $featureName=$this->featureRepository->getBySector($sectorDetail->sector);
        }else{
            $featureName='';
        }

        return view('project.featureValue.index',compact('featureName','projects','status','project_id','featureValue'));
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
    public function store(Request $request)
    {
         try {
            $structureDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $structureDetails['project_id'] = auth()->user()->project_id;
            }
        foreach($structureDetails['value']['before'] as $key=>$val){
            if($val!=null){
                $data['project_id']=$structureDetails['project_id'];
                $data['sailent_feature_id']=$key;
                $data['before_value']=$val;
                if($structureDetails['value']['after'][$key]!=null){
                $data['after_value']=$structureDetails['value']['after'][$key];

                }
                $oldData= $this->salientfeatureValueRepository->findByStructureId($key,$data['project_id']);
                if($oldData!=null){
                    $create=$oldData->fill($data)->save();
                }else{
                    $create = FeaturesValue::create($data);
                }
                
               
            }
        }
            if ($create) {
                session()->flash('success', 'Strcuture Estimation successfully created!');
                return redirect(route('features_value.index'));
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
