<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/sql/m_user_define.php';
class M_USER {
	private $pdo = null;
	private $userid = '';
	private $userpswd = '';
	private $email = '';
	private $token = '';
	private $charaid = '';
	private $course = '';
	private $limitdate = '';
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

	function insertData() {
		try{
			$stmt = $this->pdo->prepare(USER001);
			$this->logger->debug(USER001);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':userpswd', $this->userpswd);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':token', $this->token);
			$stmt->bindValue(':charaid', $this->charaid);
			$stmt->bindValue(':course', $this->course);
			$stmt->bindValue(':limitdate', $this->limitdate);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

	function getDataByEmail() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(USER002);
			$this->logger->debug(USER002);
			$stmt->bindValue(':email', $this->email);
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

	function auth() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(USER003);
			$this->logger->debug(USER003);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':userpswd', $this->userpswd);
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

	function updateData($loginemail) {
		try{
			$stmt = $this->pdo->prepare(USER004);
			$this->logger->debug(USER004);
			$stmt->bindValue(':userid', $this->userid);
			$stmt->bindValue(':userpswdcond', $this->userpswd);
			$stmt->bindValue(':userpswdval', $this->userpswd);
			$stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':limitdate', $this->limitdate); // debug
			$stmt->bindValue(':key', $loginemail);
			$stmt->execute();
		}catch(Exception $e){
			$this->setError($e->getMessage());
			$this->logger->error($e->getMessage(), $e);
		}
	}

    function updateDebug($loginemail) {
        try{
            $stmt = $this->pdo->prepare(USER005);
            $this->logger->debug(USER005);
            $stmt->bindValue(':limitdate', $this->limitdate); // debug
            $stmt->bindValue(':key', $loginemail);
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
	function setUserpswd($userpswd){
		$this->userpswd = $userpswd;
	}
	function setEmail($email){
		$this->email = $email;
	}
	function setToken($token){
		$this->token = $token;
	}
	function setCharaid($charaid){
		$this->charaid = $charaid;
	}
	function setCourse($course){
		$this->course = $course;
	}
	function setLimitdate($limitdate){
		$this->limitdate = $limitdate;
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
	function getUserid(){
		return $this->userid;
	}
	function getUserpswd(){
		return $this->userpswd;
	}
	function getEmail(){
		return $this->email;
	}
	function getToken(){
		return $this->token;
	}
	function getCharaid(){
		return $this->charaid;
	}
	function getCourse(){
		return $this->course;
	}
	function getLimitdate(){
		return $this->limitdate;
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

