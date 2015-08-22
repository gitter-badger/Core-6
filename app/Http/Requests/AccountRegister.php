<?php

namespace App\Http\Requests;

class AccountRegister extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Check username is unique and less than 20 characters
            'username' => 'required|max:20|unique:users,username',
            //Check that the email hasn't been used before
            'email' => 'required|email|unique:users,email',
            //Ensure a password is entered and is a minimum of 8 characters
            'password' => 'required|confirmed|min:8|max:72',
            //Ensure that the password confirmation is the same as first password entered
            'password_confirmation' => 'required|same:password|min:8|max:72'
        ];
    }
}
