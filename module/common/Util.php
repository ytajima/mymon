<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/log4php/Logger.php');
/**
 * utilクラス
 * ロガーや入力チェック等を記載する
 *
 * @version 1.0.0
 */
class Util {
	/**
	 * 設定ファイルにあわせてLoggerを作成する
	 * @return Logger Logger
	 */
	public static function getLogger(){
		$tmpPath = $_SERVER['DOCUMENT_ROOT'].'/config/appender_dailyfile.properties';
		Logger::configure($tmpPath);
		$logger = Logger::getRootLogger();
		return $logger;
	}
	/**
	 * 指定された文字長により、文字列の長さを判定する
	 * @param String $str 判定対象文字列
	 * @param int $length 文字列長
	 * @param boolean $flg true:文字列が文字長のみtrue、false:文字列が文字長以下true
	 * @return boolean true:条件合致、false:条件不一致
	 */
	public static function lengthCheck($str,$length,$flg ){
		if($flg){
			if(strlen($str)===$length){
				return true;
			}
			return false;
		}else{
			if(strlen($str)<=$length){
				return true;
			}
			return false;
		}
	}
	/**
	 * 引数の文字列が数字のみであるか判定する
	 * @param String $str 判定対象文字列
	 * @return boolean true:条件合致、false:条件不一致
	 */
	public static function chkTypeOfNumber($str){
		$pattern = "/^\d+/";
		if(preg_match($pattern, $str)){
			return true;
		}
		else{
			return false;
		}
	}
	/**
	 * 引数の文字列が数字のみかつ長さが指定範囲内であるか判定する
	 * @param String $str 判定対象文字列
	 * @param int $length 文字列長
	 * @return boolean true:条件合致、false:条件不一致
	 */
	public static function chkLengthOfNumber($str, $length){
		if(Util::chkTypeOfNumber($str) && Util::lengthCheck($str,$length,true)){
			return true;
		}
		else{
			return false;
		}
	}
	/**
	 * アルファベットかどうか判定します
	 * @param String $str 対象の文字列
	 * @return boolean アルファベット以外無:true、アルファベット以外有:false
	 */
	public static function isAlphaNum($str){
		if(preg_match("/[^a-zA-Z0-9]+/", $str)==null){
			return true;
		}
		return false;
	}
	/**
	 * エラーメッセージを表示します
	 * @param String $messageNo メッセージ番号
	 * @return string　メッセージ内容
	 */
	public static function getMessage($messageNo){
		$messageXml=  simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/SchoolReserve/config/message.xml');
		foreach ($messageXml->messageNo as $key) {
			$messageNoXml = $key["no"];
			if($messageNoXml == $messageNo){
				return $key->message;
			}
		}
		return "";
	}
	/**
	 * NULLを空文字に変換します。NULL以外の場合、値を変更せずに返します。
	 * @param String $param 変更対象の文字列
	 * @return string 変換後の値
	 */
	public static function getEmptyStringFromDBString($param){
		if(is_null($param)){
			return '';
		}
		return $param;
	}
	/**
	 * 日付文字列を書式（YYYY/MM/DD)の日付で返す
	 * @param string $param
	 * @return string
	 */
	public static function getDateFormatFromString($param) {
	if(is_null($param) || $param===''){
		return '';
	}
		return date('Y/m/d',strtotime($param));
	}
	/**
	 * 日付文字列を書式（HH:MM)の時刻で返す
	 * @param string $param
	 * @return string
	 */
	public static function getTimeFormatFromString($param){
	 if(is_null($param) || trim($param==='')){
		return '';
	}

		return date('H:i',strtotime($param));
	}
	/**
	 * 日付文字列を書式（HH:MM)の時刻で返す
	 * @param string $param
	 * @return string
	 */
	public static function getDateTimeFormatFromStrｖing($param){
	 if(is_null($param) || trim($param==='')){
		return '';
	}
		return date('Y/m/d H:i',strtotime($param));
	}

	/**
	 * 引数で渡された２つの日付の差(日数)を求める
	 * @param string $date1
	 * @param string $date2
	 * @return string
	 */
	public static function day_diff($date1, $date2) {
		$timestamp1 = strtotime($date1);
		$timestamp2 = strtotime($date2);
		$seconddiff = $timestamp2 - $timestamp1;
		$daydiff = $seconddiff / (60 * 60 * 24);
		return $daydiff;
	}

	/**
	 * 指定された長さのランダムな英数文字を取得する
	 * @param String $length
	 * @return String
	 */
	public static function makeRandStr($length) {
		$str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
		$r_str = null;
		for ($i = 0; $i < $length; $i++) {
			$r_str .= $str[rand(0, count($str)-1)];
		}
		return $r_str;
	}

	/**
	 * Ajaxによる非同期通信の際に用いるトークンを生成する
	 * @return String
	 */
	public static function setToken(){
		$token = sha1(uniqid(mt_rand(), true));
		return $token;
	}
}
