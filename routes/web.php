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
use App\Http\Controllers\ProductController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware'=>'auth'], function(){
Route::resource('/', App\Http\Controllers\ProductController::class);
Route::get('/list',[App\Http\Controllers\ProductController::class, 'index']);
});
Auth::routes();


// Route::get('/dash', [ProductController::class,'index']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
