<?php

namespace App\Http\Controllers;


use App\Exports\ProjectExport;
use Illuminate\Http\Request;
use App\Repository\QualityControlRepository;
use App\Repository\ProjectRepository;
use App\Http\Requests\QualityControlRequest;
use App\Models\QualityControl;
use App\Http\Controllers\BaseController;
use App\Repository\Configurations\TestTypeRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class QualityControlController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $projectRepository;
    private $qualityControlRepository;
    private $testTypeRepository;


    public function __construct(ProjectRepository $projectRepository, QualityControlRepository $qualityControlRepository, TestTypeRepository $testTypeRepository)
    {
        parent::__construct();
        $this->projectRepository = $projectRepository;
        $this->qualityControlRepository = $qualityControlRepository;
        $this->testTypeRepository = $testTypeRepository;
    }

    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $qc = $this->qualityControlRepository->getByProjectId($request->project_id, 'search');
        } else {
            $qc = $this->qualityControlRepository->all();
        }
        $projects = $this->projectRepository->all();
        $user_group=auth()->user()->user_group_id;

        if($request->has('export')){
            $time=Carbon::now()->toDateTimeString();
               $filename='qualitycontrol'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();
                return Excel::download(new ProjectExport($qc,'qualitycontrol'),$filename);
        }else{
            if($user_group==2){
                $project_id=auth()->user()->project_id;
                $qc_types = $this->testTypeRepository->all();
                $edits = $this->qualityControlRepository->getByProjectId($project_id);
                if($edits!=null){
    
                $qualityData = $edits->mapWithKeys(function ($items) {
                    return [$items['qc_type_id'] => $items['target']];
                });
                    return view('project.qualityControl.edit',compact('edits', 'projects', 'qc_types', 'qualityData'));
        
                }else{
        
                    return view('project.qualityControl.add', compact('qc_types', 'projects'));

        
                }
            }else{
    
            return view('project.qualityControl.index', compact('qc', 'projects'));
        }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qc_types = $this->testTypeRepository->all();
        $projects = $this->projectRepository->all();
        return view('project.qualityControl.add', compact('projects', 'qc_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QualityControlRequest $request)
    {
        try {

            $user_group = auth()->user()->user_group_id;
        
            for ($count = 0; $count < count($request->qc_type_id); $count++) {
                $qcDetails = array(
                    'project_id' => $request->project_id ? $request->project_id : auth()->user()->project_id,
                    'qc_type_id' => $request->qc_type_id[$count],
                    'target' => $request->target[$count],
                );

                if ($request->target[$count] != null) 
                {

                    $qcCheck = $this->qualityControlRepository->getByqcTypeId($request->qc_type_id[$count], $qcDetails['project_id']);
                    if (!is_null($qcCheck)) 
                    {
                        $qcCheck->delete();                   
                    } 
                        QualityControl::insert($qcDetails);
                    }
                }
            
            if ($qcDetails) {
                session()->flash('success', 'Quality Control successfully created!');
                return redirect(route('qualityControl.index'));
            } else {
                session()->flash('error', 'Quality Control could not be created!');
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
            $edits = $this->qualityControlRepository->getByProjectId($id);

            $qualityData = $edits->mapWithKeys(function ($items) {
                return [$items['qc_type_id'] => $items['target']];
            });

            if ($edits != null && $edits->count() > 0) {
                $projects = $this->projectRepository->all();
                $qc_types = $this->testTypeRepository->all();
                return view('project.qualityControl.edit', compact('edits', 'projects', 'qc_types', 'qualityData'));
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
    public function update(QualityControlRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $qcDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $qcDetails['project_id'] = auth()->user()->project_id;
            }

            for ($count = 0; $count < count($request->qc_type_id); $count++) {
                if ($request->target[$count] == null) {

                    $qcCheck = $this->qualityControlRepository->getByqcTypeId($request->qc_type_id[$count], $qcDetails['project_id']);
                    if (!is_null($qcCheck)) {
                        $qcCheck->delete();
                    }
                } else {
                    $qc = QualityControl::updateOrCreate(
                        [
                            'project_id' => $request->project_id ? $request->project_id : auth()->user()->project_id,
                            'qc_type_id' => $request->qc_type_id[$count]
                        ],
                        [
                            'target' => $request->target[$count]
                        ]
                    );
                }
            }

            if ($qc) {
                session()->flash('success', 'Quality Control updated successfully!');

                return redirect(route('qualityControl.index'));
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
        //
    }

    public function qcModal(Request $request)
    {
        try {
            $qcModel = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $project_id = auth()->user()->project_id;
            }
            $project = $this->projectRepository->findById($project_id);

            if ($project) {
                $project->fill($qcModel)->save();
                session()->flash('success', 'QC successfully created!');
                return redirect(route('qualityControl.index'));
            } else {
                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Exception' . $e->getMessage());
            return back();
        }
    }
}
