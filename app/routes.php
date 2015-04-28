<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/**
 * admin
 * admin login
 * admin retrieve password
 * dashboard home
 * dashboard language
 * dashboard post
 * dashboard category
 * dashboard page
 */

Route::get('admin', function() {
	return Redirect::route('admin.home');
});

Route::get('/', function() {
	return Redirect::route('public.index', array('lang' => Lang::getFallback()));
});

Route::group(array('prefix' => '{lang}/public', 'before' => 'locale.setup'), function($lang)
{
	Route::pattern('lang', '[A-Za-z\-]{0,6}');
	Route::pattern('title', '[0-9A-Za-z\-]*');

	Route::get('index', 								array('as' => 'public.index', 		'uses' => 'PublicController@index'));
	Route::get('post/{id}/{title}', 		array('as' => 'public.post', 			'uses' => 'PublicController@post'));
	Route::get('category/{id}/{title}', array('as' => 'public.category', 	'uses' => 'PublicController@category'));
});

Route::group(array('prefix' => 'api/secret', 'before' => 'auth'), function()
{
	Route::get('dashboard/candies/{skip}/{amount}', function($skip = null, $amount = 1) {
		return Response::json(API\JSON\Secret\Dashboard::loadCandyImagesJson($skip, $amount));
	});

	/**
	 * Notifications API
	 */
	Route::get('dashboard/notifications/warning', function() {
		return Response::json(API\JSON\Secret\Dashboard::warnNotifications());
	});

	Route::get('dashboard/notifications/info', function() {
		return Response::json(API\JSON\Secret\Dashboard::infoNotifications());
	});

	Route::get('dashboard/notifications/success', function() {
		return Response::json(API\JSON\Secret\Dashboard::successNotifications());
	});

	Route::get('dashboard/notifications/error', function() {
		return Response::json(API\JSON\Secret\Dashboard::errorNotifications());
	});
});

Route::group(array('prefix' => 'admin', 'before' => 'guest'), function()
{
	/*----Admin-------------------------------------------------------------------------------------------*/	
	Route::get('home', 		array('as' => 'admin.home',		'uses' => 'AdminHomeController@index'));
	Route::post('home', 	array('as' => 'admin.login',	'uses' => 'AdminHomeController@login'));
	Route::get('signup', 	array('as' => 'admin.signup',	'uses' => 'AdminSignupController@index'));
	Route::post('signup',	array('as' => 'admin.create',	'uses' => 'AdminSignupController@create'));
});

