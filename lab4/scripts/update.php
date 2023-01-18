<?php
require_once "fileutils.php";

$id = $_GET['id'];
$element = null;
foreach ($bundle as $flower) {
    if($flower->getAttribute('id') == $id) {
        $element = $flower;
        break;
    }
}

if (isset($_POST['submit'])) {
    updateRecordToXML(
        $element,
        $_POST['name'],
        $_POST['price'],
        $_POST['desc']
    );
    header('location: index.php');
}

?>

<form action="" method="post">
    <p><input type="text" name="name" placeholder="Наименование" value="<?= $element->getAttribute('name') ?>"/></p>
    <p><input type="text" name="price" placeholder="Цена" value="<?= $element->getAttribute('price') ?>"/></p>
    <p><input type="text" name="desc" placeholder="Описание" value="<?= $element->getAttribute('desc') ?>"/></p>
    <p><input type="submit" name="submit" /></p>
</form>