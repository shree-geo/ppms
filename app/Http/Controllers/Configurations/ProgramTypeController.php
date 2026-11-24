<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\BaseController;
use App\Repository\Configurations\ProgramTypeRepository;
use App\Http\Requests\Configurations\ProgramTypesRequest;
use Illuminate\Http\Request;
use App\Models\ProgramTypes;

class ProgramTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  private $programTypesRepository;

    public function __construct(ProgramTypeRepository $programTypesRepository){
        parent::__construct();
        $this->programTypesRepository= $programTypesRepository;

    }
    public function index(Request $request)
    {
        $programTypes= $this->programTypesRepository->all();
        return view('backend.configurations.programTypes.index',compact('programTypes'));
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
    public function store(ProgramTypesRequest $request)
    {
       try{
            $create = ProgramTypes::create($request->all());
            if($create){
                session()->flash('success','Program Types successfully created!');
                return back();
            }else{
                session()->flash('error','Program Types could not be created!');
                return back();
            }
        }catch (\Exception $e){
            session()->flash('error','Exception : '.$e->getMessage());
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
            $edits = $this->programTypesRepository->findById($id);
            if ($edits->count() > 0)
            {
                $programTypes = $this->programTypesRepository->all();
                return view('backend.configurations.programTypes.index', compact('edits','programTypes'));
            }
            else{
                session()->flash('error','Id could not be obtained!');
                return back();
            }

        }catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION :' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramTypesRequest $request, $id)
    {
       $id = (int)$id;
        try{
            $programTypes =$this->programTypesRepository->findById($id);
            if($programTypes){
                $programTypes->fill($request->all())->save();
                session()->flash('success','Program Types updated successfully!');

                return redirect(route('programTypes.index'));
            }else{

                session()->flash('error','No record with given id!');
                return back();
            }
        }catch (\Exception $e){
            session()->flash('error','EXCEPTION:'.$e->getMessage());
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
            $value = $this->programTypesRepository->findById($id);
            $value->delete();
            session()->flash('success','Program Types successfully deleted!');
            return back();

        }catch (\Exception $e){
            session()->flash('error','EXCEPTION'.$e->getMessage());
            return back();

        }
    }
}
