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
    
}
