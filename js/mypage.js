$(document).ready(function(){
	var data = { type : "init"};
	$.ajax({
		url: "module/MypageControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.status == 'fail'){
			location.href = '/testApp/error.php';
		}
		else if(data.status == 'done'){
			// 次の実行可能日を表示する
			$('#exec_day').empty();
			$('#exec_day').append('次の回答日は ' + data.y + '年' + data.m + '月' + data.d + '日 になります');
			// ↓検証期間のみ設定
			// ボタンを非活性
			//$('#toInputExecGrowthTest').attr('disabled', true);
			//$('#toInputExecGrowthTest').empty();
			//$('#toInputExecGrowthTest').append('本日の質問には回答済みです');
			// ボタンを活性
			$('#toInputExecGrowthTest').attr('disabled', false);
			$('#toInputExecGrowthTest').empty();
			$('#toInputExecGrowthTest').append('本日の質問に回答する');
			// ↑検証期間のみ設定
		}
		else if(data.status == 'over'){
			// 次の実行可能日を表示する
			$('#exec_day').empty();
			$('#exec_day').append('すべての質問が終了しました');
			// ボタンを非活性
			$('#toInputExecGrowthTest').attr('disabled', true);
			$('#toInputExecGrowthTest').empty();
			$('#toInputExecGrowthTest').append('完了');
		}
		else{
			// 次の実行可能日を表示する
			$('#exec_day').empty();
			$('#exec_day').append('次の回答日は ' + data.y + '年' + data.m + '月' + data.d + '日 になります');
			// ボタンを活性
			$('#toInputExecGrowthTest').attr('disabled', false);
			$('#toInputExecGrowthTest').empty();
			$('#toInputExecGrowthTest').append('本日の質問に回答する');
		}
		// コメント表示
		$('#resultCmt').empty();
		$('#resultCmt').append(data.resultCmt);
		// 残日数表示
		$('#rmnumDays').empty();
		$('#rmnumDays').append('（残り ' + data.rmnumDays + ' 日）');
		// ソーシャル領域表示
		$('#twitter').append(data.twitter);
		$('#facebook').append(data.facebook);
		$('#line').append(data.line);
		return false;
	});
	$("#toUpdateUserData").click(function(){
		location.href = "/testApp/updateUserData.php";
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
				location.href = '/testApp/error.php';
			}
			else{
				// トップページへ遷移
				location.href = '/testApp/index.php';
			}
		});
		return false;
	});
	$("#toInputExecGrowthTest").click(function(){
		location.href = "/testApp/inputExecGrowthTest.php";
		return false;
	});
});
