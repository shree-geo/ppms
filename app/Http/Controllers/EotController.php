<?php

namespace App\Http\Controllers;

use App\Repository\EotRepository;
use App\Repository\ProjectRepository;
use App\Models\Eot;
use App\Http\Requests\EotRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use DB;



use Illuminate\Http\Request;

class EotController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $eotRepository;
    private $projectRepository;

    public function __construct(EotRepository $eotRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->eotRepository = $eotRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $eots = $this->eotRepository->getByProjectId($request->project_id, 'search');
        } else {
            $eots = $this->eotRepository->all();
        }
        $projects = $this->projectRepository->all();

        return view('project.eot.index', compact('eots', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = $this->projectRepository->all();
         $user_group= auth()->user()->user_group_id;
        if($user_group==2){
            $data=$this->projectRepository->findById(auth()->user()->project_id);
        }else{
            $data['contract_signing_date']=null;
            $data['completion_date_stage1']=null;
            $data['completion_date_stage2']=null;
            $data['revised_stage1']=null;
            $data['revised_stage2']=null;
        }
        return view('project.eot.add', compact('projects','data'));
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EotRequest $request)
    {
        try {
            DB::beginTransaction();
            $eotDetails = $request->eot;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $eotDetails['project_id'] = auth()->user()->project_id;
            }
                  if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/Eot');
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/Eot');
                    }

                    $image->move(storage_path() . '/app/public/uploads/Eot/', $newName);

                $eotDetails['file'] = $newName;
            }
            $create = Eot::create($eotDetails);
            $projectDetails=$this->projectRepository->findById($eotDetails['project_id']);
            $details['latest_eot']=$eotDetails['revised_stage1_completion_date'];
            $details['revised_stage2_date']=$eotDetails['revised_stage2_completion_date'];
            $projectDetails->fill($details)->save();

            DB::select("call progrssData(".$eotDetails['project_id'].")");

            if ($create) {
                DB::commit();
                session()->flash('success', 'Eot Details successfully created!');
                return redirect(route('eot.index'));
            } else {
                DB::rollback();
                session()->flash('error', 'Eot Details could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
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
            $edits['eot'] = $this->eotRepository->findById($id);
            if ($edits['eot'] != null && $edits['eot']->count() > 0) {
                $projects = $this->projectRepository->all();
                $project=$this->projectRepository->findById($edits['eot']->project_id);
                $edits['eot']['contract_start_date']=$project->contract_signing_date;
                $edits['eot']['original_stage1']=$project->completion_date_stage1;
                $edits['eot']['original_stage2']=$project->completion_date_stage2;
                $edits['eot']['revised_stage1']=$project->latest_eot;
                $edits['eot']['revised_stage2']=$project->revised_stage2_date;
                return view('project.eot.edit', compact('edits', 'projects'));
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
    public function update(EotRequest $request, $id)
    {
        $id = (int)$id;
        try {
            DB::beginTransaction();

            $eotDetails = $request->eot;
            // $date=new Carbon($eotDetails['contract_end_date']);
            // $eotDetails['revised_contract_date']= $date->addDays($eotDetails['approved_days']);
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $eotDetails['project_id'] = auth()->user()->project_id;
            }
            $eots = $this->eotRepository->findById($id);
            if ($eots) {
                  if ($request->hasFile('file')) {
                      if($eots->file!=null){
                      @unlink(storage_path('/app/public/uploads/eot/' . $eots->file));
                      }
                    $image = $request->file('file');
                        $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                        $directories = storage_path('/app/public/uploads/eot');

                        if (!file_exists($directories)) {
                            Storage::makeDirectory('app/public/uploads/eot');
                        }

                        $image->move(storage_path() . '/app/public/uploads/eot/', $newName);


                    $eotDetails['file'] = $newName;
                }
                $eots->fill($eotDetails)->save();
                // $latestEot=$this->eotRepository->getLatestData($eotDetails['project_id']);
                $projectDetails=$this->projectRepository->findById($eotDetails['project_id']);
           
                // $details['latest_eot']=$latestEot->revised_stage1_completion_date;
                // $details['revised_stage2_date']=$latestEot->revised_stage2_completion_date; 

                $details['latest_eot']=$eotDetails['revised_stage1_completion_date'];
                $details['revised_stage2_date']=$eotDetails['revised_stage2_completion_date'];

                $projectDetails->fill($details)->save();

                DB::select("call progrssData(".$eotDetails['project_id'].")");

                DB::commit();
                session()->flash('success', 'Eot Details updated successfully!');
                return redirect(route('eot.index'));
            } else {

                DB::rollback();
                session()->flash('error', 'No record with given id!');
                return back();
            }
        } catch (\Exception $e) {

            DB::rollback();
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
        $id=(int)$id;
        try{
            $value = $this->eotRepository->findById($id);
            if($value->file!=null){
              @unlink(storage_path('/app/public/uploads/eot/' . $value->file));
            }
            $value->delete();
            session()->flash('success','Eot Details successfully deleted!');
            return back();

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }

     public function deleteImage($id, $picName)
    {
        $eots = $this->eotRepository->findById($id);
        if ($eots != null) {
            if ($eots->file != null) {
@unlink(storage_path('/app/public/uploads/eot/' . $eots->file));
                     
                $eots->update(['file' => null]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }
}