<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\WorkerRepository;
use App\Repository\ProjectRepository;
use App\Models\WorkerDetails;
use App\Http\Requests\WorkerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\WorkersDetailsLogs;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\FiscalYearRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class WorkerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $workerRepository;
    private $projectRepository;
    private $fiscalYearRepository;
    private $dataRepository;

    public function __construct(WorkerRepository $workerRepository, 
    ProjectRepository $projectRepository,
    FiscalYearRepository $fiscalYearRepository, DataRepository $dataRepository)
    {
        parent::__construct();
        $this->workerRepository = $workerRepository;
        $this->projectRepository = $projectRepository;
        $this->fiscalYearRepository= $fiscalYearRepository;
         $this->dataRepository= $dataRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $workers = $this->workerRepository->getByProjectId($request->project_id, 'search');
        } else {
            $workers = $this->workerRepository->all();
        }
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->englishMonths();
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
             $filename= 'workerDetails'.'-'.$time.'.xlsx';
            ob_end_clean();
            ob_start();
            $list['monthslist'] = $monthList; 
            return Excel::download(new ProjectExport($workers,'worker',$list), $filename);
        }else{
            return view('project.worker.index', compact('workers', 'projects','monthList'));
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
        $year = $this->fiscalYearRepository->all();
        $month = $this->dataRepository->englishMonths();
        return view('project.worker.add', compact('projects','year','month'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkerRequest $request)
    {
        try {
            $workerDetails = $request->worker;          
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $workerDetails['project_id'] = auth()->user()->project_id;
            }
            $workerDetails['status']='submitted';
            $workerDetails['status_date']=Carbon::now();
            $oldData=$this->workerRepository->findByYearMonth($workerDetails['project_id'],$workerDetails['year'],$workerDetails['month']);
            if($oldData->count()>0){
                session()->flash('error', 'Data Already created for this year and month!');
                return back();
            }else{
                $create = WorkerDetails::create($workerDetails)->id;
                $WokDeLogs['user_id']=auth()->user()->id;
                $WokDeLogs['status']=$workerDetails['status'];
                $WokDeLogs['status_date']=$workerDetails['status_date'];
                if ($create) {
                    $WokDeLogs['worker_details_id']=$create;
                    WorkersDetailsLogs::create($WokDeLogs);
                    session()->flash('success', 'Workers Details successfully created!');
                    return redirect(route('worker.index'));
                } else {
                    session()->flash('error', 'Worker Details could not be created!');
                    return back();
                }
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
            $edits['worker'] = $this->workerRepository->findById($id);
            if ($edits['worker'] != null && $edits['worker']->count() > 0) {
                $projects = $this->projectRepository->all();
                $year = $this->fiscalYearRepository->all();
                 $month = $this->dataRepository->englishMonths();
                return view('project.worker.edit', compact('edits', 'projects','year','month'));
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
    public function update(WorkerRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $workerDetails = $request->worker;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $workerDetails['project_id'] = auth()->user()->project_id;
            }
            $worker = $this->workerRepository->findById($id);
            if ($worker) {
                $worker->fill($workerDetails)->save();
                session()->flash('success', 'Workers Details updated successfully!');

                return redirect(route('worker.index'));
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
            $value = $this->workerRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Worker Details successfully deleted!');
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
                $value = $this->workerRepository->findById($details['worker_details_id']);
                $value->fill($details)->save();
                WorkersDetailsLogs::create($details);
                return back();
             }
          } catch (\Exception $e) {
              session()->flash('error', 'EXCEPTION' . $e->getMessage());
              return back();
          }
      }
}
