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
            @if($boards->attfiles)
            <tr>
                <th width="100">첨부 이미지</th>
                <td>
                    @foreach ($boards->attfiles as $af)
                        <img src="/images/{{ $af }}" style="max-width:100%;"><br>
                    @endforeach
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    <div align="right">
        @auth()
        @if($boards->email==auth()->user()->email)
            <a href="/boards/edit/{{ $boards->num }}"><button type="button" class="btn btn-secondary">수정</button></a>
            <a href="/boards/delete/{{ $boards->num }}" class="btn btn-secondary" onclick="return confirm('삭제하시겠습니까?');">삭제</a>
        @endif
        @endauth
        <a href="#" onclick="history.back();" class="btn btn-primary">목록</a>
    </div>
    
    <!--댓글 시작 -->
    <div id="reply">
        @foreach ($memos as $key => $m)
        @if ($m->pid)
            <div class="d-flex" id="{{ 'memolist_'.$m->id }}">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                                          </svg>
                                    </td>
                                    <td class="ml">{{ $m->name }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <font size="2">{{ $m->regdate }}</font> 
                                        <span style="cursor:pointer" onclick="#"></span>
                                    </td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $m->memo }}</p>
                            @auth()
                            <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_modify('{{ $m->id }}')">수정</a></span>
                            <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('{{ $m->id }}','{{ $boards->num }}')">삭제</a></span>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card mt-2" id="{{ 'memolist_'.$m->id }}">
                <div class="card-header p-2">
                    <table>
                        <tbody>
                            <tr class="align-middle">
                                <td rowspan="2" class="pr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-chat-square-dots" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                </td>
                                <td class="ml">{{ $m->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <font size="2">{{ $m->regdate }}</font> 
                                        <span style="cursor:pointer" onclick="#"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    @if($m->memo_file)
                        <p class="card-text"><img src="/images/{{ $m->memo_file }}" style="max-width:90%;"></p>
                    @endif
                    <p class="card-text">{!! nl2br($m->memo) !!}</p>
                    @auth()
                    <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="reply_write('{{ $m->id }}','{{ $boards->num }}')">답글</a></span>
                    <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_modify('{{ $m->id }}')">수정</a></span>
                    <span class="badge bg-secondary" style="cursor:pointer;padding:10px;"><a onclick="memo_delete('{{ $m->id }}','{{ $boards->num }}')">삭제</a></span>
                    @endauth
                </div>
            </div>
            <div class="input-group" style="margin-top:10px;margin-bottom:10px;display:none;" id="{{ 'memo_reply_area_'.$m->id }}">
                <div class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"></path>
                    </svg>
                </div>
                <input type="hidden" name="memoid" id="memopid" value="{{ $m->id }}">
                <textarea class="form-control" aria-label="With textarea" name="{{ 'memo_'.$m->id }}" id="{{ 'memo_'.$m->id }}" placeholder="대댓글을 입력해주세요"></textarea>
                @auth()
                    <button type="button" class="btn btn-secondary" style="float:right;" id="{{ 'memo_submit_reply_'.$m->id }}" onclick="memo_reply('{{ $m->id }}','{{ $boards->num }}')">입력</button>
                @else
                    <button type="button" class="btn btn-secondary" style="float:right;" onclick="alert('로그인 하셔야 입력할 수 있습니다.');">입력</button>
                @endauth
            </div>
        @endif
        @endforeach
    </div>

    <!-- 댓글 끝 -->

    <!-- 댓글 입력 -->
    <div class="input-group" id="firstmemo" style="margin-top:10px;margin-bottom:10px;">
		<input type="hidden" name="memo_file" id="memo_file">
		<span class="input-group-text" id="memo_image_view" style="display:none;"></span>
		<button type="button" id="attmemoimg" class="btn btn-secondary">이미지첨부</button>
		<input type="file" name="upfile" id="upfile" accept="image/*" style="display:none;">
		<textarea class="form-control" aria-label="With textarea" style="height:100px;" name="memo" id="memo" placeholder="댓글을 입력해주세요"></textarea>
        @auth()
		    <button type="button" class="btn btn-secondary" style="float:right;" id="memo_submit" onclick="memoup()">입력</button>
        @else
            <button type="button" class="btn btn-secondary" style="float:right;" id="memo_submit" onclick="alert('로그인 하셔야 입력할 수 있습니다.');">입력</button>
        @endauth
    </div>
    <!-- 댓글 입력 끝-->
    <div style="padding:20px;">
    </div>

    <script>
        function memoup(){
            var memo=$("#memo").val();
            var memo_file=$("#memo_file").val();
            var data = {
                memo : memo,
                memo_file : memo_file,
                bid : {{ $boards->num }}
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

        function reply_write(m, b){
            $("#memo_reply_area_"+m).toggle();
        }

        function memo_modify(m){
            var data = {
                mid : m
            };
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '{{ route('boards.memoread') }}',
                dataType: 'json',
                data: data,
                success: function(data) {
                    var html='<div class="input-group" id="firstmemo" style="margin-top:10px;margin-bottom:10px;"><textarea class="form-control" aria-label="With textarea" style="height:100px;" name="memomodify_'+m+'" id="memomodify_'+m+'">'+data.data.memo+'</textarea><button type="button" class="btn btn-secondary" style="float:right;" id="memo_modifyup" onclick="memomodifyup('+m+')">수정</button></div>';
                    $("#memolist_"+m).append(html);
                },
                error: function(data) {
                    console.log("error" +JSON.stringify(data));
                }
            });
        }

        function memomodifyup(m){
            var memo=$("#memomodify_"+m).val();
            var data = {
                memo : memo,
                mid : m
            };
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '{{ route('boards.memomodifyup') }}',
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

        function memo_reply(m, b){
            var memo=$("#memo_"+m).val();
            var data = {
                memo : memo,
                pid : m,
                bid : b
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

        function memo_delete(m, b){
            if(!confirm('삭제하시겠습니까?')){
                return false;
            }
            var data = {
                id : m,
                bid : b
            };
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'post',
                url: '{{ route('boards.memodelete') }}',
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


    $("#attmemoimg").click(function () {
		$('#upfile').click();
    });
    
    $("#upfile").change(function(){
        var formData = new FormData();
        var files = $('#upfile').prop('files');
        console.log("files=>"+JSON.stringify(files));
        for(var i=0; i < files.length; i++) {
            attachFile(files[i]);
        }
    });

    function attachFile(file) {
    var formData = new FormData();
    formData.append("file", file);
    $.ajax({
        url: '{{ route('boards.saveimage') }}',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
		dataType : 'json' ,
        type: 'POST',
        success: function (return_data) {
			console.log(JSON.stringify(return_data));
			if(return_data.result=='image'){
				alert('용량이 너무크거나 이미지 파일이 아닙니다.');
				return;
			}else if(return_data.result=='gif'){
				alert(return_data.msg);
				return;
			}else{
				var html = "<img src='/images/"+return_data.fn+"' style='max-width:100%;height:88px;'>";
				//console.log("memoid=>"+memoid);
					$("#memo_image_view").html(html);
					$("#memo_image_view").show();
					$("#attmemoimg").hide();
					$("#memo_file").val(return_data.fn);
			}
        }
		, beforeSend: function () {
              var width = 0;
              var height = 0;
              var left = 0;
              var top = 0;
              width = 50;
              height = 50;

			  top = ( $(window).height() - height ) / 2 + $(window).scrollTop();
              left = ( $(window).width() - width ) / 2 + $(window).scrollLeft();

              if($("#div_ajax_load_image").length != 0) {
                     $("#div_ajax_load_image").css({
                            "top": top+"px",
                            "left": left+"px"
                     });
                     $("#div_ajax_load_image").show();
              }
              else {
						$('#memo_image_view').html('<div id="div_ajax_load_image" style="width:' + width + 'px; height:' + height + 'px; z-index:9999; " class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
              }

       }
	    , complete: function () {
                     $("#div_ajax_load_image").hide();
       }
    });

}

   </script>

@endsection
