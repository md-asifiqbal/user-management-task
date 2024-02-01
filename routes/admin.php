<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\UserController;



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {

    Route::resource('users', UserController::class);
});
