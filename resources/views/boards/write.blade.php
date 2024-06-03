@extends('boards.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<br />
     <form method="post" action="{{ route('boards.create') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
      <div class="form-group">
       <label class="col-md-4 text-right">제목</label>
       <div class="col-md-8">
        <input type="text" name="subject" id="subject" class="form-control input-lg" />
       </div>
      </div>

      <div class="form-group">
       <label class="col-md-4 text-right">내용</label>
       <div class="col-md-8">
            <textarea class="form-control" name="content" id="content" rows="10"></textarea>
       </div>
      </div>
      <br />
      <br />
      <br />
      <div class="col-md-8 form-group text-center">
       {{-- <input type="submit" name="edit" class="btn btn-primary input-lg" value="등록" /> --}}
       <input type="button" name="edit" class="btn btn-primary input-lg" onclick="sendsubmit()" />등록</button>
      </div>
     </form>
<script>
     function sendsubmit(){
          var subject=$("#subject").val();
          var content=$("#content").val();
          var data = {
               subject : subject,
               content : content
          };
          $.ajax({
               //아래 headers에 반드시 token을 추가해줘야 한다.!!!!! 
               headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
               type: 'post',
               url: '{{ route('boards.create') }}',
               dataType: 'json',
               data: data,
               success: function(data) {
                    console.log(data);
               },
               error: function(data) {
                    console.log("error" +data);
               }
          });
     }
</script>
@endsection
