<?php

namespace App\Http\Controllers;

use App\Repository\GrievanceCommitteRepository;
use App\Repository\ProjectRepository;
use App\Repository\Configurations\DataRepository;
use App\Models\GrievanceCommunity;
use App\Http\Requests\GrievanceCommitteRequest;
use App\Http\Controllers\BaseController;
use App\Http\Requests\GrievanceCommitteEditRequest;
use Illuminate\Http\Request;

class GrievanceCommitteController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(GrievanceCommitteRepository $grievanceCommitteRepository, ProjectRepository $projectRepository, DataRepository $dataRepository)
    {
        parent::__construct();
        $this->grievanceCommitteRepository = $grievanceCommitteRepository;
        $this->projectRepository = $projectRepository;
        $this->dataRepository = $dataRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $grievance_committe = $this->grievanceCommitteRepository->getByProjectId($request->project_id, 'search');
        } else {
            $grievance_committe = $this->grievanceCommitteRepository->all();
        }
        $projects = $this->projectRepository->all();
        return view('project.grievanceCommitte.index', compact('grievance_committe', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = $this->projectRepository->all();
        $grievanceWard = $this->dataRepository->grievanceWardDesignation();
        $grievanceMuni = $this->dataRepository->grievanceMuniDesignation();
        return view('project.grievanceCommitte.add', compact('project', 'grievanceWard', 'grievanceMuni'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrievanceCommitteRequest $request)
    {
        try {
            $grievanceCommitteDetails = $request->all();
            foreach ($grievanceCommitteDetails['grievance'] as $details) {
                foreach ($details as $value) {
                    if($value['name']!=null){
                        $value['project_id'] = isset($grievanceCommitteDetails['project_id']) ? $grievanceCommitteDetails['project_id'] : auth()->user()->project_id;
                        $create = GrievanceCommunity::create($value);
                    }
                }
            }

            if ($create) {
                session()->flash('success', 'Grievance Committe successfully created!');
                return redirect(route('grievanceCommitte.index'));
            } else {
                session()->flash('error', 'Grievance Committe could not be created!');
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
            $edits['grievanceCommitte'] = $this->grievanceCommitteRepository->findById($id);
            if ($edits['grievanceCommitte'] != null && $edits['grievanceCommitte']->count() > 0) {
                $projects = $this->projectRepository->all();
                $grievanceWard = $this->dataRepository->grievanceWardDesignation();
                $grievanceMuni = $this->dataRepository->grievanceMuniDesignation();
                return view('project.grievanceCommitte.edit', compact('edits', 'projects', 'grievanceWard', 'grievanceMuni'));
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
    public function update(GrievanceCommitteEditRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $grievanceCommitteDetails = $request->grievanceCommitte;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $grievanceCommitteDetails['project_id'] = auth()->user()->project_id;
            }
            $grievanceCommitte = $this->grievanceCommitteRepository->findById($id);
            if ($grievanceCommitte) {
                $grievanceCommitte->fill($grievanceCommitteDetails)->save();
                session()->flash('success', 'Grievance Committe updated successfully!');

                return redirect(route('grievanceCommitte.index'));
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
            $value = $this->grievanceCommitteRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Grievance Committe  successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
