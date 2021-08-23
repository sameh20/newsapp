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

// main

Route::get('/', 'frontController@index');
Route::get('article/{slug}','frontController@article');
Route::get('category/{slug}','frontController@category');
Route::get('page/{slug}','frontController@page');
Route::get('contact-us','frontController@contactUs');
Route::post('sendmessage','crudController@insertData');

// admin
Route::get('post','frontController@post');
Route::get('laranews-admin','adminController@index');
// category 
Route::get('viewcategory','adminController@viewcategory');
Route::post('addcategory','crudController@insertData');
Route::get('editcategory/{id}','adminController@editcategory');
Route::post('updatecategory/{id}','crudController@updatetData');
Route::post('multipledelete', 'adminController@multipleDelete');

// settings
Route::get('settings','adminController@settings');
Route::post('addsettings','crudController@insertData');
Route::post('updatesettings/{id}','crudController@updatetData');
// posts
Route::get('add-post','adminController@addPost');
Route:: post('addpost','crudController@insertData');
Route:: get('all-posts','adminController@allPosts');
Route::get('editpost/{id}','adminController@editPost');
Route::post('updatepost/{id}','crudController@updatetData');
Route::get('search-content','frontController@searchContent');
// pages
Route::get('add-page','adminController@addPage');
Route:: post('addpage','crudController@insertData');
Route:: get('all-pages','adminController@allPages');
Route::get('editpage/{id}','adminController@editPage');
Route::post('updatepage/{id}','crudController@updatetData');

// messages
Route::get('messages','adminController@messages');
// advertisments
Route::get('add-adv','adminController@addAdv');
Route::get('all-adv','adminController@allAdv');
Route::get('editadv/{id}','adminController@editAdv');
Route::post('addadv','crudController@insertData');
Route::post('updateadv/{id}','crudController@updatetData');

// auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', 'HomeController@logout')->name('logout');

//Route::post('/addcategory',[crudController::class ,'addcategory']);

// Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//     ->name('ckfinder_connector');

// Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//     ->name('ckfinder_browser');
