<?php
require_once "data/appcontent.php";

$idToDelete = $_GET['id'];
$repo->delete($idToDelete);
header('location: index.php');
?>