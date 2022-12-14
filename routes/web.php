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


Route::get('/','App\Http\Controllers\QuizController@top');
Route::get('/quiz/{no?}','App\Http\Controllers\QuizController@quiz')->name('quiz');
Route::post('/quiz/{no?}','App\Http\Controllers\QuizController@vote');
Route::get('/result','App\Http\Controllers\QuizController@result');



