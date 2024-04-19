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
            // Validation des données soumises
            $validatedData = $request->validate([
                'nomMatiere' => 'required|string|max:255|unique:matieres', // Assurez-vous que la table pour les matières est correctement spécifiée ici
                 // Assurez-vous que la table pour les domaines est correctement spécifiée ici
            ]);
    
            // Création d'une nouvelle matière
            $matiere = new Matiere();
            $matiere->nomMatiere = $validatedData['nomMatiere'];
            // Assurez-vous que la colonne dans la table "matieres" correspond
            $matiere->save();
            
            // Rediriger avec un message de succès
            return redirect()->back()->with('success', 'La matière a été ajoutée avec succès.');
        } catch (\Throwable $e) {
            // Gérer l'erreur
            Log::error('Error creating matiere: ' . $e->getMessage());
            return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la matière.']);
        }
    }

    public function storeProf(Request $request)
{
    try {
        // Validation des données soumises
        $validatedData = $request->validate([
            'nomMatiere' => 'required|string|max:255|unique:matieres', // Assurez-vous que la table pour les matières est correctement spécifiée ici
           
        ]);

        // Récupérer le domaine d'étude du professeur
        $domaineProf = Auth::user()->domaineEtude;

        // Recherche de la matière par nom et domaine d'étude
        $matiereExistante = Matiere::where('nomMatiere', $validatedData['nomMatiere'])
                                    
                                    ->first();

        // Si la matière existe déjà, pas besoin de la recréer
        if ($matiereExistante) {
            // Rediriger avec un message d'information
            return redirect()->back()->with('info', 'La matière existe déjà dans votre domaine d\'étude.');
        }

        // Création d'une nouvelle matière
        $matiere = new Matiere();
        $matiere->nomMatiere = $validatedData['nomMatiere'];
       // Associer la matière au domaine d'étude du professeur
        $matiere->save();
        
        // Associer la matière au domaine d'étude du professeur dans la table pivot
        $domaine = Domaine::findOrFail($domaineProf);
        if (!$domaine->matieres->contains($matiere)) {
            $domaine->matieres()->attach($matiere);
        }
        
        // Création de notes pour les utilisateurs élèves du domaine d'étude du professeur
        $utilisateursEleves = Usager::where('domaineEtude', $domaineProf)
                                     ->where('role', 'eleve')
                                     ->get();

        foreach ($utilisateursEleves as $utilisateur) {
            // Vérifier si une note existe déjà pour cette matière et cet utilisateur
            $noteExiste = Note::where('idCompte', $utilisateur->id)
                              ->where('idMatiere', $matiere->id)
                              ->exists();
            if (!$noteExiste) {
                // Créer une nouvelle note avec une valeur par défaut
                $note = new Note();
                $note->idCompte = $utilisateur->id;
                $note->idMatiere = $matiere->id;
                $note->note = 0; // Valeur par défaut de la note
                $note->save();
            }
        }

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'La matière a été ajoutée avec succès et des notes de base ont été créées pour les utilisateurs de votre domaine d\'étude.');
    } catch (\Throwable $e) {
        // Gérer l'erreur
        Log::error('Erreur lors de l\'ajout de la matière et des notes: ' . $e->getMessage());
        return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la matière et des notes.']);
    }
}


public function update(Request $request, string $id)
{
    //
}


    
    
    
}
