<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Repositories\Contract\OAuthClientRepository;
use PS\Entities\OAuthClient;

/**
 * Class OAuthClientRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class OAuthClientRepositoryEloquent extends BaseRepository implements OAuthClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OAuthClient::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(  app('Prettus\Repository\Criteria\RequestCriteria')  );
    }
}