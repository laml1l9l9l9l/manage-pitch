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


// router customer
Route::group(array('prefix' => '', 'before' => ''), function () {
    require __DIR__.'/customer.php';
});

// router manager
Route::group(array('prefix' => 'manager', 'before' => ''), function () {
    require __DIR__.'/manager.php';
});