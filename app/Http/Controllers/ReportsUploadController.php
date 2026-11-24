<?php

namespace App\Http\Controllers;

use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ReportUploadRequest;
use App\Models\Reports;
use App\Repository\Configurations\DataRepository;
use App\Repository\Configurations\FiscalYearRepository;
use App\Repository\ReportsUploadRepository;

class ReportsUploadController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $reportsUploadRepository;
    private $projectRepository;
    private $dataRepository;
    private $fiscalYearRepository;
  

    public function __construct(ReportsUploadRepository $reportsUploadRepository, ProjectRepository $projectRepository, DataRepository $dataRepository,
    FiscalYearRepository $fiscalYearRepository)
    {
        parent::__construct();
        $this->reportsUploadRepository = $reportsUploadRepository;
        $this->projectRepository = $projectRepository;
        $this->dataRepository = $dataRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }
    public function index(Request $request)
    {
        if($request->project_id!=null ||$request->year!=null || $request->months!=null){

            $reports = $this->reportsUploadRepository->searchData($request);
        }else{
            $reports = $this->reportsUploadRepository->all();

        }
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->monthDataForReport();
        $years = $this->fiscalYearRepository->all();

        return view('project.report_upload.index', compact('reports', 'projects','monthList','years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = $this->projectRepository->all();
        $monthList= $this->dataRepository->monthDataForReport();
        $years = $this->fiscalYearRepository->all();
        return view('project.report_upload.add', compact('projects', 'monthList','years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportUploadRequest $request)
    {

        try {
            $reportDetails = $request->all();
            
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $reportDetails['project_id'] = auth()->user()->project_id;
            }
            $reportDetails['user_id'] = auth()->user()->id;
            if ($request->hasFile('file')) {

                $image = $request->file('file');
                $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/reports');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/reports');
                }

                $image->move(storage_path() . '/app/public/uploads/reports/', $newName);

                $reportDetails['file'] = $newName;
            }
            $create = Reports::create($reportDetails);

            if ($create) {
                session()->flash('success', 'Reports successfully created!');
                return redirect(route('reportUpload.index'));
            } else {
                session()->flash('error', 'Reports could not be created!');
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
            $edits = $this->reportsUploadRepository->findById($id);
            if ( $edits->count() > 0) {
                $projects = $this->projectRepository->all();
                $monthList= $this->dataRepository->monthDataForReport();
                 $years = $this->fiscalYearRepository->all();
                return view('project.report_upload.edit', compact('edits', 'projects', 'monthList','years'));
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
    public function update(Request $request, $id)
    {
        $id = (int)$id;
        try {
            $reportDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $reportDetails['project_id'] = auth()->user()->project_id;
            }
            $reportDetails['user_id'] = auth()->user()->id;
            $reports = $this->reportsUploadRepository->findById($id);

            if ($reports) {

                if ($request->hasFile('file')) {
                    @unlink(storage_path('/app/public/uploads/reports/' . $reports->file));
                    $image = $request->file('file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/reports');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/reports');
                    }

                    $image->move(storage_path() . '/app/public/uploads/reports/', $newName);


                    $reportDetails['file'] = $newName;
                }
                $reports->fill($reportDetails)->save();
              
                session()->flash('success', 'Reports updated successfully!');

                return redirect(route('reportUpload.index'));
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
            $value = $this->reportsUploadRepository->findById($id);
            if ($value->file != null) {
                @unlink(storage_path('/app/public/uploads/reports/' . $value->file));
            }
            $value->delete();
            session()->flash('success', 'Reports successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }


    public function deleteImage($id)
    {
        $reports = $this->reportsUploadRepository->findById($id);
        if ($reports != null) {
            if ($reports->file != null) {
                @unlink(storage_path('/app/public/uploads/reports/' . $reports->file));

                $reports->update(['file' => '']);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }
}
