<?php
session_start();

if(!isset($_SESSION['csrf-requested-token']) || empty($_SESSION['csrf-requested-token'])){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /testApp/index.php");
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
		<script type='text/javascript' src='js/inputExecTest.js'></script>
		<title>心理テスト</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>心理テスト</h2>
			</div>
			<div id='main'>
				<form id='inputExecTestForm' name='inputExecTestForm'>
				<input type="hidden" name='csrf-requested-token' value='<?= $_SESSION['csrf-requested-token']?>'>
				<input type="hidden" id='contentid' name='contentid' value=''>
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
						</td>
					</tr>
					<tr>
						<td>
							<button class='customize' id='toBack' type='submit'>前の質問へ</button>
							&nbsp;<span id ='pagenate'><span id ='questionNum'></span>/<span id ='maxcount'></span></span>&nbsp;
							<button class='customize' id='toExecTestControl' type='submit'>次の質問へ</button>
						</td>
					</tr>
				</table>
				</form>
			</div>
			<div id='footer'>
			</div>
		</div>
		<div id="modal-content">
			<p>分析処理中・・・</p>
		</div>
		<div id="modal-overlay"></div>
	</body>
</html>
