<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/view/UpdateUserView.php');

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
		<script type='text/javascript' src='js/updateUserData.js'></script>
		<title>ユーザー情報更新</title>
	</head>
	<body>
		<div id='content'>
			<div id='header'>
				<h2>ユーザー情報更新</h2>
			</div>
			<div id='main'>
			<?php
				// DB接続
				$pdo = db_connect_pdo();

				// 汎用属性マスタのインスタンス生成
				$m_hanyo = new M_HANYO($pdo);
				// コース選択データの取得
				$m_hanyo->getCourse();

				// ビューの生成
				$view = new UpdateUserView();
				echo $view->getMain($m_hanyo->getResultList());
			?>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
