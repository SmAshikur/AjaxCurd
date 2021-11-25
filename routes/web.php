<?php

use App\Http\Controllers\AjaxController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('ajax',[AjaxController::class,'ajax']);
Route::get('ajax/get',[AjaxController::class,'get']);
Route::post('ajax/add',[AjaxController::class,'add']);
Route::get('ajax/edit/{id}',[AjaxController::class,'edit']);
Route::get('ajax/del/{id}',[AjaxController::class,'del']);
Route::post('ajax/update/{id}',[AjaxController::class,'up']);
//Route::post('ajax/update/{id}',[AjaxController::class,'update']);
