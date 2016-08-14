$(document).ready(function(){
	var data = { type : "age"};
	$.ajax({
		url: "module/InputAttributeControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.status != 'fail'){
			$("#age").append(data.status);
		}
		else{
			location.href = "/testApp/error.php";
		}
	});
	var data2 = { type : "gender"};
	$.ajax({
		url: "module/InputAttributeControl.php",
		type: "POST",
		data: data2,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.status != 'fail'){
			$("#gender").append(data.status);
		}
		else{
			location.href = "/testApp/error.php";
		}
	});
	$("#toInputAttributeControl").click(function(){
		var fd = new FormData($("#inputAttributeForm").get(0));
		$.ajax({
			url: "module/InputAttributeControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false
		})
		.done(function( data ){
			if(data.status != 'fail'){
				location.href = "/testApp/inputExecTest.php";
			}
			else{
				location.href = "/testApp/error.php";
			}
		});
		return false;
	});
	$("#toIndex").click(function(){
		location.href = "/testApp/index.php";
		return false;
	});
});
