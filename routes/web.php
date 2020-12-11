<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('home');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'menu','as'=>'menu.'],function (){  //các route về menu
Route::get('setup/info', 'ConfigInfoController@index')->name('setup_info');
Route::get('analytics/nv', 'AnalyticsNv@index')->name('analytic_nv');
});

//ConfigInfo
Route::post('setup/info', 'ConfigInfoController@store')->name('store_info');
Route::post('edit/info', 'ConfigInfoController@edit')->name('edit_info');
Route::post('delete/info', 'ConfigInfoController@destroy')->name('delete_info');
////Test
Route::post('/test','Test@upPhoto')->name('testPost');

