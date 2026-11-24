<?php

namespace App\Http\Controllers;

use App\Repository\ProgressDataRepository;
use App\Repository\ProgressRevisionRepository;
use App\Repository\ProjectRepository;
use App\Revision;
use Illuminate\Http\Request;
use DB;

class ProgressRevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $projectRepository;
    private $progressDataRepository;
    private $progressRevisionRepository;

    public function __construct(ProjectRepository $projectRepository, ProgressDataRepository $progressDataRepository, ProgressRevisionRepository $progressRevisionRepository){

        $this->projectRepository = $projectRepository;
        $this->progressDataRepository = $progressDataRepository;
        $this->progressRevisionRepository = $progressRevisionRepository;

      }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRevisionByProject($project_id)
    {
        $projects=$this->projectRepository->findByProject($project_id);

        $progressData= $this->progressDataRepository->latestData($project_id);
        $allprogressData=$progressData->groupBy('year');
        $scurveData=$this->progressDataRepository->getScurveData($project_id);
        // $allRevision=$this->progressRevisionRepository->all();
        $allRevision=Revision::where('project_id',$project_id)->get();
        $revisions = $allRevision->mapWithKeys(function($revision, $key) {
            return [$revision->id => $revision->rname];
        });
        return view('project.revision.add',compact('projects','allprogressData','scurveData','revisions','progressData'));
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
            $details=$request->all();
            $user_group= auth()->user()->user_group_id;
            if($user_group==2){
              $project_id=auth()->user()->project_id;
            }else{
                $project_id=$details['project_id'];
            }
            $data['project_id']=$project_id;
            $data['revision_name']=$details['revision_name'];
           $create= DB::select('call createScurve('. $data['project_id'] .','." '" .$data['revision_name']."'" .')');

          
           return \Redirect::route('progressDataByProject', ['project_id'=>$project_id])->with('message', 'Revision saved correctly!!!');
           
        //    session()->flash('success', 'Revision successfully created!');
           
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
