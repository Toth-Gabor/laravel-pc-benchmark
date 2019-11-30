<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('autocomplete', 'AutoCompleteController@liveSearch');

Route::get('/','ComputerController@index');
Route::get('/show','ComputerController@show');
Route::get('/hardware','HardwareController@index');

Route::get('/hardware/cpu','HardwareController@showCPUAndAvgScoreList');
Route::get('/hardware/cpu/chart','HardwareController@showScoreChart');

Route::get('/hardware/gpu','HardwareController@showGPUAndAvgScoreList');
Route::get('/hardware/gpu/chart','HardwareController@showScoreChart');

Route::get('/hardware/ram','HardwareController@showRAMAndAvgScoreList');
Route::get('/hardware/ram/chart','HardwareController@showScoreChart');

Route::get('/hardware/ssd','HardwareController@showSSDAndAvgScoreList');
Route::get('/hardware/ssd/chart','HardwareController@showScoreChart');

Route::get('/hardware/hdd','HardwareController@showHDDAndAvgScoreList');
Route::get('/hardware/hdd/chart','HardwareController@showScoreChart');
