<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\TutoratsController;

use App\Http\Controllers\domaineEtudesController;




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

Route::POST('/domaines//matieres/AjoutRelation', 
[domaineEtudesController::class, 'ajoutRelation'])->name('Domaines.ajoutRelation')->middleware('auth');
