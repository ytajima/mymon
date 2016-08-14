$(document).ready(function(){
	$("#toAuthControl").click(function(){
		var fd = new FormData($("#authenticationForm").get(0));
		$.ajax({
			url: "module/AuthControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false
		})
		.done(function( data ){
			if(data.status == 'fail'){
				location.href = "/error.php";
			}
			else{
				// エラー表示のクリア
				$('#err_userid').empty();
				$('#err_userpswd').empty();
				// 該当のエラー表示
				if(data.errorid != null){
					$('#'+data.errorid).append(data.errormsg);
				}
				else{
					// マイページへ遷移
					location.href = '/mypage.php';
				}
			}
		});
		return false;
	});
	$("#toIndex").click(function(){
		location.href = "/index.php";
		return false;
	});
});
