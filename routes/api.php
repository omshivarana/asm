<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\CourseCategoryController;
use App\Http\Controllers\Api\CourseAllController;

include('omshiva.php');

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('get_service_Api','Api\ApiController@get_service_Api');
Route::post('get_works_Api','Api\ApiController@get_works_Api');
Route::post('get_team_Api','Api\ApiController@get_team_Api');
Route::post('get_solutions_Api','Api\ApiController@get_solutions_Api');
Route::post('get_solcategory_Api','Api\ApiController@get_solcategory_Api');
Route::post('get_testimonials_Api','Api\ApiController@get_testimonials_Api');
Route::post('get_products_Api','Api\ApiController@get_products_Api');
Route::post('get_productdetails_Api','Api\ApiController@get_productdetails_Api');
Route::post('get_faqs_Api','Api\ApiController@get_faqs_Api');
Route::post('get_products_categories_Api','Api\ApiController@get_products_categories_Api');
Route::post('get_blogs_Api','Api\ApiController@get_blogs_Api');
Route::post('get_blogs_categories_Api','Api\ApiController@get_blogs_categories_Api');
Route::post('get_case_study_Api','Api\ApiController@get_case_study_Api');
Route::post('get_case_study_categories_Api','Api\ApiController@get_case_study_categories_Api');
Route::post('get_platforms_Api','Api\ApiController@get_platforms_Api');
Route::post('get_platforms_categories_Api','Api\ApiController@get_platforms_categories_Api');
Route::post('newsletter_Api','Api\ApiController@newsletter_Api');
// ---------------------- simpel-ai -----------------------
// Route::post('get_products_Api_1','Api\ApiController@get_products_Api_1');
// Route::post('get_productdetails_Api_1','Api\ApiController@get_productdetails_Api_1');


// Route::post('/get_api','Api\NewController@get_api');
Route::post('collect_leads', 'Api\ApiController@leads')->name('leads');

Route::get('/login_email/{ip}',function($ip){
    $admin= DB::table('admins')->where('ip_address',$ip)->first();
    if($admin)
        return response()->json(['status'=>'success','data'=>$admin->email]);
    else
        return response()->json(['status'=>'error','data'=>null]);
});


