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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login','AuthController@login')->name('login');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/logout','AuthController@logout');


Route::group(['middleware' => ['auth','checkRole:2']], function() {

Route::get('/dashboard','DashboardController@index');

Route::get('/company','CompanyController@index');
Route::post('/company/create','CompanyController@create');
Route::get('/company/{idc}/edit','CompanyController@edit');
Route::post('/company/{idc}/update','CompanyController@update');
Route::get('/company/{idc}/delete','CompanyController@delete');

Route::get('/paket','PaketController@index');
Route::post('/paket/create','PaketController@create');
Route::get('/paket/{id}/edit','PaketController@edit');
Route::post('/paket/{id}/update','PaketController@update');
Route::get('/paket/{id}/delete','PaketController@delete');

Route::get('/projects','ProjectsController@index');
Route::post('/projects/create','ProjectsController@create');
Route::get('/projects/{id}/edit','ProjectsController@edit');
Route::post('/projects/{id}/update','ProjectsController@update');
Route::get('/projects/{id}/delete','ProjectsController@delete');
Route::get('/pr/{id}/p_relation','ProjectsController@p_relation')->name('pr');
Route::post('/pr/post','ProjectsController@p_relation_post');
Route::get('/pr/{id}/delete_pr','ProjectsController@delete_pr');

Route::get('/requestheader','RequestheaderController@index');
Route::get('/requestheader/creates','RequestheaderController@creates');
Route::post('/requestheader/create','RequestheaderController@create');
Route::get('/requestheader/{id}/edit','RequestheaderController@edit');
Route::get('/requestheader/{id}/requestlines','RequestheaderController@requestlines')->name('rl');
Route::post('requestlines/post','RequestheaderController@requestlines_post');
Route::get('/requestlines/{idl}/delete','RequestlinesController@delete');

Route::post('/requestheader/{id}/update','RequestheaderController@update');
Route::get('/requestheader/{id}/delete','RequestheaderController@delete');
Route::get('/requestheader/{id}/cancel','RequestheaderController@cancel');

Route::get('/transaksi','TransaksiController@index');
Route::post('/transaksi/create','TransaksiController@create');
Route::get('/transaksi/{id}/edit','TransaksiController@edit');
Route::post('/transaksi/{id}/update','TransaksiController@update');
Route::get('/transaksi/{id}/delete','TransaksiController@delete');

Route::get('/typesupport','TypesupportController@index');
Route::post('/typesupport/create','TypesupportController@create');
Route::get('/typesupport/{id}/edit','TypesupportController@edit');
Route::post('/typesupport/{id}/update','TypesupportController@update');
Route::get('/typesupport/{id}/delete','TypesupportController@delete');


Route::get('/jabatan','JabatanController@index');
Route::post('/jabatan/create','JabatanController@create');
Route::get('/jabatan/{id}/edit','JabatanController@edit');
Route::post('/jabatan/{id}/update','JabatanController@update');
Route::get('/jabatan/{id}/delete','JabatanController@delete');

Route::get('/users','UsersController@index');
Route::post('/users/create','UsersController@create');
Route::get('/users/{id}/edit','UsersController@edit');
Route::post('/users/{id}/update','UsersController@update');
Route::get('/users/{id}/delete','UsersController@delete');

});

Route::group(['middleware' => ['auth','checkRole:3,2']], function() {
Route::get('/company','CompanyController@index');
Route::post('/company/create','CompanyController@create');
Route::get('/company/{id}/edit','CompanyController@edit');
Route::post('/company/{id}/update','CompanyController@update');
Route::get('/company/{id}/delete','CompanyController@delete');

Route::get('/users','UsersController@index');
Route::post('/users/create','UsersController@create');
Route::get('/users/{id}/edit','UsersController@edit');
Route::post('/users/{id}/update','UsersController@update');
Route::get('/users/{id}/delete','UsersController@delete');
});
Route::group(['middleware' => ['auth','checkRole:4,2']], function() {

Route::get('/dashboard','DashboardController@index');
	
Route::get('/requestheader','RequestheaderController@index');
Route::get('/requestheader/creates','RequestheaderController@creates');
Route::post('/requestheader/create','RequestheaderController@create');
Route::get('/requestheader/{id}/edit','RequestheaderController@edit');
Route::post('/requestheader/{id}/update','RequestheaderController@update');
Route::get('/requestheader/{id}/delete','RequestheaderController@delete');
Route::get('/requestheader/{id}/cancel','RequestheaderController@cancel');
Route::get('/transaksi','TransaksiController@index');
Route::get('/transaksi/creates','TransaksiController@creates');
Route::post('/transaksi/create','TransaksiController@create');
Route::get('/transaksi/{id}/edit','TransaksiController@edit');
Route::post('/transaksi/{id}/update','TransaksiController@update');

Route::get('/requestheader/{id}/requestlines','RequestheaderController@requestlines');
Route::post('/requestheader/{id}/requestlines/post','RequestheaderController@requestlines_post');
Route::get('/requestlines/{idl}/delete','RequestlinesController@delete');
});
Route::group(['middleware' => ['auth']], function() {
Route::get('/requestheader','RequestheaderController@index');
Route::get('/requestheader/creates','RequestheaderController@creates');
Route::post('/requestheader/create','RequestheaderController@create');
Route::get('/requestheader/{id}/edit','RequestheaderController@edit');
Route::post('/requestheader/{id}/update','RequestheaderController@update');
Route::get('/requestheader/{id}/requestlines','RequestheaderController@requestlines');
Route::post('requestlines/post','RequestheaderController@requestlines_post');

Route::get('/requestlines/{idl}/edit','RequestlinesController@edit');
Route::get('/requestlines/{idl}/mtesting','RequestlinesController@mtesting');
Route::get('/requestlines/{idl}/delete','RequestlinesController@delete');
Route::get('/requestlines/{idl}/analysis','RequestlinesController@analysis');
Route::get('/requestlines/{idl}/done','RequestlinesController@done');
Route::post('/requestlines/{idl}/update','RequestlinesController@update');
Route::get('/requestheader/{id}/delete','RequestheaderController@delete');
Route::get('/requestheader/{id}/close','RequestheaderController@close');
Route::post('/requestheader/{id}/requestlines/post','RequestheaderController@requestlines_post');
Route::get('/dashboard','DashboardController@index');

Route::resource('requestlines','RequestlinesController');
Route::get('/projectrelation/{projectrelation_id}','RequestheaderController@projectrelation');
Route::get('/company/{company_idc}','CompanyController@company');
Route::get('/transaksi/{company_idc}','TransaksiController@transaksi');
});

