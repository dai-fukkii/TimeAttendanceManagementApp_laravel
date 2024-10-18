<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserLogsController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'],'/signup', [AuthController::class, 'signup']
)->name('signup');
//[AuthController::class ,'signup']

Route::match(['get', 'post'],'/login', [AuthController::class, 'login']
)->name('login');

Route::middleware(['auth'])->group(function () {
    Route::match(['get','post'], '/mytop', [UserLogsController::class, 'userinfos'])->name('mytop');
    Route::post('/mytop/store', [UserLogsController::class, 'attendanceRegister'])->name('mytop.store');
    Route::get('/mytop/logs', [UserLogsController::class, 'userlogs'])->name('mytop.logs');
    Route::match(['get','post'],'/administrator', [AdminController::class, 'adminInfo'])->name('administrator');
    Route::get('/administrator/status', [AdminController::class, 'adminStatus'])->name('administrator.status');
});

