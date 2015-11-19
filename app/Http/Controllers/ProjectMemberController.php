<?php

namespace PS\Http\Controllers;

use Illuminate\Http\Request;

use PS\Http\Requests;
use PS\Http\Controllers\Controller;
use PS\Repositories\Contract\ProjectMemberRepository;
use PS\Services\ProjectService;

class ProjectMemberController extends Controller
{
    /**
     * @var ProjectMemberRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * ProjectMemberController constructor.
     * @param ProjectMemberRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectMemberRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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
    public function store(Request $request)
    {
        return $this->service->addMember($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param $memberId
     * @return Response
     */
    public function show($id,$memberId
    )
    {
        return $this->repository->findWhere(['project_id' => $id,'member_id' => $memberId]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @param $member_id
     * @return Response
     */
    public function update(Request $request, $id,$member_id)
    {
        return $this->repository->update($request->all(),$member_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param $memberId
     * @return Response
     */
    public function destroy($id,$memberId)
    {
        return $this->service->removeMember($id,$memberId);
    }
}
