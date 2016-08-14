<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/m_hanyo_define.php';
class M_HANYO {
	private $pdo = null;
	private $attrcd = '';
	private $attrname = '';
	private $delflg = '';
	private $createdate = '';
	private $updatedate = '';
	private $result_list = array();
	private $result = null;
	private $error = '';
	private $logger = null;

	public function __construct($pdo) {
		$this->pdo=$pdo;
		$this->logger = Util::getLogger();
	}

	function getAge() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(HANYO_001);
			$this->logger->debug(HANYO_001);
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

	function getGender() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(HANYO_002);
			$this->logger->debug(HANYO_002);
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

	function getCourse() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(HANYO_003);
			$this->logger->debug(HANYO_003);
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

	function getLimit() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(HANYO_004);
			$this->logger->debug(HANYO_004);
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

	function getPenaltyVal() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(HANYO_005);
			$this->logger->debug(HANYO_005);
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

	function setAttrcd($attrcd){
		$this->attrcd = $attrcd;
	}
	function setAttrname($attrname){
		$this->attrname = $attrname;
	}
	function setDelflg($delflg){
		$this->delflg = $delflg;
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
	function getAttrcd(){
		return $this->attrcd;
	}
	function getAttrname(){
		return $this->attrname;
	}
	function getDelflg(){
		return $this->delflg;
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

