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

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

 Route::get('/login', function () {
    //  $data = [];
    //  switch ($as) {
    //      case 'AM' :
    //          $data['bg_image'] = "/img/curved-images/curved-8.jpg";
    //          break;
    //      default :
    //          $data['bg_image'] = "/img/logo.png";
    //      break;
    //  }
    //  return $as;
    return view('login');

 })->name('login');

Route::get('/artisan-minier', function () {
    $code = 'AM';
    return view('miner', compact('code'));
})->name('miner');

Auth::routes();

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/
