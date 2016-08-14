<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_RESULT_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_USER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/UpdateUserView.php');

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
	// パラメータチェック
	if(!isset($_POST['email']) || empty($_POST['email'])){
		$logger->error('[UpdateUserControl]emailパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_email',
			'errormsg' => 'メールアドレスを入力してください<br>'
		);
	}
	else if((isset($_POST['userpswd']) && !empty($_POST['userpswd'])) && (!isset($_POST['userpswd_new']) || empty($_POST['userpswd_new']))){
		$logger->error('[UpdateUserControl]userpswd_newパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userpswd_new',
			'errormsg' => '新しいパスワードを入力してください<br>'
		);
	}
	else if((isset($_POST['userpswd_new']) && !empty($_POST['userpswd_new'])) && (!isset($_POST['userpswd']) || empty($_POST['userpswd']))){
		$logger->error('[UpdateUserControl]userpswdパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userpswd',
			'errormsg' => '現在のパスワードを入力してください<br>'
		);
	}
	else if(!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $_POST['email'])) {
		$logger->error('[InputUserControl]メールアドレスフォーマットエラー');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_email',
			'errormsg' => '入力された内容がメールアドレスの形式ではありません<br>'
		);
	}
	else{
		// ユーザマスタのインスタンス生成
		$m_user = new M_USER($pdo);

		if(!empty($_POST['userpswd_new'])){
			// 入力されたメールアドレスとパスワードで検索
			$m_user->setEmail($_POST['email']);
			$m_user->setUserpswd($_POST['userpswd']);
			$m_user->auth();
			$authArr = $m_user->getResultList();
			$cnt = count($authArr);
			if($cnt == 0){
				$logger->error('[UpdateUserControl]認証失敗。');
				$resultArr = array(
					'status' => 'chkerror',
					'errorid' => 'err_userpswd',
					'errormsg' => '現在登録されているパスワードが異なります<br>'
				);
			}
		}
		else{
			$_POST['userpswd_new'] = null;

			// メールアドレスが重複していないかチェック
			if($_POST['email'] != $_SESSION['loginemail']){
				$m_user->setEmail($_POST['email']);
				$m_user->getDataByEmail();
				$authArr = $m_user->getResultList();
				$cnt = count($authArr);
				if($cnt >= 1){
					$logger->error('[UpdateUserControl]メールアドレスの重複チェックで失敗。');
					$resultArr = array(
						'status' => 'chkerror',
						'errorid' => 'err_email',
						'errormsg' => 'このメールアドレスは使用できません<br>'
					);
				}
			}
			else{
				$resultArr = array(
					'status' => 'success',
					'errorid' => null,
					'errormsg' => null
				);
			}
		}

		$m_user->close();
	}
	// 入力内容をセッションに保存
	$_SESSION['userid'] = htmlspecialchars($_POST['userid']);
	$_SESSION['userpswd_new'] = htmlspecialchars($_POST['userpswd_new']);
	$_SESSION['email'] = htmlspecialchars($_POST['email']);
    $_SESSION['limit'] = htmlspecialchars($_POST['limit']); // debug
}
else if($type == 'complete'){
	// ユーザマスタのインスタンス生成
	$m_user = new M_USER($pdo);

	// ユーザマスタに入力内容を登録
	$m_user->setUserid($_SESSION['userid']);
	$m_user->setEmail($_POST['email']);
	if(!isset($_POST['userpswd_new']) || empty($_POST['userpswd_new'])){
		$_POST['userpswd_new'] = null;
	}
	$m_user->setUserpswd($_POST['userpswd_new']);
    $m_user->setLimitdate($_POST['limit']); // debug
	$m_user->updateData($_SESSION['loginemail']);
	$m_user->close();
	if($m_user->getError() != ''){
		$logger->error('[UpdateUserControl]ユーザ情報の更新に失敗しました。');
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

