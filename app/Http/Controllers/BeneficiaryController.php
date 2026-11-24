<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\BeneficiaryRepository;
use App\Repository\ProjectRepository;
use App\Models\Beneficiary;
use App\Http\Requests\BeneficiaryRequest;
use App\Models\BeneficiaryLogs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Maatwebsite\Excel\Facades\Excel;

class BeneficiaryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $beneficiaryRepository;
    private $projectRepository;

    public function __construct(BeneficiaryRepository $beneficiaryRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->beneficiaryRepository = $beneficiaryRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $beneficiaries = $this->beneficiaryRepository->getByProjectId($request->project_id, 'search');
        } else {
            $beneficiaries = $this->beneficiaryRepository->all();
        }
        $projects = $this->projectRepository->all();
          if($request->has('export')){
              $time= Carbon::now()->toDateTimeString();
               $filename='beneficary'.'-'.$time.'.xlsx';
                ob_end_clean(); 
                ob_start();

                return Excel::download(new ProjectExport($beneficiaries,'beneficary'),$filename);
          }else{

              return view('project.beneficiary.index', compact('beneficiaries', 'projects'));
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
        return view('project.beneficiary.add', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeneficiaryRequest $request)
    {
        try {
            $benDetails = $request->ben;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $benDetails['project_id'] = auth()->user()->project_id;
            }
            $benDetails['status']='submitted';
            $benDetails['status_date']=Carbon::now();
            $create = Beneficiary::create($benDetails)->id;
            $benlogs['user_id']=auth()->user()->id;
            $benlogs['status']=$benDetails['status'];
            $benlogs['status_date']=$benDetails['status_date'];
            if ($create) {
                $benlogs['beneficiary_id']=$create;
                BeneficiaryLogs::create($benlogs);
                session()->flash('success', 'Beneficiary successfully created!');
                return redirect(route('beneficiary.index'));
            } else {
                session()->flash('error', 'Beneficiary could not be created!');
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
            $edits['ben'] = $this->beneficiaryRepository->findById($id);
            if ($edits['ben'] != null && $edits['ben']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.beneficiary.edit', compact('edits', 'projects'));
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
    public function update(BeneficiaryRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $benDetails = $request->ben;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $benDetails['project_id'] = auth()->user()->project_id;
            }
            $beneficiary = $this->beneficiaryRepository->findById($id);
            if ($beneficiary) {
                $beneficiary->fill($benDetails)->save();
                session()->flash('success', 'Beneficiary updated successfully!');

                return redirect(route('beneficiary.index'));
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
            $value = $this->beneficiaryRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Beneficiary  successfully deleted!');
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
            $value = $this->beneficiaryRepository->findById($details['beneficiary_id']);
            $value->fill($details)->save();
            BeneficiaryLogs::create($details);
                return back();
           }
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
