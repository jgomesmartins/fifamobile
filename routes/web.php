<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class , 'index'])->name('home');

    /*Rotas de Times*/
    Route::get('/team/add', 'App\Http\Controllers\TeamController@create')->name('create_team');
    Route::get('/team/view', 'App\Http\Controllers\TeamController@index')->name('view_team');
    Route::post('/team/add', 'App\Http\Controllers\TeamController@store')->name('adicionar_team');
    Route::post('/team/view/del', 'App\Http\Controllers\TeamController@delete')->name('delete_team');
    Route::post('/team/view/edit', 'App\Http\Controllers\TeamController@alter')->name('editar_team');

    /*Rotas de Temporada*/
    Route::get('/season/add', 'App\Http\Controllers\SeasonsController@create')->name('create_season');
    Route::get('/season/view', 'App\Http\Controllers\SeasonsController@index')->name('view_season');
    Route::post('/season/add', 'App\Http\Controllers\SeasonsController@store')->name('adicionar_season');
    Route::post('/season/view/del', 'App\Http\Controllers\SeasonsController@delete')->name('delete_season');
    Route::post('/season/view/edit', 'App\Http\Controllers\SeasonsController@alter')->name('editar_season');

    /*Rotas de partidas*/
    Route::get('/matches/add', 'App\Http\Controllers\MatchesController@create')->name('create_matches');
    Route::get('/matches/dashboard', 'App\Http\Controllers\MatchesController@dashboard')->name('dashboard_matches');
    Route::get('/matches/del/{id}', 'App\Http\Controllers\MatchesController@destroy')->name('delete_matches');
    Route::post('/matches/add', 'App\Http\Controllers\MatchesController@store')->name('adicionar_matches');
    Route::post('/matches/view/del', 'App\Http\Controllers\MatchesController@destroy')->name('delete_matches');
    Route::post('/matches/view/edit', 'App\Http\Controllers\MatchesController@alter')->name('editar_matches');
    Route::post('/matches/view/delmatches', 'App\Http\Controllers\MatchesController@delmatches');

    /*Dashboard*/
    Route::post('/matches/showpartidas', 'App\Http\Controllers\DashboardController@partidaRealizadas');
    Route::post('/matches/resumodashday', 'App\Http\Controllers\DashboardController@resumodashday');
    Route::post('/matches/resumodashseasons', 'App\Http\Controllers\DashboardController@resumodashseasons');

});