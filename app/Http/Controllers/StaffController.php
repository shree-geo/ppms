<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\DesignationRepository;
use App\Repository\ProjectRepository;
use App\Repository\StaffRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StaffController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $staffRepository;
    private $projectRepository;
    private $dataRepository;
    private $designationRepository;

    public function __construct(StaffRepository $staffRepository, ProjectRepository $projectRepository,
    DataRepository $dataRepository, DesignationRepository $designationRepository)
    {
        parent::__construct();
        $this->staffRepository = $staffRepository;
        $this->projectRepository = $projectRepository;
        $this->dataRepository=$dataRepository;
        $this->designationRepository=$designationRepository;
    }

    public function index(Request $request)
    {
        if($request->project_id != null) {
            $staffs = $this->staffRepository->getByProjectId($request->project_id, 'search');
        } else {
            $staffs = $this->staffRepository->all();  
        }
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
            $filename='staffDetails'.'-'.$time.'.xlsx';
            $list['designation'] = $this->designationRepository->all(); 
            ob_end_clean();
            ob_start();
             return Excel::download(new ProjectExport($staffs,'staffs',$list), $filename);
        }else{
            $projects = $this->projectRepository->all();
            $designationlist = $this->designationRepository->all();
            return view('project.staff.index', compact('staffs', 'projects','designationlist'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = $this->projectRepository->all();
        $designation = $this->designationRepository->all();
        return view('project.staff.add', compact('projects','designation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StaffRequest $request)
    {
        try {
            $staffDetails = $request->staff;        
        
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $staffDetails['project_id'] = auth()->user()->project_id;
            }
            $create = Staff::create($staffDetails);          
            if ($create) {
                session()->flash('success', 'Staff Details successfully created!');
                return redirect(route('staff.index'));
            } else {
                session()->flash('error', 'Staff Details could not be created!');
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
            $edits['staff'] = $this->staffRepository->findById($id);
            if ($edits['staff'] != null && $edits['staff']->count() > 0) {
                $projects = $this->projectRepository->all();               
                $designation = $this->designationRepository->all();
                return view('project.staff.edit', compact('edits', 'projects','designation'));
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
    public function update(StaffRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $staffDetails = $request->staff;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $staffDetails['project_id'] = auth()->user()->project_id;
            }
            $staff = $this->staffRepository->findById($id);
            if ($staff) {
                $staff->fill($staffDetails)->save();
                session()->flash('success', 'Staffs Details updated successfully!');

                return redirect(route('staff.index'));
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
            $value = $this->staffRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Staff Details successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
