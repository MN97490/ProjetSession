<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsagerRequest;
use App\Http\Controllers\UsagersController;
use Auth;
use Log;
use App\Models\Usager;
use Illuminate\Http\Request;

class ConversationController extends Controller
{

    public function index(){
        $users = Usager::all();
        return view('Conversation.index',compact('users'));


    }

    public function show(int $id){



    }

}
