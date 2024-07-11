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

    public function signup(){
        return view('signup');
    }

    public function emailcheck(Request $request){
        $email = $request->email;
        
        $rs = Member::where('email',$email)->count();
        if($rs){
            return response()->json(array('msg'=> "이미 사용중인 이메일입니다.", 'result'=>false), 200);
        }else{
            return response()->json(array('msg'=> "사용할 수 있는 이메일입니다.", 'result'=>true), 200);
        }
    }

    public function namecheck(Request $request){
        $name = $request->name;
        
        $rs = Member::where('nickName',$name)->count();
        if($rs){
            return response()->json(array('msg'=> "이미 사용중인 이름입니다.", 'result'=>false), 200);
        }else{
            return response()->json(array('msg'=> "사용할 수 있는 이름입니다.", 'result'=>true), 200);
        }
    }

    public function signupok(Request $request){
        $passwd = $request->password;
        $passwd = hash('sha512',$passwd);
        $form_data = array(
            'email' => $request->email,
            'passwd' => $passwd,
            'name' => $request->name,
            'nickName' => $request->name
        );

        $rs=Member::create($form_data);
        
        if($rs){
            return response()->json(array('msg'=> "가입해 주셔서 감사합니다.", 'result'=>true), 200);
        }else{
            return response()->json(array('msg'=> "실패했습니다. 관리자에게 문의해주세요.", 'result'=>false), 200);
        }
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