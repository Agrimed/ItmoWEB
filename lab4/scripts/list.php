<?php
require_once "fileutils.php";
?>

<h3>Букет</h3>
<table>
    <thead>
        <tr>
            <th>№</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Описание</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $number = 1;
            foreach ($bundle as $flower) {
                $id = $flower->getAttribute('id');
                echo '<tr>';
                print_r('<td>'. $number++. '</td>');
                print_r('<td>'. $flower->getAttribute('name'). '</td>');
                print_r('<td>'. $flower->getAttribute('price'). '</td>');
                print_r('<td>'. $flower->getAttribute('desc'). '</td>');
                print_r("<td>
                            <a href='update.php?id=$id'>
                            <img src='edit.png'>
                        </td>");
                print_r("<td>
                            <a href='delete.php?id=$id'>
                            <img src='delete.png'>
                        </td>");

                echo '</tr>';

            }
        ?>
    </tbody>
</table>
<button onclick="location.href='create.php'">Добавить</button>

