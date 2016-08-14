<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/sql/t_survey_history_define.php';
class T_SURVEY_HISTORY {
	private $pdo = null;
	private $id = '';
	private $age = '';
	private $gender = '';
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
			$stmt = $this->pdo->prepare(SURVEY001);
			$this->logger->debug(SURVEY001);
			$stmt->bindValue(':id', $this->id);
			$stmt->bindValue(':age', $this->age);
			$stmt->bindValue(':gender', $this->gender);
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

	function setId($id){
		$this->id = $id;
	}
	function setAge($age){
		$this->age = $age;
	}
	function setGender($gender){
		$this->gender = $gender;
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
	function getAge(){
		return $this->age;
	}
	function getGender(){
		return $this->gender;
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

