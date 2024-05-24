<?php

namespace App\Http\Controllers;
use App\Models\Kboard;
use Illuminate\Http\Request;

class KboardController extends Controller
{
    public function index(){
        //Qna::orderBy('regdate', 'desc')->get();
        //$boards = Kboard::latest('reg_date')->paginate(10);
        $boards = Kboard::orderBy('num','desc')->paginate(20);
        //return view('boards.index', compact('boards'));
        return view('boards.index', compact('boards'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function show($num)
    {
        $boards = Kboard::findOrFail($num);
        $boards->content = str_replace("/board/upImages/","https://www.zzarbang.com/board/upImages/",$boards->content);
        return view('boards.view', compact('boards'));
    }

}
