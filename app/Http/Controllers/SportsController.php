<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Timeslot;
use App\Models\Reservation;
use App\Models\ReservationUser;
use App\Models\User;
use App\Models\News;
use App\Notifications\ReservationNotification;
use Illuminate\Support\Facades\Notification;




class SportsController extends Controller
{
    
    public function home()
    {
        $allNews = News::where('section_id', 2)->orderBy('created_at', 'desc')->paginate(5);
        return view('sports/home', compact('allNews'));
    }


    public function planning(Request $request)
    {
        $date = $_GET['date'];
        $fieldType = $request->input('fieldType', '');

        $reservations = Reservation::where('section_id', 2)
                                    ->where('date', $date)
                                    ->get();

        $timeslots = Timeslot::where('section_id', 2)->get();
        $fields = Field::all();
        return view('sports.planning', compact('fields', 'timeslots', 'reservations', 'date'));
    }

    public function setFieldType(Request $request)
    {
        $fieldType = $request->input('fieldType');

        // Si le paramètre fieldType n'est pas présent ou vide, récupérer tous les terrains
        if (empty($fieldType)) {
            $fields = Field::all();
        } else {
            $fields = Field::where('type', $fieldType)->get();
        }

        $date = $request->input('date'); // Récupérer la date depuis la requête GET

        $reservations = Reservation::where('section_id', 2)
                                    ->where('date', $date)
                                    ->get();
        $timeslots = Timeslot::where('section_id', 2)->get();

        // Passer toutes les données nécessaires à la vue "sports.fields"
        return view('sports.fields', compact('fields', 'timeslots', 'reservations', 'date'));
    }

    public function booking($date, $field_id, $timeslot_id, $fieldType)
    {
        $users = User::all();
        return view('sports.booking', compact('date', 'field_id', 'timeslot_id', 'fieldType', 'users'));
    }

    public function searchUsers(Request $request)
    {
        $term = $request->input('term');

        // Effectuer la recherche sur les utilisateurs par leur nom ou leur prénom
        $users = User::where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $term . '%')
                    ->get();

        return response()->json($users);
    }

    public function setBooking(Request $request)
{
    $userIds = $request->input('selectedUsers');
    $errors = [];

    // Vérification des erreurs potentielles
    foreach ($userIds as $index => $userId) {
        if ($userId) {
            $userObject = User::find($userId);
            if ($userObject->hrsremaining <= 0) {
                $errors["selectedUsers.$index"] = "$userObject->name $userObject->lastname a atteint son quota de sessions pour ce mois";
            }
        }
    }

    // Si des erreurs ont été trouvées, renvoyez-les
    if (count($errors) > 0) {
        return redirect()->back()->withErrors($errors);
    }

    // Sinon, créez la réservation et continuez
    $reservation = new Reservation([
        'date' => $request->input('date'),
        'field_id' => $request->input('field_id'),
        'timeslot_id' => $request->input('timeslot_id'),
        'section_id' => 2,
    ]);

    $reservation->save();
    $reservationId = $reservation->id;

    // Création des associations entre les utilisateurs et la réservation
    foreach ($userIds as $userId) {
        if ($userId) {
            $userObject = User::find($userId);
            $reservationUser = new ReservationUser([
                'user_id' => $userId,
                'reservation_id' => $reservationId,
            ]);

            $userObject->hrsremaining -= 1;

            $reservationUser->save();
            $userObject->save();
        }
    }

    $admins = User::where('admin', 1)->get();
    Notification::send($admins, new ReservationNotification($reservation));

    return redirect('/users/reservations/one/' . $reservationId)->with('success', 'Réservation enregistrée avec succès!');
}




}
