<?php

use App\CourseCategory;
use App\CourseAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\CourseAllController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Course Category Api crud Routes
Route::get('course_category', [CourseCategoryController::class, 'index'])->name('index');
Route::post('course_category', [CourseCategoryController::class, 'store'])->name('store');
Route::get('course_category/{id}', [CourseCategoryController::class, 'show'])->name('show');
Route::post('course_category/edit/{id}', [CourseCategoryController::class, 'update'])->name('update');
Route::delete('course_category/delete/{id}', [CourseCategoryController::class, 'destroy'])->name('destroy');

//Course Api crud Routes
Route::get('course', [CourseAllController::class, 'index'])->name('index');
Route::post('course', [CourseAllController::class, 'store'])->name('store');
Route::get('course/{id}', [CourseAllController::class, 'show'])->name('show');
Route::post('course/edit/{id}', [CourseAllController::class, 'update'])->name('update');
Route::delete('course/delete/{id}', [CourseAllController::class, 'destroy'])->name('destroy');
