<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PS\Validators;

/**
 * Description of ClientValidator
 *
 * @author Falgor
 */
use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'owner_id' => 'required',
        'client_id' => 'required',
        'name' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'duo_date' => 'required'
    ];

    protected $messages = [
        'name.max' => 'Muito grande'
    ];
}
