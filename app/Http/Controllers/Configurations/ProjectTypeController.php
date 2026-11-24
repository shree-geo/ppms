<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\ProjectTypeRequest ;
use App\Models\ProjectType;
use App\Repository\Configurations\ProjecTypeRepository;
use Illuminate\Http\Request;

class ProjectTypeController extends BaseController
{
   
    
    private $projectyperepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProjecTypeRepository $projectyperepository)
    {
        parent::__construct();
        $this->projectyperepository = $projectyperepository;
    }
    public function index()
    {
        $projectTypes = $this->projectyperepository->all();
        return view('backend.configurations.projectType.index',compact('projectTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectTypeRequest $request)
    {
        try{
            $create = ProjectType::create($request->all());
            if($create){
                session()->flash('success','Project Type successfully created!');
                return back();
            }else{
                session()->flash('error','Project type could not be created!');
                return back();
            }
        }catch (\Exception $e){
            $e->getMessage();
            session()->flash('error','Exception : '.$e);
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
        
        try{
            $id = (int)$id;
            $edits = $this->projectyperepository->findById($id);
            if ($edits->count() > 0)
            {
                $projectTypes = $this->projectyperepository->all();
                return view('backend.configurations.projectType.index', compact('edits','projectTypes'));
            }
            else{
                session()->flash('error','Id could not be obtained!');
                return back();
            }

        }catch (\Exception $e) {
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
    public function update(Request $request, $id)
    {
        $id = (int)$id;
        try{
            $projectType =$this->projectyperepository->findById($id);
            if($projectType){
                $projectType->fill($request->all())->save();
                session()->flash('success','Office Type updated successfully!');

                return redirect(route('projecttype.index'));
            }else{

                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION:'.$exception);
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
            $value = $this->projectyperepository->findById($id);
        //    if ($value) {
        //         $valueId = $value->id;
        //         $result = ProjectType::where('id', $valueId)->get();

        //         if (count($result) > 0) {
        //             session()->flash('error', 'Project Type is in use. Unable to delete!');
        //             return back();
        //         }
        //     }
            $value->delete();
            session()->flash('success','Project Type successfully deleted!');
            return back();

        }catch (\Exception $e){
            $exception=$e->getMessage();
            session()->flash('error','EXCEPTION'.$exception);
            return back();

        }
    }
}
