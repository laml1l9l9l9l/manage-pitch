<?php

$group      = "customer";
$LoginController    = "Customer\LoginController";
$RegisterController = "Customer\RegisterController";
$HomeController     = "Customer\HomeController";

// login
Route::get("login","$LoginController@index")
->name("$group.login");
Route::post("login","$LoginController@login")
->name("$group.process_login");

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



Route::group(["prefix" => "", "middleware" => ["checkAuthenticateCustomer"]],function()
{
	// tách ra nhiều controller
	$group = "customer";
	$ProfileController = "Customer\Profile\ProfileController";
	$BillController    = "Customer\Bill\BillController";


	// profile
	Route::get("profile","$ProfileController@index")
		->name("$group.profile");
	Route::post("profile/update","$ProfileController@update")
		->name("$group.profile.update");
	Route::get("profile/bill","$ProfileController@bill")
		->name("$group.profile.bill");
	Route::get("information","$ProfileController@information")
		->name("$group.infor");


	// bill
	Route::post("bill","$BillController@createBill")
		->name("$group.bill.create");

	
	// logout
	Route::get("logout","$ProfileController@logout")
		->name("$group.logout");

});


