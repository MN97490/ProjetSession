<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domaine;
use App\Models\Matiere;
use App\Models\Note;
use App\Models\Usager;
use App\Http\Requests\NoteRequest;
use Log;
use Auth;



class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return $notes;
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
  /**
 * Update the specified resource in storage.
 */
public function updateNote(NoteRequest $request, Note $note)
{
    try {
        $note->update($request->all());
        return redirect()->route('Usagers.profil')->with('message', "Modification de la note réussie!");
    } catch (\Throwable $e) {
  
        Log::emergency($e);
        return redirect()->route('Tutorat.index')->withErrors(['La modification n\'a pas fonctionné']); 
    }
}

    
public function updateNoteProf(Request $request, $noteId)
{
    $note = Note::findOrFail($noteId);
    $note->update(['Note' => $request->newNote]);

    return redirect()->back()->with('success', 'Note mise à jour avec succès!');
}

    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
