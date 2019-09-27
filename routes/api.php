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
        //Permisos vs Roles
        Route::get('allRoles', 'PermissionController@allRoles');
        Route::get('allPermissions', 'PermissionController@allPermissions');
        Route::post('editRole', 'PermissionController@editRole');
        Route::post('createRole', 'PermissionController@createRole');

        //Permisos vs usuarios
        Route::get('allUsers', 'PermissionController@allUsers');
        Route::post('assign_permissions_to_user', 'PermissionController@assignPermissionsToUser');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('/getUser', 'UserController@getUser');
    });
});
