$(document).ready(function(){
	var data = { type : "init"};
	$.ajax({
		url: "module/ResultExecTestControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.img == null){
			location.href = '/error.php';
		}
		else{
			$('#charanm').append(data.name);
			$('#resultImg').append(data.img);
			$('#resultCmt').append(data.cmt);
            $('#selfPositiveRate').append(data.selfPositiveRate);
			$('#twitter').append(data.twitter);
			$('#facebook').append(data.facebook);
			$('#line').append(data.line);
		}
	});
	$("#toIndex").click(function(){
		location.href = "/index.php";
		return false;
	});
	$("#toInputUserData").click(function(){
		location.href = "/inputUserData.php";
		return false;
	});
});
