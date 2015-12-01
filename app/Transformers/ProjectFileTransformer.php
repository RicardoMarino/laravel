<?php

namespace PS\Transformers;

use League\Fractal\TransformerAbstract;
use PS\Entities\ProjectFile;

/**
 * Class ProjectFileTransformer
 * @package namespace PS\Transformers;
 */
class ProjectFileTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectFile entity
     * @param \ProjectFile $model
     *
     * @return array
     */
    public function transform(ProjectFile $model) {
        return [
            'id'          => $model->id,
            'name'        => $model->name,
            'description' => $model->description,
            'extension'   => $model->extension,
            'project_id'  => $model->project_id,
        ];
    }
}