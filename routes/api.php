<?php

use Illuminate\Http\Request;

Route::resource('freights', 'API\FreightController');

Route::get('estados/{idestado}/municipios', 'API\EstadosController@municipios');
Route::resource('estados', 'API\EstadosController')->only([
    'index'
]);

Route::get('municipios/{idmunicipio}/localidades', 'API\MunicipiosController@localidades');

Route::get('localidades/buscarlocalidad/{busqueda}', 'API\LocalidadesController@buscarlocalidad');

Route::resource('localidades', 'API\LocalidadesController')->only([
    'index', 'show'
]);

Route::get('proposals/unattended', 'API\ProposalsController@unattended');
Route::post('proposals/response', 'API\ProposalsController@storeResponse');

Route::resource('proposals', 'API\ProposalsController')->only([
    'index', 'store', 'show'
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


Route::get('representatives', 'API\RepresentativesController@index')->middleware('isAdmin');
Route::post('representatives/register', 'API\RepresentativesController@register')->middleware('isAdmin');
Route::delete('representatives/{id}', 'API\RepresentativesController@destroy')->middleware('isAdmin');
Route::get('representatives/{id}', 'API\RepresentativesController@show')->middleware('isAdmin');
Route::put('representatives/{id}', 'API\RepresentativesController@update')->middleware('isAdmin');
Route::put('representatives/{id}/updatepassword', 'API\RepresentativesController@updatepassword')->middleware('isAdmin');


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::put('users/{id}', 'UserController@update')->middleware('isAdminOrSelf');
    Route::put('users/{id}/updatepassword', 'UserController@updatepassword')->middleware('isAdminOrSelf');
});
