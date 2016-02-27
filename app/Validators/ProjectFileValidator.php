<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 04:59
 */

namespace PS\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = array(
        ValidatorInterface::RULE_CREATE => array(
            'file' => 'required',
            'name' => 'required',
            'project_id' => 'required',
            'description' => 'required',
        ),
        ValidatorInterface::RULE_UPDATE => array(
            'project_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        )
    );
}