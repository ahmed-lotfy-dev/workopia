<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('pages.index');
});

Route::resource('jobs', JobController::class);
