$(document).ready(function(){
	$("#toUpdateUserData").click(function(){
		location.href = "/updateUserData.php";
		return false;
	});
});
function toComplete(){
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
			location.href = '/error.php';
		}
		else{
			// 登録完了画面へ遷移
			location.href = '/completeUpdateUserData.php';
		}
	});
	return false;
}
