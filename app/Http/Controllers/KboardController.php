<?php

namespace App\Http\Controllers;
use App\Models\Kboard;
use Illuminate\Http\Request;

class KboardController extends Controller
{
    public function index(){
        //Qna::orderBy('regdate', 'desc')->get();
        $boards = Kboard::latest('reg_date')->paginate(10);
        return view('boards.index', compact('boards'));
    }

}
