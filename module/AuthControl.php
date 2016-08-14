<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/models/M_USER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/models/T_PHTEST_TOTAL_HISTORY.php');

session_start();

$logger = Util::getLogger();
$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['userid']) || empty($_POST['userid'])){
	$logger->error('[AuthControl]useridパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'chkerror',
		'errorid' => 'err_userid',
		'errormsg' => 'メールアドレスを入力してください<br>'
	);
}
else if(!isset($_POST['userpswd']) || empty($_POST['userpswd'])){
	$logger->error('[AuthControl]userpswdパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'chkerror',
		'errorid' => 'err_userpswd',
		'errormsg' => 'パスワードを入力してください<br>'
	);
}
else{
	$email = htmlspecialchars($_POST['userid']);
	$userpswd = htmlspecialchars($_POST['userpswd']);

	// DB接続
	$pdo = db_connect_pdo();

	// ユーザマスタのインスタンス生成
	$m_user = new M_USER($pdo);

	// 入力されたIDとパスワードで検索
	$m_user->setEmail($email);
	$m_user->setUserpswd($userpswd);
	$m_user->auth();
	$authArr = $m_user->getResultList();
	$cnt = count($authArr);
	if($cnt == 0){
		$logger->error('[AuthControl]認証失敗。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userid',
			'errormsg' => 'このメールアドレスとパスワードは登録されていません<br>'
		);
	}
	else{
		// 入力内容をセッションに保存
		$_SESSION['loginid'] = $authArr[0]['userid'];
		$_SESSION['loginemail'] = $authArr[0]['email'];
		$_SESSION['logincid'] = $authArr[0]['charaid'];
		$_SESSION['logincs'] = $authArr[0]['course'];
		$_SESSION['charanm'] = $authArr[0]['name'];
		$_SESSION['limit'] = $authArr[0]['limitdate'];
		$_SESSION['resultImg'] = $authArr[0]['imgfilenm'];
		$_SESSION['resultCmt'] = $authArr[0]['cmttxt'];
		$resultArr = array(
			'status' => 'success',
			'errorid' => null,
			'errormsg' => null
		);
	}

	$m_user->close();

	$pdo = null;
}

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

