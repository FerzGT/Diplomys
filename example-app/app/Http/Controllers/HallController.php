<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Place;
use App\Models\Session;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HallController extends Controller
{
   public function create(HallStoreRequest $request)  //: RedirectResponse
    {
        $validated = $request->validated();
        $hall = Hall::query()->create([
            'name' => $validated['name']
        ]);
        
        for ($i = 0; $i < 6; $i++) {
            Place::query()->create([
                'hall_id' => $hall->id,
                'type_Place' => 'st',
            ]);
        }

        return redirect()->back();
    }

    public function delete(int $id) //: RedirectResponse
    {
        $sessions = Session::all();
        foreach ($sessions as $session) {
            if ($session->hall_id === $id) {
                Session::destroy($session->id);
            }
        }
        Place::query()->where(['hall_id' => $id])->delete();
        Hall::destroy($id);

        return redirect('admin/index');
    }

    public function update(Request $request, Hall $hall)
    {
        $hall->fill($request->all());
        $hall->save();

        return response()->json($hall);
    }

    public function updateSeats(Request $request, int $id)
    {
        Place::query()->where(['hall_id' => $id])->delete();
        $newSeats = $request->json();
        foreach ($newSeats as $newSeat) {
            Place::query()->create($newSeat);
        }
        $seats = Place::all();
        
        return response()->json($seats);
    }
}
