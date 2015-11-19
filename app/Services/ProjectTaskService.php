<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 18/11/15
 * Time: 16:08
 */

namespace PS\Services;

use PS\Repositories\Contract\ProjectTaskRepository;
use PS\Validators\ProjectTaskValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ProjectTaskService
{
    protected $repository;
    protected $validator;

    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return array|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
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

    /**
     * @param array $data
     * @param $id
     * @return array|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
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
}