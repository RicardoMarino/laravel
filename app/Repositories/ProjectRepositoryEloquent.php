<?php

namespace PS\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use PS\Entities\Project;
use PS\Repositories\Contract\ProjectRepository;
use PS\Presenters\ProjectPresenter;
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
        $this->pushCriteria( app('Prettus\Repository\Criteria\RequestCriteria') );
    }

    public function isOwner($projectId, $userId){
        if(count($this->findWhere(['id' => $projectId,'owner_id' => $userId])) > 0){
            return true;
        }
        return false;
    }

    public function hasMember($project_id,$member_id){
        $project =  $this->find($project_id);
        foreach($project->members as $member){
            if($member->id == $member_id){
                return true;
            }
        }
        return false;
    }

    public function presenter(){
        return ProjectPresenter::class;
    }
}
