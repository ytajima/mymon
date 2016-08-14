<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/m_totalcomment_define.php';
class M_TOTALCOMMENT {
	private $pdo = null;
	private $id = '';
	private $minval = '';
	private $maxval = '';
	private $cmttxt = '';
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

	function getComment($totalval) {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(TCOMT001);
			$this->logger->debug(TCOMT001);
			$stmt->bindValue(':minval', $totalval);
			$stmt->bindValue(':maxval', $totalval);
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
	function setMinval($minval){
		$this->minval = $minval;
	}
	function setMaxval($maxval){
		$this->maxval = $maxval;
	}
	function setCmttxt($cmttxt){
		$this->cmttxt = $cmttxt;
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
	function getId(){
		return $this->id;
	}
	function getMinval(){
		return $this->minval;
	}
	function getMaxval(){
		return $this->maxval;
	}
	function getCmttxt(){
		return $this->cmttxt;
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

