<?php

namespace App\Http\Controllers;
use Auth;
use Log;

use App\Http\Requests\UsagerRequest;



use App\Models\Usager;
use Illuminate\Http\Request;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Demande;
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

    public function indexProf()
    {

        $matieress = Matiere::all();
        $usager = Auth::user();
        $domaineId = $usager->domaineEtude;
        $domaine = Domaine::find($domaineId);
        
        $matieres = $domaine->matieres;
    
      
        $notesParMatiere = [];
        foreach ($matieres as $matiere) {
            $notesParMatiere[$matiere->id] = Note::where('idMatiere', $matiere->id)
                ->with('usager')
                ->get();
        }



      
        $demandess = Demande::where('statut', 'en cours')
        ->with('usager', 'matieres')
        ->get()
        ->filter(function ($demande) use ($domaineId) {
            return $demande->usager->domaineEtude === $domaineId;
        });

        $demandes = Demande::with(['usager', 'matieres'])->get();
        $tuteurs = Usager::where('domaineEtude', $domaineId)
                     ->where('is_tuteur', true)
                     ->with('matieresAutorisees')
                     ->get();
    

                     $usagersDomaine = Usager::where('domaineEtude', $domaineId)->get();

        return view('Domaines.index', compact('domaine', 'matieres','matieress', 'notesParMatiere','demandes','demandess','tuteurs', 'usagersDomaine'));
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
    public function store(DomaineRequest $request)
    {
        try {
           
            $domaine = Domaine::create($request->validated());

          
            return redirect()->back()->with('success', 'Le domaine a été ajouté avec succès.');
        } catch (\Throwable $e) {
         
            Log::error($e);
            return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout du domaine.']);
        }
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
    
          
            $domaine = Domaine::findOrFail($idDomaine);
            $matiere = Matiere::findOrFail($idMatiere);
            
            
            if ($domaine->matieres->contains($matiere)) {
                return redirect()->back()->withErrors(['La relation existe déjà.']);
            }
            
       
            $domaine->matieres()->attach($matiere);
    
           
            $utilisateurs = Usager::where('domaineEtude', $idDomaine)->where('role', 'eleve')->get();
            foreach ($utilisateurs as $utilisateur) {
           
                $noteExiste = Note::where('idCompte', $utilisateur->id)
                                  ->where('idMatiere', $idMatiere)
                                  ->exists();
                if (!$noteExiste) {
                 
                    $note = new Note();
                    $note->idCompte = $utilisateur->id;
                    $note->idMatiere = $idMatiere;
                    $note->note = 0; 
                    $note->save();
                }
            }
    
            return redirect()->back()->with('success', 'Relation ajoutée avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['Une erreur est survenue lors de l\'ajout de la relation.']);
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
           
            Log::emergency($e);
            return redirect()->back()->withErrors(['La suppression de la relation n\'a pas fonctionné']); 
        }
    }
    
    
}
