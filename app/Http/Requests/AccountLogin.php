<?php

namespace App\Http\Requests;

class AccountLogin extends Request {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }
}