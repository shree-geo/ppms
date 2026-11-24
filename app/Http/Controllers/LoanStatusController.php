<?php

namespace App\Http\Controllers;

use App\Repository\LoanStatusRepository;
use App\Repository\ProjectRepository;
use App\Models\LoanStatus;
use App\Http\Requests\LoanStatusRequest;
use App\Http\Controllers\BaseController;


use Illuminate\Http\Request;

class LoanStatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $loanStatusRepository;
    private $projectRepository;

    public function __construct(LoanStatusRepository $loanStatusRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->loanStatusRepository = $loanStatusRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $loanStatus = $this->loanStatusRepository->getByProjectId($request->project_id, 'search');
        } else {
            $loanStatus = $this->loanStatusRepository->all();
        }
        $projects = $this->projectRepository->all();

        return view('project.loanStatus.index', compact('loanStatus', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $loanStatus = $this->loanStatusRepository->all();
        $projects = $this->projectRepository->all();
        return view('project.loanStatus.add', compact('loanStatus','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanStatusRequest $request)
    {
        try {
            $loanDetails = $request->loan;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $loanDetails['project_id'] = auth()->user()->project_id;
            }
            $create = LoanStatus::create($loanDetails);
            if ($create) {
                session()->flash('success', 'Loan Status successfully created!');
                return redirect(route('loanStatus.index'));
            } else {
                session()->flash('error', 'Loan Status could not be created!');
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
            $edits['loan'] = $this->loanStatusRepository->findById($id);
            if ($edits['loan'] != null && $edits['loan']->count() > 0) {
                $projects = $this->projectRepository->all();
                return view('project.loanStatus.edit', compact('edits', 'projects'));
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
    public function update(LoanStatusRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $loanDetails = $request->loan;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $loanDetails['project_id'] = auth()->user()->project_id;
            }
            $loanStatus = $this->loanStatusRepository->findById($id);
            if ($loanStatus) {
                $loanStatus->fill($loanDetails)->save();
                session()->flash('success', 'Loan Status updated successfully!');

                return redirect(route('loanStatus.index'));
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
        //
    }
}
