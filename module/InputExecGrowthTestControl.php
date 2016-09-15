<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_PHTEST_GROWTH.php');

session_start();

$logger = Util::getLogger();

$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[InputExecGrowthTestControl]typeパラメータの取得に失敗しました。');
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
		// 育成マイモンチェックマスタのインスタンス生成
		$m_phtest_growth = new M_PHTEST_GROWTH($pdo);

		// 質問リストの取得(陰)
		$m_phtest_growth->setResult_list(array());
		$m_phtest_growth->setAttrcd('500');
		$m_phtest_growth->getLists();
		$_SESSION['contentlist_500'] = $m_phtest_growth->getResultList();

		// 質問数の取得
		$_SESSION['maxcount_500'] = count($_SESSION['contentlist_500']);

		// 質問順のランダム化
		$ar = array();
		for($i = 0; $i < $_SESSION['maxcount_500']; $i++) {
			$idx = $i;
			array_push($ar, $idx);
		}
		shuffle($ar);
		$_SESSION['contentorder_500'] = $ar;
		$logger->debug($_SESSION['contentorder_500']);

		// 陰属性の質問を頭から3つ取得してリストに格納
		$_SESSION['contentlist'] = array();
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_500'][$_SESSION['contentorder_500'][0]]);
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_500'][$_SESSION['contentorder_500'][1]]);
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_500'][$_SESSION['contentorder_500'][2]]);

		// 質問リストの取得(陽)
		$m_phtest_growth->setResult_list(array());
		$m_phtest_growth->setAttrcd('501');
		$m_phtest_growth->getLists();
		$_SESSION['contentlist_501'] = $m_phtest_growth->getResultList();

		// 質問数の取得
		$_SESSION['maxcount_501'] = count($_SESSION['contentlist_501']);

		// 質問順のランダム化
		$ar = array();
		for($i = 0; $i < $_SESSION['maxcount_501']; $i++) {
			$idx = $i;
			array_push($ar, $idx);
		}
		shuffle($ar);
		$_SESSION['contentorder_501'] = $ar;
		$logger->debug($_SESSION['contentorder_501']);

		// 陽属性の質問を頭から3つ取得してリストに格納
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_501'][$_SESSION['contentorder_501'][0]]);
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_501'][$_SESSION['contentorder_501'][1]]);
		array_push($_SESSION['contentlist'], $_SESSION['contentlist_501'][$_SESSION['contentorder_501'][2]]);
		$logger->debug($_SESSION['contentlist']);

		// 現在の質問数を初期化
		$_SESSION['currentorder'] = 0;

		// 最初の質問内容を生成
		$resultArr = array(
			'maxcount' => 6,
			'currentorder' => $_SESSION['currentorder'],
			'id' => $_SESSION['contentlist'][$_SESSION['currentorder']]['id'],
			'attrcd' => $_SESSION['contentlist'][$_SESSION['currentorder']]['attrcd'],
			'content' => $_SESSION['contentlist'][$_SESSION['currentorder']]['content']
		);

		$m_phtest_growth->close();
	}
	else{
		// リロード時、現在の質問内容を再生成
		$resultArr = array(
			'maxcount' => 6,
			'currentorder' => $_SESSION['currentorder'],
			'id' => $_SESSION['contentlist'][$_SESSION['currentorder']]['id'],
			'attrcd' => $_SESSION['contentlist'][$_SESSION['currentorder']]['attrcd'],
			'content' => $_SESSION['contentlist'][$_SESSION['currentorder']]['content']
		);
	}
}
else if($type == 'next'){
	// 1問ずつ回答内容をセッションに保存
	$already = '0';
	if(!isset($_SESSION['answerlist'])){
		$_SESSION['answerlist'] = array();
	}

	for($i = 0; $i < count($_SESSION['answerlist']); $i++) {
		// 戻るボタン対応。すでに回答済みだった場合は上書き
		if($_SESSION['answerlist'][$i]['phid'] == $_POST['contentid'] && $_SESSION['answerlist'][$i]['attrcd'] == $_POST['attrcd']){
			$_SESSION['answerlist'][$i]['answer'] = $_POST['answer'];
			$already = '1';
		}
	}
	if($already == '0'){
		$anwerArr = array(
				'id' => $_SESSION['loginid'],
				'phid' => $_POST['contentid'],
				'attrcd' => $_POST['attrcd'],
				'answer' => $_POST['answer']
		);
		array_push($_SESSION['answerlist'], $anwerArr);
	}

	//すべての質問に回答済み(0~5の計6問)
	if($_SESSION['currentorder'] == 5){
		unset($_SESSION['currentorder']);
		$logger->debug($_SESSION['answerlist']);
		$resultArr = array(
				'id' => 'success'
		);
	}
	else{
		// 次の質問内容を生成
		$_SESSION['currentorder']++;
		$resultArr = array(
			'maxcount' => 6,
			'currentorder' => $_SESSION['currentorder'],
			'id' => $_SESSION['contentlist'][$_SESSION['currentorder']]['id'],
			'attrcd' => $_SESSION['contentlist'][$_SESSION['currentorder']]['attrcd'],
			'content' => $_SESSION['contentlist'][$_SESSION['currentorder']]['content']
		);
	}
}
else if($type == 'back'){
	// 前の質問内容を生成
	$_SESSION['currentorder']--;
	$resultArr = array(
			'maxcount' => 6,
			'currentorder' => $_SESSION['currentorder'],
			'id' => $_SESSION['contentlist'][$_SESSION['currentorder']]['id'],
			'attrcd' => $_SESSION['contentlist'][$_SESSION['currentorder']]['attrcd'],
			'content' => $_SESSION['contentlist'][$_SESSION['currentorder']]['content']
	);
	header("Content-Type: text/javascript; charset=utf-8");
	$html = json_encode($resultArr);
}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