Route::group(array('prefix' => 'admin/dashboard/', 'before' => 'auth'), function()
{
	Route::get('prepare', array('as' => 'admin.dashboard.prepare',		'uses' => 'AdminHomeController@prepare'));

	/*----Dashboard Home----------------------------------------------------------------------------------------------*/
	Route::get('home',		array('as' => 'admin.dashboard', 			'uses' => 'DashboardHomeController@index'));

	/*----Dashboard Language-----------------------------------------------------------------------------------*/
	Route::get('language', 								array('as' => 'admin.dashboard.language', 			'uses' => 'DashboardLanguageController@index'));
	Route::post('language/store', 				array('as' => 'admin.dashboard.language.store',  	'uses' => 'DashboardLanguageController@store'));
	Route::get('language/edit/{id}', 			array('as' => 'admin.dashboard.language.edit',  	'uses' => 'DashboardLanguageController@edit'));
	Route::post('language/update/{id}', 	array('as' => 'admin.dashboard.language.update',  	'uses' => 'DashboardLanguageController@update'));
	Route::get('language/restore/{id}', 	array('as' => 'admin.dashboard.language.restore',  	'uses' => 'DashboardLanguageController@restore'));
	Route::get('language/delete/{id}', 		array('as' => 'admin.dashboard.language.delete',  	'uses' => 'DashboardLanguageController@destroy'));
	
	/*----Dashboard Category------------------------------------------------------------------------------------------*/
	Route::get('category', 								array('as' => 'admin.dashboard.category', 			'uses' => 'DashboardCategoryController@index'));
	Route::post('category/store', 				array('as' => 'admin.dashboard.category.store', 	'uses' => 'DashboardCategoryController@store'));
	Route::get('category/edit/{id}', 			array('as' => 'admin.dashboard.category.edit', 		'uses' => 'DashboardCategoryController@edit'));
	Route::post('category/update/{id}', 	array('as' => 'admin.dashboard.category.update', 	'uses' => 'DashboardCategoryController@update'));
	Route::get('category/restore/{id}', 	array('as' => 'admin.dashboard.category.restore', 	'uses' => 'DashboardCategoryController@restore'));
	Route::get('category/delete/{id}', 		array('as' => 'admin.dashboard.category.delete', 	'uses' => 'DashboardCategoryController@destroy'));
	
	/*----Dashboard Post-----------------------------------------------------------------------------------------*/
	Route::get	('post', 							array('as' => 'admin.dashboard.post', 			'uses' => 'DashboardPostController@index'));
	Route::post	('post/store', 				array('as' => 'admin.dashboard.post.store', 	'uses' => 'DashboardPostController@store'));
	Route::get	('post/edit/{id}', 		array('as' => 'admin.dashboard.post.edit', 		'uses' => 'DashboardPostController@edit'));
	Route::post	('post/update/{id}', 	array('as' => 'admin.dashboard.post.update', 	'uses' => 'DashboardPostController@update'));
	Route::get	('post/restore/{id}', array('as' => 'admin.dashboard.post.restore', 	'uses' => 'DashboardPostController@restore'));
	Route::get	('post/delete/{id}', 	array('as' => 'admin.dashboard.post.delete', 	'uses' => 'DashboardPostController@destroy'));
	
	/*----Dashboard Page----------------------------------------------------------------------------------------------*/
	Route::get	('page', 							array('as' => 'admin.dashboard.page', 			'uses' => 'DashboardPageController@index'));
	Route::post	('page/store', 				array('as' => 'admin.dashboard.page.store', 	'uses' => 'DashboardPageController@store'));
	Route::get	('page/edit/{id}', 		array('as' => 'admin.dashboard.page.edit', 		'uses' => 'DashboardPageController@edit'));
	Route::post	('page/update/{id}', 	array('as' => 'admin.dashboard.page.update', 	'uses' => 'DashboardPageController@update'));
	Route::get	('page/restore/{id}', array('as' => 'admin.dashboard.page.restore', 	'uses' => 'DashboardPageController@restore'));
	Route::get	('page/delete/{id}', 	array('as' => 'admin.dashboard.page.delete', 	'uses' => 'DashboardPageController@destroy'));

	/*----Candy Page----------------------------------------------------------------------------------------------*/
	Route::get	('candy', 							array('as' => 'admin.dashboard.candy', 			'uses' => 'DashboardCandyController@index'));
	Route::post	('candy/store', 				array('as' => 'admin.dashboard.candy.store', 	'uses' => 'DashboardCandyController@store'));
	Route::get	('candy/edit/{id}', 		array('as' => 'admin.dashboard.candy.edit', 	'uses' => 'DashboardCandyController@edit'));
	Route::post	('candy/update/{id}', 	array('as' => 'admin.dashboard.candy.update', 	'uses' => 'DashboardCandyController@update'));
	Route::get	('candy/restore/{id}', 	array('as' => 'admin.dashboard.candy.restore', 	'uses' => 'DashboardCandyController@restore'));
	Route::get	('candy/delete/{id}', 	array('as' => 'admin.dashboard.candy.delete', 	'uses' => 'DashboardCandyController@destroy'));
	
	/*----Dashboard Widget-------------------------------------------------------------------------------------*/
	Route::get('widget', 							array('as' => 'admin.dashboard.widget', 		'uses' => 'DashboardWidgetController@index'));
	Route::get('widget/show/{id}', 		array('as' => 'admin.dashboard.widget.show', 	'uses' => 'DashboardWidgetController@show'));
	Route::get('widget/install/{id}', 			array('as' => 'admin.dashboard.widget.install', 'uses' => 'DashboardWidgetController@install'));
	Route::post('widget/update/{id}', array('as' => 'admin.dashboard.widget.update', 	'uses' => 'DashboardWidgetController@update'));
	Route::get('widget/update/{id}', 	array('as' => 'admin.dashboard.widget.update', 	'uses' => 'DashboardWidgetController@update'));
	Route::get('widget/destroy/{id}', array('as' => 'admin.dashboard.widget.destroy', 'uses' => 'DashboardWidgetController@destroy'));

	/*----Dashboard Social-Media-------------------------------------------------------------------------------------*/
	Route::get('social-media', 	array('as' => 'admin.dashboard.social', 	'uses' => 'DashboardSocialMediaController@index'));
	
	/*----Dashboard User-------------------------------------------------------------------------------------*/
	Route::get('user/logout', 	array('as' => 'admin.user.logout', 	'uses' 	=> 'DashboardUserController@logout'));

	/*----Dasbhoard Mass-Email---------------------------------------------------------------------------------------*/
	Route::get('mass-email', 	array('as' => 'admin.dashboard.mass', 		'uses' => 'DashboardMassEmailController@index'));
	// Route::get('backup', array('as' => 'admin.dashboard', 'uses' => 'DashboardHomeController@index'));
});

Route::group(array('prefix' => 'error'), function() {
	Route::get('not-found', 	array('as' => 'error.404.general', 'uses' => 'PublicErrorPageCtrl@notFound'));
});