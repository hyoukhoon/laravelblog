<?php

namespace App\Http\Controllers;
use App\Models\Kboard;
use Illuminate\Http\Request;
use Log;

class KboardController extends Controller
{
    public function index(){
        //Qna::orderBy('regdate', 'desc')->get();
        //$boards = Kboard::latest('reg_date')->paginate(10);
        $boards = Kboard::orderBy('num','desc')->paginate(20);
        //error_log ('['.__FILE__.']['.__FUNCTION__.']['.__LINE__.']['.date("YmdHis").']'.print_r($boards,true)."\n", 3, "/var/www/chukppa/board/upImages/data/L_".date("Ymd").'.log');
        //return view('boards.index', compact('boards'));
        return view('boards.index', compact('boards'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function show($num)
    {
        $boards = Kboard::findOrFail($num);
        $boards->content = htmlspecialchars_decode($boards->content);
        $boards->content = str_replace("/board/upImages/","https://www.zzarbang.com/board/upImages/",$boards->content);
        return view('boards.view', compact('boards'));
    }

    public function edit($num)
    {
        $boards = Kboard::findOrFail($num);
        return view('boards.edit', compact('boards'));
    }

    public function update(Request $request, $num)
    {

        $request->validate([
            'subject'    =>  'required',
            'content'     =>  'required'
        ]);

        $form_data = array(
            'subject'       =>   $request->subject,
            'content'        =>   $request->content
        );

        if(Kboard::where('num', $num)->update($form_data)){
            return redirect('/boards/show/'.$num);
        }else{
            return redirect('/boards/edit/'.$num);
        }
    }

    public function delete($num)
    {
        $data = Kboard::findOrFail($num);
        $data->delete();

        return redirect('/boards')->with('success', 'Data is successfully deleted');
    }

}
