@extends('boards.layout')
@section('content')
<br />
     <form method="post" action="{{ route('boards.update', $boards->num) }}" enctype="multipart/form-data">
                @csrf
                @method('post')
      <div class="form-group">
       <label class="col-md-4 text-right">제목</label>
       <div class="col-md-8">
        <input type="text" name="first_name" value="{{ $boards->subject }}" class="form-control input-lg" />
       </div>
      </div>
      <br />
      <br />
      <br />
      <div class="form-group">
       <label class="col-md-4 text-right">내용</label>
       <div class="col-md-8">
            <textarea name="content" rows="10" cols="600">{{ $boards->content }}</textarea>
       </div>
      </div>
      <br />
      <br />
      <br />
      <div class="form-group text-center">
       <input type="submit" name="edit" class="btn btn-primary input-lg" value="수정" />
      </div>
     </form>

@endsection
