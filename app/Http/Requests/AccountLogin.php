<?php

namespace App\Http\Requests;

class AccountLogin extends Request
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
            //Ensure that the Email entered is a valid email address
            'email' => 'required|email',
            //Force Passwords to be between 8 and 72 Characters. (Password_Hash Max Encrypted Characters)
            'password' => 'required|min:8|max:72'
        ];
    }
}
