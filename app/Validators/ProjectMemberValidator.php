<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 04:59
 */

namespace PS\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required',
        'user_id' => 'required'
    ];
}