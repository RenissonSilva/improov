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
})->middleware('guest')->name('welcome');

Route::get('/error', function () {
    return view('error');
})->middleware('guest')->name('error');

Auth::routes();

Route::get('teste','TesteController@index');

Route::prefix('user')->middleware('auth','throttle:500,1', 'update.user')->group(function () {
    Route::post('teste', 'MissionController@teste')->name('teste');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('repos', 'UserController@listRepositories')->name('repos');
    Route::get('performance', 'UserController@getPerformance')->name('performance');
    Route::post('addrepo', 'UserController@addFavoriteRepository')->name('addRepo');
    Route::prefix('mission')->middleware('auth')->group(function () {
        Route::get('/', 'MissionController@index')->name('mission');
        Route::post('store', 'MissionController@store')->name('mission.store');
        Route::post('change', 'MissionController@changeStatusMission')->name('mission.changeStatusMission');
        Route::post('edit', 'MissionController@modalEditMission');
        Route::any('update', 'MissionController@update')->name('mission.update');
        Route::delete('delete/{id}', 'MissionController@delete')->name('mission.delete');
        Route::any('modifiedCompletedMission/{id}', 'MissionController@modifiedCompletedMission')->name('mission.modifiedCompletedMission');
    });
});

Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');

// Rotas de atualização
Route::get('atualizaRepositorios/WcDzrAL3Hbhc', 'AcaoController@atualizaRepositorios');
Route::get('atualizaSubirNivel/WcDzrAL3Hbhc', 'AcaoController@atualizaSubirNivel');
