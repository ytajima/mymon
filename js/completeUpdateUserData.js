$(document).ready(function(){
	$("#toMypage").click(function(){
		location.href = "/mypage.php";
		return false;
	});
	$("#toLogoutControl").click(function(){
		$.ajax({
			url: "module/LogoutControl.php",
			type: "POST",
			dataType: 'json',
			processData: false,
			contentType: false
		})
		.done(function( data ) {
			if(data.status == 'fail'){
				location.href = '/error.php';
			}
			else{
				// トップページへ遷移
				location.href = '/index.php';
			}
		});
		return false;
	});
});
