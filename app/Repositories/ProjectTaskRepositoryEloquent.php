<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Presenters\ProjectTaskPresenter;
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
     * @return mixed
     */
    public function  presenter(){

        return ProjectTaskPresenter::class;
    }
}