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
                <td colspan="2">글쓴이 : {{ $boards->name }}&nbsp;조회 : {{ number_format($boards->cnt) }}&nbsp;등록일 : {{ $boards->reg_date }}</td>
            </tr>
            <tr>
                <th width="100">내용</th>
                <td>{!! $boards->content !!}</td>
            </tr>
        </tbody>
    </table>
    <div align="right">
        @if($boards->email==auth()->user()->email)
            <a href="/boards/edit/{{ $boards->num }}" class="btn btn-default">수정</a>
            <a href="/boards/delete/{{ $boards->num }}" class="btn btn-default" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
        @else

        @endif
        <a href="{{ route('boards.index') }}" class="btn btn-default">목록</a>
    </div>
    <div>
        <table class="table table-bordered">
            <tr>
                <td>
                    <textarea class="form-control" name="memo" id="memo" rows="3"></textarea>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" id="memoup" onclick="memoup()">등록</button>
                </td>
            </tr>
        </table>
    </div>
    <script>
        function memoup(){
             var memo=$("#memo").val();
             var data = {
                  memo : memo,
                  pid : {{ $boards->num }}
             };
             $.ajax({
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  type: 'post',
                  url: '{{ route('boards.memoup') }}',
                  dataType: 'json',
                  data: data,
                  success: function(data) {
                    console.log(JSON.stringify(data));
                    location.reload();
                  },
                  error: function(data) {
                    console.log("error" +JSON.stringify(data));
                  }
             });
        }
   </script>

@endsection
