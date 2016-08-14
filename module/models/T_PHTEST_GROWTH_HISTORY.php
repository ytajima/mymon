<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/t_phtest_growth_history_define.php';
class T_PHTEST_GROWTH_HISTORY {
	private $pdo = null;
	private $userid = '';
	private $phid = '';
	private $attrcd = '';
	private $answer = '';
	private $prifix = '';
	private $val = '';
	private $createdate = '';
	private $result_list = array();
	private $result = null;
	private $error = '';
	private $logger = null;

	public function __construct($pdo) {
		$this->pdo=$pdo;
		$this->logger = Util::getLogger();
	}

	function insertData() {
		try{
			$stmt = $this->pdo->prepare(PHTGHIS001);
			$this->logger->debug(PHTGHIS001);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':phid', $this->phid);
			$stmt->bindValue(':attrcd', $this->attrcd);
			$stmt->bindValue(':answer', $this->answer);
			$stmt->bindValue(':prifix', $this->prifix);
			$stmt->bindValue(':val', $this->val);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function beginTransaction() {
		$this->pdo->beginTransaction();
	}

	function rollback() {
		$this->pdo->rollback();
	}

	function commit() {
		$this->pdo->commit();
	}

	function close() {
		$this->pdo = null;
	}

	function setUserid($userid){
		$this->userid = $userid;
	}
	function setPhid($phid){
		$this->phid = $phid;
	}
	function setAttrcd($attrcd){
		$this->attrcd = $attrcd;
	}
	function setAnswer($answer){
		$this->answer = $answer;
	}
	function setPrifix($prifix){
		$this->prifix = $prifix;
	}
	function setVal($val){
		$this->val = $val;
	}
	function setCreatedate($createdate){
		$this->createdate = $createdate;
	}
	function setResult_list($result_list){
		$this->result_list = $result_list;
	}
	function setResult($result){
		$this->result = $result;
	}
	function setError($error){
		$this->error = $error;
	}
	function getUserid(){
		return $this->userid;
	}
	function getPhid(){
		return $this->phid;
	}
	function getAnswer(){
		return $this->answer;
	}
	function getAttrcd(){
		return $this->attrcd;
	}
	function getPrifix(){
		return $this->prifix;
	}
	function getVal(){
		return $this->val;
	}
	function getCreatedate(){
		return $this->createdate;
	}
	function getResultList(){
		return $this->result_list;
	}
	function getResult(){
		return $this->result;
	}
	function getError(){
		return $this->error;
	}
}

