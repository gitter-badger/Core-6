<?php

namespace App\Http\Requests;

class AccountForgotPassword extends Request {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'email' => 'required|email'
        ];
    }
}