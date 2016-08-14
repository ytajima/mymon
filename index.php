<?php
session_start();

if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
	$_SESSION = array();
}
else{
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /testApp/mypage.php");
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
		<script type='text/javascript' src='js/index.js'></script>
		<title>TOPページ</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>TOPページ</h2>
			</div>
			<div id='main'>
				<table class='index_table'>
				<tr>
				<td><button class='customize index_buttons' id='toLogin' type='submit'>ログイン</button></td>
				<td><button class='customize index_buttons' id='toInputAttribute' type='submit'>アンケートに<br>答える</button></td>
				</tr>
				</table>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
