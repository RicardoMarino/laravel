<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 27/11/15
 * Time: 10:57
 */

namespace PS\Transformers;

use League\Fractal\TransformerAbstract;
use PS\Entities\Project;

class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes =[
        'members',
        'client',
        'notes',
        'files',
        'tasks'
    ];
    /**
     * @param Project $project
     * @return array
     */
    public function transform(Project $project){
        return [
            'project_id' => $project->id,
            'name' => $project->name,
            'owner_id' => $project->owner_id,
            'client_id' => $project->client_id,
            'description' => $project->description,
            'progress'  => $project->progress,
            'due_date'  => $project->due_date
        ];
    }

    public function includeMembers(Project $project){

        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeClient(Project $project){

        return $this->item($project->client, new ClientTransformer());
    }

    public function includeNotes(Project $projct)
    {
        return $this->collection($projct->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $projct)
    {
        return $this->collection($projct->files, new ProjectFileTransformer());
    }

    public function includeTasks(Project $projct)
    {
        return $this->collection($projct->tasks, new ProjectTaskTransformer());
    }
}