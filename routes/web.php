<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('regions', 'Region\RegionController')->middleware('auth');
Route::get('regions/{region}/eliminate', 'Region\RegionController@eliminate')
    ->name('regions.eliminate')
    ->middleware('auth');

Route::resource('departments', 'Department\DepartmentController')->middleware('auth');
Route::get('departments/{department}/eliminate', 'Department\DepartmentController@eliminate')
    ->name('departments.eliminate')
    ->middleware('auth');

Route::resource('destinations', 'Destination\DestinationController')->middleware('auth');
Route::get('destinations/{destination}/eliminate', 'Destination\DestinationController@eliminate')
    ->name('destinations.eliminate')
    ->middleware('auth');

Route::get('search-destinations', 'Destination\SearchDestinationController@index')
    ->name('search.destinations')
    ->middleware('auth');