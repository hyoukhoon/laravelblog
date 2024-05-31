<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $email = $request->email;
        $passwd = $request->passwd;
        //$passwd = Hash::make($passwd);
        $passwd = hash('sha512',$passwd);
        $remember = $request->remember;
        $loginInfo = array(
            'email' => $email,
            'passwd' => $passwd
        );
        //$ismember=Member::where($loginInfo)->exists();
        $ismember = Member::where($loginInfo)->first();
        //print_r($ismember);
        if($ismember){
            Auth::login($ismember, $remember);
            return redirect() -> route('boards.index');
        }else{
            return redirect() -> route('auth.login');
        }
    }

    public function logout(){
        auth() -> logout();
        return redirect() -> route('boards.index');
    }
}