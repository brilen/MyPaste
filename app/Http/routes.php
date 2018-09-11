<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
////    $pastes = DB::table('pastes')
////            ->latest()
////            ->where(['private', false], ['access_all', true])
////            ->get();
//    return view('welcome');//, compact('pastes')
//});
Route::get('/', 'PastesController@showLast');
Route::post('/', 'PastesController@insert');
Route::get('/{paste}', 'PastesController@show');

//Route::get('/{paste}', 'PastesController@show');
