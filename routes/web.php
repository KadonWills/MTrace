<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
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
})->name('welcome');

// Génération automatique des routes pour la gestion de l'authentification
Auth::routes(); 

Route::middleware('auth')->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home'); 

    Route::get('/menu', function () {return view('menu');})->name('menu'); 

    Route::get('/users', function () {return view('dashboard.users');})->name('users');   
});

Route::middleware('guest')->group( function(){

}); 

