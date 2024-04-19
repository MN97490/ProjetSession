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

    /**
     * Show the form for creating a new resource.
     */
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
                'domaineEtude' => 'required|exists:domaines,id', // Modifiez ici si le nom de votre table est "domaines"
                'password' => 'required|string|min:8|confirmed',
                'role' => 'required',
            ]);
    
            // Création d'un nouvel utilisateur
            $usager = new Usager();
            $usager->nomUtilisateur = $validatedData['nomUtilisateur'];
            $usager->email = $validatedData['email'];
            $usager->nom = $validatedData['nom'];
            $usager->prenom = $validatedData['prenom'];
            $usager->domaineEtude = $validatedData['domaineEtude']; // Assurez-vous que la colonne dans la table "usagers" correspond
            $usager->password = Hash::make($validatedData['password']);
            $usager->role = $validatedData['role'];
            $usager->save();
    
            // Récupérer les matières associées au domaine d'étude de l'utilisateur
            $matieres = Domaine::find($usager->domaineEtude)->matieres;
    
            // Créer des notes de base pour chaque matière
            foreach ($matieres as $matiere) {
                $note = new Note();
                $note->idCompte = $usager->id;
                $note->idMatiere = $matiere->id;
                $note->note = 0; // Vous pouvez définir la note de base ici
                $note->save();
            }
    
            // Log successful user creation
            Log::info('New user created successfully: ' . $usager->nomUtilisateur);
        } catch (\Throwable $e) {
            // Log error if user creation fails
            Log::error('Error creating user: ' . $e->getMessage());
            return redirect()->route('usagers.create')->withErrors(['L\'ajout n\'a pas fonctionné']);
        }
        return redirect()->route('login');
    }
    

    public function storeAdmin(Request $request)
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
            return redirect()->route('Tutorat.index') ->with('message', "Connexion réussie");
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
        // Récupérer l'utilisateur authentifié
        $usager = Auth::user();
    
        // Récupérer le domaine d'étude de l'utilisateur
        $domaine = Domaine::find($usager->domaineEtude);
    
        // Initialiser un tableau pour stocker les notes
        $notes = [];
    
        // Vérifier si le domaine existe
        if ($domaine) {
            // Récupérer les matières associées au domaine d'étude de l'utilisateur
            $matieres = $domaine->matieres;
    
            // Récupérer les notes correspondantes de l'utilisateur pour chaque matière
            foreach ($matieres as $matiere) {
                // Récupérer les notes de l'utilisateur pour cette matière
                $note = Note::where('idCompte', $usager->id)
                             ->where('idMatiere', $matiere->id)
                             ->first();
    
                // Stocker la note dans le tableau avec le nom de la matière comme clé
                $notes[$matiere->nomMatiere] = $note ? $note->Note : 'Non disponible';
            }
        } else {
            // Gérer le cas où le domaine d'étude n'est pas trouvé
            // Vous pouvez renvoyer un message d'erreur ou rediriger l'utilisateur
            // selon vos besoins
        }
    
        // Passer les données à la vue
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
        
      
        return View('usagers.modifierAdmin', compact('usager'));
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsagerRequest $request, Usager $usager)
    {
        try{
        
            $usager->nom = $request->nom;
            $usager->nomUtilisateur = $request->nomUtilisateur;
            $usager->prenom = $request->prenom;
            $usager->email = $request->email;
            $usager->domaineEtude=$request->domaineEtude;
            $usager->role=$request->role;
            $usager->password = Hash::make($request->password);
            $usager->save();
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
            $usager->nom = $request->nom;
            $usager->nomUtilisateur = $request->nomUtilisateur;
            $usager->prenom = $request->prenom;
            $usager->email = $request->email;
            $usager->domaineEtude = $request->domaineEtude;
            $usager->role = $request->role;
    
            // Vérifier si le nouveau mot de passe est différent de l'ancien
            if ($request->password !== $usager->password) {
                $usager->password = Hash::make($request->password);
            }
    
            $usager->save();
    
            return redirect()->route('Usagers.liste')->with('message', "Modification de " . $usager->nomUtilisateur . " réussie!");
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
        try {
            $usager = Usager::findOrFail($id);
            
            // Supprimer toutes les notes associées à l'utilisateur
            $usager->notes()->delete();
            
            // Maintenant, supprimer l'utilisateur lui-même
            $usager->delete();
            
            return redirect()->route('Usagers.liste')->with('message', "Suppression de " . $usager->nomUsager . " réussie!");
        } catch (\Throwable $e) {
            Log::emergency($e);
            return redirect()->route('Usagers.liste')->withErrors(['La suppression n\'a pas fonctionné']); 
        }
    }
    
    
}
