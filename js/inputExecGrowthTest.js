$(document).ready(function(){
	//回答が選ばれるまで、次へボタンを非活性
	$('#toExecGrowthTestControl').attr('disabled', true);

	var data = { type : "init"};
	$.ajax({
		url: "module/InputExecGrowthTestControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.id == null){
			location.href = '/testApp/error.php';
		}
		else{
			// 取得した質問内容を描画
			var no = data.currentorder + 1;
			$('#questionNum').append(no);
			$('#contentid').val(data.id);
			$('#attrcd').val(data.attrcd);
			$('#contentData').append("問" + no + "." + data.content);
			$('#maxcount').append(data.maxcount);
			// 戻るボタンを非活性
			$('#toBack').attr('disabled', true);
		}
	});
	$("#toExecGrowthTestControl").click(function(){
		$('#type').val('next');
		var fd = new FormData($("#inputExecGrowthTestForm").get(0));
		$.ajax({
			url: "module/InputExecGrowthTestControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false,
			async: false
		})
		.done(function( data ){
			if(data.id == null){
				location.href = '/testApp/error.php';
			}
			else if(data.id == 'success'){
				location.href = '/testApp/inputExecRandomTest.php';
			}
			else{
				// 描画前に前回表示分を削除
				$('#questionNum').empty();
				$('#contentData').empty();
				$('#maxcount').empty();
				$('#on').attr("checked", false);
				$('#off').attr("checked", false);
				$('#none').attr("checked", false);
				$('#toExecGrowthTestControl').attr('disabled', true);

				// 取得した質問内容を描画
				var no = data.currentorder + 1;
				$('#questionNum').append(no);
				$('#contentid').val(data.id);
				$('#attrcd').val(data.attrcd);
				$('#contentData').append("問" + no + "." + data.content);
				$('#maxcount').append(data.maxcount);

				// 戻るボタンを活性
				$('#toBack').attr('disabled', false);

				// 最後の質問時にボタンラベル変更
				if(no == data.maxcount){
					$('#toExecTestControl').empty();
					$('#toExecTestControl').append('次へ');
				}
			}
		});
		return false;
	});
	$("#toBack").click(function(){
		$('#type').val('back');
		var fd = new FormData($("#inputExecGrowthTestForm").get(0));
		$.ajax({
			url: "module/InputExecGrowthTestControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false,
			async: false
		})
		.done(function( data ){
			if(data.id == null){
				location.href = '/testApp/error.php';
			}
			else{
				// 描画前に前回表示分を削除
				$('#questionNum').empty();
				$('#contentData').empty();
				$('#maxcount').empty();
				$('#on').attr("checked", false);
				$('#off').attr("checked", false);
				$('#none').attr("checked", false);
				$('#toExecTestControl').attr('disabled', true);

				// 取得した質問内容を描画
				var no = data.currentorder + 1;
				$('#questionNum').append(no);
				$('#contentid').val(data.id);
				$('#contentData').append("問" + no + "." + data.content);
				$('#maxcount').append(data.maxcount);

				if(data.currentorder == 0){
					// 戻るボタンを非活性
					$('#toBack').attr('disabled', true);
				}
				else{
					// 戻るボタンを活性
					$('#toBack').attr('disabled', false);
				}
				$('#toExecGrowthTestControl').empty();
				$('#toExecGrowthTestControl').append('次の質問へ');
			}
		});
		return false;
	});
	$("#on").click(function(){
		//回答が選ばれたら、次へボタンを活性
		$('#toExecGrowthTestControl').attr('disabled', false);
	});
	$("#off").click(function(){
		//回答が選ばれたら、次へボタンを活性
		$('#toExecGrowthTestControl').attr('disabled', false);
	});
	$("#none").click(function(){
		//回答が選ばれたら、次へボタンを活性
		$('#toExecGrowthTestControl').attr('disabled', false);
	});
});
