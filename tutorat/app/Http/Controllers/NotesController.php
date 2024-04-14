<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NoteEtudiant;

class NotesController extends Controller
{
    public function index()
    {
        $notes = NoteEtudiant::all();
        return $notes;
    }
}
