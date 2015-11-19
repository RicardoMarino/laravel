<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PS\Services;

/**
 * Description of ClientService
 *
 * @author Falgor
 */
use PS\Entities\ProjectMember;
use PS\Repositories\Contract\ProjectMemberRepository;
use PS\Repositories\Contract\ProjectRepository;
use PS\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectService {

    protected $repository;
    protected $validator;
    /**
     * @var ProjectMemberRepository
     */
    private $memberRepository;

    /**
     * @param ProjectRepository $repository
     * @param ProjectMemberRepository $memberRepository
     * @param ProjectValidator $validator
     */
    public function __construct(ProjectRepository $repository, ProjectMemberRepository $memberRepository,ProjectValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->memberRepository = $memberRepository;
    }

    public function create(array $data) {

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return [
                'error' => true,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public function update(array $data, $id) {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $ex) {
            return [
                'error' => true,
                'message' => $ex->getMessageBag()
            ];
        }
    }

    public  function addMember(array $data){
        return $this->memberRepository->create($data);
    }

    public  function removeMember($project_id,$member_id){
        return $this->memberRepository->findWhere(['project_id' => $project_id, 'member_id' => $member_id])->delete();
    }

    public  function isMember($project_id,$member_id){
         if(count($this->memberRepository->findWhere(['project_id' => $project_id, 'member_id' => $member_id])) > 0){
            return true;
         }
        return false;
    }
}
