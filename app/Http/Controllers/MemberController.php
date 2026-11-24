<?php

namespace App\Http\Controllers;

use App\Exports\ProjectExport;
use App\Repository\MemberRepository;
use App\Repository\ProjectRepository;
use App\Repository\Configurations\DataRepository;
use App\Models\Samitis;
use App\Http\Requests\SamitiRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     private $memberRepository;
     private $projectRepository;
     private $dataRepository;

     public function __construct(MemberRepository $memberRepository, ProjectRepository $projectRepository,DataRepository $dataRepository){

      parent::__construct();
      $this->memberRepository= $memberRepository;
      $this->projectRepository= $projectRepository;
      $this->dataRepository= $dataRepository;
     }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $members = $this->memberRepository->getByProjectId($request->project_id, 'search');
        } else {
            $members = $this->memberRepository->all();
        }
        $projects = $this->projectRepository->all();
        $positions = $this->dataRepository->samitiPosition();
        $casts = $this->dataRepository->casts();
        if($request->has('export')){
        $time= Carbon::now()->toDateTimeString();
        $filename='members'.'-'.$time.'.xlsx';
        ob_end_clean(); 
        ob_start();
        return Excel::download(new ProjectExport($members,'members'),$filename);
        }else{
            return view('member.index',compact('members','projects','casts','positions'));
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
        $positions = $this->dataRepository->samitiPosition();
        $casts = $this->dataRepository->casts();
        return view('member.add', compact( 'projects', 'casts', 'positions'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SamitiRequest $request)
    {
        try {
            $membersDetails = $request->members;
            // dd($membersDetails);
            $project_id= $request->project_id;
            $samiti_year= $request->samiti_year;
            $user_group = auth()->user()->user_group_id;
            
            foreach($membersDetails as $members){
                if ($user_group == 2) {
                    $members['project_id'] = auth()->user()->project_id;
                }else{
                    $members['project_id']  =$project_id;
                }
                if(!isset($members['excluded_group'])){
                    $members['excluded_group']='0';
                }

                 $members['samiti_year']=$samiti_year;
                 
                $create = Samitis::create($members);
            }
            if ($create) {
                session()->flash('success', 'Member successfully created!');
                return redirect(route('member.index'));
            } else {
                session()->flash('error', 'Member could not be created!');
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
            $edits = $this->memberRepository->findById($id);
            if ($edits!=null && $edits->count() > 0) {
                $projects = $this->projectRepository->all();
                $positions = $this->dataRepository->samitiPosition();
                $casts = $this->dataRepository->casts();
                $members = $this->memberRepository->all();

                return view('member.edit', compact('edits','members', 'projects', 'casts', 'positions'));

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
    public function update(SamitiRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $members = $this->memberRepository->findById($id);
            $membersDetails= $request->all();
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $membersDetails['project_id'] = auth()->user()->project_id;
            }
            if(!isset($membersDetails['excluded_group'])){
                $membersDetails['excluded_group']='0';
            }
            if ($members) {
                $members->fill($membersDetails)->save();
                session()->flash('success', 'Members updated successfully!');

                return redirect(route('member.index'));
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
            $value = $this->memberRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Member  successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }
}
