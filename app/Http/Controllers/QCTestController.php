<?php

namespace App\Http\Controllers;


use App\Exports\ProjectExport;
use Illuminate\Http\Request;
use App\Repository\QCTestRepository;
use App\Repository\ProjectRepository;
use App\Http\Requests\QCTestRequest;
use App\Models\QCTest;
use App\Models\QcTestLogs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\Configurations\MaterialRepository;
use App\Repository\Configurations\TestTypeRepository;
use Maatwebsite\Excel\Facades\Excel;

class QCTestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $projectRepository;
    private $qcTestRepository;
    private $testTypeRepository;
    private $fiscalYearRepository;
    private $dataRepository;


    public function __construct(ProjectRepository $projectRepository, 
    QCTestRepository $qcTestRepository, 
    FiscalYearRepository $fiscalYearRepository,
    DataRepository $dataRepository,
    TestTypeRepository $testTypeRepository,
    MaterialRepository $materialRepository)
    {
        parent::__construct();

        $this->projectRepository = $projectRepository;
        $this->qcTestRepository = $qcTestRepository;
        $this->testTypeRepository = $testTypeRepository;
        $this->fiscalYearRepository= $fiscalYearRepository;
        $this->dataRepository= $dataRepository;
        $this->materialRepository= $materialRepository;
   
    }

    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $qcTest = $this->qcTestRepository->getByProjectId($request->project_id, 'search');
        } else {
            $qcTest = $this->qcTestRepository->all();
        }
        $projects = $this->projectRepository->all();
        // $test_types = $this->testTypeRepository->all();
        $monthList= $this->dataRepository->englishMonths();
        if($request->has('export')){
            $time=Carbon::now()->toDateTimeString();
            $list['monthslist'] = $monthList; 
            $filename='qualitycontrolTest'.'-'.$time.'.xlsx';
            ob_end_clean(); 
            ob_start();
           return Excel::download(new ProjectExport($qcTest,'qualitycontroltest',$list),$filename);
        }else{
            return view('project.qcTest.index', compact('qcTest','monthList','projects'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $test_types = $this->testTypeRepository->all()->groupBy('material_id');
        $materials = $this->materialRepository->all();
        $projects = $this->projectRepository->all();
        $year = $this->fiscalYearRepository->all();
        $month = $this->dataRepository->englishMonths();
        return view('project.qcTest.add', compact('projects', 'test_types','month','year','materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QCTestRequest $request)
    {
        try {
            $qcTest = $request->qcTest;
            // dd($qcTest);
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $qcTest['project_id'] = auth()->user()->project_id;
            }
            $qcTest['status']='submitted';
            $qcTest['status_date']=Carbon::now();

            $qcTest['user_id'] = auth()->user()->id;

            if ($request->hasFile('report_file')) {

                $reportFile = $request->file('report_file');
                $files = array();

                foreach ($reportFile as $val) {

                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . '/qcTestRerport');


                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . '/qcTestReport');
                    }

                    $val->move(storage_path() . '/app/public/uploads/' . '/' . '/qcTestReport', $newName);

                    array_push($files, $newName);
                }

                $qcTest['report_file'] = json_encode($files);
            }
            $qcTestLog['user_id']= $qcTest['user_id'] ;
            $qcTestLog['status']='submitted';
            $qcTestLog['status_date']= $qcTest['status_date'] ;

            $create = QCTest::create($qcTest)->id;
            if ($create) {
                $qcTestLog['qc_test_id']=$create;
                QcTestLogs::create($qcTestLog);
                session()->flash('success', 'QC Test successfully created!');
                return redirect(route('qcTest.index'));
            } else {
                session()->flash('error', 'QC Test could not be created!');
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
            $edits['qcTest'] = $this->qcTestRepository->findById($id);
            if ($edits['qcTest'] != null && $edits['qcTest']->count() > 0) {
                $projects = $this->projectRepository->all();
                $test_types = $this->testTypeRepository->all()->groupBy('material_id');
                $year = $this->fiscalYearRepository->all();
                $month = $this->dataRepository->englishMonths();
                $materials = $this->materialRepository->all();


                return view('project.qcTest.edit', compact('edits', 'projects', 'test_types','year','month','materials'));
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
    public function update(QCTestRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $qcTestDetails = $request->qcTest;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $qcTestDetails['project_id'] = auth()->user()->project_id;
            }
            $qcTestDetails['user_id'] = auth()->user()->id;
            $qcTest = $this->qcTestRepository->findById($id);

            if ($qcTest) {
                if ($request->hasFile('report_file')) {
                    if ($qcTest->report_file != null) {
                        $files = json_decode($qcTest->report_file);
                    } else {
                        $files = [];
                    }


                    $reportFile = $request->file('report_file');

                    foreach ($reportFile as $val) {

                        $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                        $directories = storage_path('/app/public/uploads/' . '/' . '/qcTestRerport');


                        if (!file_exists($directories)) {
                            Storage::makeDirectory('/app/public/uploads/' . '/' . '/qcTestReport');
                        }

                        $val->move(storage_path() . '/app/public/uploads/' . '/' . '/qcTestReport', $newName);

                        array_push($files, $newName);
                    }

                    $qcTestDetails['report_file'] = json_encode($files);
                }
                $qcTest->fill($qcTestDetails)->save();

                session()->flash('success', 'QC Test updated successfully!');
                return redirect(route('qcTest.index'));
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
            $value = $this->qcTestRepository->findById($id);

            if ($value->report_file != null) {
                $arrayFile = json_decode($value->report_file);

                for ($i = 0; $i < count($arrayFile); $i++) {

                    @unlink(storage_path('/app/public/uploads/qcTestReport' . '/' . $arrayFile[$i]));
                }
            }

            $value->delete();

            session()->flash('success', 'QC Test successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function deleteFile($id, $fileName)
    {
        $qcTest = $this->qcTestRepository->findById($id);
        if ($qcTest != null) {
            if ($qcTest->report_file != null) {
                $arrayFile = json_decode($qcTest->report_file);

                for ($i = 0; $i < count($arrayFile); $i++) {
                    if ($arrayFile[$i] == $fileName) {

                        @unlink(storage_path('/app/public/uploads/qcTestReport' . '/' . $fileName));

                        unset($arrayFile[$i]);
                    }
                }
                $files = json_encode(array_values($arrayFile));
                $qcTest->update(['report_file' => $files]);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }

     public function updateStatus(Request $request){
      try {
           $details= $request->all();
           $details['user_id']=auth()->user()->id;
           $details['status_date']=Carbon::now();
           if($details['status']!=null){
            $value = $this->qcTestRepository->findById($details['qc_test_id']);
            $value->fill($details)->save();
            QcTestLogs::create($details);
                return back();
           }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
