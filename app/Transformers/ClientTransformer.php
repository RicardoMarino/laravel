<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use PS\Entities\Client;

/**
 * Class ClientTransformer
 * @package namespace PS\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $model) {
        return [

            'id'            => $model->id,
            'name'          => $model->name,
            'responsable'   => $model->responsable,
            'email'         => $model->email,
            'phone'         => $model->phone,
            'address'       => $model->address,
            'obs'           => $model->obs,

        ];
    }

}