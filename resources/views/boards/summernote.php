<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<div id="summernote"></div>

<script>
$(document).ready(function() {
        var $summernote = $('#summernote').summernote({
            codeviewFilter: false,
            codeviewIframeFilter: true,
            lang: 'ko-KR',
            height: 360,
            toolbar:[
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']],
				['insert', ['link', 'picture', 'video', 'file']],
				['misc', ['codeview']]
            ],
            callbacks: {
            onImageUpload: function (files) {//이미지등록
				var summercnt=$("#summercnt").val();
				var summersize=$("#summersize").val();
				var sfcnt=parseInt(summercnt)+parseInt(files.length);
				$("#summercnt").val(sfcnt);

				if(sfcnt>10){
						alert('이미지는 10개까지 첨부 가능합니다.');
						return;
				}

				var tfsize=0;
				for(var i=0; i < files.length; i++) {
					var fsize=files[i].size;
					var tfsize=tfsize+fsize;
				 } 

				 var totalfsize=parseInt(summersize)+parseInt(tfsize);

				var maxSize = 30 * 1024 * 1024; // 5MB

				if(totalfsize>=maxSize){
					alert('이미지는 30MB까지 첨부 가능합니다.');
					return false;
				}

                for(var i=0; i < files.length; i++) {
					sendFile($summernote, files[i]);
				 } 
                
            }
        }
        });
    });

</script>