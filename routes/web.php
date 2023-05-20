<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
Route::match(['get', 'put'], '/student/{id}', 'StudentController@update')->name('student.update');
