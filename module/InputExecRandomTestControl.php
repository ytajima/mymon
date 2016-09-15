<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_PHTEST_GROWTH.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_GROWTH_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_TOTAL_HISTORY.php');

session_start();

$logger = Util::getLogger();

$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[InputExecRandomTestControl]typeパラメータの取得に失敗しました。');
	$resultArr = array(
		'status' => 'fail'
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
	// 不正防止のため、2回目以降はスキップ
	if(!isset($_SESSION['rmd_phid'])){
		// 育成マイモンチェックマスタのインスタンス生成
		$m_phtest_growth = new M_PHTEST_GROWTH($pdo);

		// 質問リストの取得(ランダム)
		$m_phtest_growth->setResult_list(array());
		$m_phtest_growth->setAttrcd('502');
		$m_phtest_growth->getLists();
		$contentlist_502 = $m_phtest_growth->getResultList();

		// 質問数の取得
		$maxcount_502 = count($contentlist_502);

		// 質問順のランダム化
		$ar = array();
		for($i = 0; $i < $maxcount_502; $i++) {
			$idx = $i;
			array_push($ar, $idx);
		}
		shuffle($ar);
		$contentorder_502 = $ar;
		$logger->debug($contentorder_502);

		// ランダム属性の質問を先頭から1つ取得してリストに格納
		$contentlist = array();
		array_push($contentlist, $contentlist_502[$contentorder_502[0]]);

		// 最初の質問内容を生成
		$_SESSION['rmd_phid'] = $contentlist[0]['id'];
		$_SESSION['rmd_anwer'] = array(
			'id' => $_SESSION['loginid'],
			'phid' => $contentlist[0]['id'],
			'attrcd' => $contentlist[0]['attrcd'],
			'prifix' => $contentlist[0]['prifix_yes'],
			'point' => $contentlist[0]['val_yes']
		);
		$resultArr = array(
			'prifix' => $contentlist[0]['prifix_yes'],
			'point' => $contentlist[0]['val_yes']
		);

		$m_phtest_growth->close();
	}
	else{
		// リロード時、現在の質問内容を再生成
		$resultArr = array(
			'prifix' => $_SESSION['rmd_anwer']['prifix'],
			'point' => $_SESSION['rmd_anwer']['point']
		);
	}
}
else if($type == 'complete'){
	// 育成マイモンチェックマスタのインスタンス生成
	$m_phtest_growth = new M_PHTEST_GROWTH($pdo);
	// 育成マイモンチェック履歴テーブルのインスタンス生成
	$t_phtest_growth_history = new T_PHTEST_GROWTH_HISTORY($pdo);
	// 育成マイモンチェック加減値累計テーブルのインスタンス生成
	$t_phtest_total_history = new T_PHTEST_TOTAL_HISTORY($pdo);

	$t_phtest_growth_history->beginTransaction();

	// 陰と陽の回答結果を履歴に保存
	$total = 0;
	for($i = 0; $i < count($_SESSION['answerlist']); $i++){
		$m_phtest_growth->setResult_list(array());
		$m_phtest_growth->setId($_SESSION['answerlist'][$i]['phid']);
		$m_phtest_growth->setAttrcd($_SESSION['answerlist'][$i]['attrcd']);
		$m_phtest_growth->getPifixVal();
		$pvArr = $m_phtest_growth->getResultList();
		$t_phtest_growth_history->setUserid($_SESSION['loginemail']);
		$t_phtest_growth_history->setPhid($_SESSION['answerlist'][$i]['phid']);
		$t_phtest_growth_history->setAttrcd($_SESSION['answerlist'][$i]['attrcd']);
		$t_phtest_growth_history->setAnswer($_SESSION['answerlist'][$i]['answer']);
		$prifix = '';
		$val = 0;
		if($_SESSION['answerlist'][$i]['answer'] == '0'){
			$prifix = $pvArr[0]['prifix_yes'];
			$val = $pvArr[0]['val_yes'];
		}
		else if($_SESSION['answerlist'][$i]['answer'] == '1'){
			$prifix = $pvArr[0]['prifix_no'];
			$val = $pvArr[0]['val_no'];
		}
		else{
			$prifix = $pvArr[0]['prifix_none'];
			$val = $pvArr[0]['val_none'];
		}
		// 各陰陽のポイントを今回の加減値累計に追加
		if($prifix == '+'){
			$total = $total + $val;
		}
		else{
			$total = $total + $val * -1;
		}
		$t_phtest_growth_history->setPrifix($prifix);
		$t_phtest_growth_history->setVal($val);
		$t_phtest_growth_history->insertData();
		if($t_phtest_growth_history->getError() != null){
			$t_phtest_growth_history->rollback();
			$t_phtest_total_history->close();
			$t_phtest_growth_history->close();
			$m_phtest_growth->close();
			$logger->error('[InputExecRandomTestControl]マイモンチェック回答内容の登録に失敗しました。');
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

	// ランダムポイントの結果を履歴に保存
	$t_phtest_growth_history->setUserid($_SESSION['loginemail']);
	$t_phtest_growth_history->setPhid($_SESSION['rmd_anwer']['phid']);
	$t_phtest_growth_history->setAttrcd($_SESSION['rmd_anwer']['attrcd']);
	$t_phtest_growth_history->setAnswer(0);
	$t_phtest_growth_history->setPrifix($_SESSION['rmd_anwer']['prifix']);
	$t_phtest_growth_history->setVal($_SESSION['rmd_anwer']['point']);
	$t_phtest_growth_history->insertData();
	if($t_phtest_growth_history->getError() != null){
		$t_phtest_growth_history->rollback();
		$t_phtest_total_history->close();
		$t_phtest_growth_history->close();
		$m_phtest_growth->close();
		$logger->error('[InputExecRandomTestControl]マイモンチェック回答内容の登録に失敗しました。');
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
		// ランダムポイントを今回の加減値累計に追加
		if($_SESSION['rmd_anwer']['prifix'] == '+'){
			$total = $total + $_SESSION['rmd_anwer']['point'];
		}
		else{
			$total = $total + $_SESSION['rmd_anwer']['point'] * -1;
		}
	}

	$t_phtest_growth_history->commit();

	$t_phtest_total_history->beginTransaction();

	// ログインユーザの最新日付の累計情報を取得
	$t_phtest_total_history->setUserid($_SESSION['loginemail']);
	$t_phtest_total_history->getLatestDate();
	$latestdate = $t_phtest_total_history->getResultList();

	// 今回の加減値に前回までの累計値を追加
	if(count($latestdate) != 0){
		$total = $total + $latestdate[0]['total'];
	}
	$t_phtest_total_history->setTotal($total);

	// コース選択により次回回答日を設定
	$nextdate = date('Y-m-d H:i:s');
	if($_SESSION['logincs'] == '400'){
		// 実施日の翌日
		$nextdate = date('Y-m-d H:i:s', strtotime("+ 1 days"));
	}
	else if($_SESSION['logincs'] == '401'){
		// 実施日の一週間後
		$nextdate = date('Y-m-d H:i:s', strtotime("+ 7 days"));
	}
	$t_phtest_total_history->setNextdate($nextdate);

	// 登録処理
	$t_phtest_total_history->insertData();
	if($t_phtest_total_history->getError() != null){
		$t_phtest_total_history->rollback();
		$t_phtest_total_history->close();
		$t_phtest_growth_history->close();
		$m_phtest_growth->close();
		$logger->error('[InputExecRandomTestControl]マイモンチェック回答内容の登録に失敗しました。');
		$resultArr = array(
				'status' => 'fail'
		);
		header("Content-Type: text/javascript; charset=utf-8");
		$html = json_encode($resultArr);
		$pdo = null;
		echo $html;
		exit;
	}

	$t_phtest_total_history->commit();

	$t_phtest_total_history->close();
	$t_phtest_growth_history->close();
	$m_phtest_growth->close();

	$resultArr = array(
		'status' => 'success'
	);
	
	// セッション情報の破棄
	unset($_SESSION['rmd_phid']);
	unset($_SESSION['rmd_anwer']);

}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

