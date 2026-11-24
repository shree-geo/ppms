<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use Illuminate\Http\Request;
use App\Repository\ProjectRepository;
use App\Models\Projects;
use App\Http\Controllers\BaseController;
use App\Http\Requests\WorkmanshipRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class WorkmanshipController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $projects = $this->projectRepository->findByProject($request->project_id);
        } else {
            $projects = $this->projectRepository->all();
        }
        $allProjects = $this->projectRepository->all();
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
            $filename='workmanshipDetails'.'-'.$time.'.xlsx';
            ob_end_clean();
            ob_start();

     return Excel::download(new ProjectExport($projects,'workmanship'), $filename);
        }else{

            return view('project.workmanship.index', compact('projects', 'allProjects'));
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
        return view('project.workmanship.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkmanshipRequest $request)
    {
        try {
            $projectDetails = $request->project;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $projectDetails['project_id'] = auth()->user()->project_id;
            }
            $projects = $this->projectRepository->findById($projectDetails['project_id']);

            if ($projects) {
                $projects->fill($projectDetails)->update();
                session()->flash('success', 'Workmanship Details successfully created!');
                return redirect(route('workmanship.index'));
            } else {
                session()->flash('error', 'Workmanship details could not be created!');
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
            $edits['project'] = $this->projectRepository->findById($id);
            if ($edits['project']->count() > 0) {
                $projects = $this->projectRepository->all();

                return view('project.workmanship.edit', compact('edits', 'projects'));
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
    public function update(WorkmanshipRequest $request, $id)
    {
        try {
            $projectDetails = $request->project;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $projectDetails['project_id'] = auth()->user()->project_id;
            }
            $projects = $this->projectRepository->findById($projectDetails['project_id']);

            if ($projects) {
                $projects->fill($projectDetails)->update();
                session()->flash('success', 'Workmanship Details successfully Updated!');
                return redirect(route('workmanship.index'));
            } else {
                session()->flash('error', 'Workmanship details could not be updated!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Exception' . $e->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $id = (int)$id;
    //     try {
    //         $value = $this->projectRepository->findById($id);
    //         $value->delete();
    //         session()->flash('success', 'Workmanship Details successfully deleted!');
    //         return back();
    //     } catch (\Exception $e) {
    //         session()->flash('error', 'EXCEPTION' . $e->getMessage());
    //         return back();
    //     }
    // }
}
