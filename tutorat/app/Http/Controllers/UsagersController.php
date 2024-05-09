<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use Auth;
use Log;

use App\Models\Usager;
use Illuminate\Support\Facades\Hash;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;



class UsagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { $domainesEtude = Domaine::all();
        $matieres = Matiere::all();
        $matieresParDomaine = [];


        foreach ($domainesEtude as $domaine) {
            $matieresParDomaine[$domaine->nomDomaine] = $domaine->matieres()->pluck('nomMatiere')->toArray();
        }
     
        $usagers = Usager::all();
        return View('Usagers.liste', compact('usagers','domainesEtude','matieresParDomaine','matieres'));
    }

    public function rechercherUsagers(Request $request)
    {
    
      $search = $request->input('search');

      
      $domaineId = Auth::user()->domaineEtude;
  
    
      $usagers = Usager::where('domaineEtude', $domaineId)
                      ->where(function($query) use ($search) {
                          $query->where('nom', 'LIKE', "{$search}%")
                                ->orWhere('prenom', 'LIKE', "{$search}%") ;
                                
                      })
                      ->get();

    return view('Usagers.recherche', compact('usagers'));
    }

    public function zoomUsager(string $id){
        $domaines = Domaine::all();
        

        $usager = Usager::findOrFail($id);
        $domaineUsager=$usager->domaineEtude;
        $domaine=Domaine::findOrFail($domaineUsager);
        
        return view('Usagers.zoom', compact('usager','domaine'));


    }


    public function create()
    {
        //$domaines = domaine::all();
       // return View('Usagers.inscription');
        $domainesEtude = Domaine::all();
        return view('Usagers.inscription', ['domainesEtude' => $domainesEtude]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données soumises
            $validatedData = $request->validate([
                'nomUtilisateur' => 'required|string|max:255|unique:usagers',
                'email' => 'required|string|email|max:255|unique:usagers',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'domaineEtude' => 'required|exists:domaines,id', 
                'password' => 'required|string|min:8|confirmed',
                
            ]);
    
          
            $usager = new Usager();
            $usager->nomUtilisateur = $validatedData['nomUtilisateur'];
            $usager->email = $validatedData['email'];
            $usager->nom = $validatedData['nom'];
            $usager->prenom = $validatedData['prenom'];
            $usager->domaineEtude = $validatedData['domaineEtude']; 
            $usager->password = Hash::make($validatedData['password']);
           
            $usager->save();
    
            // Récupére les matières associées au domaine d'étude de l'utilisateur
            $matieres = Domaine::find($usager->domaineEtude)->matieres;
    
            // Créer des notes de base pour chaque matière
            foreach ($matieres as $matiere) {
                $note = new Note();
                $note->idCompte = $usager->id;
                $note->idMatiere = $matiere->id;
                $note->note = 0; 
                $note->save();
            }
    
            
            Log::info('New user created successfully: ' . $usager->nomUtilisateur);
        } catch (\Throwable $e) {
           
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->route('usagers.create')->withErrors(['L\'ajout n\'a pas fonctionné']);
        }
        return redirect()->route('login');
    }
    

    public function storeAdmin(Request $request)
    {
        try {
         
            $validatedData = $request->validate([
                'nomUtilisateur' => 'required|string|max:255|unique:usagers',
                'email' => 'required|string|email|max:255|unique:usagers',
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'domaineEtude' => 'required|exists:domaines,id', 
                'password' => 'required|string|min:8|confirmed',
               
                'role' => 'required',
            ]);
    
          
            $usager = new Usager();
            $usager->nomUtilisateur = $validatedData['nomUtilisateur'];
            $usager->email = $validatedData['email'];
            $usager->nom = $validatedData['nom'];
            $usager->prenom = $validatedData['prenom'];
            $usager->domaineEtude = $validatedData['domaineEtude']; 
            $usager->password = Hash::make($validatedData['password']);
            $usager->role = $validatedData['role'];
            $usager->save();
    
           
            if ($usager->role === 'eleve') {
                $matieres = Domaine::find($usager->domaineEtude)->matieres;
        
                
                foreach ($matieres as $matiere) {
                    $note = new Note();
                    $note->idCompte = $usager->id;
                    $note->idMatiere = $matiere->id;
                    $note->note = 0; 
                    $note->save();
                }
            }
    
            
            Log::info('New user created successfully: ' . $usager->nomUtilisateur);
        } catch (\Throwable $e) {
           
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->route('Usagers.liste')->withErrors(['L\'ajout n\'a pas fonctionné']);
        }
        return redirect()->route('Usagers.liste');
    }
    

    public function connect(Request $request)
    {
        $reussi = Auth::attempt(['nomUtilisateur' => $request->username, 'password' => $request->password]);
        if($reussi){
            return redirect()->route('Sondages.index') ->with('message', "Connexion réussie");
        }
        else{
            return redirect()->route('login')->withErrors(['Informations invalides']); 
        }

    }
    public function logout(Request $request)
    {
     Auth::logout();   
     return redirect()->route('login'); 

    }
    /**
     * Display the specified resource.
     */
    public function showLoginForm()
    {
       
        return View('Usagers.login');
    }
    public function showProfil()
    {
        $usager = Auth::user();
        $domaineId = $usager->domaineEtude;
        $matieres = Matiere::whereHas('domaines', function($query) use ($domaineId) {
            $query->where('domaine_id', $domaineId);
        })->get();
        $notes = Note::where('idCompte', $usager->id)->get()->keyBy('idMatiere');
        return view('Usagers.profil', compact('usager', 'matieres', 'notes'));
    }
    
    
    
    
    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
        $usager = Auth::user();
        return view('Usagers.modifier', compact('usager'));
    }
   
    public function editAdmin(Usager $usager)
    {
        
        $domainesEtude = Domaine::all();
        return View('usagers.modifierAdmin', compact('usager','domainesEtude'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsagerRequest $request, Usager $usager)
    {
        try{
            $usager->update([
                'nom' => $request->nom,
                'nomUtilisateur' => $request->nomUtilisateur,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'domaineEtude' => $request->domaineEtude,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'presence' => $request->presence,
            ]);
     
            return redirect()->route('Usagers.profil')->with('message', "Modification de " . $usager->nomUtilisateur . " réussie!");
        }
        catch(\Throwable $e){
            //Gérer l'erreur
            Log::emergency($e);
            return redirect()->route('Usagers.modifier')->withErrors(['la modification n\'a pas fonctionné']); 
        }
        return redirect()->route('Usagers.modifier');

    }

    public function updateAdmin(UsagerRequest $request, Usager $usager)
    {
        try {
            $usager->update([
                'nom' => $request->nom,
                'nomUtilisateur' => $request->nomUtilisateur,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'domaineEtude' => $request->domaineEtude,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'presence' => $request->presence,
            ]);
            
       
            if ($request->role !== $usager->role) {
               
                if ($usager->role === 'eleve') {
                   
                    if ($request->role === 'admin' || $request->role === 'prof') {
                        $usager->notes()->delete();
                    } 
                   
                    else {
                       
                        $matieres = Domaine::find($request->domaineEtude)->matieres;
    
                        foreach ($matieres as $matiere) {
                            
                            $existingNote = $usager->notes()->where('idMatiere', $matiere->id)->first();
    
                            // Si aucune note n'existe, on en crée une nouvelle
                            if (!$existingNote) {
                                $note = new Note();
                                $note->idCompte = $usager->id;
                                $note->idMatiere = $matiere->id;
                                $note->note = 0; // Vous pouvez définir la note de base ici
                                $note->save();
                            }
                        }
                    }
                } 
               
                elseif ($request->role === 'eleve') {
                    
                    $usager->notes()->delete();
                    
                   
                    $matieres = Domaine::find($request->domaineEtude)->matieres;
    
                    foreach ($matieres as $matiere) {
                        $note = new Note();
                        $note->idCompte = $usager->id;
                        $note->idMatiere = $matiere->id;
                        $note->note = 0; 
                        $note->save();
                    }
                }
            }
    
            $usager->role = $request->role;
            $usager->domaineEtude = $request->domaineEtude;
            
           
            if ($request->password !== $usager->password) {
                $usager->password = Hash::make($request->password);
            }
    
            $usager->save();
    
            return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de la mise à jour du profil.');
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $usager = Usager::findOrFail($id);
            
           
            $usager->notes()->delete();
            
          
            $usager->delete();
            
            return redirect()->route('Usagers.liste')->with('message', "Suppression de " . $usager->nomUsager . " réussie!");
        } catch (\Throwable $e) {
            Log::emergency($e);
            return redirect()->route('Usagers.liste')->withErrors(['La suppression n\'a pas fonctionné']); 
        }
    }


    
    
}
