<?php

namespace App\Http\Controllers;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Log;

class LoginController extends Controller
{

    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $email = $request->email;
        $passwd = $request->passwd;
        $passwd = Hash::make($passwd);
        $form_data = array(
            'email'       =>   $email,
            'passwd'        =>   $passwd
        );
        $loginInfo = $request -> only(['email', 'passwd']);
        $rs = auth() -> attempt($loginInfo);
        error_log ('['.__FILE__.']['.__FUNCTION__.']['.__LINE__.']['.date("YmdHis").']'.print_r($rs,true)."\n", 3, "/var/www/chukppa/board/upImages/data/L_".date("Ymd").'.log');
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