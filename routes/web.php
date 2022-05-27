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
Route::get('accountabilities','AssetController@accountabilities');
Route::get('deployed-assets','AssetController@deployedAssets');
Route::get('transactions','AssetController@transactions');
Route::post('return-item','AssetController@returnItem');
Route::post('generate-data','AssetController@generateData');

//Request
Route::get('requests','RequestController@viewRequests');

//PDF
Route::get('accountabilityPDF/{id}','AssetController@viewAccountabilityPdf');
Route::get('returnItem/{id}','AssetController@returnItemPdf');
Route::post('upload-pdf','AssetController@uploadSignedContract');

//for Repair
Route::get('for-repair','AssetController@for_repair');

//Return
Route::get('returns','AssetController@return_items');
Route::post('generate-data-return','AssetController@generate_data_return');
Route::post('upload-pdf-return','AssetController@upload_pdf_return');

});

//outside
Route::get('request','RequestController@BorrowInformation');
Route::get('BorrowInformation/{id}','RequestController@BorrowInformation');
Route::get('getDataAccountability','AssetController@viewAccountabilitiesData');
Route::post('borrow-submit','RequestController@borrowSubmit');
Route::get('trackStatus','RequestController@trackStatus');