<?php

namespace App\Http\Controllers;
use App\Models\Qna;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    public function index(){
        //Qna::orderBy('regdate', 'desc')->get();
        $Qnas = Qna::latest('regdate')->paginate(10);
        return view('qna.index', compact('Qnas'));
    }

}
