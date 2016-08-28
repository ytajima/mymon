<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_RESULT_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_USER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/DebugView.php');

session_start();

$logger = Util::getLogger();
$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[UpdateUserControl]typeパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'fail'
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
	echo $html;
	exit;
}

$type = $_POST['type'];

// DB接続
$pdo = db_connect_pdo();

if($type == 'confirm'){
	// 入力内容をセッションに保存
    $_SESSION['limit'] = htmlspecialchars($_POST['limit1']);
}
else if($type == 'complete'){
	// ユーザマスタのインスタンス生成
	$m_user = new M_USER($pdo);

	// ユーザマスタに入力内容を登録
    $m_user->setLimitdate($_POST['limit']); // debug
	$m_user->updateDebug($_SESSION['loginemail']);
	$m_user->close();
	if($m_user->getError() != ''){
		$logger->error('[UpdateUserControl]ユーザ情報(デバッグ)の更新に失敗しました。');
		$resultArr = array(
			'status' => 'fail'
		);
	}
	else{
		$resultArr = array(
			'status' => 'success'
		);
	}

	// セッション情報の破棄
	unset($_SESSION['userid']);
	unset($_SESSION['userpswd_new']);
	unset($_SESSION['email']);
}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

