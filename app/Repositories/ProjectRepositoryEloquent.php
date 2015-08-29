<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Entities\Project;
use PS\Repositories\Contract\ProjectRepository;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace PS\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function isOwner($projectId, $userId){
        if($this->findWhere(['project_id' => $projectId,'owner_id' => $userId])){
            return true;
        }
        return false;
    }
}
