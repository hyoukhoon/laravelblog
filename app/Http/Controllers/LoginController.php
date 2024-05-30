<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use Log;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $loginInfo = $request -> only(['email', 'password']);
        if(auth() -> attempt($loginInfo)){
            return redirect() -> route('boards.index');
        } else{
            return redirect() -> route('auth.login');
        }

    }

    public function logout(){
        auth() -> logout();
        
        return redirect() -> route('boards.index');
    }
}