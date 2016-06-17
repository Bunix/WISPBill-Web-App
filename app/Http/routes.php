<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if (Auth::check())
    {
    return view('home');
    }
    else
    {
    return view('auth/login');
    }
});
//Lead Routes
Route::get('/maplead', 'leadcontroller@map');
Route::get('/newlead', 'leadcontroller@create');
Route::post('/newlead', 'leadcontroller@store');
Route::get('/addleadlocation', 'leadcontroller@addlocation');
Route::post('/addleadlocation', 'leadcontroller@storeaddlocation');
Route::get('/viewlead', 'leadcontroller@index');
Route::get('/viewalead/{id}', 'leadcontroller@show');
Route::get('/addleadaccount', 'leadcontroller@addaccount');
Route::post('/addleadaccount', 'leadcontroller@storeaddaccount');
Route::get('/addleadbilling', 'leadcontroller@addbilling');
Route::post('/addleadbilling', 'leadcontroller@addbillingstore');
//Settings Routes
Route::get('/settings', 'settingscontroller@main');
Route::get('/viewusers', 'settingscontroller@indexusers');
Route::get('/manageusers', 'settingscontroller@manageuserpermissions');
Route::post('/manageusers', 'settingscontroller@storemanageuserpermissions');
Route::post('/setstripekey', 'settingscontroller@setstripekey');
Route::post('/setgeocoder', 'settingscontroller@setgeocoder');
Route::post('/setmapview', 'settingscontroller@setmapview');
Route::post('/togglesettings', 'settingscontroller@togglesettings');
//Site Routes
Route::get('/newsite', 'sitecontroller@create');
Route::post('/newsite', 'sitecontroller@store');
Route::get('/editcoverage', 'sitecontroller@coverage');
Route::post('/editcoverage', 'sitecontroller@storecoverage');
Route::get('/mapsites', 'sitecontroller@map');
Route::get('/viewsites', 'sitecontroller@index');
Route::get('/site/newnote', 'sitecontroller@notecreate');
Route::post('/site/newnote', 'sitecontroller@notestore');
//Contact Routes
Route::get('/newcontact', 'contactcontroller@create');
Route::post('/newcontact', 'contactcontroller@store');
Route::get('/addcontactsite', 'contactcontroller@add');
Route::post('/addcontactsite', 'contactcontroller@storeadd');
Route::get('/viewcontacts', 'contactcontroller@index');
Route::get('/contact/newnote', 'contactcontroller@notecreate');
Route::post('/contact/newnote', 'contactcontroller@notestore');
//Placeholder routes
Route::get('/customer/', function () {
    return view('lander');
});