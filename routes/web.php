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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'SiteController@index');
Route::get('/about-us', 'SiteController@aboutUs')->name('about-us');
Route::get('/about-us', 'SiteController@aboutUs')->name('about-us');
Route::get('/product-list', 'SiteController@productList')->name('product-list');
Route::post('/product-list', 'SiteController@productList')->name('product-list');
Route::get('/product-details/{product_id}', 'SiteController@show');
Route::post('/product-search', 'SiteController@productListSearch');
Route::get('/product-search/{cat_id}', 'SiteController@productListById');
Route::get('/contact-us', 'SiteController@contactUs')->name('contact-us');
Route::post('/add-to-cart', 'SiteController@addToCart');
Route::get('/view-cart', 'SiteController@viewCart');
Route::post('/delete-cart', 'SiteController@deleteCart');

Auth::routes();

Route::group(['middlewareGroups' => ['auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');
	// Route::get('/about', 'HomeController@aboutInfo');
	Route::get('/about', 'AboutController@index');
	Route::post('/add-about', 'AboutController@store');
	Route::post('/delete-about', 'AboutController@destroy');
	Route::post('/edit-about', 'AboutController@edit');
	Route::post('/update-about', 'AboutController@update');
	Route::post('/about-status-isactive', 'AboutController@checkAlreadyActivated');
	Route::post('/about-status', 'AboutController@aboutStatus');
	// Category Routes
	Route::get('/category', 'CategoryController@index')->name('category');
	Route::post('/add-category', 'CategoryController@store');
	Route::get('/edit-category/{cat_id}', 'CategoryController@edit');
	Route::post('/update-category', 'CategoryController@update');
	Route::post('/delete-category', 'CategoryController@destroy');
	Route::post('/category-status', 'CategoryController@categoryStatus');

	// Product Routes
	Route::get('/product', 'ProductController@index')->name('product');
	Route::post('/add-product', 'ProductController@store');
	Route::get('/edit-product/{product_id}', 'ProductController@edit');
	Route::post('/update-product', 'ProductController@update');
	Route::post('/delete-product', 'ProductController@destroy');

	// Slider Routes
	Route::get('/slider', 'SliderController@index')->name('slider');
	Route::post('/add-slider', 'SliderController@store');
	Route::post('/delete-slider', 'SliderController@destroy');
	Route::get('/edit-slider/{slider_id}', 'SliderController@edit');
	Route::post('/update-slider', 'SliderController@update');

});


