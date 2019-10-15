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
        Route::post('permissions/import', 'PermissionController@import'); ///api/permissions/import
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', 'AuthController@logout');
        Route::get('/getUser', 'UserController@getUser');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/getComplements', 'UserController@getComplements');
        Route::post('/saveUser', 'UserController@saveUser');
        Route::get('/getUsersAll/{rol}', 'UserController@getUsersAll');
        Route::post('/editUser', 'UserController@editUsers');
        Route::post('/importUsers', 'UserController@importUsers');
        Route::get('/changeState/{user_id}/{newState}/{rol}', 'UserController@changeState');
    });
    Route::group(['prefix' => 'enrollment'], function () {
        Route::get('/getOptions', 'MatriculaController@getOptions');
        Route::get('/getStudents/{year}/{degree}', 'MatriculaController@getStudents');
        Route::post('/assignStudentDegrees', 'MatriculaController@assignStudentDegrees');
    });
});
