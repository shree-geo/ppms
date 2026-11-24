<?php

namespace App\Http\Controllers;

use App\Repository\VoRepository;
use App\Repository\ProjectRepository;
use App\Models\Vo;
use App\Http\Requests\VoRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;



use Illuminate\Http\Request;

class VoController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $voRepository;
    private $projectRepository;

    public function __construct(VoRepository $voRepository, ProjectRepository $projectRepository)
    {
        parent::__construct();
        $this->voRepository = $voRepository;
        $this->projectRepository = $projectRepository;
    }
    public function index(Request $request)
    {
        if ($request->project_id != null) {
            $vos = $this->voRepository->getByProjectId($request->project_id, 'search');
        } else {
            $vos = $this->voRepository->all();
        }
        $projects = $this->projectRepository->all();

        return view('project.vo.index', compact('vos', 'projects'));
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
            $data['contract_amount']=null;
            $data['estimated_amount']=null;
        }
        return view('project.vo.add',compact('projects','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoRequest $request)
    {
        try {
            $voDetails = $request->vo;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $voDetails['project_id'] = auth()->user()->project_id;
            }
             if ($request->hasFile('file')) {
                    $image = $request->file('file');
                    $newName =time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/vo');
                    if (!file_exists($directories)) {
                        Storage::makeDirectory('app/public/uploads/vo');
                    }

                    $image->move(storage_path() . '/app/public/uploads/vo/', $newName);

                $voDetails['file'] = $newName;
            }
            $create = Vo::create($voDetails);
            $projectDetails=$this->projectRepository->findById($voDetails['project_id']);
            $details['latest_revised_contract_amount']=$voDetails['revised_cost_estimated'];
            $details['latest_revised_cost_estimated']=$voDetails['revised_contract_amount'];
            $projectDetails->fill($details)->save();
            if ($create) {
                session()->flash('success', 'Vo Details successfully created!');
                return redirect(route('vo.index'));
            } else {
                session()->flash('error', 'Vo Details could not be created!');
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
            $edits['vo'] = $this->voRepository->findById($id);
            if ($edits['vo'] != null && $edits['vo']->count() > 0) {
                $projects = $this->projectRepository->all();
                
                $project=$this->projectRepository->findById($edits['vo']->project_id);
                $edits['vo']['contract_amount']=$project->contract_amount;
                $edits['vo']['estimated_amount']=$project->estimated_amount;
                return view('project.vo.edit', compact('edits', 'projects'));
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
    public function update(VoRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $voDetails = $request->vo;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $voDetails['project_id'] = auth()->user()->project_id;
            }
            $vos = $this->voRepository->findById($id);
            if ($vos) {
                   if ($request->hasFile('file')) {
                       if($vos->file!=null){
                           @unlink(storage_path('/app/public/uploads/vo/' . $vos->file));
                       }
                    $image = $request->file('file');
                        $newName = time() . rand_string(6) . '.' . $image->getClientOriginalExtension();
                        $directories = storage_path('/app/public/uploads/vo');

                        if (!file_exists($directories)) {
                            Storage::makeDirectory('app/public/uploads/vo');
                        }

                        $image->move(storage_path() . '/app/public/uploads/vo/', $newName);


                    $voDetails['file'] = $newName;
                }
                $vos->fill($voDetails)->save();
                $latestVo=$this->voRepository->getLatestData($voDetails['project_id']);
                $projectDetails=$this->projectRepository->findById($voDetails['project_id']);
                $details['latest_revised_contract_amount']=$latestVo->revised_cost_estimated;
                $details['latest_revised_cost_estimated']=$latestVo->revised_contract_amount;
                $projectDetails->fill($details)->save();
                session()->flash('success', 'Vo Details updated successfully!');

                return redirect(route('vo.index'));
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
        $id=(int)$id;
        try{
            $value = $this->voRepository->findById($id);
             if($value->file!=null){
                @unlink(storage_path('/app/public/uploads/vo/' . $value->file));
            }
            $value->delete();
            session()->flash('success','Vo Details successfully deleted!');
            return back();

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }

      public function deleteImage($id, $picName)
    {
        $vo = $this->voRepository->findById($id);
        if ($vo != null) {
            if ($vo->file != null) {
                  @unlink(storage_path('/app/public/uploads/vo/' . $vo->file));
                     
                $vo->update(['file' => null]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }
}
