<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 18/11/15
 * Time: 16:12
 */

namespace PS\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];

}