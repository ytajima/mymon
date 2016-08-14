<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_BASIC_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_RESULT_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_CHARACTER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/ResultExecTestView.php');

session_start();

$logger = Util::getLogger();

$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[ResultExecTestControl]typeパラメータの取得に失敗しました。');
	$resultArr = array(
		'img' => null
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
	$pdo = null;
	echo $html;
	exit;
}
if(!isset($_SESSION['csrf-requested-token']) || empty($_SESSION['csrf-requested-token'])){
	$logger->error('[ResultExecTestControl]不正なアクセスが実行されました。');
	$resultArr = array(
		'img' => null
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

// ビューの生成
$view = new ResultExecTestView();

if($type == 'init'){
	// 心理テスト履歴テーブルのインスタンス生成
	$t_phtest_basic_history = new T_PHTEST_BASIC_HISTORY($pdo);

	// ソート済み集計データの取得
	$t_phtest_basic_history->setId($_SESSION['csrf-requested-token']);
	$t_phtest_basic_history->getCountAnswerById();
	$t_phtest_basic_history->close();
	$countArr = $t_phtest_basic_history->getResultList();

	if(count($countArr) == 0){
		// 0件の場合は回答がすべて「いいえ」なので、結果を「火5」とする
		$m_character = new M_CHARACTER($pdo);
		$m_character->setAttrcd('301');
		$m_character->setRank('5');
		$m_character->getDataByAttribute();
		$mcArr = $m_character->getResultList();
		for($i = 0; $i < count($mcArr); $i++) {
			$resultArr = array(
					'name' => $mcArr[$i]['name'],
					'img' => $view->img($mcArr[$i]['name'], $mcArr[$i]['imgfilenm']),
					'cmt' => $mcArr[$i]['cmttxt'],
					'twitter' => $view->twitter('301.'.'5', ''),
					'facebook' => $view->facebook('301.'.'5', ''),
					'line' => $view->line('301.'.'5', '')
			);
		}
	}
	else{
		// 心理テスト履歴テーブルのインスタンス生成
		$t_phtest_basic_history = new T_PHTEST_BASIC_HISTORY($pdo);

		// 集計ランクを取得
		$t_phtest_basic_history->setId($_SESSION['csrf-requested-token']);
		$t_phtest_basic_history->getSumRankById();
		$t_phtest_basic_history->close();
		$rankArr = $t_phtest_basic_history->getResultList();

		// ソート順第1位のキャラクターデータを取得
		$m_character = new M_CHARACTER($pdo);
		$m_character->setAttrcd($countArr[0]['attrcd']);
		$m_character->setRank($rankArr[0]['rank']);
		$m_character->getDataByAttribute();
		$m_character->close();
		$mcArr = $m_character->getResultList();

		// 心理テスト結果履歴テーブルのインスタンス生成
		// トークンとキャラクターIDを紐づける
		$t_phtest_result_history = new T_PHTEST_RESULT_HISTORY($pdo);
		$t_phtest_result_history->setId($_SESSION['csrf-requested-token']);
		$t_phtest_result_history->setCharaid($mcArr[0]['id']);
		$t_phtest_result_history->insertData();
		$t_phtest_result_history->close();
		if($t_phtest_result_history->getError() != ''){
			$logger->error('[ResultExecTestControl]キャラクターIDの登録に失敗しました。');
			$resultArr = array(
					'img' => null
			);
			header("Content-Type: text/javascript; charset=utf-8");
			$html = json_encode($resultArr);
			$pdo = null;
			echo $html;
			exit;
		}
		else{
			$resultArr = array(
				'name' => $mcArr[0]['name'],
				'img' => $view->img($mcArr[0]['name'], $mcArr[0]['imgfilenm']),
				'cmt' => $mcArr[0]['cmttxt'],
				'twitter' => $view->twitter($countArr[0]['attrcd'].".".$rankArr[0]['rank'], ''),
				'facebook' => $view->facebook($countArr[0]['attrcd'].".".$rankArr[0]['rank'], ''),
				'line' => $view->line($countArr[0]['attrcd'].".".$rankArr[0]['rank'], '')
			);
		}
	}
}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

