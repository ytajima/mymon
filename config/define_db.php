<?php
//define ("HOST", "mysql512.heteml.jp");
//define ("DBNAME", "_psychologygame");
//define ("SERVER","mysql:host=".HOST.";port=3306;charset=utf8;dbname=".DBNAME);
//define ("USERID","_psychologygame");
//define ("PASSWORD","88709615p");
define ("HOST", "localhost");
define ("DBNAME", "psychologygame");
define ("SERVER","mysql:host=".HOST.";port=3306;charset=utf8;dbname=".DBNAME);
define ("USERID","root");
define ("PASSWORD","root");
function db_connect_pdo()
{
    $pdo = new PDO(SERVER,USERID,PASSWORD);
    //エラー発生時、exception発生に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $pdo;
}
?>
