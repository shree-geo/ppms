<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Repository\Configurations\ObaTypesRepository;
use App\Http\Requests\Configurations\ObaTypesRequest;
use Illuminate\Http\Request;
use App\Models\ObaTypes;

class ObaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  private $obaTypesRepository;

    public function __construct(ObaTypesRepository $obaTypesRepository){

        $this->obaTypesRepository= $obaTypesRepository;

    }
    public function index(Request $request)
    {
        $obaTypes= $this->obaTypesRepository->all();
        return view('backend.configurations.obaTypes.index',compact('obaTypes'));
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
    public function store(ObaTypesRequest $request)
    {
       try{
            $create = ObaTypes::create($request->all());
            if($create){
                session()->flash('success','OBA Types successfully created!');
                return back();
            }else{
                session()->flash('error','OBA Types could not be created!');
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
            $edits = $this->obaTypesRepository->findById($id);
            if ($edits->count() > 0)
            {
                $obaTypes = $this->obaTypesRepository->all();
                return view('backend.configurations.obaTypes.index', compact('edits','obaTypes'));
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
    public function update(ObaTypesRequest $request, $id)
    {
       $id = (int)$id;
        try{
            $obaTypes =$this->obaTypesRepository->findById($id);
            if($obaTypes){
                $obaTypes->fill($request->all())->save();
                session()->flash('success','OBA Types updated successfully!');

                return redirect(route('obaTypes.index'));
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
            $value = $this->obaTypesRepository->findById($id);
            $value->delete();
            session()->flash('success','OBA Types successfully deleted!');
            return back();

        }catch (\Exception $e){
            session()->flash('error','EXCEPTION'.$e->getMessage());
            return back();

        }
    }
}
