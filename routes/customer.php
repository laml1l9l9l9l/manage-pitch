<?php

$group      = "customer";
$LoginController = "Customer\LoginController";
$RegisterController = "Customer\RegisterController";
$HomeController = "Customer\HomeController";

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

	Route::get("profile","$ProfileController@index")
		->name("$group.profile");

	
	// logout
	Route::get("logout","$ProfileController@logout")
		->name("$group.logout");

});


