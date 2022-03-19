<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\Auth'], function()
{
	Route::post('/register', 'UserAuthController@register');
	Route::post('/login', 'UserAuthController@login');
});


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\School', 'middleware' => 'auth:api'], function()
{
	Route::get('/schools', 'SchoolController@index')->name('schools.index');
	Route::get('/school/{school}', 'SchoolController@show')->name('schools.show');
	Route::post('/schools', 'SchoolController@store')->name('schools.create');
	Route::put('/schools/{school}', 'SchoolController@update')->name('schools.update');
	Route::delete('/schools/{school}', 'SchoolController@destroy')->name('schools.delete');
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\Student', 'middleware' => 'auth:api'], function()
{
	Route::get('/students', 'StudentController@index')->name('students.index');
	Route::get('/student/{student}', 'StudentController@show')->name('students.show');
	Route::post('/students', 'StudentController@store')->name('students.create');
	Route::put('/students/{student}', 'StudentController@update')->name('students.update');
	Route::delete('/students/{student}', 'StudentController@destroy')->name('students.delete');
});
