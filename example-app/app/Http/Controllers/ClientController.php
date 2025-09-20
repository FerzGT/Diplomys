<?php

namespace App\Http\Controllers;


use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Place;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
     public function index()
    {
        $halls = Hall::query()->where(['is_open' => true])->get();
        $movies = Movie::with('sessions')->get();
        $seances = Session::all();

        return view('client.index', [
            'halls' => $halls,
            'movies' => $movies,
            'seances' => $seances,
        ]);
    }

    public function hall(int $id)
    {
        $seance = Session::with(['movie','hall'])->get()->findOrFail($id);
        $Place = Place::query()->where(['hall_id' => $seance->hall_id])->get();

        return view('client.hall', ['seance' => $seance, 'seats'=> $Place]);
    }

    public function payment(Request $request, int $id)
    {
        $seance = Session::with(['movie','hall'])->get()->findOrFail($id);

        return view('client.payment', ['seance' => $seance]);
    }

    public function ticket(Request $request, int $id)
    {
        $seance = Session::with(['movie','hall'])->get()->findOrFail($id);

        return view('client.ticket', ['seance' => $seance]);
    }
}
