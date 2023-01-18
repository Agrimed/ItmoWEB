<?php
require_once "fileutils.php";

if (isset($_POST['submit'])) {
    addRecordToXML(
        $_POST['name'],
        $_POST['price'],
        $_POST['desc']
    );
    header('location: index.php');
}

?>

<form action="" method="post">
    <p><input type="text" name="name" placeholder="Наименование"/></p>
    <p><input type="text" name="price" placeholder="Цена"/></p>
    <p><input type="text" name="desc" placeholder="Описание"/></p>
    <p><input type="submit" name="submit" /></p>
</form>