<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 09/02/16
 * Time: 17:41
 */

namespace PS\Services;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use PS\Repositories\Contract\ProjectFileRepository;
use PS\Repositories\Contract\ProjectRepository;
use PS\Validators\ProjectFileValidator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class ProjectFileService
{
    /**
     * @var ProjectFileRepository
     */
    private $repository;
    /**
     * @var ProjectRepository
     */
    private $projectRepository;
    /**
     * @var ProjectService
     */
    private $service;
    /**
     * @var ProjectFileValidator
     */
    private $validator;
    /**
     * @var Filesystem
     */
    private $filesystem;
    /**
     * @var Storage
     */
    private $storage;


    /**
     * ProjectFileService constructor.
     * @param ProjectFileRepository $repository
     * @param ProjectRepository $projectRepository
     * @param ProjectService $service
     * @param ProjectFileValidator $validator
     * @param Filesystem $filesystem
     * @param Storage $storage
     */
    public function __construct(ProjectFileRepository $repository,ProjectRepository $projectRepository,
                                ProjectService $service,ProjectFileValidator $validator, Filesystem $filesystem, Storage $storage)
    {
        $this->repository = $repository;
        $this->projectRepository = $projectRepository;
        $this->service = $service;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }

    /**
     * @param array $data
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function create(array $data)
    {
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $file = $data['file'];
            $data['extension'] = $file->getClientOriginalExtension();
            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->getFileName(), $this->filesystem->get($data['file']));
            return  $projectFile;

        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function update(array $data,$id)
    {
        try{
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($data, $id);
        }catch (ValidatorException $e){
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }
    /**
     * @param $id
     */
    public function delete($id)
    {
        $projectFile =  $this->repository->SkipPresenter()->find($id);
        if($this->storage->exists($projectFile->id.'.'.$projectFile->extension)){
            $this->storage->delete($projectFile->getFileName());
            $this->repository->delete($projectFile->id);

        }else{
            $projectFile->delete();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getFileName($id)
    {
        $projectFile = $this->repository->SkipPresenter()->find($id);
        return $projectFile->getFileName();
    }

    /**
     * @param $id
     * @return string
     */
    public function getFilePath($id)
    {
        $projectFile = $this->repository->SkipPresenter()->find($id);
        return $this->getBaseUrl($projectFile);
    }

    /**
     * @param $projectFile
     * @return string
     */
    public function getBaseUrl($projectFile)
    {
        switch($this->storage->getDefaultDriver()){
            case 'local':
                return $this->storage->getDriver()->getAdapter()->getPathPrefix()
                       .'/'.$projectFile->getFileName();
        }
    }



    /**
     * @param $projectFileId
     * @return mixed
     */
    public function checkProjectOwner($projectFileId)
    {
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->SkipPresenter()->find($projectFileId)->project_id;
        return $this->projectRepository->isOwner($projectId,$userId);
    }

    /**
     * @param $projectFileId
     * @return mixed
     */
    private function checkProjectMember($projectFileId){
        $userId = \Authorizer::getResourceOwnerId();
        $projectId = $this->repository->SkipPresenter()->find($projectFileId)->project_id;
        return $this->repository->hasMember($projectId,$userId);
    }

    /**
     * @param $projectFileId
     * @return bool
     */
    public function checkProjectPermissions($projectFileId){
        if($this->checkProjectOwner($projectFileId) || $this->checkProjectMember($projectFileId)){
            return true;
        }
        return false;
    }
}