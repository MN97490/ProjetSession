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
use App\Models\Disponibilite;
use App\Models\Conversation;
use App\Models\Message;
use Carbon\Carbon;
use App\Models\Aide;


class AideController extends Controller
{
    public function index()
    {
        $user =  auth()->id();
        $aide = Aide::where('user', $user)->get();

    return view('Aides.index', compact('aide', 'user'));

    }

    public function indexAdmin()
    {
        $users = Usager::all();
        $aides=Aide::all();

    return view('Aides.gestion', compact('aides', 'users'));

    }
    public function store(Request $request)
    {
   
        $request->validate([
            'texte' => 'required|string',
        ]);

    
        $aide = new Aide();
        $aide->texte = $request->texte;
        $aide->user = auth()->id(); 
        $aide->save();


        return redirect()->route('Aides.index')->with('success', 'Demande d\'aide enregistrée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'texte' => 'required|string',
          
        ]);
    
        $aide = Aide::findOrFail($id);
        $aide->texte = $request->texte;
        $aide->save();
    
        return redirect()->route('Aides.index')->with('success', 'La demande d\'aide a été mise à jour avec succès.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'texte' => 'required|string',
            'status' => 'required|in:en cours,terminer',
          
        ]);
    
        $aide = Aide::findOrFail($id);
        $aide->texte = $request->texte;
        $aide->status = $request->status;
        $aide->save();
    
        return redirect()->route('Aides.gestion')->with('success', 'La demande d\'aide a été mise à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $aide = Aide::findOrFail($id);
        $aide->delete();
    
        return redirect()->back()->with('success', 'La demande d\'aide a été supprimée avec succès.');
    }
    public function edit($id)
    {
        $aide = Aide::findOrFail($id);
    
        return view('Aides.edit', compact('aide'));
    }
}
