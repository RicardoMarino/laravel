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

class ProjectNoteValidator extends LaravelValidator {

    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required',
    ];

    protected $messages = [
        'name.max' => 'Muito grande'
    ];
}
