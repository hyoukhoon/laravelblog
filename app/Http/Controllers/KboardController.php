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
        //$boards = Kboard::latest('reg_date')->paginate(20);
        $boards = Kboard::orderBy('num','desc')->paginate(20);
        return view('boards.index', compact('boards'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function search(Request $request){
        $param = "%".$request->input('search')."%";
        $boards = Kboard::where('subject', 'LIKE', $param)->orderBy('num', 'desc')->paginate(20);
        return view('boards.index', compact('boards'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    // public function search($search){
    //     $param = "%".$search."%";
    //     $boards = Kboard::where('subject', 'LIKE', $param)->orderBy('num', 'desc')->paginate(20);
    //     return view('boards.index', compact('boards','search'))->with('i', (request()->input('page', 1) - 1) * 20);
    // }

    public function write()
    {
        if(auth()->check()){
            return view('boards.write');
        }else{
            return redirect()->back()->with('로그인 하십시오.');
        }
    }

    public function summernote()
    {
        $boards = array();
        return view('boards.summernote',compact('boards'));
    }

    public function create(Request $request)
    {
        $form_data = array(
            'subject' => $request->subject,
            'content' => $request->content,
            'file_list' => $request->imgUrl,
            'attachfile' => $request->attachFile,
            'name' => Auth::user()->nickName,
            'email' => Auth::user()->email,
            'isdisp' => 1
        );

        if(auth()->check()){
            $rs=Kboard::create($form_data);
            return response()->json(array('msg'=> "succ", 'num'=>$rs->num), 200);
        }
    }

    public function show($num,$page)
    {
        Kboard::find($num)->increment('cnt');
        $boards = Kboard::findOrFail($num);
        $boards->content = htmlspecialchars_decode($boards->content);
        $boards->content = str_replace("/board/upImages/","https://www.zzarbang.com/board/upImages/",$boards->content);
        $boards->attfiles = $boards->attachfile?explode(",",$boards->attachfile):0;
        $boards->pagenumber = $page;

        $memos = memo::where('bid', $num)
            ->orderByRaw('IFNULL(pid,id), pid ASC')
            ->orderBy('id', 'asc')
            ->get();
        return view('boards.view', ['boards' => $boards, 'memos' => $memos]);
    }

    public function edit($num)
    {
        $boards = Kboard::findOrFail($num);
        $boards->attfiles = explode(",",$boards->attachfile);
        return view('boards.edit', compact('boards'));
    }

    public function summernoteedit($num)
    {
        $boards = Kboard::findOrFail($num);
        return view('boards.summernote', compact('boards'));
    }

    public function update(Request $request)
    {

        $num = $request->num;
        $request->validate([
            'subject'    =>  'required',
            'content'     =>  'required'
        ]);

        $form_data = array(
            'subject' => $request->subject,
            'content' => $request->content,
            'file_list' => $request->imgUrl,
            'attachfile' => $request->attachFile,
        );

        $boards = Kboard::findOrFail($num);

        if(Auth::user()->email==$boards->email){
            if(Kboard::where('num', $num)->update($form_data)){
                return response()->json(array('msg'=> "succ", 'num'=>$num), 200);
            }else{
                return redirect('/boards/edit/'.$num);
            }
        }
    }

    public function delete($num)
    {
        $data = Kboard::findOrFail($num);
        if(Auth::user()->email==$data->email){
            attachdeletes($data->attachfile);
            attachdeletes($data->file_list);
            $data->delete();

            return redirect('/boards')->with('success', 'Data is successfully deleted');
        }else{
            return redirect('/boards/show/'.$num);
        }
    }

    public function memoread(Request $request)
    {
        $data = memo::findOrFail($request->mid);
        if(Auth::user()->email==$data->userid){
            return response()->json(array('msg'=> "succ", 'data'=>$data), 200);
        }else{
            return response()->json(array('msg'=> "fail"), 200);
        }
    }

    public function memomodifyup(Request $request)
    {
        $data = memo::findOrFail($request->mid);
        if(Auth::user()->email==$data->userid){
            $form_data = array(
                'memo'       =>   $request->memo
            );
            memo::where('id', $request->mid)->update($form_data);
            return response()->json(array('msg'=> "succ", 'data'=>$request->memo), 200);
        }else{
            return response()->json(array('msg'=> "fail"), 200);
        }
    }

    public function memodelete(Request $request)
    {
        $data = memo::findOrFail($request->id);
        if(Auth::user()->email==$data->userid){
            attachdeletes($data->memo_file);
            $rs = $data->delete();

            if($rs){
                Kboard::find($request->bid)->decrement('memo_cnt');
            }

            return response()->json(array('msg'=> "succ", 'num'=>$rs), 200);
        }else{
            return response()->json(array('msg'=> "fail"), 200);
        }
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
        $insert_data->memo_file = $request->memo_file??null;
        $insert_data->bid = $request->bid;
        $insert_data->pid = $request->pid??null;
        $insert_data->name = Auth::user()->nickName;
        $insert_data->userid = Auth::user()->email;

        if(auth()->check()){
            $rs = $insert_data->save(); // 여기서 $rs는 true만 리턴
            if($rs){
                Kboard::find($request->bid)->increment('memo_cnt');//부모글의 댓글 갯수 업데이트
                Kboard::where('num', $request->bid)->update([//부모글의 댓글 날짜 업데이트
                    'memo_date' => date('Y-m-d H:i:s')
                ]);
            }

            return response()->json(array('msg'=> "succ", 'num'=>$rs), 200);
        }
    }

    public function saveimage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        if(auth()->check()){
            $image = $request->file('file');
            $new_name = rand().'_'.time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $fid = rand();
            return response()->json(array('msg'=> "succ", 'fn'=>$new_name, 'fid'=>$fid), 200);
        }
    }

    public function deletefile(Request $request)
    {
        $image = $request->fn;
        $num = $request->num;
        unlink(public_path('images')."/".$image);

        $boards = Kboard::findOrFail($num);
        $attachfiles = explode(",",$boards->attachfile);
        $key = array_search($image, $attachfiles );
        array_splice($attachfiles, $key, 1 );

        $form_data = array(
            'attachfile'       =>   implode(",",$attachfiles)
        );
        Kboard::where('num', $num)->update($form_data);

        return response()->json(array('msg'=> "succ", 'fn'=>$image, 'fid'=>substr($image,0,10)), 200);
    }

}
