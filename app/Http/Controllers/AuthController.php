<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public function getRegister() {
        return View::make('auth.register');
    }

    public function getLogin() {
        return View::make('auth.login');
    }

    public function postRegister() {
        try {
            $user = Sentry::CreateUser(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'activated' => true,
            ));
        } catch(Cartalyst\Sentry\Users\UserExistsException $e) {
            echo 'User already exsist.';
        }
    }

    public function postLogin() {
        $credentials = array('email' => Input::get('email'), 'password' => Input::get('password'));
        try {
            $user = Sentry::authenticate($credentials, false);
            if($user) {
                return Redirect::to('/');
            }
        } catch (\Exception $e) {
            return Redirect::to('login')->withErrors(array('login' => $e->getMessage()));
        }
    }

    public function logout() {
        Sentry::logout();
        Redirect::to('/');
    }
}
