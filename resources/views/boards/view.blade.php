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
    
    <div class="input-group" id="firstmemo" style="margin-top:10px;margin-bottom:10px;">
		<input type="hidden" name="memo_file" id="memo_file">
		<span class="input-group-text" id="memo_image_view" style="display:none;"></span>
		<button type="button" id="togglememoimage" class="btn btn-seconday">
			이미지첨부
		  </button>
		  <input type="file" name="upfile" id="upfile" accept="image/*" style="display:none;">
		  <textarea class="form-control" aria-label="With textarea" style="height:100px;" name="memo" id="memo" placeholder="댓글을 입력해주세요"></textarea>
		  <button type="button" class="btn btn-secondary" style="float:right;" id="memo_submit" onclick="memoup()">입력</button>
    </div>

    <div id="reply">
        <!--댓글 시작 -->
        <div class="card mt-2" id="memolist_30">
            <div class="card-header p-2">
                <table>
                    <tbody>
                        <tr class="align-middle">
                            <td rowspan="2" class="pr-2">
                                댓글:
                            </td>
                            <td class="ml">파르티</td>
                        </tr>
                        <tr>
                            <td>
                                <font size="2">2024-06-05 13:02:59</font> 
                                    <span style="cursor:pointer" onclick="#"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <p class="card-text">test</p>
                <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="reply_write('30','4513')">답글</a></span>
                <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('30','4513')">삭제</a></span>
            </div>
        </div>
        <div class="d-flex" id="memolist_32">
            <div class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"></path>
            </svg>
            </div>
            <div class="flex-fill" style="width:100%">
                <div class="card mt-2">
                    <div class="card-header">
                        <table>
                            <tbody><tr class="align-middle">
                                <td rowspan="2" class="pr-2">
                                    대댓글:
                                </td>
                                <td class="ml">칸토나</td>
                            </tr>
                            <tr>
                                <td>
                                    <font size="2">2024-06-05 13:03:38</font> 
                                    <span style="cursor:pointer" onclick="#"></span>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="card-body">
                        
                        <p class="card-text">다답글</p>
                        <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('32','4513')">삭제</a></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- 대댓글 -->
        <div class="card mt-2" id="memolist_31">
            <div class="card-header p-2">
                <table>
                    <tbody>
                        <tr class="align-middle">
                            <td rowspan="2" class="pr-2">
                                댓글:
                            </td>
                            <td class="ml">칸토나</td>
                        </tr>
                        <tr>
                            <td>
                                <font size="2">2024-06-05 13:03:14</font> 
                                    <span style="cursor:pointer" onclick="#"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <p class="card-text">testtest</p>
                <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('31','4513')">삭제</a></span>
            </div>
        </div>
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
