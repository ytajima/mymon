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
		<link rel="stylesheet" href="css/share-button.css" type='text/css'  media='screen' />
		<script type='text/javascript'  src='js/common/jquery-1.11.1.min.js'></script>
		<script type='text/javascript' src="js/share-button.js"></script>
		<script type='text/javascript' src='js/mypage.js'></script>
		<title>マイページ</title>
	</head>
	<body>
		<div id="content">
			<div id='mypage_header'>
				<div id='loginUserId'><?= $_SESSION['loginid'] ?> さん</div>
			</div>
			<div id='main'>
				<div id='configure'>
					<button class='customize mypage_size' id='toUpdateUserData' type='submit'>設定</button>
					<button class='customize mypage_size' id='toLogoutControl' type='submit'>ログアウト</button>
				</div>
				<div id='main_left'>
					<table id='custom_admin_left' >
						<tr>
							<th id='charanm'>名前：<?= $_SESSION['charanm'] ?></th>
						</tr>
						<tr>
							<td id='resultImg'><img alt='<?= $_SESSION['charanm'] ?>' title='<?= $_SESSION['charanm'] ?>' src='<?= $_SESSION['resultImg'] ?>'></td>
						</tr>
					</table>
				</div>
				<div id='main_right'>
					<table id='custom_admin_right' >
						<tr>
							<th>コメント</th>
						</tr>
						<tr>
							<td id='resultCmt'><?= $_SESSION['resultCmt'] ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div id='mypage_start'>
				<table id='custom_admin' >
					<tr>
						<td>
							<span id='exec_day'></span><br>
							<button class='customize' id='toInputExecGrowthTest' type='submit'></button><br>
							<span id='rmnumDays'></span>
						</td>
					</tr>
				</table>
			</div>
			<div id='mypage_banner'>
				<table>
					<tr>
						<td id='banner'><a href='#'><img alt='' title='' src='/testApp/img/banner/banner_left.jpg'></a></td>
						<td id='banner'><a href='#'><img alt='' title='' src='/testApp/img/banner/banner_center.jpg'></a></td>
						<td id='banner'><a href='#'><img alt='' title='' src='/testApp/img/banner/banner_right.jpg'></a></td>
					</tr>
				</table>
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
	</body>
</html>
