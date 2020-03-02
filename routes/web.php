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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Backend */
Route::group(['middleware' => ['status', 'auth']], function () {
	$group = [
		'namespace' => 'Blog\Admin',
		'prefix'    => 'admin'
	];
	Route::group($group, function () {
		Route::resource('index', 'MainController')->names('blog.admin.main');
		Route::resource('orders', 'OrderController')->names('blog.admin.orders');
		Route::get('/orders/change/{id}', 'OrderController@change')->name('blog.admin.orders.change');
	});

});

Route::get('user/index', 'Blog\User\MainController@index');