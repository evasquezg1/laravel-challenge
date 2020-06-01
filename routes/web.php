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
});

Auth::routes();

Route::get('Evento/todos', 'ControllerEvent@index');
Route::get('home', 'ControllerEvent@index');
Route::get('Evento/form','ControllerEvent@form');
Route::post('Evento/create','ControllerEvent@create');
Route::post('Evento/edit','ControllerEvent@edit');
Route::get('Evento/details/{id}','ControllerEvent@details');
Route::get('Evento/index/{month}','ControllerEvent@index_month');
Route::post('Evento/calendario','ControllerEvent@calendario');

Route::get('Evento/dia','ControllerEvent@dia');
Route::get('Evento/5dias','ControllerEvent@fivedays');

Route::post('send-mail','MailSend@mailsend');