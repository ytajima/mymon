<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/sql/t_phtest_total_history_define.php';
class T_PHTEST_TOTAL_HISTORY {
	private $pdo = null;
	private $userid = '';
	private $total = '';
	private $nextdate = '';
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
			$stmt = $this->pdo->prepare(PHTTHIS001);
			$this->logger->debug(PHTTHIS001);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':total', $this->total);
			$stmt->bindValue(':nextdate', $this->nextdate);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function getLatestDate() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTTHIS002);
			$this->logger->debug(PHTTHIS002);
			$stmt->bindValue(':useridcond1', $this->userid);
			$stmt->bindValue(':useridcond2', $this->userid);
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
	function setTotal($total){
		$this->total = $total;
	}
	function setNextdate($nextdate){
		$this->nextdate = $nextdate;
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
	function getTotal(){
		return $this->total;
	}
	function getNextdate(){
		return $this->nextdate;
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

