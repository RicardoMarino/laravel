<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Repositories\Contract\ProjectTaskRepository;
use PS\Entities\ProjectTask;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}