<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;
use Carbon\Carbon;



class DisponibilitesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        // Ajoutez cette ligne pour extraire la date à partir de la valeur 'start'
        $jour = Carbon::parse($request->start)->toDateString();

        Disponibilite::create([
            'start' => $request->start,
            'end' => $request->end,
            'jour' => $jour, // Ajout de la date à la création
            'usager_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'Disponibilité créée avec succès'], 200);
    }

    public function index()
{
    $disponibilites = Disponibilite::where('usager_id', auth()->id())->get(['id', 'start', 'end']);
    return response()->json($disponibilites);
}

public function destroy($id)
{
    $disponibilite = Disponibilite::findOrFail($id);
    $disponibilite->delete();

    return response()->json(['message' => 'Disponibilité supprimée avec succès'], 200);
}

}

