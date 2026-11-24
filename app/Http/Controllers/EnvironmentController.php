<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\EnvironmentRepository;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use App\Models\Environment;
use App\Http\Requests\EnvironmentRequest;
use  App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;


class EnvironmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $environmentRepository;
     private $projectRepository;

     public function __construct(EnvironmentRepository $environmentRepository, ProjectRepository $projectRepository){

            parent::__construct();
           $this->environmentRepository= $environmentRepository;
           $this->projectRepository= $projectRepository;
     }


       public function index(Request $request)
      {
        if ($request->project_id != null) {
            $environments = $this->environmentRepository->getByProjectId($request->project_id, 'search');
        } else {
            $environments = $this->environmentRepository->all();
        }
        $user_group=auth()->user()->user_group_id;
        $projects = $this->projectRepository->all();
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
               $filename='environment'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();
                return Excel::download(new ProjectExport($environments,'environment'),$filename);
        }else{

            if($user_group==2){
                $project_id=auth()->user()->project_id;
                $edits = $this->environmentRepository->findByProjectId($project_id);
                if($edits!=null){
                    return view('project.environment.edit',compact('projects','edits'));
        
                }else{
                    return view('project.environment.add', compact('environments', 'projects'));

        
                }
            }else{
    
            return view('project.environment.index', compact('environments', 'projects'));
        }
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects=$this->projectRepository->all();
        $user_group=auth()->user()->user_group_id;
        // if($user_group==2){
        //     $project_id=auth()->user()->project_id;
        //     $edits = $this->environmentRepository->findById($project_id);
        //     if($edits!=null){
        //         return view('project.environment.edit',compact('projects','edits'));
    
        //     }else{
        //         return view('project.environment.add',compact('projects'));
    
        //     }
        // }else{
            return view('project.environment.add',compact('projects'));

        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnvironmentRequest $request)
    {
     try {
            $environmentDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $environmentDetails['project_id'] = auth()->user()->project_id;
            }
            if ($request->hasFile('gon_tor_approval_file')) {
                $image = $request->file('gon_tor_approval_file');
                $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/environment');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/environment');
                }

                $image->move(storage_path() . '/app/public/uploads/environment/', $newName);

            $environmentDetails['gon_tor_approval_file'] = $newName;
        }
            if ($request->hasFile('gon_iee_file')) {
                $image = $request->file('gon_iee_file');
                $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/environment');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/environment');
                }

                $image->move(storage_path() . '/app/public/uploads/environment/', $newName);

            $environmentDetails['gon_iee_file'] = $newName;
        }
            if ($request->hasFile('adb_approval_file')) {
                $image = $request->file('adb_approval_file');
                $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/environment');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/environment');
                }

                $image->move(storage_path() . '/app/public/uploads/environment/', $newName);

            $environmentDetails['adb_approval_file'] = $newName;
        }
            if ($request->hasFile('safe_mou_file')) {
                $image = $request->file('safe_mou_file');
                $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/environment');
                if (!file_exists($directories)) {
                    Storage::makeDirectory('app/public/uploads/environment');
                }

                $image->move(storage_path() . '/app/public/uploads/environment/', $newName);

            $environmentDetails['safe_mou_file'] = $newName;
        }
            $create = Environment::create($environmentDetails);
            if ($create) {
                session()->flash('success', 'Environment Details successfully created!');
                return redirect(route('environment_detail.index'));
            } else {
                session()->flash('error', 'Environment Details could not be created!');
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
            $edits = $this->environmentRepository->findById($id);
            if ($edits!= null  ) {
                $projects = $this->projectRepository->all();

                return view('project.environment.edit', compact('edits', 'projects'));
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
    public function update(EnvironmentRequest $request, $id)
    {
      $id = (int)$id;
        try {
            $environmentDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $environmentDetails['project_id'] = auth()->user()->project_id;
            }
            $environment = $this->environmentRepository->findById($id);
            // dd($environment);
            if ($environment) {
                if ($request->hasFile('gon_tor_approval_file')) {
                    @unlink(storage_path('/app/public/uploads/environment/' . $environment->gon_tor_approval_file));
                    $image = $request->file('gon_tor_approval_file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/environment');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/environment');
                    }

                    $image->move(storage_path() . '/app/public/uploads/environment/', $newName);


                    $environmentDetails['gon_tor_approval_file'] = $newName;
                }
                if ($request->hasFile('gon_iee_file')) {
                    @unlink(storage_path('/app/public/uploads/environment/' . $environment->gon_iee_file));
                    $image = $request->file('gon_iee_file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/environment');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/environment');
                    }

                    $image->move(storage_path() . '/app/public/uploads/environment/', $newName);


                    $environmentDetails['gon_iee_file'] = $newName;
                }
                if ($request->hasFile('adb_approval_file')) {
                    @unlink(storage_path('/app/public/uploads/environment/' . $environment->adb_approval_file));
                    $image = $request->file('adb_approval_file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/environment');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/environment');
                    }

                    $image->move(storage_path() . '/app/public/uploads/environment/', $newName);


                    $environmentDetails['adb_approval_file'] = $newName;
                }
                if ($request->hasFile('safe_mou_file')) {
                    @unlink(storage_path('/app/public/uploads/environment/' . $environment->safe_mou_file));
                    $image = $request->file('safe_mou_file');
                    $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/environment');

                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/environment');
                    }

                    $image->move(storage_path() . '/app/public/uploads/environment/', $newName);


                    $environmentDetails['safe_mou_file'] = $newName;
                }
                // dd($environmentDetails);
                $environment->fill($environmentDetails)->save();
                session()->flash('success', 'Environment Details updated successfully!');

                return redirect(route('environment_detail.index'));
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
            $value = $this->environmentRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Environment Details successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
    public function deleteImage($id, $col_name,$picName)
    {
        $environment = Environment::where($col_name,$picName)->first();
        if ($environment != null) {
                  @unlink(storage_path('/app/public/uploads/environment/' . $picName));
                     
                $environment->update([$col_name=> null]);
                session()->flash('success', 'File has been deleted');
                return back();
        }
    }
}
