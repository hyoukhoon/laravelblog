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
        $email = $request->email;
        $passwd = $request->passwd;
        $passwd = hash('sha512',$passwd);
        $form_data = array(
            'email'       =>   $email,
            'passwd'        =>   $passwd
        );
        error_log ('['.__FILE__.']['.__FUNCTION__.']['.__LINE__.']['.date("YmdHis").']'.print_r($form_data,true)."\n", 3, "/var/www/chukppa/board/upImages/data/V_".date("Ymd").'.log');
        $loginInfo = $request -> only(['email', 'passwd']);
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