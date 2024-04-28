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
use App\Models\Sondage;
use App\Models\Commentaire;


class SondagesController extends Controller
{

    public function index()
    {
        $userId = Auth::id(); 
        $sondagesEnCours = Sondage::where('status', 'en cours')
        ->whereDoesntHave('commentaires', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->get();
        
        $allCommented = true;
        foreach ($sondagesEnCours as $sondage) {
            if (!Commentaire::where('sondage_id', $sondage->id)->where('user_id', $userId)->exists()) {
                $allCommented = false;
                break;
            }
        }

        if ($allCommented) {
          
            return redirect()->route('Tutorat.index')->with('info', 'Vous avez commenté tous les sondages en cours.');
        }

        $sondagesTermines = Sondage::where('status', 'terminé')->get()->sortBy('type');

        return view('Sondages.index', compact('sondagesEnCours', 'sondagesTermines'));
    }

    public function storeCommentaire(Request $request)
    {
        $request->validate([
            'sondage_id' => 'required|exists:sondages,id', 
            'contenu' => 'required|string|max:500', 
            'note' => 'nullable|integer|min:1|max:5' 
        ]);

        $commentaire = new Commentaire();
        $commentaire->sondage_id = $request->sondage_id;
        $commentaire->user_id = Auth::id(); 
        $commentaire->contenu = $request->contenu;
        $commentaire->note = $request->has('note') ? $request->note : null; 

        $commentaire->save();

        return redirect()->route('Sondages.index')->with('success', 'Votre commentaire a été ajouté avec succès.');
    }
    public function gestionSondage()
    {
        $sondages = Sondage::all();
        $commentaires = Commentaire::all();
        $sondagesEnCours = Sondage::where('status', 'en cours')->get();
        $sondagesTermines = Sondage::where('status', 'terminer')->get();
        
        $sondagesTermines = $sondagesTermines->sortBy('type');

         return view('Sondages.gestion',compact('sondagesEnCours', 'sondagesTermines','commentaires'));
    }

    public function create()
    {
        return view('Sondages.create');
    }
    
    public function show($id)
    {
        $sondage = Sondage::with('commentaires')->findOrFail($id); 

        if ($sondage->type === 'evaluation' && $sondage->commentaires->isNotEmpty()) {
         
            $ratingSondage = $sondage->commentaires->whereNotNull('note')
                                  ->pluck('note')
                                  ->average();
    
            
         
    
           
            $sondage->ratingSondage = $ratingSondage;
            $sondage->save(); 
        }

        
        return view('Sondages.zoom', compact('sondage'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:question,evaluation',  
        ]);
    
        Sondage::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'type' => $request->type,  
            'status' => 'en cours',  
        ]);
    
        return redirect()->route('Sondages.gestion')->with('success', 'Nouveau sondage créé avec succès.');
    }
    

    public function edit($id)
    {
        $sondage = Sondage::findOrFail($id);
    return view('sondages.edit', compact('sondage'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:en cours,terminer',
            'type' => 'required|in:question,evaluation',
        ]);
    
        $sondage = Sondage::findOrFail($id);
        if ($sondage->type == 'evaluation' && $request->type == 'question') {
            $sondage->ratingSondage = null;
        }
        $sondage->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'status' => $request->status,
            'type' => $request->type,
        ]);
    
        return redirect()->route('Sondages.gestion')->with('success', 'Sondage mis à jour avec succès.');
    }
    public function destroy($id)
    {
        $sondage = Sondage::findOrFail($id);
        $sondage->delete();
        return redirect()->route('Sondages.gestion')->with('success', 'Sondage supprimé avec succès.');
    }

}
