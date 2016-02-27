<?php

namespace PS\Http\Controllers;

use Illuminate\Http\Request;


use PS\Http\Requests;
use PS\Repositories\Contract\ProjectFileRepository;
use PS\Services\ProjectFileService;

class ProjectFileController extends Controller
{
    /**
     * @var ProjectFileService
     */
    private $service;
    /**
     * @var ProjectFileRepository
     */
    private $repository;

    /**
     * ProjectFileController constructor.
     * @param ProjectFileService $service
     * @param ProjectFileRepository $repository
     */
    public function __construct(ProjectFileRepository $repository, ProjectFileService $service)
    {
        $this->service = $service;
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return Response
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request,$id)
    {
        $file = $request->file('file');
        $data['file'] = $file;
        $data['extension'] = $file->getClientOriginalExtension();
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['project_id'] =  $id;
        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $file_id
     * @return Response
     */
    public function show($id,$file_id)
    {
        if($this->service->checkProjectPermissions($file_id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        return $this->repository->find($file_id);
    }


    /**
     * Display the specified resource.
     *
     * @param $file_id
     * @return Response
     */
    public function showFile($file_id)
    {
        if($this->service->checkProjectPermissions($file_id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        $fiePath = $this->service->getFilePath($file_id);
        $fileContent = file_get_contents($fiePath);
        $fileBase64 = base64_encode($fileContent);

        return [
            'file' => $fileBase64,
            'name' => $this->service->getFileName($file_id),
            'size' => filesize($fiePath)
        ];
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @param $file_id
     * @return Response
     */
    public function update(Request $request, $id,$file_id)
    {
        if($this->service->checkProjectPermissions($file_id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        return $this->service->update($request->all(),$file_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $file_id
     * @return Response
     */
    public function destroy($id,$file_id)
    {
        if($this->service->checkProjectPermissions($file_id) ==  false){
            return ['error' =>'Access Forbidden'];
        }

        $this->service->delete($file_id);
    }
}
