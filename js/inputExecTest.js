$(document).ready(function(){
	//回答が選ばれるまで、次へボタンを非活性
	$('#toExecTestControl').attr('disabled', true);
    $('#toExecTestControl').hide();

	var data = { type : "init"};
	$.ajax({
		url: "module/InputExecTestControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.id == null){
			location.href = '/error.php';
		}
		else{
			// 取得した質問内容を描画
			var no = data.currentorder + 1;
			$('#questionNum').append(no);
			$('#contentid').val(data.id);
			$('#contentData').append("問" + no + "." + data.content);
			$('#maxcount').append(data.maxcount);
			// 戻るボタンを非活性
			$('#toBack').attr('disabled', true);
		}
	});
	$("#toExecTestControl").click(function(){
		// 「結果を見る」が押された場合
		if($('#questionNum').text() == $('#maxcount').text()){
			//コンテンツをセンタリングする
			centeringModalSyncer();
			//コンテンツを出現させる
			$("#modal-content,#modal-overlay").fadeIn("fast");
		}
		$('#type').val('next');
		var fd = new FormData($("#inputExecTestForm").get(0));
		$.ajax({
			url: "module/InputExecTestControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false,
			async: false
		})
		.done(function( data ){
			if(data.id == null){
				location.href = '/error.php';
			}
			else if(data.id == 'success'){
				// 3秒間待機してからフェードアウトし、画面遷移する
				setTimeout(function(){
					$("#modal-content,#modal-overlay").fadeOut("fast");
					location.href = '/resultExecTest.php';
				},3000);
			}
			else{
				// 描画前に前回表示分を削除
				$('#questionNum').empty();
				$('#contentData').empty();
				$('#maxcount').empty();
				$('#on').attr("checked", false);
				$('#off').attr("checked", false);
				$('#toExecTestControl').attr('disabled', true);
                $('#toExecTestControl').hide();

				// 取得した質問内容を描画
				var no = data.currentorder + 1;
				$('#questionNum').append(no);
				$('#contentid').val(data.id);
				$('#contentData').append("問" + no + "." + data.content);
				$('#maxcount').append(data.maxcount);

				// 戻るボタンを活性
				$('#toBack').attr('disabled', false);

				// 最後の質問時にボタンラベル変更
				if(no == data.maxcount){
					$('#toExecTestControl').empty();
					$('#toExecTestControl').append('結果を見る');
                    $('#toExecTestControl').hide();
				}
			}
		});
		return false;
	});
	$("#toBack").click(function(){
		$('#type').val('back');
		var fd = new FormData($("#inputExecTestForm").get(0));
		$.ajax({
			url: "module/InputExecTestControl.php",
			type: "POST",
			data: fd,
			dataType: 'json',
			processData: false,
			contentType: false,
			async: false
		})
		.done(function( data ){
			if(data.id == null){
				location.href = '/error.php';
			}
			else{
				// 描画前に前回表示分を削除
				$('#questionNum').empty();
				$('#contentData').empty();
				$('#maxcount').empty();
				$('#on').attr("checked", false);
				$('#off').attr("checked", false);
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
				$('#toExecTestControl').hide();
			}
		});
		return false;
	});
	$("#on").click(function(){
		//回答が選ばれたら、次へボタンを活性
//		$('#toExecTestControl').attr('disabled', false);
        setTimeout(function(){
            $('#toExecTestControl').click();
        },300);
	});
	$("#off").click(function(){
		//回答が選ばれたら、次へボタンを活性
//		$('#toExecTestControl').attr('disabled', false);
        setTimeout(function(){
            $('#toExecTestControl').click();
        },300);
	});
});

//センタリングを実行する関数
function centeringModalSyncer(){

	//画面(ウィンドウ)の幅、高さを取得
	var w = $(window).width();
	var h = $(window).height();

	//コンテンツ(#modal-content)の幅、高さを取得
	var cw = $("#modal-content").outerWidth({margin:true});
	var ch = $("#modal-content").outerHeight({margin:true});

	var left = ((w - cw)/2);
	var top = ((h - ch)/2);

	//センタリングを実行する
	$("#modal-content").css({"left": left + "px","top": top + "px"})

}
