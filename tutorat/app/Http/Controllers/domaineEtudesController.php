<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Http\Requests\DomaineRequest;

class domaineEtudesController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaineEtudes = domaine::all();
        return $domaineEtudes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domaine $domaine)
    {
        return View('Domaines.modifier', compact('domaine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DomaineRequest $request, Domaine $domaine)
    {
        try {
            $domaine->nomDomaine = $request->nomDomaine;
            $domaine->save();
    
            return redirect()->route('Usagers.liste')->with('message', "Modification de " . $domaine->nomDomaine . " réussie!");
        } catch (\Throwable $e) {
            // Gérer l'erreur
            Log::emergency($e);
            return redirect()->route('Usagers.liste')->withErrors(['La modification n\'a pas fonctionné']); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function ajoutRelation(Request $request)
    {
        try {
            $idDomaine = $request->input('idDomaine');
            $idMatiere = $request->input('idMatiere');
    
            // Recherche du domaine et de la matière
            $domaine = Domaine::findOrFail($idDomaine);
            $matiere = Matiere::findOrFail($idMatiere);
            
            // Vérification si la relation existe déjà
            if ($domaine->matieres->contains($matiere)) {
                return redirect()->back()->withErrors(['La relation existe déjà.']);
            }
            
            // Ajout de la relation
            $domaine->matieres()->attach($matiere);
    
            return redirect()->back()->with('success', 'La relation a été ajoutée avec succès.');
        } catch (\Throwable $e) {
            // Gérer l'erreur
            Log::error($e);
            return redirect()->back()->withErrors(['Erreur lors de l\'ajout de la relation.']);
        }
    }
    
    public function destroyRelation($idDomaine, $idMatiere)
    {
        try {
          
            $domaine = Domaine::findOrFail($idDomaine);
            $matiere = Matiere::findOrFail($idMatiere);
    
            
            $domaine->matieres()->detach($idMatiere);
    
            return redirect()->back()->with('success', 'La relation a été supprimée avec succès.');
        } catch (\Throwable $e) {
            // En cas d'erreur, enregistrer l'exception dans les logs et rediriger avec un message d'erreur
            Log::emergency($e);
            return redirect()->back()->withErrors(['La suppression de la relation n\'a pas fonctionné']); 
        }
    }
    
    
}
