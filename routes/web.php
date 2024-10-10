<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'],'/signup', function() {
    return view('signup');
})->name('signup');

Route::match(['get', 'post'],'/login', function() {
    return view('login');
})->name('login');
