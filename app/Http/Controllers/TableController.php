<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function list()
    {
        $tables = Table::all();
        return view('/admin/horeca/tables/list', compact('tables'));
    }

    public function create()
    {
        return view('/admin/horeca/tables/create');
    }

    public function edit($id)
    {
        $table = Table::Find($id);

        return view('/admin/horeca/tables/edit', compact('table'));

        return redirect('/admin/horeca/tables/list/' . $id)->with('success', 'Table modifiée avec succès!');
    }

    public function store(Request $request)
    {
        $table = new Table(
        [
            'number' => $request->number,
            'capacity' => $request->capacity,
            'availability' => $request->has('availability') ? 1 : 0,
        ]);

        $table->save();

        return redirect('/admin/horeca/tables/list')->with('success', 'Table ajoutée avec succès!');
    }

    public function update(Request $request, $id)
    {
        $table = Table::Find($id);
        
        $table->number = $request->number;
        $table->capacity = $request->capacity;
        $table->availability = $request->has('availability') ? 1 : 0;

        $table->update();

        return redirect('/admin/horeca/tables/edit/' . $id)->with('success', 'Table modifiée avec succès!');
    }

    public function delete($id)
    {
        $table = Table::Find($id);

        $table->delete();

        return redirect('/admin/horeca/tables/list')->with('success', 'Table supprimée avec succès!');
    }
}
