<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountForgotPassword;
use App\Http\Requests\AccountLogin;
use App\Http\Requests\AccountRegister;

class AuthController extends Controller {

    /**
     * Login User
     *
     * @param AccountLogin $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function Login(AccountLogin $request) {
        $credentials = array(
            'email' => \Input::get('email'),
            'password' => \Input::get('password')
        );
        try {
            if (\Input::get('remember_me') === true) {
            } else {
                $user = \Sentinel::authenticate($credentials, \Input::get('remember_me'));
                \Sentinel::getUserRepository()->recordLogin($user);
            }
            if (\Sentinel::check()) {
                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect('auth/login')->withErrors(array('login' => 'The login information provided was incorrect'));
        }
    }

    /**
     * Register an account
     *
     * @param AccountRegister $request
     *
     * @return $this
     */
    public function Register(AccountRegister $request) {
        try {
            $credentials = array(
                'username' => \Input::get('username'),
                'email' => \Input::get('email'),
                'password' => \Input::get('password')
            );
            \Sentinel::register($credentials);
            $activation_user = \Sentinel::getUserRepository()->findByCredentials($credentials);
            $activation = \Activation::create($activation_user);
            \Mail::queue('emails.account.activate_account',
                [
                    'username' => \Input::get('username'),
                    'user_id' => $activation['user_id'],
                    'activation_code' => $activation['code'],
                    'activation_url' => env('URL') . '/auth/activate?' . http_build_query(array('ActivationCode' => $activation['code'], 'UserId' => $activation['user_id'])),
                ], function ($message) {
                    $message->from('no-reply@modestmusic.ml', 'Modest Music | Account Services');
                    $message->to(\Input::get('email'));
                });
            return redirect('auth/login')->withErrors(array('login' => 'We have sent your activation email. Please check the Spam Folder.'));
        } catch (\Exception $e) {
            return redirect('auth/register')->withErrors(array('register' => $e->getMessage())/*array('register' => 'A user with that e-mail already exist!')*/);
        }
    }

    /**
     * Activate the new account
     * @return $this
     */
    public function activate() {
        $user_id = \Request::get('UserId');
        $activation_code = \Request::get('ActivationCode');
        try {
            $user = \Sentinel::getUserRepository()->findById($user_id);
            if (\Activation::complete($user, $activation_code)) {
                return redirect('auth/login')->withErrors(array('login' => 'Your account was activated successfully.'));
            } else {
                return redirect('auth/register')->withErrors(array('register' => 'Invalid Activation Code! Please Contact Us.'));
            }
        } catch (\Exception $e) {
            return redirect('auth/register')->withErrors(array('register' => 'Something went wrong with activating that account.'));
        }
    }

    /**
     * Log a user out
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout() {
        $user = \Sentinel::getUser();
        \Sentinel::getUserRepository()->recordLogout($user);
        \Sentinel::logout();
        return redirect('/');
    }

    /**
     * Begin the password reset process
     *
     * @param AccountForgotPassword $request
     *
     * @return $this
     */
    public function InitForgotPassword(AccountForgotPassword $request) {
        try {
            $credentials = [
                'email' => \Input::get('email')
            ];
            $user = \Sentinel::getUserRepository()->findByCredentials($credentials);
            \Reminder::create($user);
            $reminder = \Reminder::exists($user);
            \Mail::queue('emails.account.resetpassword', [
                'username' => \Input::get('email'),
                'user_id' => $user->getUserId(),
                'reset_code' => $reminder['code'],
                'reset_link' => env('URL') . '/auth/forgotpassword/set?' . http_build_query(array('ResetCode' => $reminder['code'], 'UserId' => $user->getUserId()))
            ], function ($message) {
                $message->from('no-reply@modestmusic.ml', 'Modest Music | Account Services');
                $message->to(\Input::get('email'));
            });
            return redirect('auth/login')->withErrors(array('login' => 'We have sent you your reset link. Please check your Spam Email.'));
        } catch (\Exception $e) {
            return redirect('auth/forgotpassword')->withErrors(array('password_reset' => 'User Not found in our database!'));
        }
    }

    /**
     * Set the new password
     * @return $this
     */
    public function SetForgotPassword() {
        try {
            $user = \Sentinel::getUserRepository()->findById(\Input::get('UserId'));
            if (\Reminder::complete($user, \Input::get('ResetCode'), \Input::get('password'))) {
                return redirect('auth/login')->withErrors(array('login' => 'Password reset successful. Please Login'));
            } else {
                return redirect('auth/forgotpassword')->withErrors(array('forgot_password' => 'Password reset failed'));
            }
        } catch (\Exception $e) {
            return redirect('auth/forgotpassword')->withErrors(array('forgot_password' => 'User not found in our database.'));
        }
    }
}