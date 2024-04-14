<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matiere;

class MatieresController extends Controller
{
    public function index()
    {
        $matieres = Matiere::all();
        return $matieres;
    }
}
