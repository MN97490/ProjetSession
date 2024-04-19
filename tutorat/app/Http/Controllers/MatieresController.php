<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Domaine;
use App\Http\Requests\MatiereRequest;

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
            // Validation des données soumises
            $validatedData = $request->validate([
                'nomMatiere' => 'required|string|max:255|unique:matieres', // Assurez-vous que la table pour les matières est correctement spécifiée ici
                'idDomaineEtude' => 'required|exists:domaines,id', // Assurez-vous que la table pour les domaines est correctement spécifiée ici
            ]);
    
            // Création d'une nouvelle matière
            $matiere = new Matiere();
            $matiere->nomMatiere = $validatedData['nomMatiere'];
            $matiere->idDomaineEtude = $validatedData['idDomaineEtude']; // Assurez-vous que la colonne dans la table "matieres" correspond
            $matiere->save();
            
            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'La matière a été ajoutée avec succès.');
        } catch (\Throwable $e) {
            // Gérer l'erreur
            Log::error('Error creating matiere: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la matière.']);
        }
    }
    
}
