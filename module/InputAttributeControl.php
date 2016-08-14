<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_SURVEY_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/InputAttributeView.php');

session_start();

$logger = Util::getLogger();
$html = '';

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[InputAttributeControl]typeパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'fail'
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
	echo $html;
	exit;
}

$type = $_POST['type'];

// トークンのセット
$_SESSION['csrf-requested-token'] = Util::setToken();

// DB接続
$pdo = db_connect_pdo();
if($type == 'age'){
	// 汎用属性マスタのインスタンス生成
	$m_hanyo = new M_HANYO($pdo);
	// 年代データの取得
	$m_hanyo->getAge();
	$age = $m_hanyo->getResultList();
	$m_hanyo->close();
	// ビューの生成
	$view = new InputAttributeView();
	$resultArr = array(
			'status' => $view->selectOptions($age)
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
}
else if($type == 'gender'){
	// 汎用属性マスタのインスタンス生成
	$m_hanyo = new M_HANYO($pdo);
	// 性別データの取得
	$m_hanyo->getGender();
	$gender = $m_hanyo->getResultList();
	$m_hanyo->close();
	// ビューの生成
	$view = new InputAttributeView();
	$resultArr = array(
			'status' => $view->selectOptions($gender)
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
}
else if($type == 'commit'){
	// アンケート履歴テーブルのインスタンス生成
	$t_survey_history = new T_SURVEY_HISTORY($pdo);
	// 入力内容の登録
	$t_survey_history->setId($_SESSION['csrf-requested-token']);
	$t_survey_history->setAge($_POST['age']);
	$t_survey_history->setGender($_POST['gender']);
	$t_survey_history->insertData();
	$t_survey_history->close();
	if($t_survey_history->getError() != ''){
		$logger->error('[InputAttributeControl]アンケート内容の登録に失敗しました。');
		$resultArr = array(
			'status' => 'fail'
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
		$pdo = null;
		echo $html;
		exit;
	}
	else{
		$resultArr = array(
				'status' => 'success'
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
	}
}

$pdo = null;

$logger->debug($html);

echo $html;

