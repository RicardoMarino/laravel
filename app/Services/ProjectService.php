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

use PS\Repositories\Contract\ProjectFileRepository;
use PS\Repositories\Contract\ProjectMemberRepository;
use PS\Repositories\Contract\ProjectRepository;
use PS\Validators\ProjectFileValidator;
use PS\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectService {

    protected $repository;
    protected $validator;
    /**
     * @var ProjectMemberRepository
     */
    private $memberRepository;

    /**
     * @param ProjectFileRepository $repositoryFile
     * @param ProjectRepository $repository
     * @param ProjectFileValidator $validatorFile
     * @param ProjectValidator $validator
     * @param Filesystem $file
     * @param Storage $storage
     * @internal param ProjectMemberRepository $memberRepository
     */
    public function __construct(ProjectFileRepository $repositoryFile, ProjectRepository $repository,ProjectFileValidator $validatorFile,ProjectValidator $validator, Filesystem $file, Storage $storage)
    {

        $this->repository = $repository;
        $this->repositoryFile = $repositoryFile;
        $this->validator = $validator;
        $this->validatorFile = $validator;
        $this->file = $file;
        $this->storage = $storage;
        $this->validatorFile = $validatorFile;
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

    private function checkProjectOwner($project_id){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($project_id,$userId);
    }
    private function checkProjectMember($project_id){
        $userId = \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($project_id,$userId);
    }

    public function checkProjectPermissions($project_id){
        if($this->checkProjectOwner($project_id) || $this->checkProjectMember($project_id)){
            return true;
        }
        return false;
    }
}
