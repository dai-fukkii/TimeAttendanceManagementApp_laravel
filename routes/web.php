<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserInfoLogs;
use App\Http\Controllers\UserLogsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'],'/signup', [AuthController::class, 'signup']
)->name('signup');
//[AuthController::class ,'signup']

Route::match(['get', 'post'],'/login', [AuthController::class, 'login']
)->name('login');

Route::match(['get','post'], '/mytop', 
// function(){    return view('mytop');}
[UserLogsController::class, 'userinfos']
)->name('mytop');

Route::get('/mytop/logs', [UserLogsController::class, 'userlogs'])->name('mytop.logs');
Route::get('/test', [UserLogsController::class, 'userlogs'])->name('test');