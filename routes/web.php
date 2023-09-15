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


/********** ROUTES DIVERSES **********/
// Routes vers la page d'accueil
Route::get('/', function () {
    return view('home');
})->middleware('verified');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

// Route vers les conditions d'utilisation
Route::get('/conditions', [App\Http\Controllers\HomeController::class, 'conditions']);


//Routes d'authentification
Auth::routes(['verify' => true]);



/******* ROUTES D'ADMINISTRATION *******/
/**** HORECA ****/
Route::get('/admin/horeca/home', [App\Http\Controllers\AdminController::class, 'horeca'])->middleware('verified', 'admin');

//Plats
Route::get('/admin/horeca/dishes/list', [App\Http\Controllers\DishController::class, 'list'])->middleware('verified', 'admin');
Route::get('/admin/horeca/dishes', [App\Http\Controllers\DishController::class, 'getDishes'])->middleware('verified', 'admin');
Route::get('/admin/horeca/dishes/filter', [App\Http\Controllers\DishController::class, 'filterDishes'])->middleware('verified');
Route::get('/admin/horeca/dishes/create', [App\Http\Controllers\DishController::class, 'create'])->middleware('verified', 'admin');
Route::get('/admin/horeca/dishes/edit/{id}', [App\Http\Controllers\DishController::class, 'edit'])->middleware('verified', 'admin');
Route::post('dishes/store', [App\Http\Controllers\DishController::class, 'store'])->middleware('verified', 'admin');
Route::put('dishes/update/{id}', [App\Http\Controllers\DishController::class, 'update'])->middleware('verified', 'admin');
Route::get('dishes/delete/{id}', [App\Http\Controllers\DishController::class, 'delete'])->middleware('verified', 'admin');

//Types de plat
Route::get('/admin/horeca/dishes/types/list', [App\Http\Controllers\DishController::class, 'getDishTypes'])->middleware('verified', 'admin');
Route::get('/admin/horeca/dishes/types/create', [App\Http\Controllers\DishController::class, 'createType'])->middleware('verified', 'admin');
Route::get('/admin/horeca/dishes/types/edit{id}', [App\Http\Controllers\DishController::class, 'editType'])->middleware('verified', 'admin');
Route::post('dishes/types/store', [App\Http\Controllers\DishController::class, 'storeType'])->middleware('verified', 'admin');
Route::post('dishes/types/update/{id}', [App\Http\Controllers\DishController::class, 'updateType'])->middleware('verified', 'admin');
Route::get('dishes/types/delete/{id}', [App\Http\Controllers\DishController::class, 'deleteType'])->middleware('verified', 'admin');

//Boissons
Route::get('/admin/horeca/drinks/list', [App\Http\Controllers\DrinkController::class, 'list'])->middleware('verified', 'admin');
Route::get('/admin/horeca/drinks', [App\Http\Controllers\DrinkController::class, 'getDrinks'])->middleware('verified', 'admin');
Route::get('/admin/horeca/drinks/filter', [App\Http\Controllers\DrinkController::class, 'filterDrinks'])->middleware('verified');
Route::get('/admin/horeca/drinks/create', [App\Http\Controllers\DrinkController::class, 'create'])->middleware('verified', 'admin');
Route::get('/admin/horeca/drinks/edit/{id}', [App\Http\Controllers\DrinkController::class, 'edit'])->middleware('verified', 'admin');
Route::post('drinks/store', [App\Http\Controllers\DrinkController::class, 'store'])->middleware('verified', 'admin');
Route::put('drinks/update/{id}', [App\Http\Controllers\DrinkController::class, 'update'])->middleware('verified', 'admin');
Route::get('drinks/delete/{id}', [App\Http\Controllers\DrinkController::class, 'delete'])->middleware('verified', 'admin');


//Types de boisson
Route::get('/admin/horeca/drinks/types/list', [App\Http\Controllers\DrinkController::class, 'getDrinkTypes'])->middleware('verified', 'admin');
Route::get('/admin/horeca/drinks/types/create', [App\Http\Controllers\DrinkController::class, 'createType'])->middleware('verified', 'admin');
Route::get('/admin/horeca/drinks/types/edit{id}', [App\Http\Controllers\DrinkController::class, 'editType'])->middleware('verified', 'admin');
Route::post('drinks/types/store', [App\Http\Controllers\DrinkController::class, 'storeType'])->middleware('verified', 'admin');
Route::post('drinks/types/update/{id}', [App\Http\Controllers\DrinkController::class, 'updateType'])->middleware('verified', 'admin');
Route::get('drinks/types/delete/{id}', [App\Http\Controllers\DrinkController::class, 'deleteType'])->middleware('verified', 'admin');

