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
		<meta charset='UTF-8' />
		<meta http-equiv='Pragma' content='no-cache' />
		<meta http-equiv='cache-control' content='no-cache' />
		<meta http-equiv='expires' content='0' />
		<meta name="viewport" content="initial-scale=1.0" />
		<link rel='stylesheet' href='css/common_for_sp_320.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common_for_sp_375.css' type='text/css'  media='screen' />
		<link rel='stylesheet' href='css/common.css' type='text/css'  media='screen' />
		<title>ランダムカード</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>ランダムカード</h2>
			</div>
			<div id='main'>
				<p class='caption'>！ カードをクリックしてください ！</p>
				<div class='cardList'>
					<div class='card'>
						<div class='inner'>
							<div class='number'>
								<p id='add_point'></p>
							</div>
							<div class='back'></div>
						</div>
					</div>
				</div>
				<button class='customize' id='toBack' type='submit'>戻る</button>
				<button class='customize' id='toExecRandomTestControl' type='submit'>終了する</button>
			</div>
			<div id='footer'>
			</div>
		</div>
		<script type='text/javascript' src='js/common/jquery-1.11.1.min.js'></script>
		<script type='text/javascript' src='js/inputExecRandomTest.js'></script>
	</body>
</html>
