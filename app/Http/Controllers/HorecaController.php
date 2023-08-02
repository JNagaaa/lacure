<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\Dish;
use App\Models\DrinkType;
use App\Models\DishType;


class HorecaController extends Controller
{
    
    public function home()
    {
        return view('horeca/home');
    }


    public function booking()
    {
        return view('horeca/booking');
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