//Actualités
Route::get('/admin/horeca/news/list', [App\Http\Controllers\AdminController::class, 'listNewsHoreca'])->middleware('verified', 'admin');
Route::get('/admin/horeca/news/create', [App\Http\Controllers\NewsController::class, 'createHoreca'])->middleware('verified', 'admin');
Route::get('/admin/horeca/news/one/{id}', [App\Http\Controllers\AdminController::class, 'one'])->middleware('verified', 'admin');
Route::get('/admin/horeca/news/edit/{id}', [App\Http\Controllers\AdminController::class, 'editNewsHoreca'])->middleware('verified', 'admin');
Route::post('news/storeHoreca', [App\Http\Controllers\NewsController::class, 'store'])->middleware('verified', 'admin');
Route::put('news/updateHoreca/{id}', [App\Http\Controllers\AdminController::class, 'updateNewsHoreca'])->middleware('verified', 'admin');
Route::get('news/deleteHoreca/{id}', [App\Http\Controllers\AdminController::class, 'deleteNewsHoreca'])->middleware('verified', 'admin');


//Tables
Route::get('/admin/horeca/tables/list', [App\Http\Controllers\TableController::class, 'list'])->middleware('verified', 'admin');
Route::get('/admin/horeca/tables/create', [App\Http\Controllers\TableController::class, 'create'])->middleware('verified', 'admin');
Route::get('/admin/horeca/tables/edit/{id}', [App\Http\Controllers\TableController::class, 'edit'])->middleware('verified', 'admin');
Route::post('tables/store', [App\Http\Controllers\TableController::class, 'store'])->middleware('verified', 'admin');
Route::put('tables/update/{id}', [App\Http\Controllers\TableController::class, 'update'])->middleware('verified', 'admin');
Route::get('tables/delete/{id}', [App\Http\Controllers\TableController::class, 'delete'])->middleware('verified', 'admin');


//Plages horaires
Route::get('/admin/horeca/timeslots/list', [App\Http\Controllers\TimeslotController::class, 'listHoreca'])->middleware('verified', 'admin');
Route::get('/admin/horeca/timeslots/create', [App\Http\Controllers\TimeslotController::class, 'createHoreca'])->middleware('verified', 'admin');



/**** SPORTS ****/
Route::get('/admin/sports/home', [App\Http\Controllers\AdminController::class, 'sports'])->middleware('verified', 'admin');

//Terrains
Route::get('/admin/sports/fields/list', [App\Http\Controllers\FieldController::class, 'list'])->middleware('verified', 'admin');
Route::get('/admin/sports/fields/create', [App\Http\Controllers\FieldController::class, 'create'])->middleware('verified', 'admin');
Route::get('/admin/sports/fields/edit/{id}', [App\Http\Controllers\FieldController::class, 'edit'])->middleware('verified', 'admin');
Route::post('fields/store', [App\Http\Controllers\FieldController::class, 'store'])->middleware('verified', 'admin');
Route::put('fields/update/{id}', [App\Http\Controllers\FieldController::class, 'update'])->middleware('verified', 'admin');
Route::get('fields/delete/{id}', [App\Http\Controllers\FieldController::class, 'delete'])->middleware('verified', 'admin');
Route::get('fields/filter', [App\Http\Controllers\FieldController::class, 'filter'])->middleware('verified');


//Plages horaires
Route::get('/admin/sports/timeslots/list', [App\Http\Controllers\TimeslotController::class, 'listSports'])->middleware('verified', 'admin');
Route::get('/admin/sports/timeslots/create', [App\Http\Controllers\TimeslotController::class, 'create'])->middleware('verified', 'admin');
Route::get('/admin/sports/timeslots/edit{id}', [App\Http\Controllers\TimeslotController::class, 'edit'])->middleware('verified', 'admin');
Route::post('timeslots/store', [App\Http\Controllers\TimeslotController::class, 'store'])->middleware('verified', 'admin');
Route::post('timeslots/update/{id}', [App\Http\Controllers\TimeslotController::class, 'update'])->middleware('verified', 'admin');
Route::get('timeslots/delete/{id}', [App\Http\Controllers\TimeslotController::class, 'delete'])->middleware('verified', 'admin');


//Actualités
Route::get('admin/sports/news/list', [App\Http\Controllers\AdminController::class, 'listNews'])->middleware('verified', 'admin');
Route::get('admin/sports/news/create', [App\Http\Controllers\NewsController::class, 'create'])->middleware('verified', 'admin');
Route::get('admin/sports/news/edit/{id}', [App\Http\Controllers\AdminController::class, 'editNews'])->middleware('verified', 'admin');
Route::get('admin/sports/news/delete/{id}', [App\Http\Controllers\AdminController::class, 'deleteNews'])->middleware('verified', 'admin');
Route::post('news/store', [App\Http\Controllers\NewsController::class, 'store'])->middleware('verified', 'admin');
Route::put('news/update/{id}', [App\Http\Controllers\AdminController::class, 'updateNews'])->middleware('verified', 'admin');
Route::get('news/delete/{id}', [App\Http\Controllers\NewsController::class, 'delete'])->middleware('verified', 'admin');



