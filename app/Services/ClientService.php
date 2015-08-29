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
use PS\Repositories\Contract\ClientRepository;
use PS\Validators\ClientValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ClientService {

    protected $repository;
    protected $validator;

    public function __construct(ClientRepository $repository, ClientValidator $validator) {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $data) {

        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $ex) {
            return response()->json([
                    'error' => true,
                    'mensage' => $ex->getMessageBag()
                    ], 412);
        }
    }

    public function update(array $data, $id) {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $ex) {
            return [
                'error' => true,
                'mensage' => $ex->getMessageBag()
            ];
        }
    }

    public function getRepository() {
        return $this->repository;
    }
}
