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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('repos', 'UserController@listRepositories')->name('repos');
    Route::post('addrepo', 'UserController@addFavoriteRepository')->name('addRepo');
    Route::prefix('mission')->middleware('auth')->group(function () {
        Route::post('store', 'MissionController@store')->name('mission.store');
        Route::any('update/{id}', 'MissionController@update')->name('mission.update');
        Route::any('modifiedCompletedMission/{id}', 'MissionController@modifiedCompletedMission')->name('mission.modifiedCompletedMission');
    });
});

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');
