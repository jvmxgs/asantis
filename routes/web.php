<?php

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
*/

//Route::resource('loads', 'API\LoadController');

/*
Route::get('/company/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*')->middleware('auth');
*/

Route::get('/{any?}', function (){
    return view('app');
})->where('any', '^(?!api\/)[\/\w\.-]*');
