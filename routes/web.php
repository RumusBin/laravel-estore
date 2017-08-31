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
Route::get('/admin-page', 'AdminController@index')->name('admin.dashboard');

Auth::routes();
Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');

Route::get('/profile', 'HomeController@index')->name('profile');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::group(['prefix'=>'admin'], function(){
    Route::get('/login', 'Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Admin\AdminLoginController@logout')->name('admin.logout');

    //Password reset routs
    Route::post('/password/email', 'Admin\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Admin\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Admin\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Admin\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

        // admin resource routs
Route::group(['middleware'=>['auth:admin']], function(){
    Route::resource('customers', 'Admin\CustomersController');
    Route::resource('brands', 'Admin\BrandsController');
    Route::resource('product-categories', 'Admin\ProductCategoriesController');
    Route::resource('products', 'Admin\ProductsController');
    Route::resource('users', 'Admin\UsersController');
});
    Route::get('orders', [
        'uses' => 'Admin\OrdersController@index',
        'as' => 'orders.index',
    ]);
});


