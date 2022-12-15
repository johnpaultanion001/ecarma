<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    // return what you want
});
Route::get('/migrate-fresh', function() {
    $exitCode = Artisan::call('migrate:fresh --seed');
    // return what you want
});

Auth::routes();


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('loaddashboard', 'DashboardController@loaddashboard')->name('loaddashboard');

    // ITEMS
    Route::resource('items', 'ItemController');

    // Manages
    route::get('items/manages/{manage_type}', 'ItemController@manage_index')->name('items.manage_index');
    route::post('items/manages/{manage_type}', 'ItemController@manage_update')->name('items.manage_update');
    route::get('items/manages/{manage_type}/{id}', 'ItemController@manage_edit')->name('items.manage_edit');
    route::get('items/manages_delete/{manage_type}/{id}', 'ItemController@manage_destroy')->name('items.manage_destroy');

    // SELLER
    Route::resource('sellers', 'SellerController');

    // BUYER
    Route::resource('buyers', 'BuyerController');

    //USER
    Route::resource('users', 'UsersController');
    route::get('loadusers', 'UsersController@load')->name('users.load');
    route::get('user/{user}', 'UsersController@usershow')->name('user.usershow');
    route::put('user/{user}', 'UsersController@userupdate')->name('user.userupdate');
});
