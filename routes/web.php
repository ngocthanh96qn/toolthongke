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

Route::get('/home', 'HomeController@index')->middleware('checkPer')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'menu','as'=>'menu.','middleware' => 'auth'],function (){  //các route về menu

Route::get('setup/info', 'ConfigInfoController@index')->name('setup_info');
Route::get('setup/page', 'ConfigPageController@index')->name('setup_page');
Route::get('analytics/nhv/{id?}', 'AnalyticsNhV@index')->name('analytic_nv');
Route::get('analytics/total', 'TotalAnalytics@index')->middleware('checkPer')->name('analytic_total');
Route::get('statics/teamab', 'TeamAb@index')->name('teamAb');
Route::get('listview/nv', 'TotalAnalytics@ListView')->name('listviewNv');
Route::get('check/post', 'TotalAnalytics@CheckPost')->name('CheckPost');
});

//ConfigInfo
Route::post('store/info', 'ConfigInfoController@store')->name('store_info');
Route::post('edit/info', 'ConfigInfoController@edit')->name('edit_info');
Route::post('delete/info', 'ConfigInfoController@destroy')->name('delete_info');
Route::post('edit/pass', 'ConfigInfoController@editPass')->name('edit_pass');
//ConfigPage 
Route::post('store/page', 'ConfigPageController@store')->name('store_page');
Route::post('edit/page', 'ConfigPageController@edit')->name('edit_page');
Route::post('delete/page', 'ConfigPageController@destroy')->name('delete_page');
//setup thong ke tong
Route::get('setup/total','TotalAnalytics@setupTotal')->name('setup_total');
Route::post('setup/total/user','TotalAnalytics@setupUser')->name('setup_user');
Route::post('setup/total/page','TotalAnalytics@setupPage')->name('setup_page');
Route::post('analytics/total','TotalAnalytics@setDay')->name('setDay');
Route::post('analyticsnv/total','AnalyticsNhV@setDay')->name('setDayNv');
///
Route::post('teamab/save','TeamAb@store')->name('add_page');
Route::post('teamab/delete','TeamAb@destroy')->name('delete_pageAB');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
})->name('clear_cache');

Route::get('/schedule', function() {
    // Artisan::call('minute:update'); 
    // Artisan::call('name:getDataPost'); 
    
});
//Test
Route::get('/test','AnalyticsNhV@runSchedule')->name('testPost');
Route::get('/UpdateData','CronJob@runScheduleTotal'); //câp nhât dư liêu bai viet cho page

