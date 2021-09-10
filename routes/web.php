<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MiningZoneController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
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

    Route::get('/user', [PageController::class, 'users'])->name('user');  
    Route::get('/mining_zone', [PageController::class, 'mining_zones'])->name('mining_zone');  
    Route::get('/mining_production', [PageController::class, 'mining_productions'])->name('mining_production');  
    Route::get('/mining_sale', [PageController::class, 'mining_sales'])->name('mining_sale');  
    Route::get('/mining_log', [PageController::class, 'mining_logs'])->name('mining_log');  
    
    Route::resource('users', UserController::class); 
    Route::resource('mining_zones', MiningZoneController::class); 
});

Route::middleware('guest')->group( function(){

}); 

