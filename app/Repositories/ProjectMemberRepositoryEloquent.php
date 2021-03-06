<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Presenters\ProjectMemberPresenter;
use PS\Repositories\Contract\ProjectMemberRepository;
use PS\Entities\ProjectMember;

/**
 * Class ProjectMemberRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectMember::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(  app('Prettus\Repository\Criteria\RequestCriteria') );
    }

    /**
     * @return mixed
     */
    public function  presenter(){

        return ProjectMemberPresenter::class;
    }
}