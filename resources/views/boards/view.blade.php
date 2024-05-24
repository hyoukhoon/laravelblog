@extends('boards.layout')
@section('content')
    <h2 class="mt-4 mb-3">게시판 보기</h2>

    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th width="100">제목</th>
                <td>{{ $boards->subject }}</td>
            </tr>
            <tr>
                <th width="100">내용</th>
                <td>{!! $boards->content !!}</td>
            </tr>
            <tr>
                <th>이미지</th>
                <td><img src="https://www.zzarbang.com/board/upImages/data/oz_2023061721464616383.jpg" style="max-width: 100%; padding: 10px;"></td>
            </tr>
        </tbody>
    </table>
    <div align="right">
        <a href="{{ route('boards.index') }}" class="btn btn-default">목록</a>
    </div>
@endsection
