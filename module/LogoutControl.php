<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';

session_start();

$logger = Util::getLogger();
$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_SESSION['loginid']) || empty($_SESSION['loginid'])){
	$logger->error('[LogoutControl]loginidパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'fail'
	);
}
else{
	// セッション情報を破棄
	session_destroy();
	$_SESSION = array();
	setcookie(session_name(), '', time() - 3600, "/");
	$resultArr = array(
		'status' => 'success'
	);
}

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

