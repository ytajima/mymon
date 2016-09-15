<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_CHARACTER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_TOTALCOMMENT.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/ResultExecTestView.php');

$logger = Util::getLogger();

// パラメータチェック
if(!isset($_GET['img']) || empty($_GET['img'])){
	$logger->error('[share]imgパラメータの取得に失敗しました。');
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /index.php");
	exit;
}

$img = $_GET['img'];
$val = $_GET['val'];

$imgArr = split('\.', $img);
$attrcd = $imgArr[0];
$rank = $imgArr[1];

// DB接続
$pdo = db_connect_pdo();

// キャラクタマスタから共通情報の取得
$m_character = new M_CHARACTER($pdo);
$m_character->setAttrcd($attrcd);
$m_character->setRank($rank);
$m_character->getDataByAttribute();
$m_character->close();
$mcArr = $m_character->getResultList();
if(count($mcArr) == 0){
	$logger->error('[share]キャラクタデータの取得に失敗しました。');
	$pdo = null;
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: /error.php");
	exit;
}
$name = $mcArr[0]['name'];
$imgfilenm = $mcArr[0]['imgfilenm'];
$tmpcmt = $mcArr[0]['cmttxt'];

if(!empty($val)){
	// 累計コメントマスタからコメント取得
	$m_totalcomment = new M_TOTALCOMMENT($pdo);
	$m_totalcomment->getComment($val);
	$m_totalcomment->close();
	$totalcomment = $m_totalcomment->getResultList();
	if(count($totalcomment) == 0){
		$logger->error('[share]累計コメント情報の取得に失敗しました。');
		$pdo = null;
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: /error.php");
		exit;
	}
	$tmpcmt = $totalcomment[0]['cmttxt'];
}

// ビューの生成
$view = new ResultExecTestView();

$pdo = null;

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
		<script type='text/javascript' src='js/share.js'></script>
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
						<th id='charanm'><?= $name ?></th>
						</tr>
						<tr>
						<td id='resultImg'><?php echo $view->img($name, $imgfilenm)?></td>
						</tr>
					</table>
				</div>
				<div id='main_right'>
					<table id='custom_admin_right' >
						<tr>
						<th>コメント</th>
						</tr>
						<tr>
						<td id='resultCmt'><?= $tmpcmt ?></td>
						</tr>
					</table>
				</div>
				<div id='clear'>
					<p class='caption'>アンケートとマイモンチェックに答えると<br>自分のキャラクターが確認できます</p>
					<button class='customize' id='toInputAttribute' type='submit'>アンケートに答える</button>
				</div>
			</div>
			<div id='footer'>
			</div>
		</div>
	</body>
</html>
