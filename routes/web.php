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
})->middleware('checkPer');



Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'menu','as'=>'menu.','middleware' => 'auth'],function (){  //các route về menu

Route::get('setup/info', 'ConfigInfoController@index')->name('setup_info');
Route::get('setup/page', 'ConfigPageController@index')->name('setup_page');
Route::get('analytics/nhv', 'AnalyticsNhV@index')->name('analytic_nv');
Route::get('analytics/total', 'TotalAnalytics@index')->name('analytic_total');
});

//ConfigInfo
Route::post('store/info', 'ConfigInfoController@store')->name('store_info');
Route::post('edit/info', 'ConfigInfoController@edit')->name('edit_info');
Route::post('delete/info', 'ConfigInfoController@destroy')->name('delete_info');
//ConfigPage 
Route::post('store/page', 'ConfigPageController@store')->name('store_page');
Route::post('edit/page', 'ConfigPageController@edit')->name('edit_page');
Route::post('delete/page', 'ConfigPageController@destroy')->name('delete_page');
//setup thong ke tong
Route::get('setup/total','TotalAnalytics@setupTotal')->name('setup_total');
Route::post('setup/total/user','TotalAnalytics@setupUser')->name('setup_user');
Route::post('setup/total/page','TotalAnalytics@setupPage')->name('setup_page');
////Test
Route::post('/test','Test@upPhoto')->name('testPost');

