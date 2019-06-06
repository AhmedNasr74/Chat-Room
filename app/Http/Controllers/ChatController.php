<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Events\ChatEvent;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function chat(){
        $user = User::find(Auth::id());
        return view('chat',['username'=>$user->name]);
    }

    // public function send(){
    //     $messege = "HI Broo...";
    //     $user = User::find(Auth::id());
    //     event(new ChatEvent($messege , $user));
    // }
    public function send(request $request)
    {        
        $user = User::find(Auth::id());
        event(new ChatEvent($request->messege , $user));
    }
}
