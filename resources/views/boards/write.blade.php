@extends('boards.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<style>
     .childImg{
          width:90%;
     }
</style>
<br />
     <form method="post" action="{{ route('boards.create') }}" enctype="multipart/form-data">
          @csrf
          @method('post')
          <input type="hidden" name="attcnt" id="attcnt" value="0">
          <input type="hidden" name="imgUrl" id="imgUrl" value="">
          <div class="form-group">
          <div class="col-md-8">
          <input type="text" name="subject" id="subject" class="form-control input-lg" placeholder="제목을 입력하세요." />
          </div>
          <br />
          </div>

          <div class="form-group">
               <div class="col-md-8">
                    {{-- <textarea class="form-control" name="content" id="content" rows="10"></textarea> --}}
                    <div id="summernote"></div>
               </div>
          </div>
          <br />
          <br />
          <div id="attach_site" class="col-md-8">
               <div class="row row-cols-1 row-cols-md-6 g-4" id="attachFiles" style="margin-left:0px;">
               </div>
          </div>
          <div class="col-md-8">
               <input type="file" name="afile" id="afile" accept="image/*" multiple class="form-control" aria-label="Large file input example">
          </div>
          <br />
          <br />
          <br />
          <div class="col-md-8 form-group text-center">
          <button type="button" name="edit" class="btn btn-primary input-lg" onclick="sendsubmit()">등록</button>
          </div>
     </form>
<script>

$(document).ready(function() {
     var $summernote = $('#summernote').summernote({
          placeholder: '내용을 입력하세요.',
          tabsize: 2,
          height: 400,
          focus: true,
          toolbar: [
               ['style', ['style']],
               ['font', ['bold', 'underline', 'clear']],
               ['color', ['color']],
               ['para', ['ul', 'ol', 'paragraph']],
               ['table', ['table']],
               ['insert', ['link', 'picture', 'video']],
               ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks: {
               onImageUpload: function (files) {
                    for(var i=0; i < files.length; i++) {
                         saveFile($summernote, files[i]);
                    } 
               }
          }
     });
});

function saveFile($summernote, file){
     var formData = new FormData();
     formData.append("file", file);
     formData.append("uptype", "editor");
     $.ajax({
          url: '{{ route('boards.saveimage') }}',
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          success: function (data) {
               if(data==-1){
                    alert('용량이 너무크거나 이미지 파일이 아닙니다.');
                    return;
               }else{
                    $summernote.summernote('insertImage', data, function ($image) {
                         var imgdata = "/images/"+data.fn;
                         $image.attr('src', imgdata);
                         $image.attr('class', 'childImg');
                    });
                    var imgUrl=$("#imgUrl").val();
                    if(imgUrl){
                         imgUrl=imgUrl+",";
                    }
                    $("#imgUrl").val(imgUrl+data.fn);
               }
          }
     });
}

$("#afile").change(function(){
	var formData = new FormData();
	var attcnt=$("#attcnt").val();
	var files = $('#afile').prop('files');
	var totcnt=parseInt(attcnt)+parseInt(files.length)

	if(totcnt>10){
		alert('10개까지만 등록할 수 있습니다.');
		return false;
	}

	for(var i=0; i < files.length; i++) {
		attachFile(files[i]);
	}
});   

function attachFile(file) {
     var formData = new FormData();
	var num=$("#num").val();
     formData.append("file", file);
	formData.append("uptype", "attach");
	formData.append("num", num);
     $.ajax({
        url: '{{ route('boards.saveimage') }}',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
	   dataType : 'json' ,
        type: 'POST',
        success: function (return_data) {
//			console.log(JSON.stringify(return_data));
			if(return_data.result=='image'){
				alert('용량이 너무 크거나 이미지 파일이 아닙니다.');
				return;
			}else if(return_data.result=='gif'){
				alert(return_data.msg);
				return;
			}else if(return_data.result=='fail'){
				alert(return_data.msg);
				return false;
			}else{
                //var img="<img src='"+data+"' width='50'><br>";
				var html = "<div id='"+return_data.fn+"' class='card h-100' style='width:120px;margin-right: 10px;margin-bottom: 10px;'><img src='/images/"+return_data.fn+"' width='100' /><div class='card-body'><button type='button' class='btn btn-warning' onclick=\"file_del('"+return_data.fn+"')\">삭제</button></div></div>";
                    $("#attachFiles").append(html);
				
				var rcnt=parseInt(attcnt)+1;
				$("#attcnt").val(rcnt);
				var attachFile=$("#attachFile").val();
				if(attachFile){
					attachFile=attachFile+",";
				}
				$("#attachFile").val(attachFile+return_data.filename);
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
                     $('body').append('<div id="div_ajax_load_image" style="position:absolute; top:' + top + 'px; left:' + left + 'px; width:' + width + 'px; height:' + height + 'px; z-index:9999;" class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>');
              }

       }
	    , complete: function () {
                     $("#div_ajax_load_image").hide();
       }
    });

}

     function sendsubmit(){
          var subject=$("#subject").val();
          //var content=$("#content").val();
          var content=$('#summernote').summernote('code');
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
                    location.href='/boards/show/'+data.num;
               },
               error: function(data) {
                    console.log("error" +data);
               }
          });
     }
</script>
@endsection
