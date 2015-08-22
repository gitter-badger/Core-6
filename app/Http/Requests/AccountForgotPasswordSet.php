<?php

namespace App\Http\Requests;

class AccountForgotPasswordSet extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:8|max:72',
            'password_confirmation' => 'required|same:password|min:8|max:72'
        ];
    }
}
