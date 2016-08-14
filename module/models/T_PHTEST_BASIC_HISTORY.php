<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/t_phtest_basic_history_define.php';
class T_PHTEST_BASIC_HISTORY {
	private $pdo = null;
	private $id = '';
	private $phid = '';
	private $answer = '';
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
			$stmt = $this->pdo->prepare(PHTHIS001);
			$this->logger->debug(PHTHIS001);
			$stmt->bindValue(':id', $this->id);
			$stmt->bindValue(':phid', $this->phid);
			$stmt->bindValue(':answer', $this->answer);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function getCountAnswerById() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTHIS002);
			$this->logger->debug(PHTHIS002);
			$stmt->bindValue(':id', $this->id);
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

	function getSumRankById() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTHIS003);
			$this->logger->debug(PHTHIS003);
			$stmt->bindValue(':id', $this->id);
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

	function setId($id){
		$this->id = $id;
	}
	function setPhid($phid){
		$this->phid = $phid;
	}
	function setAnswer($answer){
		$this->answer = $answer;
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
	function getId(){
		return $this->id;
	}
	function getPhid(){
		return $this->phid;
	}
	function getAnswer(){
		return $this->answer;
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

