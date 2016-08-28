$(document).ready(function(){
	$("#toMypage").click(function(){
		location.href = "/mypage.php";
		return false;
	});
	$("#toUpdateDebugData").click(function(){
		location.href = "/updateDebugData.php";
		return false;
	});
});
function toConfirm(){
	var fd = new FormData($('#updateDebugDataForm').get(0));
	$.ajax({
		url: "module/DebugControl.php",
		type: "POST",
		data: fd,
		dataType: 'json',
		processData: false,
		contentType: false
	})
	.done(function( data ) {
		if(data.status == 'fail'){
			location.href = '/error.php';
		}
		else{
			// エラー表示のクリア
			$('#err_userpswd').empty();
			$('#err_userpswd_conf').empty();
			$('#err_email').empty();
			// 該当のエラー表示
			if(data.errorid != null){
				$('#'+data.errorid).append(data.errormsg);
			}
			else{
				// 入力内容確認画面へ遷移
				location.href = '/confirmUpdateDebugData.php';
			}
		}
	});
	return false;
}
