<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Entities\ProjectNote;
use PS\Repositories\Contract\ProjectNoteRepository;
/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app(RequestCriteria::class) );
    }
}