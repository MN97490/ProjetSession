<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\TutoratsController;
use App\Http\Requests\CheckRole;
use App\Http\Controllers\DomaineEtudesController;




Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');

Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');

Route::get('/modifier',
[UsagersController::class, 'edit'])->name('Usagers.modifier');

Route::get('/modifierAdmin',
[UsagersController::class, 'editAdmin'])->name('Usagers.modifierAdmin')->middleware('CheckRole:admin');

Route::get('/usagers/creation',
[UsagersController::class, 'create'])->name('usagers.create');

Route::post('/usagers',
[UsagersController::class, 'store'])->name('usagers.store');

Route::get('/index',
[TutoratsController::class, 'index'])->name('Tutorat.index');

Route::get('/profil',
[UsagersController::class, 'showProfil'])->name('Usagers.profil');

Route::POST('/connect',
[UsagersController::class, 'connect'])->name('Usagers.connect');

Route::get('/logout',
[UsagersController::class, 'logout'])->name('Usagers.logout');


Route::patch('/usagers/{usager}/modifier',
[UsagersController::class, 'update'])->name('Usagers.update');

Route::get('/usagers/liste',
[UsagersController::class, 'index'])->name('usagers.liste')->middleware('CheckRole:admin');