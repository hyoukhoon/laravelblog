@extends('boards.layout')
@section('content')
<br />
     <form method="post" action="{{ route('boards.create') }}" enctype="multipart/form-data">
        @csrf
        @method('post')
      <div class="form-group">
       <label class="col-md-4 text-right">제목</label>
       <div class="col-md-8">
        <input type="text" name="subject" class="form-control input-lg" />
       </div>
      </div>

      <div class="form-group">
       <label class="col-md-4 text-right">내용</label>
       <div class="col-md-8">
            <textarea class="form-control" name="content" rows="10"></textarea>
       </div>
      </div>
      <br />
      <br />
      <br />
      <div class="col-md-8 form-group text-center">
       <input type="submit" name="edit" class="btn btn-primary input-lg" value="등록" />
      </div>
     </form>

@endsection
