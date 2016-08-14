$(document).ready(function(){
	$("#toInputUserData").click(function(){
		location.href = "/inputUserData.php";
		return false;
	});
});
function toConfirm(){
	var fd = new FormData($('#inputUserDataForm').get(0));
	$.ajax({
		url: "module/InputUserControl.php",
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
			$('#err_userid').empty();
			$('#err_userpswd').empty();
			$('#err_userpswd_conf').empty();
			$('#err_email').empty();
			// 該当のエラー表示
			if(data.errorid != null){
				$('#'+data.errorid).append(data.errormsg);
			}
			else{
				// 入力内容確認画面へ遷移
				location.href = '/confirmUserData.php';
			}
		}
	});
	return false;
}
