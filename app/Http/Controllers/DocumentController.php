<?php

namespace App\Http\Controllers;

use App\Repository\DocumentRepository;
use App\Repository\ProjectRepository;
use App\Models\Documents;
use App\Http\Requests\DocumentRequest;
use Illuminate\Http\Request;
use App\Repository\Configurations\DocumentCategoryRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;

class DocumentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $documentRepository;
    private $projectRepository;
    private $documentCategoryRepository;

    public function __construct(DocumentRepository $documentRepository, ProjectRepository $projectRepository, DocumentCategoryRepository $documentCategoryRepository)
    {
        parent::__construct();
        $this->documentRepository = $documentRepository;
        $this->projectRepository = $projectRepository;
        $this->documentCategoryRepository = $documentCategoryRepository;
    }
    public function index(Request $request)
    {
        if($request->project_id!=null || $request->category_id!=null){

            $documents = $this->documentRepository->searchData($request->all());
        }else{
            $documents = $this->documentRepository->all();

        }
        $projects = $this->projectRepository->all();
        $category = $this->documentCategoryRepository->all();
        return view('project.document.index', compact('documents', 'projects','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = $this->projectRepository->all();
        $categories = $this->documentCategoryRepository->all();
        return view('project.document.add', compact('projects', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {

        try {
            $docDetails = $request->doc;
            
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $docDetails['project_id'] = auth()->user()->project_id;
            }
            $docDetails['user_id'] = auth()->user()->id;
            if ($request->hasFile('images')) {

                $image = $request->file('images');
                $photos = array();

                foreach ($image as $val) {

                    $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                    $directories = storage_path('/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document');


                    if (!file_exists($directories)) {
                        Storage::makeDirectory('/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document');
                    }

                    $val->move(storage_path() . '/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document', $newName);

                    array_push($photos, $newName);
                }

                $docDetails['file'] = json_encode($photos);
            }
            $create = Documents::create($docDetails);

            if ($create) {
                session()->flash('success', 'Documents successfully created!');
                return redirect(route('document.index'));
            } else {
                session()->flash('error', 'Documents could not be created!');
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
            $edits['doc'] = $this->documentRepository->findById($id);
            if ($edits['doc'] != null && $edits['doc']->count() > 0) {
                $projects = $this->projectRepository->all();
                $categories = $this->documentCategoryRepository->all();
                return view('project.document.edit', compact('edits', 'projects', 'categories'));
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
    public function update(DocumentRequest $request, $id)
    {
        $id = (int)$id;
        try {
            $docDetails = $request->doc;
            $user_group = auth()->user()->user_group_id;
            if ($user_group == 2) {
                $docDetails['project_id'] = auth()->user()->project_id;
            }
            $docDetails['user_id'] = auth()->user()->id;
            $document = $this->documentRepository->findById($id);

            if ($document) {
              
                    $photos = json_decode($document->file);
                    $oldimage=[];
                   
               
                    if (isset($request->old)) {
                        foreach($request->old as $old)
                        {
                            array_push($oldimage,$photos[$old]);
                        }
                        foreach ($photos as $pic) {
                            foreach($oldimage as $old){
                                if($old!=$pic){
                                   
                                    // @unlink(storage_path('/app/public/uploads/' . '/' . $docDetails['cat_id'] .'/'. $docDetails['project_id'] . '/document'. $pic));
                                    @unlink(public_path('/storage/uploads/'. $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document' . '/' . $pic));  
                                }
                            }
                        }
                      
                    }else{
                        $oldimage=$photos;
                    }
                if($request->hasFile('photos')){
                    
                    $image = $request->file('photos');

                    foreach ($image as $val) {

                        $newName = time() . rand_string(6) . '.' . $val->getClientOriginalExtension();
                        $directories = storage_path('/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document');


                        if (!file_exists($directories)) {
                            Storage::makeDirectory('/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document');
                        }

                        $val->move(storage_path() . '/app/public/uploads/' . '/' . $docDetails['cat_id'] . '/' . $docDetails['project_id'] . '/document', $newName);

                        array_push($oldimage, $newName);
                    }

                    
                }
                $docDetails['file'] = json_encode($oldimage);
                
                $document->fill($docDetails)->save();
                session()->flash('success', 'Documents updated successfully!');

                return redirect(route('document.index'));
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
            $value = $this->documentRepository->findById($id);
            

            if ($value->file != null) {
                $arrayFile = json_decode($value->file);

                for ($i = 0; $i < count($arrayFile); $i++) {
              
                    @unlink(public_path('/storage/uploads/'. $value->cat_id . '/' . $value->project_id . '/document' . '/' . $arrayFile[$i]));                   
                }
            }

            $value->delete();
            session()->flash('success', 'Documents successfully deleted!');
            return back();
        } catch (\Exception $e) {
            session()->flash('error', 'EXCEPTION' . $e->getMessage());
            return back();
        }
    }


    public function deleteImage($id, $picName)
    {
        $documents = $this->documentRepository->findById($id);
        if ($documents != null) {
            if ($documents->file != null) {
                $arrayPhoto = json_decode($documents->file);

                for ($i = 0; $i < count($arrayPhoto); $i++) {
                    if ($arrayPhoto[$i] == $picName) {

                        @unlink(storage_path('/app/public/uploads/' . '/' . $documents->cat_id . '/' . $documents->project_id . '/document' . '/' . $picName));

                        unset($arrayPhoto[$i]);
                    }
                }
                $images = json_encode(array_values($arrayPhoto));
                $documents->update(['file' => $images]);
                session()->flash('success', 'Image has been deleted');
                return back();
            }
        }
    }
}
