<?php

namespace App\Http\Controllers;


use App\Exports\ProjectExport;
use App\Http\Requests\SafeguardRequest;
use App\Models\Safeguard;
use App\Repository\SafeguardRepository;
use App\Repository\ProjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class SafeguardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     private $projectRepository;
     private $safeguardRepository;

     public function __construct(ProjectRepository $projectRepository, SafeguardRepository $safeguardRepository){
         parent::__construct();
         $this->projectRepository= $projectRepository;
         $this->safeguardRepository= $safeguardRepository;

     }
    public function index(Request $request)
    {
        $projects= $this->projectRepository->all();
        if($request->project_id!=null){
           $safeguards= $this->safeguardRepository->getByProjectId($request->project_id,'search');
        }else{
            $safeguards= $this->safeguardRepository->all();
        }
        if($request->has('export')){
             $time= Carbon::now()->toDateTimeString();
             $filename='safeguards'.'-'.$time.'.xlsx';
            ob_end_clean(); 
            ob_start();
            return Excel::download(new ProjectExport($safeguards,'safeguards'),$filename);
        }else{
            return view('project.safeguard.index',compact('projects','safeguards'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects= $this->projectRepository->all();
        return view('project.safeguard.add',compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SafeguardRequest $request)
    {
        try {
            $safeguardDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $safeguardDetails['project_id'] = auth()->user()->project_id;
            }
            $create = Safeguard::create($safeguardDetails);
            if ($create) {
                session()->flash('success', 'Safeguard successfully created!');
                return redirect(route('safeguard_detail.index'));
            } else {
                session()->flash('error', 'Safeguard could not be created!');
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
            $edits = $this->safeguardRepository->findById($id);
            if ($edits!= null ) {
                $projects = $this->projectRepository->all();

                return view('project.safeguard.edit', compact('edits', 'projects'));
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
    public function update(SafeguardRequest $request, $id)
    {
       $id = (int)$id;
        try {
            $safeguardDetails = $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $safeguardDetails['project_id'] = auth()->user()->project_id;
            }
            $safeguard = $this->safeguardRepository->findById($id);
            if ($safeguard) {
                $safeguard->fill($safeguardDetails)->save();
                session()->flash('success', 'Safeguard updated successfully!');

                return redirect(route('safeguard_detail.index'));
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
            $value = $this->safeguardRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Safeguard successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}

