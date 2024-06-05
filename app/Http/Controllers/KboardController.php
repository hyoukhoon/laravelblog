<?php

namespace App\Http\Controllers;
use App\Models\Kboard;
use App\Models\memo;
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

        $memos = memo::where(['bid' => $num, 'pid' => 0])
               ->orderBy('id', 'asc')
               ->get();
        return view('boards.view', ['boards' => $boards, 'memos' => $memos]);
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
        // $form_data = array(
        //     'memo' => $request->memo,
        //     'bid' => $request->bid,
        //     'pid' => $request->pid??null,
        //     'name' => Auth::user()->nickName,
        //     'userid' => Auth::user()->email
        // );

        //$rs=memo::create($form_data); 여기서 $rs는 입력한 전체 값을 리턴

        $insert_data = new memo();
        $insert_data->memo = $request->memo;
        $insert_data->bid = $request->bid;
        $insert_data->pid = $request->pid??null;
        $insert_data->name = Auth::user()->nickName;
        $insert_data->userid = Auth::user()->email;

        $rs = $insert_data->save(); // 여기서 $rs는 true만 리턴
        if($rs){
            Kboard::find($request->bid)->increment('memo_cnt');//부모글의 댓글 갯수 업데이트
            Kboard::where('num', $request->bid)->update([//부모글의 댓글 날짜 업데이트
                'memo_date' => date('Y-m-d H:i:s')
            ]);
        }

        return response()->json(array('msg'=> "succ", 'num'=>$rs), 200);
    }

    public function saveimage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $image = $request->file('file');
        $new_name = rand().'_'.time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
        return response()->json(array('msg'=> "succ", 'fn'=>$new_name), 200);
    }

}
