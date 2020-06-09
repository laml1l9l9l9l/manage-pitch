<?php

$group      = "customer";
$LoginController    = "Customer\LoginController";
$RegisterController = "Customer\RegisterController";
$HomeController     = "Customer\HomeController";
$DateOffController  = "Customer\API\DateOffController";

// login
Route::get("login","$LoginController@index")
->name("$group.login");
Route::post("login","$LoginController@login")
->name("$group.process_login");
Route::post("login/ajax","$LoginController@ajaxLogin")
->name("$group.login.ajax");

// view register
Route::get("register","$RegisterController@index")
->name("$group.register");

// process register
Route::post("register","$RegisterController@register")
->name("$group.process_register");


// home
Route::get("","$HomeController@home")
	->name("$group.home");
Route::get("/home","$HomeController@home")
	->name("$group.home");


// Get date off
Route::get("date-off","$DateOffController@getAllDateOff")
	->name("$group.api.date.off");


Route::group(["prefix" => "", "middleware" => ["checkAuthenticateCustomer"]],function()
{
	// tách ra nhiều controller
	$group = "customer";
	$ProfileController        = "Customer\Profile\ProfileController";
	$ChangePasswordController = "Customer\Profile\ChangePasswordController";
	$BillController           = "Customer\Bill\BillController";
	$ListBillController       = "Customer\Bill\ListBillController";
	$DetailBillController     = "Customer\Bill\DetailBillController";


	// profile
	Route::get("profile","$ProfileController@index")
		->name("$group.profile");
	Route::post("profile/update","$ProfileController@update")
		->name("$group.profile.update");
	Route::get("information","$ProfileController@information")
		->name("$group.infor");
	Route::get("change-password","$ChangePasswordController@index")
		->name("$group.profile.change.password");
	Route::post("change-password","$ChangePasswordController@update")
		->name("$group.profile.update.password");


	// bill
	Route::post("bill","$BillController@createBill")
		->name("$group.bill.create");
	Route::get("bill","$ListBillController@bill")
		->name("$group.bill");
	Route::get("bill/detail/{id}","$DetailBillController@index")
		->name("$group.bill.detail");

	
	// logout
	Route::get("logout","$ProfileController@logout")
		->name("$group.logout");

});


