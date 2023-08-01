<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeslot;

class TimeslotController extends Controller
{
    public function listSports()
    {
        $timeslots = Timeslot::where('section_id', 2)->get();
        return view('/admin/sports/timeslots/list', compact('timeslots'));
    }

    public function listHoreca()
    {
        $timeslots = Timeslot::where('section_id', 1)->get();
        return view('/admin/horeca/timeslots/list', compact('timeslots'));
    }

    public function create()
    {
        return view('/admin/sports/timeslots/create');
    }

    public function store(Request $request)
    {
        $timeslot = new Timeslot(
        [
            'start_time' => $request->start_time,
            'end_time' => $request->end_time ? $request->end_time : NULL,
            'section_id' => $request->section_id,
        ]);

        $timeslot->save();
        return response()->json(['success' => true, 'startTime' => $request->start_time, 'endTime' => $request->end_time]);
    }

    public function update(Request $request, $id)
    {
        $timeslot = Timeslot::Find($id);
        
        $timeslot->start_time = $request->start_time;
        $timeslot->end_time = $request->end_time;

        $timeslot->update();
        
    }

    public function delete($id)
    {
        $timeslot = Timeslot::Find($id);
        $timeslot->delete();

    }
}
