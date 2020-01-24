<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Jobs\FirstJob;

use App\User;

Route::get('/', function () {
    $user=User::find(1);
    $token=Str::random(60);
dispatch(new FirstJob($user,$token));
});
