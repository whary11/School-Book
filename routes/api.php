<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'role'], function () {
        Route::get('allRoles', 'RoleController@allRoles');
        Route::get('allPermissions', 'RoleController@allPermissions');
        Route::post('editRole', 'RoleController@editRole');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
    });
});
