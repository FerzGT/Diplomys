<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Place;
use App\Models\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $halls = Hall::with('seat')->get();
        $place = Place::all();
        $movies = Movie::query()->paginate(10);
        $seances = Session::with('movie')->get();

        return view('admin.index', [
            'halls' => $halls,
            'movies' => $movies,
            'seances' => $seances,
            'place' => $place,
        ]);
    }
    
    public function addMovie(MovieStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Movie::create([
            'title' => Arr::get($validated, 'name'), //$validated['name']
            'duration' => Arr::get($validated, 'duration'), //$validated['duration'],
        ]);

        return redirect()->back();
    }


    public function deleteMovie(int $id): RedirectResponse
    {
        Movie::destroy($id);

        return redirect('admin/index');
    }   
}
