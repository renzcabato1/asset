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
Auth::routes();
Route::group( ['middleware' => 'auth'], function()
{
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');



//Category
Route::get('category','CategoryController@categories');
Route::post('new-category','CategoryController@newCategory');
Route::post('deactivate-category','CategoryController@deactivateCategory');
Route::post('activate-category','CategoryController@activateCategory');



//Employees API
Route::get('employees','EmployeeController@employees');


//Assets
Route::get('assets-inventory','AssetController@assets');
Route::post('new-inventory','AssetController@newAssets');
Route::get('available-assets','AssetController@availableAssets');
Route::post('assign-asset','AssetController@assignAssets');


//Request
Route::get('requests','RequestController@viewRequests');


//PDF
Route::get('accountabilityPDF','AssetController@viewAccountabilityPdf');
});