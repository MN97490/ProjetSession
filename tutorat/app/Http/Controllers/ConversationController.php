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
<<<<<<< Updated upstream
        $users = Usager::all();
=======
        $users = Usager::all() -> where('id','!=',Auth::user()->id);
>>>>>>> Stashed changes
        return view('Conversation.index',compact('users'));


    }

<<<<<<< Updated upstream
    public function show(int $id){



    }

}
=======
    public function show(Usager $user){

        $users = Usager::all() -> where('id','!=',Auth::user()->id);
        return view('Conversation.users',compact('users'));

    }


}
>>>>>>> Stashed changes
