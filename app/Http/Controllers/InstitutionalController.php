<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\InstitutionalRepository;
use App\Repository\ProjectRepository;
use App\Models\Institutional;
use App\Http\Requests\InstitutionalRequest;
use App\Models\InstitutionLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Maatwebsite\Excel\Facades\Excel;

class InstitutionalController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $institutionalRepository;
    private $projectRepository;

    public function __construct(InstitutionalRepository $institutionalRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->institutionalRepository = $institutionalRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $institutions = $this->institutionalRepository->getByProjectId($request->project_id, 'search');
        } else {
            $institutions = $this->institutionalRepository->all();
        }
        $projects = $this->projectRepository->all();
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
             $filename='institutions'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();
                return Excel::download(new ProjectExport($institutions,'institutions'),$filename);
        }else{
            return view('project.institutional.index', compact('institutions', 'projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = $this->projectRepository->all();
        return view('project.institutional.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionalRequest $request)
    {
        try {
            $instiDetails = $request->insti;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $instiDetails['project_id'] = auth()->user()->project_id;
            }
            $instiDetails['status']='submitted';
            $instiDetails['status_date']=Carbon::now();
            $create = Institutional::create($instiDetails)->id;
            $instiLogs['user_id']=auth()->user()->id;
            $instiLogs['status']=$instiDetails['status'];
            $instiLogs['status_date']=$instiDetails['status_date'];
            if ($create) {
                $instiLogs['institution_id']=$create;
                InstitutionLogs::create($instiLogs);
                session()->flash('success', 'Instituition successfully created!');
                return redirect(route('institutional.index'));
            } else {
                session()->flash('error', 'Institution could not be created!');
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
            $edits['insti'] = $this->institutionalRepository->findById($id);
            if ($edits['insti'] != null && $edits['insti']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.institutional.edit', compact('edits', 'projects'));
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
    public function update(InstitutionalRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $instiDetails = $request->insti;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $instiDetails['project_id'] = auth()->user()->project_id;
            }
            $institutions = $this->institutionalRepository->findById($id);
            if ($institutions) {
                $institutions->fill($instiDetails)->save();
                session()->flash('success', 'Institutional updated successfully!');

                return redirect(route('institutional.index'));
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
            $value = $this->institutionalRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Institutional  successfully deleted!');
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
                $value = $this->institutionalRepository->findById($details['institution_id']);
                $value->fill($details)->save();
                InstitutionLogs::create($details);
                return back();
           }
          
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
