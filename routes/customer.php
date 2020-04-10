<?php

$group      = "customer";
$LoginController = "Customer\LoginController";
$RegisterController = "Customer\RegisterController";

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



Route::group(["prefix" => ""],function()
{
	// tách ra nhiều controller
	$group      = "customer";
	$HomeController = "Customer\HomeController";

	// home
	Route::get("","$HomeController@home")
		->name("$group.home");
	Route::get("/home","$HomeController@home")
		->name("$group.home");

	// search football ground
	// Route::post("view_search_football_ground","$controller@view_search_football_ground")
	// ->name("$group.view_search_football_ground");

	// select football ground
	// Route::post("view_football_ground","$controller@view_football_ground")
	// ->name("$group.view_football_ground");



	// calendar
	// Route::get("view_calendar_football_ground/{ma_san_bong}","$controller@calendar_football_ground")
	// ->name("$group.view_calendar_football_ground");

	// // load calendar
	// Route::get("load_calendar","$controller@load_calendar")
	// ->name("$group.load_calendar");

	// // view calendar football ground
	// Route::match(["get","post"],"view_calendar_detail_football_ground","$controller@view_calendar_detail_football_ground")
	// ->name("$group.view_calendar_detail_football_ground");

	// // load calendar detail football ground
	// Route::get("load_calendar_detail_football_ground/{ma_san_bong}","$controller@load_calendar_detail_football_ground")
	// ->name("$group.load_calendar_detail_football_ground");



	// // view detail football ground
	// Route::get("view_detail_football_ground/{ma_san_bong}","$controller@view_detail_football_ground")
	// ->name("$group.view_detail_football_ground");

	// // view_book_football_ground
	// Route::get("view_book_football_ground/{ma_san_bong}","$controller@view_book_football_ground")
	// ->name("$group.view_book_football_ground");

	// // view_book_football_ground
	// Route::get("ajax_check_book_football_ground","$controller@ajax_check_book_football_ground")
	// ->name("$group.ajax_check_book_football_ground");

	// // view_book_tournament
	// Route::match(["get","post"],"view_book_tournament","$controller@view_book_tournament")
	// ->name("$group.view_book_tournament");

	// // view_select_date_tournament_for_hour
	// Route::get("view_select_date_tournament","$controller@view_select_date_tournament")
	// ->name("$group.view_select_date_tournament");
	// Route::get("view_check_football_ground_tournament","$controller@view_check_football_ground_tournament")
	// ->name("$group.view_check_football_ground_tournament");

	// // view_book_hour_football_ground
	// Route::post("view_book_hour_football_ground","$controller@view_book_hour_football_ground")
	// ->name("$group.view_book_hour_football_ground");



	// Route::group(["prefix" => "customer", "middleware" => "check_profile"],function()
	// {
	// 	$group      = "customer";
	// 	$controller = "Customer\customer_controller";

	// 	// logout
	// 	Route::get("logout","$controller@logout")
	// 	->name("$group.logout");

	// 	// profile
	// 	Route::get("view_profile","$controller@view_profile")
	// 	->name("$group.view_profile");

	// 	// update profile
	// 	Route::post("update_profile","$controller@update_profile")
	// 	->name("$group.update_profile");



	// 	// create_session_to_create_bill
	// 	Route::post("create_session_to_create_bill","$controller@create_session_to_create_bill")
	// 	->name("$group.create_session_to_create_bill");

	// 	// view_create_bill_once_football_ground
	// 	Route::get("view_create_bill_once_football_ground","$controller@view_create_bill_once_football_ground")
	// 	->name("$group.view_create_bill_once_football_ground");

	// 	// create bill
	// 	Route::post("create_bill_once_football_ground","$controller@create_bill_once_football_ground")
	// 	->name("$group.create_bill_once_football_ground");

	// 	// view bill profile
	// 	Route::get("view_bill","$controller@view_bill")
	// 	->name("$group.view_bill");
	// });

});


