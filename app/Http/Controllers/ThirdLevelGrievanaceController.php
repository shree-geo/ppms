<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Http\Requests\ThirdLevelGrievanceRequest;
use App\Models\GrievanceCommunity;
use App\Models\ThirdLevelGrievance;
use App\Repository\Configurations\DataRepository;
use App\Repository\GrievanceCommitteRepository;
use App\Repository\GrievanceRepository;
use App\Repository\ProjectRepository;
use App\Repository\ThirdGrievanceCommitteRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ThirdLevelGrievanaceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $projectRepository;
    private $thirdGrievanceCommitteRepository;

    public function __construct(ProjectRepository $projectRepository, ThirdGrievanceCommitteRepository $thirdGrievanceCommitteRepository){

        parent::__construct();
        $this->projectRepository= $projectRepository;
        $this->thirdGrievanceCommitteRepository= $thirdGrievanceCommitteRepository;

    }
    public function index(Request $request)
    {
        $thirdlevelgrievances= $this->thirdGrievanceCommitteRepository->all();

        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
            $filename='thirdlevelgrievances'.'-'.$time.'.xlsx';
            ob_end_clean(); 
            ob_start();
            return Excel::download(new ProjectExport($thirdlevelgrievances,'thirdlevelgrievances'),$filename);
        }
        else{

            return view('project.thirdlevelgrievance.index',compact('thirdlevelgrievances'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.thirdlevelgrievance.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThirdLevelGrievanceRequest $request)
    {
        try {

            $thirdlevelgrievanceDetails = $request->all(); 
            // dd($thirdlevelgrievanceDetails);
           $create = ThirdLevelGrievance::create($thirdlevelgrievanceDetails['grievanceThirdLevel']);
                           

            if ($create) {
                session()->flash('success', 'Third Level Grievance  successfully created!');
                return redirect(route('thirdlevelgrievance.index'));
            } else {
                session()->flash('error', 'Third Level Grievance  could not be created!');
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
        try {
            $id = (int)$id;
            $edits['grievanceThirdLevel'] = $this->thirdGrievanceCommitteRepository->findById($id);
            if ($edits['grievanceThirdLevel'] != null && $edits['grievanceThirdLevel']->count() > 0) {
                return view('project.thirdlevelgrievance.edit', compact('edits'));
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
    
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThirdLevelGrievanceRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $thirdlevelgrievance = $request->grievanceThirdLevel;
            
            $grievanceCommitte = $this->thirdGrievanceCommitteRepository->findById($id);
            if ($grievanceCommitte) {
                $grievanceCommitte->fill($thirdlevelgrievance)->save();
                session()->flash('success', 'Third Level Grievance updated successfully!');

                return redirect(route('thirdlevelgrievance.index'));
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
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->thirdGrievanceCommitteRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Third Level Grievance successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
