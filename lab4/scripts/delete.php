<?php
require_once "fileutils.php";

$idToDelete = $_GET['id'];
$element = $xmlFile->getElementById('one');

$b = $xmlFile->getElementsByTagName('bundle');
foreach ($bundle as $flower) {
    if($flower->getAttribute('id') == $idToDelete) {
        $b->item(0)->removeChild($flower);
        break;
    }
}

$xmlFile->save('bundle.xml');
header('location: index.php');
?>