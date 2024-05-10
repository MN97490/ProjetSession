<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Domaine;
use App\Models\Note;
use App\Http\Requests\MatiereRequest;
use App\Models\Usager;
use Auth;
use Log;
class MatieresController extends Controller
{
    public function index()
    {
        $matieres = Matiere::all();
        return $matieres;
    }
    public function store(Request $request)
    {
        try {
          
            $validatedData = $request->validate([
                'nomMatiere' => 'required|string|max:255|unique:matieres',
              
            ]);
    
         
            $matiere = new Matiere();
            $matiere->nomMatiere = $validatedData['nomMatiere'];
         
            $matiere->save();
            
        
            return redirect()->back()->with('success', 'La matière a été ajoutée avec succès.');
        } catch (\Throwable $e) {
           
            Log::error('Error creating matiere: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la matière.']);
        }
    }

    public function storeProf(Request $request)
{
    try {
  
        $validatedData = $request->validate([
            'nomMatiere' => 'required|string|max:255|unique:matieres', 
           
        ]);

        
        $domaineProf = Auth::user()->domaineEtude;

      
        $matiereExistante = Matiere::where('nomMatiere', $validatedData['nomMatiere'])
                                    
                                    ->first();

       
        if ($matiereExistante) {
       
            return redirect()->back()->with('info', 'La matière existe déjà dans votre domaine d\'étude.');
        }

    
        $matiere = new Matiere();
        $matiere->nomMatiere = $validatedData['nomMatiere'];
      
        $matiere->save();
        
       
        $domaine = Domaine::findOrFail($domaineProf);
        if (!$domaine->matieres->contains($matiere)) {
            $domaine->matieres()->attach($matiere);
        }
        
        
        $utilisateursEleves = Usager::where('domaineEtude', $domaineProf)
                                     ->where('role', 'eleve')
                                     ->get();

        foreach ($utilisateursEleves as $utilisateur) {
          
            $noteExiste = Note::where('idCompte', $utilisateur->id)
                              ->where('idMatiere', $matiere->id)
                              ->exists();
            if (!$noteExiste) {
            
                $note = new Note();
                $note->idCompte = $utilisateur->id;
                $note->idMatiere = $matiere->id;
                $note->note = 0; 
                $note->save();
            }
        }

    
        return redirect()->back()->with('success', 'La matière a été ajoutée avec succès et des notes de base ont été créées pour les utilisateurs de votre domaine d\'étude.');
    } catch (\Throwable $e) {
    
        Log::error('Erreur lors de l\'ajout de la matière et des notes: ' . $e->getMessage());
        return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la matière et des notes.']);
    }
}


public function edit(Matiere $matiere)
{
    return View('Domaines.modifierMatiere', compact('matiere'));
}


public function update(MatiereRequest $request, Matiere $matiere)
{
    try {
        $matiere->nomMatiere = $request->nomMatiere;
        $matiere->save();

        return redirect()->route('Tutorat.index')->with('message', "Modification de " . $matiere->nomMatiere . " réussie!");
    } catch (\Throwable $e) {
    
        Log::emergency($e);
        return redirect()->route('Tutorat.index')->withErrors(['La modification n\'a pas fonctionné']); 
    }
}
public function destroy(string $id)
{
    try {
        $matiere = Matiere::findOrFail($id);
        
        // Supprimer les relations dans la table pivot matiere_domaine
        $matiere->domaines()->detach();
       
        // Supprimer les notes associées à la matière
        $matiere->notes()->delete();
        
 
        $matiere->delete();
        
        return redirect()->route('Tutorat.index')->with('message', "Suppression de " . $matiere->nomMatiere . " réussie!");
    } catch (\Throwable $e) {
        Log::emergency($e);
        return redirect()->route('Tutorat.index')->withErrors(['La suppression n\'a pas fonctionné']); 
    }
}

    
    
    
}
