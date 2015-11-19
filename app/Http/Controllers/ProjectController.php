<?php

namespace PS\Http\Controllers;

use Illuminate\Http\Request;
use PS\Http\Controllers\Controller;
use PS\Repositories\Contract\ProjectRepository;
use PS\Services\ProjectService;

class ProjectController extends Controller {

    private $repository;
    private $service;

    public function __construct(ProjectRepository $repository, ProjectService $service) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        return $this->repository->findWhere(['owner_id' =>\Authorizer::getResourceOwnerId()])->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        if($this->checkProjectPermissions($id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        return $this->repository->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        if($this->checkProjectPermissions($id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        return $this->service->update($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        if($this->checkProjectPermissions($id) ==  false){
            return ['error' =>'Access Forbidden'];
        }
        $this->repository->delete($id);
    }

    private function checkProjectOwner($project_id){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($project_id,$userId);
    }
    private function checkProjectMember($project_id){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($project_id,$userId);
    }

    private function checkProjectPermissions($project_id){
        if($this->checkProjectOwner($project_id) || $this->checkProjectMember($project_id)){
            return true;
        }
        return false;
    }
}
