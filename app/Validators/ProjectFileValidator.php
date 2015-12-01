<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 04:59
 */

namespace PS\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'file' => 'required|image',
        'name' => 'required',
        'project_id' => 'required',
        'description' => 'required',
    ];
}