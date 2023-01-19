<?php
include_once "model.php";
include_once "xmldao.php";
include_once "repository.php";
include_once "mysqldao.php";

//$xmlFile = new XMLFile('bundle.xml');
//$xmlFlowerDao = new XMLFileDao($xmlFile);
//$repo = new Repository($xmlFlowerDao);

$testFlowerdb = new Flowerdb();
$mySqlDao = new MySqlDao($testFlowerdb);
$repo = new Repository($mySqlDao);
?>