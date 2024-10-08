@extends('boards.layout')
@section('content')
<br />
     <form method="post" action="{{ route('boards.update') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
      <input type="hidden" name="attcnt" id="attcnt" value="0">
      <input type="hidden" name="imgUrl" id="imgUrl" value="">
      <input type="hidden" name="attachFile" id="attachFile" value="">
      <input type="hidden" name="num" id="num" value="{{ $boards->num}}">
      <div class="form-group">
       <label class="col-md-4 text-right">제목</label>
       <div class="col-md-8">
        <input type="text" name="subject" id="subject" value="{{ $boards->subject }}" class="form-control input-lg" />
       </div>
      </div>

      <div class="form-group">
       <div class="col-md-8">
          <iframe id="summerframe" src="{{ route('boards.summernoteedit', $boards->num) }}" style="width:100%; height:650px; border:none" scrolling = "no"></iframe>
       </div>
      </div>
      <br />
      <br />
      <div id="attach_site" class="col-md-8">
         <div class="row row-cols-1 row-cols-md-6 g-4" id="attachFiles" style="margin-left:0px;">
            @foreach ($boards->attfiles as $af)
               @if($af)
                  <div id="af_{{ substr($af,0,10) }}" class='card h-100' style='width:120px;margin-right: 10px;margin-bottom: 10px;'><img src="/images/{{ $af }}" width='100' /><div class='card-body'><button type='button' class='btn btn-warning' onclick="deletefile('{{ $af }}')">삭제</button></div></div>
               @endif
            @endforeach
         </div>
      </div>
      <div class="col-md-8">
         <input type="file" name="afile" id="afile" accept="image/*" multiple class="form-control" aria-label="Large file input example">
    </div>
      <div class="col-md-8 form-group text-center">
       <button type="button" name="edit" class="btn btn-primary input-lg" onclick="sendsubmit();">수정하기</button>
      </div>
     </form>
<script>
   function deletefile(fn){
          var data = {
               fn : fn,
               num : '<?php echo $boards->num;?>'
          };
          $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type: 'post',
               url: '{{ route('boards.deletefile') }}',
               dataType: 'json',
               data: data,
               success: function(data) {
                    alert("삭제했습니다.");
                    $("#af_"+data.fid).hide();
               },
               error: function(data) {
                    console.log("error" +JSON.stringify(data));
               }
          });
   }

   function sendsubmit(){
          var subject=$("#subject").val();
          var content=$('#summerframe').get(0).contentWindow.$('#summernote').summernote('code');//iframe에 있는 summernote함수를 작동시킨다.
          var imgUrl = $("#imgUrl").val();
          var attachFile = $("#attachFile").val();
          var data = {
               subject : subject,
               content : content,
               imgUrl : imgUrl,
               attachFile : attachFile,
               num : '<?php echo $boards->num;?>'
          };
          $.ajax({
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type: 'post',
               url: '{{ route('boards.update') }}',
               dataType: 'json',
               data: data,
               success: function(data) {
                    location.href='/boards/show/'+data.num+'/1';
               },
               error: function(data) {
                    console.log("error" +data);
               }
          });
     }
</script>
@endsection
