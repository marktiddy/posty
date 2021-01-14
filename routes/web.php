<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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
Route::get('/', function() {
    return '<h2>Welcome</h2>';
});

Route::get('/posts', function () {
    return view('posts.index');
});
//Call the action index from our RegisterController
//Naming it makes it easy to come back to for nav etc.
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class,'store'])->name('register');
