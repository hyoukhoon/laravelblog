@extends('boards.layout')
@section('content')
<section class="vh-100" style="background-color: #e3e4e6;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-9">
          <h1 class="mb-4" style="text-align:center;">회원가입</h1>
          <div class="card" style="border-radius: 15px;">
            <div class="card-body">
              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">이름(닉넴임)</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="text" name="name" id="name" class="form-control form-control-lg" />
                </div>
              </div>
              <hr class="mx-n3">
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">이메일</h6>
                </div>
                <div class="col-md-9 pe-5">
                  <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="example@example.com" />
                </div>
              </div>
              <hr class="mx-n3">
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">비밀번호</h6>
                </div>
                <div class="col-md-9 pe-5">
                    <input type="password" name="password1" id="password1" class="form-control form-control-lg" />
                </div>
              </div>
              <hr class="mx-n3">
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
                  <h6 class="mb-0">비밀번호 확인</h6>
                </div>
                <div class="col-md-9 pe-5">
                    <input type="password" name="password2" id="password2" class="form-control form-control-lg" />
                </div>
              </div>
              <hr class="mx-n3">
              <div class="px-5 py-4" style="text-align:center;">
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" id="signup">가입하기</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection  
<script>
  $("#email").on( "keyup, keydown", function() {
    alert("keyup");
});
</script>