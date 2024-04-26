<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;

use App\Models\Usager;
use Illuminate\Support\Facades\Hash;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Rencontre;
use App\Models\Disponibilite;


class RencontresController extends Controller
{

    public function index() {
        $userId = auth()->id(); 
        $rencontres = Rencontre::where('tuteur_id', $userId)
                                ->orWhere('eleve_id', $userId)
                                ->get();  

            foreach ($rencontres as $rencontre) {
             if ($rencontre->heure_fin < now() && $rencontre->status !== 'terminé') {
              $rencontre->update(['status' => 'terminé']);
              }
                 }
                            
                                
             $rencontres = Rencontre::where('tuteur_id', $userId)
                    ->orWhere('eleve_id', $userId)
                    ->get();
                            
    
        return view('Tutorat.rencontre', compact('rencontres'));  
    }

    public function destroy($id)
{
    $rencontre = Rencontre::findOrFail($id);
    $rencontre->delete();
    return redirect()->route('Tutorat.rencontre')->with('success', 'Rencontre annulée avec succès.');
}

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tuteur_id' => 'required',
            'eleve_id' => 'required',
            'heure_debut' => 'required|date',
            'heure_fin' => 'required|date',
            'tuteur_disponibilite_id' => 'required',
        ]);
    
        $rencontre = Rencontre::create($validated);

        $tuteurDisponibilite = Disponibilite::findOrFail($request->tuteur_disponibilite_id);
        $eleveDisponibilite = Disponibilite::where('usager_id', $validated['eleve_id'])
                                           ->where('start', $tuteurDisponibilite->start)
                                           ->where('end', $tuteurDisponibilite->end)
                                           ->first();

                                           $eleveDisponibilite->delete();
                                           $tuteurDisponibilite->delete();
    
        return redirect()->route('Tutorat.rencontre')->with('success', 'Rencontre réservée avec succès!');
    }
    
}
