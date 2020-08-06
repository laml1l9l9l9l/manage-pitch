<?php

$group      = "customer";
$LoginController      = "Customer\LoginController";
$RegisterController   = "Customer\RegisterController";
$HomeController       = "Customer\HomeController";
$BookPitchsController = "Customer\BookPitchs\BookPitchsController";
$DateOffController    = "Customer\API\DateOffController";
$BillBookPitchsController = "Customer\BookPitchs\BillBookPitchsController";

// Login
Route::get("login","$LoginController@index")
->name("$group.login");
Route::post("login","$LoginController@login")
->name("$group.process_login");
Route::post("login/ajax","$LoginController@ajaxLogin")
->name("$group.login.ajax");

// View Register
Route::get("register","$RegisterController@index")
->name("$group.register");

// Process Register
Route::post("register","$RegisterController@register")
->name("$group.process.register");


// Home
Route::get("","$HomeController@home")
	->name("$group.home");
Route::get("/home","$HomeController@home")
	->name("$group.home");

// Book
// Book Pitchs
Route::get("check-book-pitchs","$BookPitchsController@check")
	->name("$group.check.book.pitchs");
Route::post("select-book-pitchs","$BookPitchsController@selectDateTimeRent")
	->name("$group.select.book.pitchs");
Route::post("add-visual-detail-bill","$BillBookPitchsController@addVisualDetailBill")
	->name("$group.add.visual.detail.bill");
Route::post("remove-visual-detail-bill","$BillBookPitchsController@removeVisualDetailBill")
	->name("$group.remove.visual.detail.bill");


// Get date off
Route::get("date-off","$DateOffController@getAllDateOff")
	->name("$group.api.date.off");


Route::group(["prefix" => "", "middleware" => ["checkAuthenticateCustomer"]],function()
{
	// tách ra nhiều controller
	$group = "customer";
	$ProfileController        = "Customer\Profile\ProfileController";
	$ChangePasswordController = "Customer\Profile\ChangePasswordController";
	$BookPitchController      = "Customer\BookPitch\BookPitchController";
	$BillBookPitchController  = "Customer\BookPitch\BillBookPitchController";
	$BillBookPitchsController = "Customer\BookPitchs\BillBookPitchsController";
	$BillController           = "Customer\Bill\BillController";
	$ListBillController       = "Customer\Bill\ListBillController";
	$SearchBillController     = "Customer\Bill\SearchBillController";
	$ListQueueBillController  = "Customer\Bill\ListQueueBillController";
	$DetailBillController     = "Customer\Bill\DetailBillController";


	// Profile
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

	// Book
	Route::post("book","$BookPitchController@confirmBill")
		->name("$group.check.book.pitch");
	Route::post("book-pitch","$BillBookPitchController@createBill")
		->name("$group.book.pitch");
	Route::get("confirm-book-pitchs","$BillBookPitchsController@confirmBills")
		->name("$group.confirm.book.pitchs");
	Route::post("book-pitchs","$BillBookPitchsController@createBill")
		->name("$group.book.pitchs");

	// Bill
	Route::get("bill","$ListBillController@bill")
		->name("$group.bill");
	Route::get("queue-bill","$ListQueueBillController@queueBill")
		->name("$group.queue.bill");
	Route::get("bill/detail/{id}","$DetailBillController@index")
		->name("$group.bill.detail");
	Route::get("bill/search","$SearchBillController@search")
		->name("$group.bill.search");

	
	// Logout
	Route::get("logout","$ProfileController@logout")
		->name("$group.logout");

});


