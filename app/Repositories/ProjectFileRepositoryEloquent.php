<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Presenters\ProjectFilePresenter;
use PS\Repositories\Contract\ProjectFileRepository;
use PS\Entities\ProjectFile;

/**
 * Class ProjectFileRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class ProjectFileRepositoryEloquent extends BaseRepository implements ProjectFileRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectFile::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }

    public function  presenter(){

        return ProjectFilePresenter::class;
    }
}