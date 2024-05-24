@extends('boards.layout')
@section('content')
    <h2 class="mt-4 mb-3">게시판 보기</h2>

    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th scope="col">제목</th>
                <td>{{ $boards->subject }}</td>
            </tr>
            <tr>
                <th scope="col">내용</th>
                <td>{{ $boards->contents }}</td>
            </tr>
        </tbody>
    </table>
    <div align="right">
        <a href="{{ route('boards.index') }}" class="btn btn-default">목록</a>
    </div>
@endsection
