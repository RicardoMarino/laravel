<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 27/11/15
 * Time: 10:57
 */

namespace PS\Transformers;

use League\Fractal\TransformerAbstract;
use PS\Entities\User;

class ProjectMemberTransformer extends TransformerAbstract
{
    /**
     * @param User $member
     * @return array
     * @internal param Project $project
     */
    public function transform(User $member){
        return [
            'member_id' =>$member->id,
            'name' => $member->name
        ];
    }
}