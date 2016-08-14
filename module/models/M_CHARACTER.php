<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/module/common/Util.php');
require_once $_SERVER['DOCUMENT_ROOT'].'/sql/m_character_define.php';
class M_CHARACTER {
	private $pdo = null;
	private $id = '';
	private $name = '';
	private $attrcd = '';
	private $rank = '';
	private $imgfilenm = '';
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

	function getDataByAttribute() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(CHARA001);
			$this->logger->debug(CHARA001);
			$stmt->bindValue(':attrcd', $this->attrcd);
			$stmt->bindValue(':rank', $this->rank);
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

	function getDataById() {
		try{
			$count = 0;
			$stmt = $this->pdo->prepare(CHARA002);
			$this->logger->debug(CHARA002);
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
	function setName($name){
		$this->name = $name;
	}
	function setAttrcd($attrcd){
		$this->attrcd = $attrcd;
	}
	function setRank($rank){
		$this->rank = $rank;
	}
	function setImgfilenm($imgfilenm){
		$this->imgfilenm = $imgfilenm;
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
	function getName(){
		return $this->name;
	}
	function getAttrcd(){
		return $this->attrcd;
	}
	function getRank(){
		return $this->rank;
	}
	function getImgfilenm(){
		return $this->imgfilenm;
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

