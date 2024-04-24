<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\CourseAllController;



//course category routes
Route::get('course_category', [CourseCategoryController::class, 'index'])->name('index');
Route::post('course_category', [CourseCategoryController::class, 'store'])->name('store');
Route::post('course_category/edit', [CourseCategoryController::class, 'update'])->name('update');
Route::delete('course_category/delete/{id}', [CourseCategoryController::class, 'destroy'])->name('destroy');


//course routes
Route::prefix('/course_all')->name('course_all.')->group(function(){
    Route::get('/course_all', [CourseAllController::class, 'index'])->name('index');
    Route::post('/course_all', [CourseAllController::class, 'store'])->name('store');
    Route::get('/course_all_list', [CourseAllController::class, 'course_listing'])->name('course_listing');
    Route::post('course/edit', [CourseAllController::class, 'update'])->name('update');
    Route::get('/course_all/delete/{id}', [CourseAllController::class, 'destroy'])->name('destroy');
    
});

//course and course category filter routes
Route::prefix('course_all_filter')->name('course_all_filter.')->group(function(){
    Route::get('/course_all_filter/{category?}', [CourseAllController::class, 'course_all_filter'])->name('course_all_filter');
    Route::get('/course_all_details/{id}', [CourseAllController::class, 'course_all_detail'])->name('course_all_detail');
    // Route::get('/course_all_enroll', [CourseAllController::class, 'course_all_enroll'])->name('course_all_enroll');
    Route::get('/course_all_login/{id}', [CourseAllController::class, 'course_all_login'])->name('course_all_login');
    Route::post('/course_all_login', [CourseAllController::class, 'course_enroll_store'])->name('course_enroll_store');
    Route::get('/course_all_enroll', [CourseAllController::class, 'course_all_enroll'])->name('course_all_enroll');
    Route::get('/course_all_enroll/delete/{id}', [CourseAllController::class, 'enroll_destroy'])->name('enroll_destroy');

    //routes for filtering high to low, low to high, latest
    Route::get('/course_filter/desc', [CourseAllController::class, 'sortByPriceDesc'])->name('latest.sort.desc');
    Route::get('/course_filter/asc', [CourseAllController::class, 'sortByPriceAsc'])->name('latest.sort.asc');
    Route::get('/course_filter/latest', [CourseAllController::class, 'sortByLatestDesc'])->name('latest.sort.latest');

});