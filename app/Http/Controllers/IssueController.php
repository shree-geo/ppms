<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Repository\IssueRepository;
use App\Repository\ProjectRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class IssueController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $issueRepository;
    private $projectRepository;

    public function __construct(IssueRepository $issueRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->issueRepository = $issueRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null || $request->from!=null|| $request->to!=null) {
            $issuesDetail= $this->issueRepository->searchData($request->all());
            $issues=$issuesDetail->groupBy('project_id');
        } else {
            $issues = $this->issueRepository->all();    
        }
        $projects = $this->projectRepository->all();
        if($request->has('export')){
            $time= Carbon::now()->toDateTimeString();
              $filename='issueDetails'.'-'.$time.'.xlsx';
               ob_end_clean();
               ob_start();
               return Excel::download(new ProjectExport($issues,'issues'), $filename);
        }else{

               return view('project.issue.index', compact('issues', 'projects'));
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
      
        return view('project.issue.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IssueRequest $request)
    {

        try {
            $issueDetails = $request->issue;  
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $issueDetails['project_id'] = auth()->user()->project_id;
            }
            if( $issueDetails['category']=='issue')
            {
                $issueDetails['participation']=null;
            }
            elseif($issueDetails['category']=='meeting')
            {
                $issueDetails['reason']=null;
                $issueDetails['responsibility']=null;
                $issueDetails['action']=null;
                $issueDetails['status']=null;

            }    

        if ($request->hasFile('files')) {

            $reportFile = $request->file('files');
            $files = array();

            foreach ($reportFile as $val) {

                $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                $directories = storage_path('/app/public/uploads/' . '/' . 'issues/',$issueDetails['category']);


                if (!file_exists($directories)) {
                    Storage::makeDirectory('/app/public/uploads/' . '/' . 'issues/', $issueDetails['category']);
                }

                $val->move(storage_path() . '/app/public/uploads/' . '/' . 'issues/'.$issueDetails['category'], $newName);

                array_push($files, $newName);
            }

            $issueDetails['files'] = json_encode($files);
        }
    
            $create = Issue::create($issueDetails);          
            if ($create) {
                session()->flash('success', 'Issue successfully created!');
                return redirect(route('issue.index'));
            } else {
                session()->flash('error', 'Issue could not be created!');
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
            $edits['issue'] = $this->issueRepository->findById($id);
            if ($edits['issue'] != null && $edits['issue']->count() > 0) {
                $projects = $this->projectRepository->all();       
                return view('project.issue.edit', compact('edits', 'projects'));
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
    public function update(IssueRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $issueDetails = $request->issue;
            
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $issueDetails['project_id'] = auth()->user()->project_id;
            }
            $issues = $this->issueRepository->findById($id);
            if ($issues) {
                if( $issueDetails['category']=='issue')                
            {
                $issueDetails['participation']=null;
            }
            elseif($issueDetails['category']=='meeting')
            {
                $issueDetails['reason']=null;
                $issueDetails['responsibility']=null;
                $issueDetails['action']=null;
                $issueDetails['status']=null;

            }   
            if ($request->hasFile('files')) {

                $reportFile = $request->file('files');
                if($issues->files!=null){
                    $files=json_decode($issues->files);
                }else{
                    $files = array();
                }
    
                foreach ($reportFile as $val) {
    
                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . 'issues/',$issueDetails['category']);
    
    
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . 'issues/', $issueDetails['category']);
                    }
    
                    $val->move(storage_path() . '/app/public/uploads/' . '/' . 'issues/'.$issueDetails['category'], $newName);
    
                    array_push($files, $newName);
                }
    
                $issueDetails['files'] = json_encode($files);
            }  
                $issues->fill($issueDetails)->save();
                
                session()->flash('success', 'Issue updated successfully!');

                return redirect(route('issue.index'));
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
            $value = $this->issueRepository->findById($id);
            if ($value->files != null) {

                $arrayFile = json_decode($value->files);
                for ($i = 0; $i < count($arrayFile); $i++) {

                    @unlink(storage_path('/app/public/uploads' . '/' . 'issues/'.$value['category']. '/' . $arrayFile[$i]));
                }
            }
            $value->delete();
            session()->flash('success', 'Issue successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
    
    public function deletefile($id,$fileName)
    {
        $issue = $this->issueRepository->findById($id);
        
        if ($issue != null) {
            if ($issue->files != null) {
                $arrayFile = json_decode($issue->files);

                for ($i = 0; $i < count($arrayFile); $i++) {
                    if ($arrayFile[$i] == $fileName) {
                        @unlink(storage_path('/app/public/uploads' . '/' . 'issues/'.$issue['category']. '/' .$fileName));

                        unset($arrayFile[$i]);
                    }
                }
                $files = json_encode(array_values($arrayFile));
                $issue->update(['files' => $files]);
                session()->flash('success', 'File has been deleted');
                return back();
            }
        }
    }
}
