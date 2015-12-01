<?php

namespace PS\Transformers;

use League\Fractal\TransformerAbstract;
use PS\Entities\ProjectNote;


/**
 * Class ProjectNoteTransformer
 * @package namespace PS\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * @param ProjectNote $model
     * @return array
     */
    public function transform(ProjectNote $model)
    {
        return [
            'id' => (int)$model->id,
            'project_id' => $model->project_id,
            'title' => $model->title,
            'note' => $model->note,
        ];
    }



}