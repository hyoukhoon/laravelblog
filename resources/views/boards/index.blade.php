@extends('boards.layout')
@section('content')
    <h2 class="mt-4 mb-3">게시판 목록</h2>

    <table class="table table-striped table-hover">
        <colgroup>
            <col width="10%"/>
            <col width="15%"/>
            <col width="45%"/>
            <col width="15%"/>
            <col width="15%"/>
        </colgroup>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">이름</th>
            <th scope="col">제목</th>
            <th scope="col">조회수</th>
            <th scope="col">등록일</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($boards as $key => $board)
            <tr>
                <th scope="row">{{$key+1 + (($boards->currentPage()-1) * 10)}}</th>
                <td>{{$board->name}}</td>
                <td><a href="{{ route('boards.show', $board->num) }}">{{$board->subject}}</a></td>
                <td>{{$board->cnt}}</td>
                {{-- <td>{{$board->reg_date->format("Y-m-d")}}</td> --}}
                <td>{{ disptime($board->reg_date) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- {!! $boards->links() !!} --}}
    {{ $boards->links('paginations.default') }}
@endsection
