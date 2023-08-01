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



/******* ROUTES D'ADMINISTRATION *******/
/**** HORECA ****/
Route::get('/admin/horeca/home', [App\Http\Controllers\AdminController::class, 'horeca']);

//Plats
Route::get('/admin/horeca/dishes/list', [App\Http\Controllers\DishController::class, 'list']);
Route::get('/admin/horeca/dishes', [App\Http\Controllers\DishController::class, 'getDishes']);
Route::get('/admin/horeca/dishes/filter', [App\Http\Controllers\DishController::class, 'filterDishes']);
Route::get('/admin/horeca/dishes/create', [App\Http\Controllers\DishController::class, 'create']);
Route::get('/admin/horeca/dishes/edit/{id}', [App\Http\Controllers\DishController::class, 'edit']);
Route::post('dishes/store', [App\Http\Controllers\DishController::class, 'store']);
Route::put('dishes/update/{id}', [App\Http\Controllers\DishController::class, 'update']);
Route::get('dishes/delete/{id}', [App\Http\Controllers\DishController::class, 'delete']);

Route::get('/admin/horeca/dishes/types/list', [App\Http\Controllers\DishController::class, 'getDishTypes']);
Route::get('/admin/horeca/dishes/types/create', [App\Http\Controllers\DishController::class, 'createType']);
Route::get('/admin/horeca/dishes/types/edit{id}', [App\Http\Controllers\DishController::class, 'editType']);
Route::post('dishes/types/store', [App\Http\Controllers\DishController::class, 'storeType']);
Route::post('dishes/types/update/{id}', [App\Http\Controllers\DishController::class, 'updateType']);
Route::get('dishes/types/delete/{id}', [App\Http\Controllers\DishController::class, 'deleteType']);

//Boissons
Route::get('/admin/horeca/drinks/list', [App\Http\Controllers\DrinkController::class, 'list']);
Route::get('/admin/horeca/drinks', [App\Http\Controllers\DrinkController::class, 'getDrinks']);
Route::get('/admin/horeca/drinks/filter', [App\Http\Controllers\DrinkController::class, 'filterDrinks']);
Route::get('/admin/horeca/drinks/create', [App\Http\Controllers\DrinkController::class, 'create']);
Route::get('/admin/horeca/drinks/edit/{id}', [App\Http\Controllers\DrinkController::class, 'edit']);
Route::post('drinks/store', [App\Http\Controllers\DrinkController::class, 'store']);
Route::put('drinks/update/{id}', [App\Http\Controllers\DrinkController::class, 'update']);
Route::get('drinks/delete/{id}', [App\Http\Controllers\DrinkController::class, 'delete']);

Route::get('/admin/horeca/drinks/types/list', [App\Http\Controllers\DrinkController::class, 'getDrinkTypes']);
Route::get('/admin/horeca/drinks/types/create', [App\Http\Controllers\DrinkController::class, 'createType']);
Route::get('/admin/horeca/drinks/types/edit{id}', [App\Http\Controllers\DrinkController::class, 'editType']);
Route::post('drinks/types/store', [App\Http\Controllers\DrinkController::class, 'storeType']);
Route::post('drinks/types/update/{id}', [App\Http\Controllers\DrinkController::class, 'updateType']);
Route::get('drinks/types/delete/{id}', [App\Http\Controllers\DrinkController::class, 'deleteType']);

//Actualités
Route::get('/admin/horeca/news/list', [App\Http\Controllers\NewsController::class, 'list']);
Route::get('/admin/horeca/news/create', [App\Http\Controllers\NewsController::class, 'create']);
Route::get('/admin/horeca/news/one/{id}', [App\Http\Controllers\NewsController::class, 'one']);
Route::get('/admin/horeca/news/edit/{id}', [App\Http\Controllers\NewsController::class, 'edit']);

//Réservations
Route::get('/admin/horeca/reservations/list', [App\Http\Controllers\ReservationController::class, 'listHoreca']);
Route::get('/admin/horeca/reservations/one/{id}', [App\Http\Controllers\ReservationController::class, 'oneHoreca']);
Route::get('/admin/horeca/reservations/edit/{id}', [App\Http\Controllers\ReservationController::class, 'editHoreca']);

