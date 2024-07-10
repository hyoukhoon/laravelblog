@extends('boards.layout')
@section('content')
<section class="vh-100" style="background-color: #e3e4e6;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-9">
  
          <h1 class="text-white mb-4">회원가입</h1>
  
          <div class="card" style="border-radius: 15px;">
            <div class="card-body">
  
              <div class="row align-items-center pt-4 pb-3">
                <div class="col-md-3 ps-5">
  
                  <h6 class="mb-0">이름</h6>
  
                </div>
                <div class="col-md-9 pe-5">
  
                  <input type="text" class="form-control form-control-lg" />
  
                </div>
              </div>
  
              <hr class="mx-n3">
  
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
  
                  <h6 class="mb-0">이메일</h6>
  
                </div>
                <div class="col-md-9 pe-5">
  
                  <input type="email" class="form-control form-control-lg" placeholder="example@example.com" />
  
                </div>
              </div>
  
              <hr class="mx-n3">
  
              <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
  
                  <h6 class="mb-0">비밀번호</h6>
  
                </div>
                <div class="col-md-9 pe-5">
  
                    <input type="password" class="form-control form-control-lg" />
  
                </div>
              </div>
  
              <hr class="mx-n3">
  
              {{-- <div class="row align-items-center py-3">
                <div class="col-md-3 ps-5">
  
                  <h6 class="mb-0">Upload CV</h6>
  
                </div>
                <div class="col-md-9 pe-5">
  
                  <input class="form-control form-control-lg" id="formFileLg" type="file" />
                  <div class="small text-muted mt-2">Upload your CV/Resume or any other relevant file. Max file
                    size 50 MB</div>
  
                </div>
              </div> --}}
  
              <hr class="mx-n3">
  
              <div class="px-5 py-4">
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">가입하기</button>
              </div>
  
            </div>
          </div>
  
        </div>
      </div>
    </div>
  </section>
  @endsection  