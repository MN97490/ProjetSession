<?php

namespace App\Http\Controllers;
use Log;
use Illuminate\Http\Request;
use App\Models\Actualite;
use Illuminate\Support\Facades\File;

class ActualitesController extends Controller
{
 

    public function create()
    {
        $actualites = Actualite::all();
        return view('Actualites.gestion', compact('actualites'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:10000',  
        ]);
    
        try {
            $actualite = new Actualite($request->except('image'));
    
            if ($request->hasFile('image')) {
                $uploadedFile = $request->file('image');
                $filename = str_replace(' ', '_', $actualite->title) . '-' . uniqid() . '.' . $uploadedFile->extension(); 
                $uploadedFile->move(public_path('Actualite'), $filename);
                $actualite->image = 'Actualite/' . $filename;
            }
    
            $actualite->save();
        } catch (\Exception $e) {
            Log::error("Erreur lors du traitement de l'actualité: ", [$e]);
            return back()->withErrors('Erreur lors de l\'ajout de l\'actualité.')->withInput();
        }
    
        return redirect()->route('Actualites.gestion')->with('success', 'Actualité ajoutée avec succès.');
    }
    
    public function destroy($id)
    {
        try {
            $actualite = Actualite::findOrFail($id);
    
           
            if (File::exists(public_path(  $actualite->image))) {
                File::delete(public_path( $actualite->image));
            }
    
           
            $actualite->delete();
    
            return redirect()->route('Actualites.gestion')->with('success', 'Actualité supprimée avec succès.');
        } catch (\Throwable $e) {
            Log::emergency($e);
            return redirect()->route('Actualites.gestion')->withErrors(['Erreur lors de la suppression de l\'actualité.']);
        }

        
    }
    public function edit($id)
        {
          
            $actualite = Actualite::findOrFail($id);
    
            return view('Actualites.edit', compact('actualite'));
        }

      // Dans app/Http/Controllers/ActualitesController.php

public function update(Request $request, $id)
{
    try {
        $actualite = Actualite::findOrFail($id);
        $actualite->title = $request->title;
        $actualite->description = $request->description;

       
        $actualite->save();

        return redirect()->route('Actualites.gestion')->with('success', 'Actualité mise à jour avec succès.');
    } catch (\Exception $e) {
        Log::error("Erreur lors de la mise à jour de l'actualité: ", [$e]);
        return back()->withErrors('Erreur lors de la mise à jour de l\'actualité.')->withInput();
    }
}

        
        
}
