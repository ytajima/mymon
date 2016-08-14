<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/testApp/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/testApp/sql/m_phtest_growth_define.php';
class M_PHTEST_GROWTH {
	private $pdo = null;
	private $id = '';
	private $content = '';
	private $attrcd = '';
	private $prifix_yes = '';
	private $prifix_no = '';
	private $prifix_none = '';
	private $val_yes = '';
	private $val_no = '';
	private $val_none = '';
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

	function getLists() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTESTG001);
			$this->logger->debug(PHTESTG001);
			$stmt->bindValue(':attrcd', $this->attrcd);
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

	function getPifixVal() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(PHTESTG002);
			$this->logger->debug(PHTESTG002);
			$stmt->bindValue(':id', $this->id);
			$stmt->bindValue(':attrcd', $this->attrcd);
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
	function setContent($content){
		$this->content = $content;
	}
	function setAttrcd($attrcd){
		$this->attrcd = $attrcd;
	}
	function setPrifix_yes($prifix_yes){
		$this->prifix_yes = $prifix_yes;
	}
	function setPrifix_no($prifix_no){
		$this->prifix_no = $prifix_no;
	}
	function setPrifix_none($prifix_none){
		$this->prifix_none = $prifix_none;
	}
	function setVal_yes($val_yes){
		$this->val_yes = $val_yes;
	}
	function setVal_no($val_no){
		$this->val_no = $val_no;
	}
	function setVal_none($val_none){
		$this->val_none = $val_none;
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
	function getContent(){
		return $this->content;
	}
	function getAttrcd(){
		return $this->attrcd;
	}
	function getPrifix_yes(){
		return $this->prifix_yes;
	}
	function getPrifix_no(){
		return $this->prifix_no;
	}
	function getPrifix_none(){
		return $this->prifix_none;
	}
	function getVal_yes(){
		return $this->val_yes;
	}
	function getVal_no(){
		return $this->val_no;
	}
	function getVal_none(){
		return $this->val_none;
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

