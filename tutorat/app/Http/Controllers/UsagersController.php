<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsagerRequest;
use Auth;
use Log;
use App\Models\Usager;
use Illuminate\Support\Facades\Hash;

class UsagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View('Usagers.inscription');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //objet de type usager a la fin objet->save
    }

    public function connect(Request $request)
    {
        $reussi = Auth::attempt(['nomUtilisateur' => $request->username, 'password' => $request->password]);
        if($reussi){
            return redirect()->route('Tutorat.index') ->with('message', "Connexion réussie");
        }
        else{
            return redirect()->route('login')->withErrors(['Informations invalides']); 
        }

    }

    public function logout(Request $request)
    {
     Auth::logout();   
     return redirect()->route('login'); 

    }
    /**
     * Display the specified resource.
     */
    public function showLoginForm()
    {
        return View('Usagers.login');
    }

    public function showProfil()
    {
        return View('Usagers.profil');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
