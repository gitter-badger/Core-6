<?php

/*
 * Redirect to default Application Locale index
 */
Route::get('/', function () {
    return redirect(Lang::getFallback());
});

/*
 * Set Locale and load all routes inside
 */
Route::group(['prefix' => '/{locale}/'], function ($locale) {
    App::setLocale($locale);
    Route::get('/', function () {
        return view('welcome');
    });

    /*
     * Login
     */
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', function () {
            return view('auth.login');
        });
        Route::post('/', 'Auth\AuthController@Login');
    });
    Route::group(['prefix' => 'register'], function () {
        Route::get('/', function () {
            return view('auth.register');
        });
        Route::post('/', 'Auth\AuthController@Register');
    });
    Route::any('/logout', 'Auth\AuthController@logout');
    Route::get('/activate', 'Auth\AuthController@activate');
    Route::group(['prefix' => 'forgotpassword'], function () {
        Route::get('/', function () {
            return view('auth.forgotpassword');
        });
        Route::post('/', 'Auth\AuthController@InitForgotPassword');
        Route::get('/set', function () {
            return view('auth.resetpasswordset');
        });
        Route::post('/set', 'Auth\AuthController@SetForgotPassword');
    });
});
