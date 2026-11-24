<?php

namespace App\Http\Controllers;


use App\Exports\ProjectExport;
use App\Http\Requests\SafeGuardIndicatorRequest;
use App\Models\SafeguardIndicator;
use App\Repository\ProjectRepository;
use App\Repository\SafeGuardIndicatorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class SafeGuardIndicatorsController extends BaseController
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $safeguardindicatorRepository;
    private $projectRepository;

    public function __construct(SafeGuardIndicatorRepository $safeguardindicatorRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->safeguardindicatorRepository = $safeguardindicatorRepository;
        $this->projectRepository = $projectRepository;
    }

    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $safeguardindicators = $this->safeguardindicatorRepository->getByProjectId($request->project_id, 'search');
        } else {
            $safeguardindicators = $this->safeguardindicatorRepository->all();
        }
        $projects = $this->projectRepository->all();
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
            $filename='safeguardindicators'.'-'.$time.'.xlsx';
            ob_end_clean(); 
            ob_start();
            
            return Excel::download(new ProjectExport($safeguardindicators,'safeguardindicators'),$filename);
        }
        else{
        return view('project.safeguardindicators.index', compact('safeguardindicators', 'projects'));
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
        return view('project.safeguardindicators.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SafeGuardIndicatorRequest $request)
    {
        try {
            $safeguardindicatorDetails = $request->saf;
            
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $safeguardindicatorDetails['project_id'] = auth()->user()->project_id;
            }
            
        if ($request->hasFile('file')) {

            $reportFile = $request->file('file');
            $files = array();

            foreach ($reportFile as $val) {

                $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/' . '/' . '/safeguardindicator/file');


                if (!file_exists($directories)) {
                    Storage::makeDirectory('/app/public/uploads/' . '/' . '/safeguardindicator/file');
                }

                $val->move(storage_path() . '/app/public/uploads/' . '/' . '/safeguardindicator/file', $newName);

                array_push($files, $newName);
            }

            $safeguardindicatorDetails['file'] = json_encode($files);
        }
            $create = SafeguardIndicator::create($safeguardindicatorDetails);
            if ($create) {
                session()->flash('success', 'Safe Guard Indicator successfully created!');
                return redirect(route('safeguardindicators.index'));
            } else {
                session()->flash('error', 'Safe Guard Indicator could not be created!');
                return back();
            }
        }
        catch (\Exception $e) {
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
            $edits['saf'] = $this->safeguardindicatorRepository->findById($id);
            if ($edits['saf'] != null && $edits['saf']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.safeguardindicators.edit', compact('edits', 'projects'));
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
    public function update(SafeGuardIndicatorRequest $request, $id)
    {
        $id = (int)$id;       
        try {
            $safeguardindicatorDetails = $request->saf;

        if ($request->hasFile('file')) {

            $reportFile = $request->file('file');
            $files = array();

            foreach ($reportFile as $val) {

                $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/' . '/' . '/safeguardindicator/file');


                if (!file_exists($directories)) {
                    Storage::makeDirectory('/app/public/uploads/' . '/' . '/safeguardindicator/file');
                }

                $val->move(storage_path() . '/app/public/uploads/' . '/' . '/safeguardindicator/file', $newName);

                array_push($files, $newName);
            }

            $safeguardindicatorDetails['file'] = json_encode($files);
        }


            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $safeguardindicatorDetails['project_id'] = auth()->user()->project_id;
            }
            $safeguardindicator = $this->safeguardindicatorRepository->findById($id);
            if ($safeguardindicator) {
                $safeguardindicator->fill($safeguardindicatorDetails)->save();
                session()->flash('success', 'Safe Guard Indicator updated successfully!');

                return redirect(route('safeguardindicators.index'));
            } else {

                session()->flash('error', 'No record with given id!');
                return back();
            }
        }
        catch (\Exception $e) {
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
    public function destroy($id)
    {
        $id = (int)$id;
        try {
            $value = $this->safeguardindicatorRepository->findById($id);
          

            if ($value->file != null) {
                $arrayFile = json_decode($value->file);

                for ($i = 0; $i < count($arrayFile); $i++) {

                    @unlink(storage_path('/app/public/uploads/' . '/' . '/safeguardindicator/file/'. $arrayFile[$i]));
                }
            }

            $value->delete();

            session()->flash('success', 'Safe Guard Indicator successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }

    public function deletefile($id,$fileName)
    {
        $safeguardindicator = $this->safeguardindicatorRepository->findById($id);
        
        if ($safeguardindicator != null) {
            if ($safeguardindicator->file != null) {
                $arrayFile = json_decode($safeguardindicator->file);

                for ($i = 0; $i < count($arrayFile); $i++) {
                    if ($arrayFile[$i] == $fileName) {
                    
                        @unlink(storage_path('/app/public/uploads/' . '/' . '/safeguardindicator/file/'. $fileName));

                        unset($arrayFile[$i]);
                    }
                }
                $files = json_encode(array_values($arrayFile));
                $safeguardindicator->update(['file' => $files]);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }
}
