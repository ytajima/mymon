<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/t_phtest_penalty_history_define.php';
class T_PHTEST_PENALTY_HISTORY {
	private $pdo = null;
	private $userid = '';
	private $val = '';
	private $adddate = '';
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
			$stmt = $this->pdo->prepare(PHTPHIS001);
			$this->logger->debug(PHTPHIS001);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':val', $this->val);
			$stmt->bindValue(':adddate', $this->adddate);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function getSum() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTPHIS002);
			$this->logger->debug(PHTPHIS002);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$this->result_list[$count] = $row;
				$count++;
			}
			$this->logger->debug($this->result_list);
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function getSameAdddate($ymd) {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTPHIS003);
			$this->logger->debug(PHTPHIS003);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':adddate', $ymd.'%');
			$stmt->execute();
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$this->result_list[$count] = $row;
				$count++;
			}
			$this->logger->debug($this->result_list);
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
	function setVal($val){
		$this->val = $val;
	}
	function setAdddate($adddate){
		$this->adddate = $adddate;
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
	function getVal(){
		return $this->val;
	}
	function getAdddate(){
		return $this->adddate;
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

