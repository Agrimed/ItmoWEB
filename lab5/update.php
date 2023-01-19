<?php
require_once "data/appcontent.php";

$id = $_GET['id'];
$flower = $repo->getRecordById($id);

if (isset($_POST['submit'])) {
    $flower->name = $_POST['name'];
    $flower->price = $_POST['price'];
    $flower->desc = $_POST['desc'];
    $repo->update($flower);
    header('location: index.php');
}

?>

<form action="" method="post">
    <p><input type="text" name="name" placeholder="Наименование" value="<?= $flower->name ?>"/></p>
    <p><input type="text" name="price" placeholder="Цена" value="<?= $flower->price ?>"/></p>
    <p><input type="text" name="desc" placeholder="Описание" value="<?= $flower->desc ?>"/></p>
    <p><input type="submit" name="submit" /></p>
</form>