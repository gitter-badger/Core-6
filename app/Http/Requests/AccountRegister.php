<?php

namespace App\Http\Requests;

class AccountRegister extends Request {
    public function authorize() {
        return true;
    }
    public function rules() {
        return [
            'username' => 'required|max:20|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password'
        ];
    }
}