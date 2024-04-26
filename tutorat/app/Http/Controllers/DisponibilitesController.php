<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disponibilite;
use Carbon\Carbon;
use App\Models\Rencontre;



class DisponibilitesController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'start' => 'required|date|after:now',  
            'end' => 'required|date|after:start',          
        ], [    
            'start.after' => 'La date et l\'heure de début doivent être dans le futur.',
            'end.after' => 'La date de fin doit être après la date de début.',
        ]);
           // Vérifier si une rencontre est déjà prévue pendant cette période
    $existingMeeting = Rencontre::where(function ($query) use ($request) {
        $query->where('eleve_id', auth()->id())
              ->orWhere('tuteur_id', auth()->id());
    })
    ->where('status', 'à venir')
    ->where('heure_debut', '<', $request->end)
    ->where('heure_fin', '>', $request->start)
    ->exists();

    if ($existingMeeting) {
        return response()->json(['message' => 'Vous avez déjà une rencontre prévue à cette période.'], 409);
    }
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
    Disponibilite::where('usager_id', auth()->id())
    ->where('end', '<', Carbon::now())
    ->delete();
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

