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

class ClientValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required|max:150',
        'resposible' => 'required',
        'email' => 'required|email'
    ];

    protected $messages = [
        'name.max' => 'Muito grande'
    ];
}
