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
use PS\Repositories\Contract\ClientRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository{

    public function model() {
        return Client::class;
    }

}