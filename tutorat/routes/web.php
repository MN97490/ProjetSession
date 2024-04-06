<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsagersController;



Route::get('/',
[UsagersController::class, 'showLoginForm'])->name('login');