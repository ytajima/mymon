<?php
session_start();

if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
	$_SESSION = array();
}
else{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /mypage.php");
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
		<script type='text/javascript' src='js/login.js'></script>
		<title>ログイン</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>ログイン</h2>
			</div>
			<div id='main'>
				<form id='authenticationForm' name='authenticationForm'>
				<table id='custom_admin' >
					<tr>
						<th>メールアドレス</th><td id='content'><span id='err_userid' class='error'></span><input type='text' name='userid' id='userid' value=''></td>
					</tr>
					<tr>
						<th>パスワード</th><td id='content'><span id='err_userpswd' class='error'></span><input type='password' name='userpswd' id='userpswd' value='' style='ime-mode:disabled'></td>
					</tr>
				</table>
				</form>
				<button class='customize' id='toIndex' type='submit'>戻る</button>
				<button class='customize' id='toAuthControl' type='submit'>ログイン</button>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
