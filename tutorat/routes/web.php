<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\TutoratsController;

use App\Http\Controllers\domaineEtudesController;
use App\Http\Controllers\MatieresController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\DisponibilitesController;




Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');

Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');

Route::get('/modifier',
[UsagersController::class, 'edit'])->name('Usagers.modifier')->middleware('auth');

Route::get('/modifierAdmin',
[UsagersController::class, 'editAdmin'])->middleware('auth')->name('Usagers.modifierAdmin');

Route::get('/usagers/creation',
[UsagersController::class, 'create'])->name('usagers.create');

Route::post('/usagers',
[UsagersController::class, 'store'])->name('usagers.store');


Route::post('/usagersAdmin',
[UsagersController::class, 'storeAdmin'])->name('usagers.storeAdmin');

Route::get('/index',
[TutoratsController::class, 'index'])->name('Tutorat.index')->middleware('auth');

Route::get('/profil',
[UsagersController::class, 'showProfil'])->name('Usagers.profil')->middleware('auth');

Route::POST('/connect',
[UsagersController::class, 'connect'])->name('Usagers.connect');

Route::get('/logout',
[UsagersController::class, 'logout'])->name('Usagers.logout');


Route::patch('/usagers/{usager}/modifier',
[UsagersController::class, 'update'])->name('Usagers.update')->middleware('auth');

Route::get('/usagers/{usager}/modifierAdmin',
[UsagersController::class, 'editAdmin'])->name('Usagers.modifierAdmin')->middleware('auth');


Route::patch('/usagers/{usager}/modifierAdmin/update',
[UsagersController::class, 'updateAdmin'])->name('Usagers.updateAdmin')->middleware('auth');

Route::get('/usagers/liste',
[UsagersController::class, 'index'])->middleware('auth')->name('Usagers.liste');

Route::delete('/usagers/{id}',
[UsagersController::class, 'destroy'])->name('Usagers.destroy')->middleware('auth');

Route::POST('/domaineAdmin',
[domaineEtudesController::class, 'store'])->name('Domaines.store')->middleware('auth');

Route::get('/domaineAdmin/{domaine}/modifierAdmin',
[domaineEtudesController::class, 'edit'])->name('Domaines.modifier')->middleware('auth');


Route::patch('/domaineAdmin/{domaine}/modifierAdmin/update',
[domaineEtudesController::class, 'update'])->name('Domaines.update')->middleware('auth');


Route::delete('/domaines/{idDomaine}/matieres/{idMatiere}', 
[domaineEtudesController::class, 'destroyRelation'])->name('Domaines.destroyRelation')->middleware('auth');

Route::POST('/domaines/matieres/AjoutRelation', 
[domaineEtudesController::class, 'ajoutRelation'])->name('Domaines.ajoutRelation')->middleware('auth');

Route::get('/domaines/indexProf', 
[domaineEtudesController::class, 'indexProf'])->name('Domaines.index')->middleware('auth');

Route::POST('/domaines/matieres/AjoutAdmin', 
[MatieresController::class, 'store'])->name('Matieres.store')->middleware('auth');

Route::POST('/domaines/matieres/Ajout', 
[MatieresController::class, 'storeProf'])->name('Matieres.storeProf')->middleware('auth');


Route::get('/domaines/matieres/Modif/{matiere}/form', 
[MatieresController::class, 'edit'])->name('Matieres.modifierMatiere')->middleware('auth');


Route::patch('/domaines/matieres/Modif/{matiere}/update', 
[MatieresController::class, 'update'])->name('Matieres.update')->middleware('auth');


Route::delete('/domaines/{id}/matieres/', 
[MatieresController::class, 'destroy'])->name('Matieres.destroyMatiere')->middleware('auth');
Route::put('/notes/{note}', [NotesController::class, 'updateNote'])->name('updateNote')->middleware('auth');

Route::put('/notes/{noteId}/update', [NotesController::class, 'updateNoteProf'])->name('notes.update');

Route::get('/calendrier', function () {
    return view('Usagers.calendrier');
});

Route::post('/disponibilites', [DisponibilitesController::class, 'store']);
Route::patch('/disponibilites/{id}', [DisponibilitesController::class, 'update']);
Route::get('/disponibilites', [DisponibilitesController::class, 'index']);
Route::delete('/disponibilites/{id}', [DisponibilitesController::class, 'destroy']);

Route::get('/tutorat', [TutoratsController::class, 'indexRecherche'])->name('Tutorat.tuteur');



Route::post('/recherche-tuteur', [TutoratsController::class, 'rechercherTuteur'])->name('Tutorat.recherche');

Route::get('/devenirTuteur', [TutoratsController::class, 'devenirTuteur'])->name('Tutorat.demande');
Route::get('/devenirTuteur', [TutoratsController::class, 'devenirTuteur'])->name('Tutorat.demande');
Route::POST('/devenirTuteurs', [TutoratsController::class, 'devenirTuteurs'])->name('Tutorat.devenirTuteur');

Route::get('/demande/{demande}/edit', [TutoratsController::class, 'editDemande'])->name('Tutorat.demandeedit');
Route::put('/demande/{demande}', [TutoratsController::class, 'updateDemande'])->name('demande.update');
Route::DELETE('/demande/{id}', [TutoratsController::class, 'destroyDemande'])->name('Tutorat.demande.destroy');

Route::post('/accepter-demande/{demande}', [TutoratsController::class,'accepterDemande'])->name('Tutorat.accepterDemande');
Route::post('/refuser-demande/{demande}', [TutoratsController::class,'refuserDemande'])->name('Tutorat.refuserDemande');

Route::get('/Usager/rechercherUsagers', [UsagersController::class,'rechercherUsagers'])->name('Usagers.recherche');