/**** UTILISATEURS ****/
Route::get('/admin/users/list', [App\Http\Controllers\UserController::class, 'list'])->middleware('verified', 'admin');
Route::get('/users/search', [App\Http\Controllers\UserController::class, 'search'])->middleware('verified');
Route::get('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->middleware('verified', 'manageProfile');
Route::get('/users/renewMember/{id}', [App\Http\Controllers\UserController::class, 'renewMember'])->middleware('verified', 'admin');



/**** NOTIFICATIONS ****/


Route::get('notifications/fetch', [App\Http\Controllers\NotificationController::class, 'fetch'])->name('notifications.fetch');
Route::get('/notifications/unread', [App\Http\Controllers\NotificationController::class, 'getUnreadNotifications']);
Route::put('notifications/mark-as-read/{notification}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');







/******* ROUTES UTILISATEURS *******/
/**** Portail Horeca ****/
Route::get('/horeca/home', [App\Http\Controllers\HorecaController::class, 'home'])->middleware('verified');
Route::get('/bookingTable/{date}/{table_id}/{timeslot_id}', [App\Http\Controllers\HorecaController::class, 'booking'])->name('bookingTable')->middleware('verified');
Route::post('/bookingHoreca', [App\Http\Controllers\HorecaController::class, 'setBooking'])->middleware('verified');
Route::get('/horeca/menu', [App\Http\Controllers\HorecaController::class, 'menu'])->middleware('verified');
Route::get('/horeca/menu/dishes', [App\Http\Controllers\HorecaController::class, 'getDishes'])->middleware('verified');
Route::get('/horeca/menu/dishes/filter', [App\Http\Controllers\HorecaController::class, 'filterDishes'])->middleware('verified');
Route::get('/horeca/menu/drinks', [App\Http\Controllers\HorecaController::class, 'getDrinks'])->middleware('verified');
Route::get('/horeca/menu/drinks/filter', [App\Http\Controllers\HorecaController::class, 'filterDrinks'])->middleware('verified');
Route::get('/horeca/planning', [App\Http\Controllers\HorecaController::class, 'planning'])->middleware('verified');
Route::get('/getAvailableTablesAndTimeslots', [App\Http\Controllers\HorecaController::class, 'getAvailableFieldsAndTimeslots'])->middleware('verified');

/**** Portail Sports ****/
Route::get('/sports/home', [App\Http\Controllers\SportsController::class, 'home'])->middleware('verified');
Route::get('/sports/planning', [App\Http\Controllers\SportsController::class, 'planning'])->middleware('verified');
Route::get('/getAvailableFieldsAndTimeslots', [App\Http\Controllers\SportsController::class, 'getAvailableFieldsAndTimeslots'])->middleware('verified');
Route::post('/setFieldType', [App\Http\Controllers\SportsController::class, 'setFieldType'])->middleware('verified');
Route::get('/booking/{date}/{field_id}/{timeslot_id}/{fieldType}', [App\Http\Controllers\SportsController::class, 'booking'])->name('booking')->middleware('verified');
Route::get('/searchUsers', [App\Http\Controllers\SportsController::class, 'searchUsers'])->middleware('verified');
Route::post('/bookingSports', [App\Http\Controllers\SportsController::class, 'setBooking'])->middleware('verified');
Route::get('sports/news/one/{id}', [App\Http\Controllers\NewsController::class, 'show'])->middleware('verified');





/**** Gestion du profil ****/
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->middleware('verified', 'manageProfile');
Route::get('/users/one/{id}', [App\Http\Controllers\UserController::class, 'show'])->middleware('verified');
Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('verified', 'manageProfile');
Route::get('/users/reservations/one/{id}', [App\Http\Controllers\ReservationController::class, 'show'])->middleware('verified', 'adminOrSelf');
Route::get('/users/reservations/delete/{id}', [App\Http\Controllers\ReservationController::class, 'delete'])->middleware('verified', 'adminOrSelf');
Route::get('/users/reservations/{id}', [App\Http\Controllers\ReservationController::class, 'home'])->middleware('verified', 'manageProfile');
Route::get('/reservations/listSports/{id}', [App\Http\Controllers\ReservationController::class, 'listSports'])->middleware('verified', 'manageProfile');
Route::get('/reservations/listHoreca/{id}', [App\Http\Controllers\ReservationController::class, 'listHoreca'])->middleware('verified', 'manageProfile');
Route::get('/reservations/list/{id}', [App\Http\Controllers\ReservationController::class, 'list'])->middleware('verified', 'manageProfile');
Route::get('/auth/passwords/edit', [App\Http\Controllers\PasswordController::class, 'edit'])->middleware('verified', 'manageProfile');
Route::post('/auth/passwords/update', [App\Http\Controllers\PasswordController::class, 'update'])->middleware('verified', 'manageProfile');

/******** GESTION IMAGES ********/
Route::get('storage/{file}', function ($file) {
    $path = storage_path('app' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $file);
    return response()->file($path);
});

Route::get('images/{file}', function ($file) {
    $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $file);
    return response()->file($path);
});
