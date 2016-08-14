<?php
session_start();

if(!isset($_SESSION['csrf-requested-token']) || empty($_SESSION['csrf-requested-token'])){
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
		<link rel="stylesheet" href="css/share-button.css" type='text/css'  media='screen' />
		<script type='text/javascript' src='js/common/jquery-1.11.1.min.js'></script>
		<script type='text/javascript' src="js/share-button.js"></script>
		<script type='text/javascript' src='js/resultExecTest.js'></script>
		<title>テスト結果表示</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>テスト結果表示</h2>
			</div>
			<div id='main'>
				<div id='main_left'>
					<table id='custom_admin_left' >
						<tr>
						<th id='charanm'></th>
						</tr>
						<tr>
						<td id='resultImg'></td>
						</tr>
					</table>
				</div>
				<div id='main_right'>
					<table id='custom_admin_right' >
						<tr>
						<th>コメント</th>
						</tr>
						<tr>
						<td id='resultCmt'></td>
						</tr>
					</table>
				</div>
				<div id='clear'>
					<button class='customize' id='toIndex' type='submit'>終了する</button>
					<button class='customize' id='toInputUserData' type='submit'>ユーザ登録に進む</button>
				</div>
			</div>
			<div id='footer'>
			</div>
			<div class="social-area">
				<ul class="social-button">
					<!-- Twitter -->
					<li id='twitter' class="sc-tw"></li>
					<!-- Facebook -->
					<li id='facebook' class="sc-fb"></li>
					<!-- LINE -->
					<li id='line' class="sc-li"></li>
				</ul>
				<!-- Facebook用 -->
				<div id="fb-root"></div>
			</div>
		</div>
<script type="text/javascript">
var $zoho= $zoho || {salesiq:{values:{},ready:function(){}}};var d=document;s=d.createElement("script");s.type="text/javascript";
s.defer=true;s.src="https://salesiq.zoho.com/jica/float.ls?embedname=chat";
t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);
$zoho.salesiq.ready=function(embedinfo){$zoho.salesiq.floatbutton.visible("hide");}
</script>
	</body>
</html>
