<?php

use Illuminate\Http\Request;

Route::resource('loads', 'API\LoadController');

Route::get('localidades/buscarlocalidad/{busqueda}', 'API\LocalidadesController@buscarlocalidad');

Route::resource('localidades', 'API\LocalidadesController')->only([
    'index', 'show'
]);


Route::post('search', 'SearchController@search');
Route::get('rangeweight', 'SearchController@rangeWeight');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});


Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
});
