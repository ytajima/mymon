<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_RESULT_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_USER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_TOTAL_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/InputUserView.php');

session_start();

$logger = Util::getLogger();
$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[InputUserControl]typeパラメータの取得に失敗しました。');
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

if($type == 'init'){
	if(!isset($_SESSION['userid'])){
		// セッション情報の初期化
		$_SESSION['userid'] = '';
		$_SESSION['userpswd'] = '';
		$_SESSION['userpswd_conf'] = '';
		$_SESSION['email'] = '';
		$_SESSION['course'] = '';
	}

	// 汎用属性マスタのインスタンス生成
	$m_hanyo = new M_HANYO($pdo);
	// コース選択データの取得
	$m_hanyo->getCourse();
	$course = $m_hanyo->getResultList();
	$m_hanyo->close();
	// ビューの生成
	$view = new InputUserView();
	$resultArr = array(
		'status' => $view->getMain($course)
	);
}
else if($type == 'confirm'){
	// パラメータチェック
	if(!isset($_POST['userid']) || empty($_POST['userid'])){
		$logger->error('[InputUserControl]useridパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userid',
			'errormsg' => 'ユーザーIDを入力してください<br>'
		);
	}
	else if(!isset($_POST['userpswd']) || empty($_POST['userpswd'])){
		$logger->error('[InputUserControl]userpswdパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userpswd',
			'errormsg' => 'パスワードを入力してください<br>'
		);
	}
	else if(!isset($_POST['userpswd_conf']) || empty($_POST['userpswd_conf'])){
		$logger->error('[InputUserControl]userpswd_confパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userpswd_conf',
			'errormsg' => '確認用パスワードを入力してください<br>'
		);
	}
	else if(!isset($_POST['email']) || empty($_POST['email'])){
		$logger->error('[InputUserControl]emailパラメータの取得に失敗しました。');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_email',
			'errormsg' => 'メールアドレスを入力してください<br>'
		);
	}
	else if($_POST['userpswd'] != $_POST['userpswd_conf']){
		$logger->error('[InputUserControl]入力パスワード不一致');
		$resultArr = array(
			'status' => 'chkerror',
			'errorid' => 'err_userpswd_conf',
			'errormsg' => '確認用パスワードが違います<br>'
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

		// 入力されたメールアドレスで検索
		$m_user->setEmail($_POST['email']);
		$m_user->getDataByEmail();
		$cnt = count($m_user->getResultList());
		if($cnt > 0){
			$logger->error('[InputUserControl]emailがすでに登録済み。');
			$resultArr = array(
				'status' => 'chkerror',
				'errorid' => 'err_email',
				'errormsg' => 'このメールアドレスは使用できません<br>'
			);
		}
		else{
			$resultArr = array(
				'status' => 'success',
				'errorid' => null,
				'errormsg' => null
			);
		}
	}
	// 入力内容をセッションに保存
	$_SESSION['userid'] = htmlspecialchars($_POST['userid']);
	$_SESSION['userpswd'] = htmlspecialchars($_POST['userpswd']);
	$_SESSION['userpswd_conf'] = htmlspecialchars($_POST['userpswd_conf']);
	$_SESSION['email'] = htmlspecialchars($_POST['email']);
	$_SESSION['course'] = $_POST['course'];
}
else if($type == 'complete'){
	// マイモンチェック結果履歴テーブルのインスタンス生成
	$t_phtest_result_history = new T_PHTEST_RESULT_HISTORY($pdo);

	// 登録されているトークンのキャラクタIDを取得
	$t_phtest_result_history->setId($_SESSION['csrf-requested-token']);
	$t_phtest_result_history->getDataById();
	$t_phtest_result_history->close();
	$tprhArr = $t_phtest_result_history->getResultList();

	// ユーザマスタのインスタンス生成
	$m_user = new M_USER($pdo);

	// ユーザマスタに入力内容を登録
	$m_user->setUserid($_POST['userid']);
	$m_user->setUserpswd($_POST['userpswd']);
	$m_user->setEmail($_POST['email']);
	$m_user->setToken($_SESSION['csrf-requested-token']);
	$m_user->setCharaid($tprhArr[0]['charaid']);
	$m_user->setCourse($_POST['course']);

	// 汎用属性マスタのインスタンス生成
	$m_hanyo = new M_HANYO($pdo);
	// 育成期間の取得
	$m_hanyo->getLimit();
	$limit = $m_hanyo->getResultList();
	$m_hanyo->close();
	$limitArr = $m_hanyo->getResultList();
	$limitStr = '+ 1 days';
	if($_POST['course'] == '400'){
		for($i = 0; $i < count($limitArr); $i++) {
			if($limitArr[$i]['attrcd'] == '600'){
				$limitStr = "+ ".$limitArr[$i]['attrname']." days";
			}
		}
	}
	else if($_POST['course'] == '401'){
		for($i = 0; $i < count($limitArr); $i++) {
			if($limitArr[$i]['attrcd'] == '601'){
				$limitStr = "+ ".$limitArr[$i]['attrname']." days";
			}
		}
	}
	$limitdate = date('Y-m-d H:i:s', strtotime($limitStr));
	$m_user->setLimitdate($limitdate);
	$m_user->insertData();
	$m_user->close();
	if($m_user->getError() != ''){
		$logger->error('[InputUserControl]ユーザ情報の登録に失敗しました。');
		$resultArr = array(
			'status' => 'fail'
		);
	}
	else{
		// 育成マイモンチェック加減値累計テーブルのインスタンス生成
		$t_phtest_total_history = new T_PHTEST_TOTAL_HISTORY($pdo);

		// ログインユーザの最新日付の累計情報を取得
		$t_phtest_total_history->setUserid($_POST['email']);
		$t_phtest_total_history->getLatestDate();
		$latestdate = $t_phtest_total_history->getResultList();

		// 初回ログイン(累計情報が存在しない)時、初期データ作成
		if(count($latestdate) == 0){
			$t_phtest_total_history->setTotal(0);
			$t_phtest_total_history->setNextdate(date('Y-m-d H:i:s'));
			$t_phtest_total_history->insertData();
			if($t_phtest_total_history->getError() != null){
				$t_phtest_total_history->rollback();
				$t_phtest_total_history->close();
				$m_user->close();
				$logger->error('[InputUserControl]累計情報の初期データ登録に失敗しました。');
				$resultArr = array(
						'status' => 'fail'
				);
				header("Content-Type: text/javascript; charset=utf-8");
				$html = json_encode($resultArr);
				$pdo = null;
				echo $html;
				exit;
			}
		}
		else{
			$logger->info('[AuthControl]累計情報の初期データがすでに存在します。');
		}
		$resultArr = array(
			'status' => 'success'
		);
	}

	// セッション情報の破棄
	unset($_SESSION['userid']);
	unset($_SESSION['userpswd']);
	unset($_SESSION['userpswd_conf']);
	unset($_SESSION['email']);
	unset($_SESSION['course']);
}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

