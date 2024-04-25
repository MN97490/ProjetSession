<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Log;

use App\Models\Usager;
use App\Models\Disponibilite;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Demande;

class TutoratsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('Tutorat.index');
    }
    public function indexRecherche()
    {
        $matieres = Matiere::all();
       
      

         return view('Tutorat.tuteur',compact('matieres'));
    }

    public function devenirTuteur(){
      

        $matieress = Matiere::all();
        $usager = Auth::user();
        $historique = $usager->demandes()->whereNotIn('statut', ['en cours'])->get();
        $domaineId = $usager->domaineEtude;
        $domaine = Domaine::find($domaineId);
        $matieres = $domaine->matieres;
        $nomDomaine = $domaine ? $domaine->nomDomaine : '';
        $demandes = Demande::where('usager_id', auth()->user()->id)
        ->where('statut', 'en cours')
        ->get();
        return view('Tutorat.demande',compact('domaine','nomDomaine','matieres','matieress','demandes','historique'));

    }

    public function editDemande(Demande $demande)
    {
        $matieres = Matiere::all();
        return view('Tutorat.demandeedit', compact('demande', 'matieres'));
    

    }

    public function updateDemande(Request $request, Demande $demande)
    {
        $request->validate([
            'motivation' => 'required|string',
            'matieres' => 'required|array',
        ]);

        $demande->update([
            'motivation' => $request->motivation,
        ]);

        $demande->matieres()->sync($request->matieres);

        return redirect()->route('Tutorat.demande')->with('success', 'Demande mise à jour avec succès');
    }
    public function accepterDemande($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = 'accepter';
        $demande->save();
    
        $usager = $demande->usager;
    
        // Vérifier si l'utilisateur est déjà un tuteur
        if (!$usager->is_tuteur) {
            $usager->is_tuteur = true;
            $usager->save();
        }
    
        // Récupérer les matières pour lesquelles l'utilisateur est déjà autorisé à être tuteur
        $matieresExistantes = $usager->matieresAutorisees()->pluck('matieres.id')->toArray();

    
        // Récupérer les nouvelles matières pour lesquelles l'utilisateur a demandé à être tuteur
        $matieresAutorisees = $usager->matieresAutorisees()->pluck('matieres.id')->toArray();

    
       // Récupérer les nouvelles matières pour lesquelles l'utilisateur a demandé à être tuteur
       $nouvellesMatieres = $demande->matieres()->pluck('matieres.id')->toArray();


// Fusionner les nouvelles matières avec les matières existantes pour éviter les doublons
$matieresAutorisees = array_merge($matieresExistantes, $nouvellesMatieres);

        // Enregistrer les matières pour lesquelles l'utilisateur est autorisé à être tuteur
        $usager->matieresAutorisees()->sync($matieresAutorisees);
    
        return back()->with('success', 'Demande acceptée avec succès.');
    }
    


public function refuserDemande(Request $request, $id)
{
    $request->validate([
        'motif' => 'required|string|max:255',
    ]);

    $demande = Demande::findOrFail($id);
    $demande->update([
        'statut' => 'refuser',
        'motif' => $request->motif,
    ]);

    return back()->with('success', 'Demande refusée avec succès.');
}

public function destroyMatiereTuteur($usager_id, $matiere_id)
{
    $usager = Usager::find($usager_id);
    $usager->matieresAutorisees()->detach($matiere_id);

    return redirect()->back()->with('success', 'Autorisation supprimée avec succès.');
}

public function addAutorisation(Request $request)
{
    $usager = Usager::find($request->usager_id);

    
    if (!$usager->is_tuteur) {
        $usager->is_tuteur = true;
        $usager->save();
    }


    $usager->matieresAutorisees()->syncWithoutDetaching($request->matieres);

    return redirect()->back()->with('success', 'Autorisations ajoutées avec succès. Usager mis à jour comme tuteur si nécessaire.');
}


public function removeTuteurStatus($usager_id)
{
    $usager = Usager::find($usager_id);
    if ($usager && $usager->is_tuteur) {
       
        $usager->is_tuteur = false;
        $usager->save();

     
        $usager->matieresAutorisees()->detach();

        return redirect()->back()->with('success', 'Statut de tuteur retiré avec succès.');
    }

    return redirect()->back()->with('error', 'Usager non trouvé ou nétait pas un tuteur.');
}



    public function destroyDemande(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();
        return redirect()->back()->with('success', 'La demande a été supprimée avec succès.');
    }

    public function devenirTuteurs(Request $request)
{
    $utilisateur = auth()->user();
    $demandeEnCours = Demande::where('usager_id', $utilisateur->id)
        ->where('statut', 'en cours')
        ->exists();

        if ($demandeEnCours) {
            return redirect()->back()->with('error', 'Vous avez déjà une demande en cours.');
        }else {
    $data = $request->validate([
        'matieres' => 'required|array',
        'motivation' => 'required|string|max:255',
    ]);

   
    $demande = Demande::create([
        'usager_id' => $utilisateur->id,
        'motivation' => $data['motivation'],
    ]);

    
    $demande->matieres()->attach($data['matieres']);

    return redirect()->back()->with('success', 'Votre demande a été soumise avec succès.');
    }
}
    public function rechercherTuteur(Request $request)
    {
        // Récupérer l'ID de la matière
        $matiereId = $request->input('matiere');
    
        // Récupérer l'utilisateur
        $utilisateur = auth()->user();
    
        // Récupérer la matière
        $matiere = Matiere::findOrFail($matiereId);
    
        // Récupérer les disponibilités de l'utilisateur
        $disponibilitesUtilisateur = $utilisateur->disponibilites;
    
        // Récupérer la note de l'utilisateur pour cette matière
        $utilisateurNote = $utilisateur->notes->where('idMatiere', $matiereId)->first();
    
        // Récupérer les tuteurs
        $tuteurs = Usager::where('is_tuteur', 1)
                        ->where('domaineEtude', $utilisateur->domaineEtude)
                        ->whereHas('notes', function ($query) use ($matiereId, $utilisateurNote) {
                            $query->where('idMatiere', $matiereId);
                            if ($utilisateurNote) {
                                $query->where('Note', '>', (float) $utilisateurNote->Note); // Conversion en nombre
                            }
                        })
                        ->where(function ($query) use ($disponibilitesUtilisateur) {
                            $query->whereHas('disponibilites', function ($q) use ($disponibilitesUtilisateur) {
                                // Comparaison de chaque disponibilité de l'utilisateur avec celle du tuteur
                                $q->where(function ($subQuery) use ($disponibilitesUtilisateur) {
                                    foreach ($disponibilitesUtilisateur as $disponibilite) {
                                        $subQuery->orWhere(function ($subSubQuery) use ($disponibilite) {
                                            $subSubQuery->where('jour', $disponibilite->jour)
                                                        ->where('start', $disponibilite->start)
                                                        ->where('end', $disponibilite->end);
                                        });
                                    }
                                });
                            });
                        })
                        ->get();
    
        return view('Tutorat.recherche', [
            'tuteurs' => $tuteurs,
            'nomMatiere' => $matiere->nomMatiere
        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
