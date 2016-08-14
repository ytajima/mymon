$(document).ready(function(){
	$("#toMypage").click(function(){
		location.href = "/testApp/mypage.php";
		return false;
	});
	$("#toUpdateUserData").click(function(){
		location.href = "/testApp/updateUserData.php";
		return false;
	});
});
function toConfirm(){
	var fd = new FormData($('#updateUserDataForm').get(0));
	$.ajax({
		url: "module/UpdateUserControl.php",
		type: "POST",
		data: fd,
		dataType: 'json',
		processData: false,
		contentType: false
	})
	.done(function( data ) {
		if(data.status == 'fail'){
			location.href = '/testApp/error.php';
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
				location.href = '/testApp/confirmUpdateUserData.php';
			}
		}
	});
	return false;
}
