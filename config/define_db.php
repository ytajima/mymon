<?php
define ("HOST", "localhost");
define ("DBNAME", "PSYCHOLOGYGAME");
define ("SERVER","mysql:host=".HOST.";port=3306;charset=utf8;dbname=".DBNAME);
define ("USERID","root");
define ("PASSWORD","Nk29ktQ1");
function db_connect_pdo()
{
        $pdo = new PDO(SERVER,USERID,PASSWORD);
        //エラー発生時、exception発生に設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
}
?>
