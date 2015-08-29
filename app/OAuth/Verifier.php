<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace PS\OAuth;
/**
 * Description of Verifier
 *
 * @author Falgor
 */
use Illuminate\Support\Facades\Auth;

class Verifier {

    public function verify($username, $password) {
        $credentials = [
            'email' => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}
