<?php

use Illuminate\Support\Facades\Route;

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

// Categories

Route::get('/forms/data/getOperations','CategoryController@getOperations');
Route::get('/forms/data/getBeneficiaries','CategoryController@getBeneficiaries');
Route::get('/forms/data/getSupport','CategoryController@getSupport');
Route::get('/forms/data/getOrganizations','CategoryController@getOrganizations');
Route::get('/forms/data/getHelps','CategoryController@getHelps');
Route::get('/forms/data/getInformation','CategoryController@getInformation');

// JSON

Route::get('/json/data/initiatives','JSONController@initiativesData');
Route::get('/json/data/organizationNames','JSONController@organizationNames');

// Events

Route::post('event/linkEventOrganization','EventController@linkEventOrganization');

// Route MODELS

Route::resource('street', 'StreetController', ['except' => 'show', 'create', 'edit']);
Route::resource('commune', 'CommuneController', ['except' => 'show', 'create', 'edit']);
Route::resource('region', 'RegionController', ['except' => 'show', 'create', 'edit']);
Route::resource('organization', 'OrganizationController', ['except' => 'show', 'create', 'edit']);
Route::resource('event', 'EventController', ['except' => 'show', 'create', 'edit']);
Route::resource('support', 'SupportController', ['except' => 'show', 'create', 'edit']);
Route::resource('contact', 'ContactController', ['except' => 'show', 'create', 'edit']);
Route::resource('direction', 'DirectionController', ['except' => 'show', 'create', 'edit']);

Route::get('/{any}', 'ApplicationController')->where('any', '.*');

