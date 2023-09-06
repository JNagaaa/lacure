<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drink;
use App\Models\DrinkType;
use Illuminate\Support\Facades\Storage;


class DrinkController extends Controller
{
    public function list()
    {
        $drinks = Drink::all();
        return view('/admin/horeca/drinks/list', compact('drinks'));
    }

    public function getDrinks()
    {
        $drinks = Drink::all();
        $drinkTypes = DrinkType::all();

        return response()->json(['success' => true, 'drinks' => $drinks, 'drinkTypes' => $drinkTypes]);
    }

    public function getDrinkTypes()
    {
        $drinkTypes = DrinkType::all();
        return view('admin/horeca/drinks/types/list', compact('drinkTypes'));
    }

    public function filterDrinks(Request $request)
    {
        $type = $request->input('type');
        
        if ($type) {
            $drinks = Drink::where('type_id', $type)->paginate(30);
        } else {
            $drinks = Drink::paginate(30);
        }
        
        return response()->json(['success' => true, 'drinksByType' => $drinks]);
    }

    public function create()
    {
        $drinkTypes = DrinkType::all();
        return view('/admin/horeca/drinks/create', compact('drinkTypes'));
    }

    public function createType()
    {
        return view('/admin/horeca/drinks/types/create');
    }

    public function edit($id)
    {
        $drink = Drink::Find($id);
        $drinkTypes = DrinkType::all();

        return view('/admin/horeca/drinks/edit', compact('drink', 'drinkTypes'));

        return redirect('/admin/horeca/drinks/list/' . $id)->with('success', 'Boisson modifiée avec succès!');
    }

    public function editType($id)
    {
        $drinkType = DrinkType::Find($id);
        return view('/admin/horeca/drinks/types/edit', compact('drinkType'));
    }

    public function store(Request $request)
    {
        if($request->image != NULL)
        {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            $imageName = time().'.'.$request->image->extension();
            $request->image->storeAs('images', $imageName);
        }

        $drink = new Drink(
        [
            'name' => $request->name,
            'type_id' => $request->type_id,
            'image' => $request->image == NULL ? 'defaultDrink.png' : $imageName,
            'description' => $request->description,
        ]);

        $drink->save();

        return redirect('/admin/horeca/drinks/list')->with('success', 'Boisson ajoutée avec succès!');
    }

    public function storeType(Request $request)
    {
        $drinkType = new DrinkType(
        [
            'name' => $request->name,
        ]);

        $drinkType->save();

        return redirect('/admin/horeca/drinks/list')->with('success', 'Type de boisson ajouté avec succès!');
    }

    public function update(Request $request, $id)
    {
        $drink = Drink::Find($id);
        
        $drink->name = $request->name;
        $drink->type_id = $request->type_id;
        $drink->description = $request->description;

        if($request->image != NULL)
        {
            Storage::delete('images/'.$drink->image);
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);
            $imageName = time().'.'.$request->image->extension();
            
            $drink->image = $imageName;
            $request->image->storeAs('images', $imageName);
        }

        $drink->update();

        return redirect('/admin/horeca/drinks/edit/' . $id)->with('success', 'Boisson modifiée avec succès!');
    }

    public function updateType(Request $request, $id)
    {
        $drinkType = DrinkType::Find($id);
        
        $drinkType->name = $request->name;

        $drinkType->update();

        return redirect('/admin/horeca/drinks/list')->with('success', 'Type de boisson modifié avec succès!');
    }

    public function delete($id)
    {
        $drink = Drink::Find($id);

        $drink->delete();

        return redirect('/admin/horeca/drinks/list')->with('success', 'Boisson supprimée avec succès!');
    }

    public function deleteType($id)
    {
        $drinkType = DrinkType::Find($id);

        $drinkType->delete();

        return redirect('/admin/horeca/drinks/list')->with('success', 'Type de boisson supprimé avec succès!');
    }
}
