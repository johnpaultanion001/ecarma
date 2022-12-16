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

    // INVENTORIES
    route::get('inventories', 'ItemController@inventories')->name('items.inventories');


    // Manages
    route::get('items/manages/{manage_type}', 'ItemController@manage_index')->name('items.manage_index');
    route::post('items/manages/{manage_type}', 'ItemController@manage_update')->name('items.manage_update');
    route::get('items/manages/{manage_type}/{id}', 'ItemController@manage_edit')->name('items.manage_edit');
    route::get('items/manages_delete/{manage_type}/{id}', 'ItemController@manage_destroy')->name('items.manage_destroy');

    // SELLER
    Route::resource('sellers', 'SellerController');

    

    // Transaction
    route::get('transactions', 'TransactionController@index')->name('transaction.index');
    route::delete('transactions/{transaction}', 'TransactionController@void')->name('transaction.void');

    // BUYINGS
    route::get('buyings/{transaction_id}/buy', 'BuyingController@index')->name('buyings.index');
    route::post('buyings/store', 'BuyingController@store')->name('buyings.store');
    route::get('buyings/{buying}/edit', 'BuyingController@edit')->name('buyings.edit');
    route::put('buyings/{buying}', 'BuyingController@update')->name('buyings.update');
    route::delete('buyings/{buying}', 'BuyingController@destroy')->name('buyings.destroy');
    route::get('buyings/saveTransaction', 'BuyingController@saveTransaction')->name('buyings.saveTransaction');
    route::get('buying/expenses', 'BuyingController@expenses')->name('buyings.expenses');


     // SELLINGS
     route::get('sellings/{transaction_id}/buy', 'SellingController@index')->name('sellings.index');
     route::post('sellings/store', 'SellingController@store')->name('sellings.store');
     route::get('sellings/{selling}/edit', 'SellingController@edit')->name('sellings.edit');
     route::put('sellings/{selling}', 'SellingController@update')->name('sellings.update');
     route::delete('sellings/{selling}', 'SellingController@destroy')->name('sellings.destroy');
     route::get('sellings/saveTransaction', 'SellingController@saveTransaction')->name('sellings.saveTransaction');
     route::get('selling/income', 'SellingController@income')->name('sellings.income');
    

    // BUYER
    Route::resource('buyers', 'BuyerController');

    //USER
    Route::resource('users', 'UsersController');
    route::get('loadusers', 'UsersController@load')->name('users.load');
    route::get('user/{user}', 'UsersController@usershow')->name('user.usershow');
    route::put('user/{user}', 'UsersController@userupdate')->name('user.userupdate');
});
