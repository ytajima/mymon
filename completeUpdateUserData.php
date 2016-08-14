<?php
session_start();

if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
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
		<script type='text/javascript' src='js/completeUpdateUserData.js'></script>
		<title>ユーザ情報更新完了</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>ユーザ情報更新完了</h2>
			</div>
			<div id='main'>
				<p class='thanks'>更新が完了しました。</p>
				<p class='thanks'>パスワードを変更した場合はログアウトし、再度ログインしてください。</p>
				<button class='customize' id='toMypage' type='submit'>マイページに戻る</button>
				<button class='customize' id='toLogoutControl' type='submit'>ログアウト</button>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
