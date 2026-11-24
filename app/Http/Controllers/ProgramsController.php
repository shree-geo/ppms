<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\ProgramsRepository;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use App\Repository\Configurations\ProgramTypeRepository;
use App\Http\Requests\ProgramsRequest;
use App\Models\ProgramLogs;
use App\Models\Programs;
use Carbon\Carbon;
use App\Http\Controllers\BaseController;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class ProgramsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $projectRepository;
    private $programsRepository;
    private $programTypeRepository;


    public function __construct(ProjectRepository $projectRepository, ProgramsRepository $programsRepository, ProgramTypeRepository $programTypeRepository)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->programsRepository = $programsRepository;
        $this->programTypeRepository = $programTypeRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null || $request->from !=null || $request->to !=null || $request->program_type_id !=null ) {
            $data = $this->programsRepository->searchData($request->all());
            $programs= $data->groupBy('project_id');

        } else {
            $programs = $this->programsRepository->all();
        }
        $program_types=$this->programTypeRepository->all();
        $projects = $this->projectRepository->all();
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
            $filename= 'programDetails'.'-'.$time.'.xlsx';
            ob_end_clean();
            ob_start();
            return Excel::download(new ProjectExport($programs,'program'), $filename);

        }else{

            return view('project.programs.index', compact('programs', 'projects','program_types'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $program_types = $this->programTypeRepository->all();
        $projects = $this->projectRepository->all();
        return view('project.programs.add', compact('program_types', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramsRequest $request)
    {
        try {
            $programsDetails = $request->programs;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $programsDetails['project_id'] = auth()->user()->project_id;
            }
            $programsDetails['status']='submitted';
            $programsDetails['status_date']=Carbon::now();
            if ($request->hasFile('files')) {

                $reportFile = $request->file('files');
                $files = array();
    
                foreach ($reportFile as $val) {
    
                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . 'programs');
    
    
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . 'programs');
                    }
    
                    $val->move(storage_path() . '/app/public/uploads/' . '/' . 'programs/', $newName);
    
                    array_push($files, $newName);
                }
    
                $programsDetails['file'] = json_encode($files);
            }
            $create = Programs::create($programsDetails)->id;
            $programsLog['user_id']= auth()->user()->id;
            $programsLog['status']= $programsDetails['status'];
            $programsLog['status_date']= $programsDetails['status_date'];
            $programsLog['program_id']= $create;
            ProgramLogs::create($programsLog);

            if ($create) {
                session()->flash('success', 'Programs successfully created!');
                return redirect(route('programs.index'));
            } else {
                session()->flash('error', 'Programs could not be created!');
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
            $edits['programs'] = $this->programsRepository->findById($id);
            if ($edits['programs'] != null && $edits['programs']->count() > 0) {
                $projects = $this->projectRepository->all();
                $program_types = $this->programTypeRepository->all();

                return view('project.programs.edit', compact('edits', 'projects', 'program_types'));
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
    public function update(ProgramsRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $programsDetails = $request->programs;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $programsDetails['project_id'] = auth()->user()->project_id;
            }
            $programs = $this->programsRepository->findById($id);
            if ($request->hasFile('files')) {

                $reportFile = $request->file('files');
                if($programs->file!=null){
                    $files=json_decode($programs->file);
                }else{
                    $files = array();
                }
    
                foreach ($reportFile as $val) {
    
                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . 'programs/');
    
    
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . 'programs/');
                    }
    
                    $val->move(storage_path() . '/app/public/uploads/' . '/' . 'programs/', $newName);
    
                    array_push($files, $newName);
                }
    
                $programsDetails['file'] = json_encode($files);
            }  
            if ($programs) {
                $programs->fill($programsDetails)->save();
                session()->flash('success', 'Programs updated successfully!');

                return redirect(route('programs.index'));
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
            $value = $this->programsRepository->findById($id);
            if ($value->file != null) {

                $arrayFile = json_decode($value->file);
                for ($i = 0; $i < count($arrayFile); $i++) {

                    @unlink(storage_path('/app/public/uploads' . '/' . 'programs/' . $arrayFile[$i]));
                }
            }
            $value->delete();
            session()->flash('success', 'Programs successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function updateStatus(Request $request){
        try {
           $details= $request->all();
           $details['user_id']=auth()->user()->id;
           $details['status_date']=Carbon::now();
           if($details['status']!=null){
            $value = $this->programsRepository->findById($details['program_id']);
            $value->fill($details)->save();
            ProgramLogs::create($details);
            return back();
           }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
    public function deletefile($id,$fileName)
    {
        $programs = $this->programsRepository->findById($id);
        
      if ($programs != null) {
            if ($programs->file!= null) {
                $arrayFile = json_decode($programs->file);

                for ($i = 0; $i < count($arrayFile); $i++) {
                    if ($arrayFile[$i] == $fileName) {
                        @unlink(storage_path('/app/public/uploads' . '/' . 'programs/'  .$fileName));

                        unset($arrayFile[$i]);
                    }
                }
                $files = json_encode(array_values($arrayFile));
                $programs->update(['file' => $files]);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }
}
