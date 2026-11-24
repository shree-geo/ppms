<?php

namespace App\Http\Controllers\Configurations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Configurations\PmoRequest;
use App\Models\Configurations\Pmo;
use App\Repository\Configurations\PmoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;

class PmoController extends BaseController
{

    /**
     * @var PmoRepository
     */
    private $pmoRepository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(PmoRepository $pmoRepository)
    {
        parent::__construct();
        $this->pmoRepository = $pmoRepository;
    }

    public function index()
    {
        $pmo = $this->pmoRepository->all();
        return view('backend.configurations.pmo.index', compact('pmo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.configurations.pmo.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PmoRequest $request)
    {
        try {
            $create = Pmo::create($request->all());
            if ($create) {
                session()->flash('success', 'Pmo successfully created!');
                return redirect(route('pmo.index'));
            } else {
                session()->flash('error', 'Pmo could not be created!');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
            session()->flash('error', 'Exception : ' . $e);
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
            $edits = $this->pmoRepository->findById($id);
            if ($edits->count() > 0) {
                return view('backend.configurations.pmo.edit', compact('edits'));
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
    public function update(PmoRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $pmo = $this->pmoRepository->findById($id);
            if ($pmo) {
                $pmo->fill($request->all())->save();
                session()->flash('success', 'Pmo updated successfully!');

                return redirect(route('pmo.index'));
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
            $value = $this->pmoRepository->findById($id);
            $value->delete();
            session()->flash('success', 'Pmo successfully deleted!');
            return back();
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            session()->flash('error', 'EXCEPTION' . $exception);
            return back();
        }
    }
}
