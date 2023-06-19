<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Routes vers la page d'accueil
Route::get('/', function () {
    return view('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Routes d'authentification
Auth::routes();

//Routes d'administration
Route::get('/admin/horeca/home', [App\Http\Controllers\AdminController::class, 'horeca']);
Route::get('/admin/sports/home', [App\Http\Controllers\AdminController::class, 'sports']);
Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users']);

//Routes portail Horeca
Route::get('/horeca/home', [App\Http\Controllers\HorecaController::class, 'home']);
Route::get('/horeca/booking', [App\Http\Controllers\HorecaController::class, 'booking']);
Route::get('/horeca/menu', [App\Http\Controllers\HorecaController::class, 'menu']);

//Routes portail Sports
Route::get('/sports/home', [App\Http\Controllers\SportsController::class, 'home']);
Route::get('/sports/booking', [App\Http\Controllers\SportsController::class, 'booking']);
Route::get('/sports/planning', [App\Http\Controllers\SportsController::class, 'planning']);

//Routes gestion du profil
Route::get('/profile/one/{id}', [App\Http\Controllers\ProfileController::class, 'one']);
Route::get('/profile/edit/{id}', [App\Http\Controllers\ProfileController::class, 'edit']);
Route::get('/profile/reservations/{id}', [App\Http\Controllers\ProfileController::class, 'reservations']);
