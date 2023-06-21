<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\DishType;

class DishController extends Controller
{
    public function list()
    {
        $dishes = Dish::all();
        return view('/admin/horeca/dishes/list', compact('dishes'));
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

    public function create()
    {
        $dishTypes = DishType::all();
        return view('/admin/horeca/dishes/create', compact('dishTypes'));
    }

    public function createType()
    {
        return view('/admin/horeca/dishes/types/create');
    }

    public function edit($id)
    {
        $dish = Dish::Find($id);
        $dishTypes = DishType::all();

        return view('/admin/horeca/dishes/edit', compact('dish', 'dishTypes'));

        return redirect('/admin/horeca/dishes/list/' . $id)->with('success', 'Plat modifié avec succès!');
    }

    public function editType($id)
    {
        $dishType = DishType::Find($id);
        return view('/admin/horeca/dishes/types/edit', compact('dishType'));
    }

    public function store(Request $request)
    {
        $dish = new Dish(
        [
            'name' => $request->name,
            'type_id' => $request->type_id,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        $dish->save();

        return redirect('/admin/horeca/dishes/list')->with('success', 'Plat ajouté avec succès!');
    }

    public function storeType(Request $request)
    {
        $dishType = new DishType(
        [
            'name' => $request->name,
        ]);

        $dishType->save();

        return redirect('/admin/horeca/dishes/list')->with('success', 'Type de plat ajouté avec succès!');
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::Find($id);
        
        $dish->name = $request->name;
        $dish->type_id = $request->type_id;
        $dish->price = $request->price;
        $dish->description = $request->description;

        $dish->update();

        return redirect('/admin/horeca/dishes/edit/' . $id)->with('success', 'Plat modifié avec succès!');
    }

    public function updateType(Request $request, $id)
    {
        $dishType = DishType::Find($id);
        
        $dishType->name = $request->name;

        $dishType->update();

        return redirect('/admin/horeca/dishes/list')->with('success', 'Type de plat modifié avec succès!');
    }

    public function delete($id)
    {
        $dish = Dish::Find($id);

        $dish->delete();

        return redirect('/admin/horeca/dishes/list')->with('success', 'Plat supprimé avec succès!');
    }

    public function deleteType($id)
    {
        $dishType = DishType::Find($id);

        $dishType->delete();

        return redirect('/admin/horeca/dishes/list')->with('success', 'Type de plat supprimé avec succès!');
    }
}
