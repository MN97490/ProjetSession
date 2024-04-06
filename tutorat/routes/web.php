<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;
use App\Http\Controllers\TutoratsController;



Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');

Route::get('/usagers/creation',
[UsagersController::class, 'create'])->name('usagers.create');

Route::get('/index',
[TutoratsController::class, 'index'])->name('Tutorat.index');

Route::get('/profil',
[UsagersController::class, 'showProfil'])->name('Usagers.profil');