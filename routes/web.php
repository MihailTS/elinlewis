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

Route::get('/', 'MainController@index');
Route::get('about', 'AboutController@index');
Route::get('contacts', 'ContactsController@index');
Route::get('terricon', 'TerriconController@index');
Route::get('service', 'ServiceController@index');
Route::get('gallery', 'GalleryController@index');
Route::get('/gallery/art/add','GalleryController@add');
Route::post('/gallery/art/add','GalleryController@save');
Route::get('/promo','PromoController@index');
//Route::post('/promo','PromoController@save');
Route::get('gallery/{category}', 'GalleryController@category');
Route::get('art/{id}', 'ArtController@index')->where('id', '[0-9]+');
Route::get('winners', 'PromoController@winners');
//Route::get('promofill', 'PromoController@randomFillUnusedPromo');
//Route::get('addcookie', 'GalleryController@setAdminCookie');
//Route::get('interlacer', 'GalleryController@interlaceAllThumblains');
//Route::get('ratiometr', 'GalleryController@addRatioToAll');
