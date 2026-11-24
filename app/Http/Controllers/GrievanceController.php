<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Http\Requests\GrievanceRequest;
use App\Models\Grievance;
use App\Repository\GrievanceRepository;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class GrievanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $projectRepository;
     private $grievanceRepository;

     public function __construct(ProjectRepository $projectRepository, GrievanceRepository $grievanceRepository){

         parent::__construct();
         $this->projectRepository= $projectRepository;
         $this->grievanceRepository= $grievanceRepository;

     }
    public function index(Request $request)
    {
        $projects= $this->projectRepository->all();

        if($request->project_id!=null ||$request->from!=null|| $request->to!=null){
           $grievancesDetail= $this->grievanceRepository->searchData($request->all());
           $grievances=$grievancesDetail->groupBy('project_id');
        }else{

            $grievances= $this->grievanceRepository->all();
        }
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
            $filename='grievanceDetails'.'-'.$time.'.xlsx';
            ob_end_clean(); 
            ob_start();
            return Excel::download(new ProjectExport($grievances,'grievances'),$filename);
        }
        else{

            return view('project.grievance.index',compact('projects','grievances'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects= $this->projectRepository->all();
        return view('project.grievance.add',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrievanceRequest $request)
    {
        try {
            $grievanceDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $grievanceDetails['project_id'] = auth()->user()->project_id;
            }
            if ($request->hasFile('files')) {

                $reportFile = $request->file('files');
              
                $files = array();
    
                foreach ($reportFile as $val) {
    
                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . '/grievance/file/');
    
    
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . '/grievance/file/');
                    }
    
                    $val->move(storage_path() . '/app/public/uploads/' . '/' . '/grievance/file/', $newName);
    
                    array_push($files, $newName);
                }
    
                $grievanceDetails['files'] = json_encode($files);
            }
            $create = Grievance::create($grievanceDetails);
            if ($create) {
                session()->flash('success', 'Grievance successfully created!');
                return redirect(route('grievance_detail.index'));
            } else {
                session()->flash('error', 'Grievance could not be created!');
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
            $edits = $this->grievanceRepository->findById($id);
            if ($edits!= null ) {
                $projects = $this->projectRepository->all();

                return view('project.grievance.edit', compact('edits', 'projects'));
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
    public function update(GrievanceRequest $request, $id)
    {
       $id = (int)$id;
        try {
            $grievanceDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $grievanceDetails['project_id'] = auth()->user()->project_id;
            }
            $grievance = $this->grievanceRepository->findById($id);
            if ($request->hasFile('files')) {

                $reportFile = $request->file('files');
                $files = array();
    
                foreach ($reportFile as $val) {
    
                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . '/grievance/file/');
    
    
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . '/grievance/file/');
                    }
    
                    $val->move(storage_path() . '/app/public/uploads/' . '/' . '/grievance/file/', $newName);
    
                    array_push($files, $newName);
                }
    
                $grievanceDetails['files'] = json_encode($files);
            }
            if ($grievance) {
                $grievance->fill($grievanceDetails)->save();
                session()->flash('success', 'Grievance updated successfully!');

                return redirect(route('grievance_detail.index'));
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
            $value = $this->grievanceRepository->findById($id);
            if ($value->files != null) {

                $arrayFile = json_decode($value->files);
                for ($i = 0; $i < count($arrayFile); $i++) {

                    @unlink(storage_path('/app/public/uploads' . '/' . 'grievance/file/' . $arrayFile[$i]));
                }
            }
            $value->delete();
            session()->flash('success', 'Grievance successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
    public function deletefile($id,$fileName)
    {
        $grievance = $this->grievanceRepository->findById($id);
        
      
        if ($grievance != null) {
            if ($grievance->files != null) {
                $arrayFile = json_decode($grievance->files);

                for ($i = 0; $i < count($arrayFile); $i++) {
                    if ($arrayFile[$i] == $fileName) {
                        @unlink(storage_path() . '/app/public/uploads' . '/' . 'grievance/file/', $fileName);

                        unset($arrayFile[$i]);
                    }
                }
                $files = json_encode(array_values($arrayFile));
                $grievance->update(['files' => $files]);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }
}

