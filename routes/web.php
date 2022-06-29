<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index']);
Route::get('verification', [MainController::class, 'verification']);
Route::post('verification', [MainController::class, 'verification_post'])->name('verification_post');
Route::get('career/wheel', [MainController::class, 'career_wheel']);
Route::post('career/wheel', [MainController::class, 'career_wheel_post'])->name('career_wheel_post');
Route::post('final/shot', [MainController::class, 'final_shot']);
Route::get('resend/code/{id}', [MainController::class, 'resend_code']);
Route::get('lead/download/{start}/{end}', [MainController::class, 'lead_download']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
