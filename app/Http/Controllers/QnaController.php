<?php

namespace App\Http\Controllers;
use App\Models\Qna;
use Illuminate\Http\Request;

class QnaController extends Controller
{
    private $Qna;

    public function __construct(Qna $Qna){
        // Laravel 의 IOC(Inversion of Control) 입니다
        // 일단은 이렇게 모델을 가져오는 것이 추천 코드라고 생각하시면 됩니다.
        $this->Qna = $Qna;
    }

    public function index(){
        // Qnas 의 데이터를 최신순으로 페이징을 해서 가져옵니다.
        $Qnas = $this->Qna->latest()->paginate(10);
        // produce/index.blade 에 $Qnas 를 보내줍니다
        return view('Qna.index', compact('Qnas')); //
    }

    public function create(){
        return view('Qna.create');
    }

    public function store(Request $request)
    {
        // Request 에 대한 유효성 검사입니다, 다양한 종류가 있기에 공식문서를 보시는 걸 추천드립니다.
        // 유효성에 걸린 에러는 errors 에 담깁니다.
        $request = $request->validate([
            'name' => 'required',
            'content' => 'required'
        ]);
        $this->Qna->create($request);
        return redirect()->route('Qna.index');
    }
}