//Tables
Route::get('/admin/horeca/tables/list', [App\Http\Controllers\TableController::class, 'list']);
Route::get('/admin/horeca/tables/create', [App\Http\Controllers\TableController::class, 'create']);
Route::get('/admin/horeca/tables/edit/{id}', [App\Http\Controllers\TableController::class, 'edit']);
Route::post('tables/store', [App\Http\Controllers\TableController::class, 'store']);
Route::put('tables/update/{id}', [App\Http\Controllers\TableController::class, 'update']);
Route::get('tables/delete/{id}', [App\Http\Controllers\TableController::class, 'delete']);


/**** SPORTS ****/
Route::get('/admin/sports/home', [App\Http\Controllers\AdminController::class, 'sports']);

//Terrains
Route::get('/admin/sports/fields/list', [App\Http\Controllers\FieldController::class, 'list']);
Route::get('/admin/sports/fields/create', [App\Http\Controllers\FieldController::class, 'create']);
Route::get('/admin/sports/fields/edit/{id}', [App\Http\Controllers\FieldController::class, 'edit']);
Route::post('fields/store', [App\Http\Controllers\FieldController::class, 'store']);
Route::put('fields/update/{id}', [App\Http\Controllers\FieldController::class, 'update']);
Route::get('fields/delete/{id}', [App\Http\Controllers\FieldController::class, 'delete']);
Route::get('fields/filter', [App\Http\Controllers\FieldController::class, 'filter']);


//Réservations
Route::get('/admin/sports/reservations/list', [App\Http\Controllers\ReservationController::class, 'listSports']);
Route::get('/admin/sports/reservations/one/{id}', [App\Http\Controllers\ReservationController::class, 'oneSports']);
Route::get('/admin/sports/reservations/edit/{id}', [App\Http\Controllers\ReservationController::class, 'editSports']);


//Plages horaires
Route::get('/admin/sports/timeslots/list', [App\Http\Controllers\TimeslotController::class, 'listSports']);
Route::get('/admin/sports/timeslots/create', [App\Http\Controllers\TimeslotController::class, 'create']);
Route::get('/admin/sports/timeslots/edit{id}', [App\Http\Controllers\TimeslotController::class, 'edit']);
Route::post('timeslots/store', [App\Http\Controllers\TimeslotController::class, 'store']);
Route::post('timeslots/update/{id}', [App\Http\Controllers\TimeslotController::class, 'update']);
Route::get('timeslots/delete/{id}', [App\Http\Controllers\TimeslotController::class, 'delete']);



/**** UTILISATEURS ****/
Route::get('/admin/users/list', [App\Http\Controllers\UserController::class, 'list']);
Route::get('/users/search', [App\Http\Controllers\UserController::class, 'search']);




/******* ROUTES UTILISATEURS *******/
/**** Portail Horeca ****/
Route::get('/horeca/home', [App\Http\Controllers\HorecaController::class, 'home']);
Route::get('/horeca/booking', [App\Http\Controllers\HorecaController::class, 'booking']);
Route::get('/horeca/menu', [App\Http\Controllers\HorecaController::class, 'menu']);


/**** Portail Sports ****/
Route::get('/sports/home', [App\Http\Controllers\SportsController::class, 'home']);
Route::get('/sports/planning', [App\Http\Controllers\SportsController::class, 'planning']);
Route::get('/getAvailableFieldsAndTimeslots', [App\Http\Controllers\SportsController::class, 'getAvailableFieldsAndTimeslots']);
Route::post('/setFieldType', [App\Http\Controllers\SportsController::class, 'setFieldType']);
Route::get('/booking/{date}/{field_id}/{timeslot_id}/{fieldType}', [App\Http\Controllers\SportsController::class, 'booking'])->name('booking');
Route::get('/searchUsers', [App\Http\Controllers\SportsController::class, 'searchUsers']);
Route::post('/bookingSports', [App\Http\Controllers\SportsController::class, 'setBooking']);




/**** Gestion du profil ****/
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/users/one/{id}', [App\Http\Controllers\UserController::class, 'show']);
Route::get('/users/reservations/{id}', [App\Http\Controllers\ProfileController::class, 'reservations']);
