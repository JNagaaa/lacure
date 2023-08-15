<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Drink;
use App\Models\Dish;
use App\Models\DrinkType;
use App\Models\DishType;
use App\Models\Table;
use App\Models\Reservation;
use App\Models\ReservationUser;
use App\Models\Timeslot;


class HorecaController extends Controller
{
    
    public function home()
    {
        return view('horeca/home');
    }


    public function booking()
    {
        return view('horeca/planning');
    }

    public function bookingTable(Request $request)
    {
        $reservation = new Reservation(
            [
                'date' => $request->date,
                'table_id' => $request->table_id,
                'timeslot_id' => $request->timeslot_id,
                'section_id' => 1,
            ]);
        
        $reservation->save();

        $reservationId = $reservation->id;

        $reservationUser = new ReservationUser(
            [
                'reservation_id' => $reservationId,
                'user_id' => Auth::user()->id,
            ]);
        
        $reservationUser->save();
    }

    public function planning()
    {
        $tables = Table::all();
        $date = $_GET['date'];

        $reservations = Reservation::where('section_id', 1)
                                    ->where('date', $date)
                                    ->get();

        $timeslots = Timeslot::where('section_id', 1)->get();
        return view('horeca/planning', compact('tables', 'date', 'reservations', 'timeslots'));
    }


    public function menu()
    {
        $dishes = Dish::all();
        $drinks = Drink::all();
        $drinkTypes = DrinkType::all();
        $dishTypes = DishType::all();
        return view('horeca/menu', compact('dishes', 'drinks', 'dishTypes', 'drinkTypes'));
    }

    public function getDishes()
    {
        $dishes = Dish::all();
        $dishTypes = DishType::all();

        return response()->json(['success' => true, 'dishes' => $dishes, 'dishTypes' => $dishTypes]);
    }

    public function getDishTypes()
    {
        $dishTypes = DishType::all(); // Assuming you have a DishType model for your dish types
        return view('admin/horeca/dishes/types/list', compact('dishTypes'));
    }

    public function filterDishes(Request $request)
    {
        $type = $request->input('type');
        
        // Récupérer les plats filtrés en fonction du type
        if ($type) {
            $dishes = Dish::where('type_id', $type)->paginate(30);
        } else {
            $dishes = Dish::paginate(30);
        }
        
        return response()->json(['success' => true, 'dishesByType' => $dishes]);
    }

    public function getDrinks()
    {
        $drinks = Drink::all();
        $drinkTypes = DrinkType::all();

        return response()->json(['success' => true, 'drinks' => $drinks, 'drinkTypes' => $drinkTypes]);
    }

    public function getDrinkTypes()
    {
        $drinkTypes = DrinkType::all(); // Assuming you have a DishType model for your dish types
        return view('admin/horeca/drinks/types/list', compact('drinkTypes'));
    }

    public function filterDrinks(Request $request)
    {
        $type = $request->input('type');
        
        // Récupérer les plats filtrés en fonction du type
        if ($type) {
            $drinks = Drink::where('type_id', $type)->paginate(30);
        } else {
            $drinks = Drink::paginate(30);
        }
        
        return response()->json(['success' => true, 'drinksByType' => $drinks]);
    }


}
