<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ProfileController;

Route::post('/get_connection_id',[AuthController::class,'get_connection_id']);

Route::post('/register/submit', [AuthController::class , 'registerSubmit'])->name('register.submit');
Route::post('/login/submit', [AuthController::class , 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout.user');
Route::post('/createprofile', [ProfileController::class , 'createprofile'])->name('create.profile');
Route::post('/updateprofile', [ProfileController::class, 'updateprofile']);
Route::post('/updateimage', [ProfileController::class, 'uploadImage']);
Route::post('/KYCdetails', [ProfileController::class, 'KYCdetails']);
