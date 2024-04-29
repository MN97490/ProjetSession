<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Log;
use Illuminate\Support\Facades\Hash;

use App\Models\Usager;
use App\Models\Disponibilite;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Demande;
use App\Models\Rencontre;

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
       
        Disponibilite::where('end', '<', Carbon::now())->delete();

         return view('Tutorat.tuteur',compact('matieres'));
    }


    public function calculerRemunerationTuteurs()
    {
        $deuxSemaines = Carbon::now()->subWeeks(2);
        $tarifParRencontre = 17;  
    
        $tuteurs = Rencontre::where('status', 'terminé')
                            ->where('heure_fin', '>=', $deuxSemaines)
                            ->get()
                            ->groupBy('tuteur_id');
    
        $remunerations = [];
        foreach ($tuteurs as $tuteur_id => $rencontres) {
            $nombreRencontres = count($rencontres);
            $remunerations[$tuteur_id] = $nombreRencontres * $tarifParRencontre; 
        }
    
        return $remunerations;
    }

   
    public function afficherFormSecu()
    {
        
        return View('Tutorat.check');
    }

    public function afficherFormRemu()
    {
    $tuteurId = Auth::id(); 
    $deuxSemaines = Carbon::now()->subWeeks(2);
    $mois = Carbon::now()->subMonth();
    $year = Carbon::now()->year;

    $tarifParRencontre = 17;

    $rencontres = Rencontre::where('tuteur_id', $tuteurId)
                            ->where('status', 'terminer')
                            ->where('heure_fin', '>=', $deuxSemaines)
                            ->get();
                            


     $rencontresM = Rencontre::where('tuteur_id', $tuteurId)
                            ->where('status', 'terminer')
                            ->where('heure_fin', '>=', $mois)
                            ->get();

    $rencontresY = Rencontre::where('tuteur_id', $tuteurId)
                            ->where('status', 'terminer')
                            ->where('heure_fin', '>=', $year)
                            ->get();
    $totalRemuneration = count($rencontres) * $tarifParRencontre;
    $totalRemunerationM = count($rencontresM)* $tarifParRencontre;
    $totalRemunerationY = count($rencontresY)* $tarifParRencontre;

    return view('Tutorat.remuneration', [
        'totalRemuneration' => $totalRemuneration,
        'rencontresCount' => count($rencontres),
        'rencontresCountM'=>count ($rencontresM),
        'totalRemunerationM'=>$totalRemunerationM,
        'rencontresCountY'=>count ($rencontresY),
        'totalRemunerationY'=>$totalRemunerationY,
        'year'=>$year,
    ]);  
}

    public function verifyPassword(Request $request)
{
    $request->validate(['password' => 'required']);

    if (Hash::check($request->password, Auth::user()->password)) {
       
        return $this->afficherFormRemu();
    } else {
        return back()->withErrors(['password' => 'Mot de passe incorrect.']);
    }
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
    
        
        if (!$usager->is_tuteur) {
            $usager->is_tuteur = true;
            $usager->save();
        }
    
        
        $matieresExistantes = $usager->matieresAutorisees()->pluck('matieres.id')->toArray();

    
      
        $matieresAutorisees = $usager->matieresAutorisees()->pluck('matieres.id')->toArray();

    
      
       $nouvellesMatieres = $demande->matieres()->pluck('matieres.id')->toArray();



$matieresAutorisees = array_merge($matieresExistantes, $nouvellesMatieres);

     
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
    
    $matiereId = $request->input('matiere');

   
    $utilisateur = auth()->user();

 
    $matiere = Matiere::findOrFail($matiereId);


    $disponibilitesUtilisateur = $utilisateur->disponibilites;

  
    $tuteurs = Usager::where('is_tuteur', 1)
                    ->where('id', '!=', $utilisateur->id) 
                    ->where('presence', $utilisateur->presence)
                    ->where('domaineEtude', $utilisateur->domaineEtude)
                    ->whereHas('matieresAutorisees', function ($query) use ($matiereId) {
                        $query->where('matiere_id', $matiereId);
                    })
                    ->where(function ($query) use ($matiereId, $utilisateur) {
       
                        $query->whereHas('notes', function ($subQuery) use ($matiereId) {
                            $subQuery->where('idMatiere', $matiereId);
                        }, '=', 0) 
                        ->orWhereHas('notes', function ($subQuery) use ($matiereId, $utilisateur) {
                            $utilisateurNote = $utilisateur->notes->where('idMatiere', $matiereId)->first();
                            $subQuery->where('idMatiere', $matiereId)
                                     ->where('role', '!=', 'prof'); 
                            if ($utilisateurNote) {
                                $subQuery->where('Note', '>', (float) $utilisateurNote->Note);
                            }
                        });
                    })
                    ->with(['disponibilites' => function ($query) use ($disponibilitesUtilisateur) {
                        $query->whereIn('jour', $disponibilitesUtilisateur->pluck('jour'))
                              ->whereIn('start', $disponibilitesUtilisateur->pluck('start'))
                              ->whereIn('end', $disponibilitesUtilisateur->pluck('end'));
                            }])
                    ->get();

    return view('Tutorat.recherche', [
        'tuteurs' => $tuteurs,
        'nomMatiere' => $matiere->nomMatiere,
        'disponibilitesUtilisateur' => $disponibilitesUtilisateur 
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
