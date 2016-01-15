<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PS\Repositories;

/**
 * Description of ClientRepositoryEloquent
 *
 * @author Falgor
 */
use Prettus\Repository\Eloquent\BaseRepository;
use PS\Entities\Client;
use PS\Presenters\ClientPresenter;
use PS\Repositories\Contract\ClientRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository{

    protected $fieldSearchable = array(
        'name',
    );

    public function model() {
        return Client::class;
    }

    /**
     * @return mixed
    */
    public function  presenter(){

        return ClientPresenter::class;
    }
}
