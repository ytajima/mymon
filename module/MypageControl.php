<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/config/define_db.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/module/common/jsonEncode.php';
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_HANYO.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_CHARACTER.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/M_TOTALCOMMENT.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_TOTAL_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/models/T_PHTEST_PENALTY_HISTORY.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/module/view/ResultExecTestView.php');

session_start();

$logger = Util::getLogger();

$html = '';
$resultArr = array();

// パラメータチェック
if(!isset($_POST['type']) || empty($_POST['type'])){
	$logger->error('[MypageControl]typeパラメータの取得に失敗しました。');
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

// ビューの生成
$view = new ResultExecTestView();

if($type == 'init'){
	// 育成心理テスト加減値累計テーブルのインスタンス生成
	$t_phtest_total_history = new T_PHTEST_TOTAL_HISTORY($pdo);

	// ログインユーザの最新日付の累計情報を取得
	$t_phtest_total_history->setUserid($_SESSION['loginemail']);
	$t_phtest_total_history->getLatestDate();
	$latestdate = $t_phtest_total_history->getResultList();

	$totalval = 0;
	if(count($latestdate) != 0){
		// 育成心理テストペナルティ履歴テーブルのインスタンス生成
		$t_phtest_penalty_history = new T_PHTEST_PENALTY_HISTORY($pdo);
		$t_phtest_penalty_history->beginTransaction();

		// 現在日付と累計情報の最新日付の差分日数を算出
		$now = date('Y-m-d');
		$latest = date('Y-m-d', strtotime($latestdate[0]['nextdate']));
		$diff = Util::day_diff($now, $latest);
		if($diff < 0){
			$t_phtest_penalty_history->setUserid($_SESSION['loginemail']);

			// 汎用属性マスタのインスタンス生成
			$m_hanyo = new M_HANYO($pdo);

			// ペナルティ値の取得
			$m_hanyo->getPenaltyVal();
			$harr = $m_hanyo->getResultList();
			$m_hanyo->close();

			$t_phtest_penalty_history->setVal($harr[0]['attrname']);

			for($i = 0; $i < abs($diff); $i++) {
				$idx = $i + 1;
				$adddate = date('Y-m-d H:i:s', strtotime("- ".$idx." days"));
				$t_phtest_penalty_history->setAdddate($adddate);

				// 同ユーザの同日付のペナルティ履歴がないかチェック
				$ymd = date('Y-m-d', strtotime($adddate));
				$t_phtest_penalty_history->getSameAdddate($ymd);
				if(count($t_phtest_penalty_history->getResultList()) == 0){
					$t_phtest_penalty_history->insertData();
					if($t_phtest_penalty_history->getError() != null){
						$t_phtest_penalty_history->rollback();
						$t_phtest_penalty_history->close();
						$t_phtest_total_history->close();
						$logger->error('[MypageControl]ペナルティ履歴の登録に失敗しました。');
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
					$logger->info('[MypageControl]同ユーザの同日付のペナルティ履歴が存在します。');
				}
			}
			$t_phtest_penalty_history->commit();

			// ログインユーザのペナルティ累計を取得
			$t_phtest_penalty_history->setResult_list(array());
			$t_phtest_penalty_history->getSum();
			$parr = $t_phtest_penalty_history->getResultList();
			$t_phtest_penalty_history->close();
			$penaltyval = 0;
			if(count($parr) != 0){
				$penaltyval = $parr[0]['sumary'];
			}

			// 加減値累計テーブルの累計にペナルティを付与
			$totalval = $latestdate[0]['total'] + $penaltyval;
		}
		else{
			$totalval = $latestdate[0]['total'];
		}

		$t_phtest_penalty_history->close();

		// 累計コメントマスタのインスタンス生成
		$m_totalcomment = new M_TOTALCOMMENT($pdo);

		// 累計情報から表示するコメントを取得
		$m_totalcomment->getComment($totalval);
		$totalcomment = $m_totalcomment->getResultList();
		if(count($totalcomment) != 0){
			// セッション情報を上書き
			$_SESSION['resultCmt'] = $totalcomment[0]['cmttxt'];
		}
		else{
			$logger->error('[MypageControl]累計値に該当するコメント情報が存在しません。');
			$t_phtest_total_history->close();
			$m_totalcomment->close();
			$resultArr = array(
				'status' => 'fail'
			);
			header("Content-Type: text/javascript; charset=utf-8");
			$html = json_encode($resultArr);
			$pdo = null;
			echo $html;
			exit;
		}
		$m_totalcomment->close();
	}

	// 残日数の取得
	$now = date('Y-m-d');
	$last = date('Y-m-d', strtotime($_SESSION['limit']));
	$diff = Util::day_diff($now, $last);

	// キャラクタデータの取得
	$m_character = new M_CHARACTER($pdo);
	$m_character->setId($_SESSION['logincid']);
	$m_character->getDataById();
	$m_character->close();
	$mcArr = $m_character->getResultList();

	// アクセス日を分解
	$now = date('Y-m-d');
	$y = date('Y');
	$m = date('m');
	$d = date('d');
	$resultArr = array(
		'status' => 'success',
		'y' => $y,
		'm' => $m,
		'd' => $d,
		'resultCmt' => $_SESSION['resultCmt'],
		'rmnumDays' => $diff,
		'twitter' => $view->twitter($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
		'facebook' => $view->facebook($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
		'line' => $view->line($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval)
	);
	if(count($latestdate) != 0){
		// 次回回答日を分解
		$nextdate = date('Y-m-d', strtotime($latestdate[0]['nextdate']));
		if(strtotime($now) < strtotime($nextdate)){
			$splitdate = split('-', $nextdate);
			$resultArr = array(
				'status' => 'done',
				'y' => $splitdate[0],
				'm' => $splitdate[1],
				'd' => $splitdate[2],
				'resultCmt' => $_SESSION['resultCmt'],
				'rmnumDays' => $diff,
				'twitter' => $view->twitter($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
				'facebook' => $view->facebook($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
				'line' => $view->line($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval)
			);
		}
		// 育成期間を超えていたら終了
		if(strtotime($_SESSION['limit']) < strtotime($nextdate)){
			$resultArr = array(
				'status' => 'over',
				'resultCmt' => $_SESSION['resultCmt'],
				'mnumDays' => $diff,
				'twitter' => $view->twitter($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
				'facebook' => $view->facebook($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval),
				'line' => $view->line($mcArr[0]['attrcd'].".".$mcArr[0]['rank'], $totalval)
			);
		}
	}

	$t_phtest_total_history->close();
}

$pdo = null;

header("Content-Type: text/javascript; charset=utf-8");
$html = json_encode($resultArr);
$logger->debug($html);

echo $html;

