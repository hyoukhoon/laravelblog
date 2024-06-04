<?php

namespace App\Http\Controllers;
use App\Models\Kboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function write()
    {
        if(auth()->check()){
            return view('boards.write');
        }else{
            return redirect()->back()->with('로그인 하십시오.');
        }
    }

    public function create(Request $request)
    {
        $form_data = array(
            'subject' => $request->subject,
            'content' => $request->content,
            'name' => Auth::user()->nickName,
            'email' => Auth::user()->email,
            'isdisp' => 1
        );

        $rs=Kboard::create($form_data);

        return response()->json(array('msg'=> "succ", 'num'=>$rs->num), 200);

        //return redirect('/boards')->with('success', 'Data Added successfully.');
    }

    public function show($num)
    {
        Kboard::find($num)->increment('cnt');
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

    public function memoup(Request $request)
    {
        $form_data = array(
            'memo' => $request->memo,
            'parent' => $request->parent,
            'name' => Auth::user()->nickName,
            'email' => Auth::user()->email,
            'isdisp' => 1
        );

        $rs=Kboard::create($form_data);

        return response()->json(array('msg'=> "succ", 'num'=>$rs->num), 200);

        //return redirect('/boards')->with('success', 'Data Added successfully.');
    }

    public function saveimage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $image = $request->file('file');
        $new_name = rand().'_'.date("YmdHis").'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        return response()->json(array('msg'=> "succ", 'fn'=>$new_name), 200);
    }

}
