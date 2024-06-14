@extends('boards.layout')
@section('content')
<br />
     <form method="post" action="{{ route('boards.update', $boards->num) }}" enctype="multipart/form-data">
        @csrf
        @method('post')
      <div class="form-group">
       <label class="col-md-4 text-right">제목</label>
       <div class="col-md-8">
        <input type="text" name="subject" value="{{ $boards->subject }}" class="form-control input-lg" />
       </div>
      </div>

      <div class="form-group">
       <div class="col-md-8">
          <iframe id="summerframe" src="{{ route('boards.summernoteedit', $boards->num) }}" style="width:100%; height:650px; border:none" scrolling = "no"></iframe>
       </div>
      </div>
      <br />
      <br />
      <br />
      <div class="col-md-8 form-group text-center">
       <input type="submit" name="edit" class="btn btn-primary input-lg" value="수정" />
      </div>
     </form>

@endsection
