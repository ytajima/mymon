<?php
session_start();

if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /index.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8'>
		<meta http-equiv='Pragma' content='no-cache' />
		<meta http-equiv='cache-control' content='no-cache' />
		<meta http-equiv='expires' content='0' />
		<meta name="viewport" content="initial-scale=1.0" />
		<link rel='stylesheet' href='css/common_for_sp_320.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common_for_sp_375.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common.css' type='text/css'  media='screen' />
		<script type='text/javascript'  src='js/common/jquery-1.11.1.min.js'></script>
		<script type='text/javascript' src='js/inputExecGrowthTest.js'></script>
		<title>本日の質問</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>本日の質問</h2>
			</div>
			<div id='main'>
				<form id='inputExecGrowthTestForm' name='inputExecGrowthTestForm'>
				<input type="hidden" id='contentid' name='contentid' value=''>
				<input type="hidden" id='attrcd' name='attrcd' value=''>
				<input type="hidden" id='type' name='type' value='next'>
				<div id='contentData'>
				</div>
				<table class='index_table'>
					<tr>
						<td id='answer_select'>
							<input type='radio' name='answer' id='on' value='0'>
							<label for='on' class='switch-on'>はい</label>
							<input type='radio' name='answer' id='off' value='1'>
							<label for='off' class='switch-off'>いいえ</label>
							<input type='radio' name='answer' id='none' value='2'>
							<label for='none' class='switch-none'>どちら<br>でもない</label>
						</td>
					</tr>
					<tr>
						<td>
							<button class='customize' id='toBack' type='submit'>前に戻る</button>
							&nbsp;<span id ='pagenate'><span id ='questionNum'></span>/<span id ='maxcount'></span></span>&nbsp;
							<button class='customize' id='toExecGrowthTestControl' type='submit'>次の質問へ</button>
						</td>
					</tr>
				</table>
				</form>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
