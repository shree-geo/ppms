<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\MonitoringRepository;
use App\Repository\ProjectRepository;
use App\Models\Monitoring;
use App\Http\Requests\MonitoringRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $monitoringRepository;
    private $projectRepository;

    public function __construct(MonitoringRepository $monitoringRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->monitoringRepository = $monitoringRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $monitorings = $this->monitoringRepository->getByProjectId($request->project_id, 'search');
        } else {
            $monitorings = $this->monitoringRepository->all();
        }
        $projects = $this->projectRepository->all();
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
             $filename='monitorings'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();
                return Excel::download(new ProjectExport($monitorings,'monitorings'),$filename);

        }else{
            return view('project.monitoring.index', compact('monitorings', 'projects'));
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
        return view('project.monitoring.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MonitoringRequest $request)
    {
        try {
            $monitoringDetails = $request->moni;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $monitoringDetails['project_id'] = auth()->user()->project_id;
            }
            if ($request->hasFile('file')) {

                $image = $request->file('file');
                $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/monitoring');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/monitoring');
                }

                $image->move(storage_path() . '/app/public/uploads/monitoring/', $newName);

                $monitoringDetails['file'] = $newName;
            }
            $create = Monitoring::create($monitoringDetails);
            if ($create) {
                session()->flash('success', 'Monitoring successfully created!');
                return redirect(route('monitoring.index'));
            } else {
                session()->flash('error', 'Monitoring could not be created!');
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
            $edits['moni'] = $this->monitoringRepository->findById($id);
            if ($edits['moni'] != null && $edits['moni']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.monitoring.edit', compact('edits', 'projects'));
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
    public function update(MonitoringRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $monitoringDetails = $request->moni;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $monitoringDetails['project_id'] = auth()->user()->project_id;
            }
            $monitoring = $this->monitoringRepository->findById($id);

            if ($monitoring) {
                if ($request->hasFile('file')) {
                    @unlink(storage_path('/app/public/uploads/monitoring/' . $monitoring->file));
                    $image = $request->file('file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/monitoring');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/monitoring');
                    }

                    $image->move(storage_path() . '/app/public/uploads/monitoring/', $newName);


                    $monitoringDetails['file'] = $newName;
                }
                $monitoring->fill($monitoringDetails)->save();
                session()->flash('success', 'Monitoring updated successfully!');

                return redirect(route('monitoring.index'));
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
            $value = $this->monitoringRepository->findById($id);
             if($value->file!=null){
                @unlink(storage_path('/app/public/uploads/monitoring/' . $value->file));
            }
            $value->delete();
            session()->flash('success', 'Monitoring successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function deleteImage($id, $picName)
    {
        $monitoring = $this->monitoringRepository->findById($id);
        if ($monitoring != null) {
            if ($monitoring->file != null) {
                @unlink(storage_path('/app/public/uploads/monitoring/' . $monitoring->file));

                $monitoring->update(['file' => null]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }
}
