<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{

    public function list()
    {
        $fields = Field::all();
        return view('/admin/sports/fields/list', compact('fields'));
    }

    public function create()
    {
        return view('/admin/sports/fields/create');
    }

    public function edit($id)
    {
        $field = Field::Find($id);
        return view('/admin/sports/fields/edit', compact('field'));
    }

    public function store(Request $request)
    {
        $field = new Field(
        [
            'number' => $request->number,
            'type' => $request->type,
            'availability' => $request->has('availability') ? 1 : 0,
        ]);

        $field->save();

        return redirect('/admin/sports/fields/list')->with('success', 'Annonce ajoutée avec succès!');
    }

    public function update(Request $request, $id)
    {
        $field = Field::Find($id);
        
        $field->number = $request->number;
        $field->type = $request->type;
        $field->availability = $request->has('availability') ? 1 : 0;

        $field->update();

        return redirect('/admin/sports/fields/edit/' . $id)->with('success', 'Terrain modifié avec succès!');
    }

    public function delete($id)
    {
        $field = Field::Find($id);

        $field->delete();

        return redirect('/admin/sports/fields/list')->with('success', 'Terrain supprimé avec succès!');
    }

    public function filter(Request $request)
    {
        $type = $request->input('type');

        // Récupérer les terrains filtrés en fonction du type
        if ($type == "all") {
            $fields = Field::paginate(30);
        } else {
            $fields = Field::where('type', $type)->paginate(30);
        }

        $response = [
            'success' => true,
            'message' => 'Filtrage réussi.',
            'data' => $fields,
        ];

        return response()->json($response);
    }
    
}
