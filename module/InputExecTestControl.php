<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_PHTEST_BASIC.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_BASIC_HISTORY.php');

session_start();

$logger = Util::getLogger();

$html = '';

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[InputExecTestControl]typeパラメータの取得に失敗しました。');
	$resultArr = array(
		'id' => null
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
	$pdo = null;
	echo $html;
	exit;
}
if(!isset($_SESSION['csrf-requested-token']) || empty($_SESSION['csrf-requested-token'])){
	$logger->error('[InputExecTestControl]不正なアクセスが実行されました。');
	$resultArr = array(
		'id' => null
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
	$pdo = null;
	echo $html;
	exit;
}

$type = $_POST['type'];

// DB接続
$pdo = db_connect_pdo();

if($type == 'init'){
	// 2回目以降はスキップ
	if(!isset($_SESSION['currentorder'])){
		// 基本心理テストマスタのインスタンス生成
		$m_phtest_basic = new M_PHTEST_BASIC($pdo);

		// 質問リストの取得
		$m_phtest_basic->getAll();
		$m_phtest_basic->close();
		$_SESSION['contentlist'] = $m_phtest_basic->getResultList();

		// 質問数の取得
		$_SESSION['maxcount'] = count($_SESSION['contentlist']);

		// 質問順のランダム化
		$ar = array();
		for($i = 0; $i < $_SESSION['maxcount']; $i++) {
			$idx = $i + 1;
			array_push($ar, $idx);
		}
		shuffle($ar);
		$_SESSION['contentorder'] = $ar;
		$logger->debug($_SESSION['contentorder']);

		// 現在の質問数を初期化
		$_SESSION['currentorder'] = 0;

		// 最初の質問内容を生成
		$idx = $_SESSION['contentorder'][$_SESSION['currentorder']];
		$idx--;
		$resultArr = array(
				'maxcount' => $_SESSION['maxcount'],
				'currentorder' => $_SESSION['currentorder'],
				'id' => $_SESSION['contentlist'][$idx]['id'],
				'content' => $_SESSION['contentlist'][$idx]['content']
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
	}
	else{
		// リロード時、現在の質問内容を再生成
		$idx = $_SESSION['contentorder'][$_SESSION['currentorder']];
		$idx--;
		$resultArr = array(
				'maxcount' => $_SESSION['maxcount'],
				'currentorder' => $_SESSION['currentorder'],
				'id' => $_SESSION['contentlist'][$idx]['id'],
				'content' => $_SESSION['contentlist'][$idx]['content']
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
	}
}
else if($type == 'next'){
	// パラメータチェック
	if($_SESSION['csrf-requested-token'] != $_POST['csrf-requested-token']){
		$logger->error('[InputExecTestControl]不正なアクセスが実行されました。');
		$resultArr = array(
				'id' => null
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
		$pdo = null;
		echo $html;
		exit;
	}

	// 1問ずつ回答内容をセッションに保存
	$already = '0';
	if(!isset($_SESSION['answerlist'])){
		$_SESSION['answerlist'] = array();
	}

	for($i = 0; $i < count($_SESSION['answerlist']); $i++) {
		// 戻るボタン対応。すでに回答済みだった場合は上書き
		if($_SESSION['answerlist'][$i]['phid'] == $_POST['contentid']){
			$_SESSION['answerlist'][$i]['answer'] = $_POST['answer'];
			$already = '1';
		}
	}
	if($already == '0'){
		$anwerArr = array(
				'id' => $_POST['csrf-requested-token'],
				'phid' => $_POST['contentid'],
				'answer' => $_POST['answer']
		);
		array_push($_SESSION['answerlist'], $anwerArr);
	}

	//すべての質問に回答されたら心理テスト履歴テーブルに登録
	if($_SESSION['currentorder'] == $_SESSION['maxcount'] - 1){
		$_SESSION['currentorder'] = 0;
		$logger->debug($_SESSION['answerlist']);

		// 心理テスト履歴テーブルのインスタンス生成
		$t_phtest_basic_history = new T_PHTEST_BASIC_HISTORY($pdo);
		$t_phtest_basic_history->beginTransaction();
		$t_phtest_basic_history->setId($_POST['csrf-requested-token']);
		for($i = 0; $i < count($_SESSION['answerlist']); $i++){
			$t_phtest_basic_history->setPhid($_SESSION['answerlist'][$i]['phid']);
			$t_phtest_basic_history->setAnswer($_SESSION['answerlist'][$i]['answer']);
			$t_phtest_basic_history->insertData();
			if($t_phtest_basic_history->getError() != null){
				$t_phtest_basic_history->rollback();
				$t_phtest_basic_history->close();
				$logger->error('[InputExecTestControl]心理テスト回答内容の登録に失敗しました。');
				$resultArr = array(
						'id' => null
				);
				header("Content-Type: text/javascript; charset=utf-8");
				$html = json_encode($resultArr);
				$pdo = null;
				echo $html;
				exit;
			}
		}
		$t_phtest_basic_history->commit();
		$t_phtest_basic_history->close();
		$resultArr = array(
				'id' => 'success'
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
	}
	else{
		// 次の質問内容を生成
		$_SESSION['currentorder']++;
		$idx = $_SESSION['contentorder'][$_SESSION['currentorder']];
		$idx--;
		$resultArr = array(
				'maxcount' => $_SESSION['maxcount'],
				'currentorder' => $_SESSION['currentorder'],
				'id' => $_SESSION['contentlist'][$idx]['id'],
				'content' => $_SESSION['contentlist'][$idx]['content']
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
	}
}
else if($type == 'back'){
	// 前の質問内容を生成
	$_SESSION['currentorder']--;
	$idx = $_SESSION['contentorder'][$_SESSION['currentorder']];
	$idx--;
	$resultArr = array(
			'maxcount' => $_SESSION['maxcount'],
			'currentorder' => $_SESSION['currentorder'],
			'id' => $_SESSION['contentlist'][$idx]['id'],
			'content' => $_SESSION['contentlist'][$idx]['content']
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
}

$pdo = null;

$logger->debug($html);

echo $html;

