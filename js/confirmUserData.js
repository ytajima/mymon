$(document).ready(function(){
	$("#toInputUserData").click(function(){
		location.href = "/testApp/inputUserData.php";
		return false;
	});
});function toComplete(){
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
			location.href = '/testApp/error.php';
		}
		else{
			// 登録完了画面へ遷移
			location.href = '/testApp/completeUserData.php';
		}
	});
	return false;
}
