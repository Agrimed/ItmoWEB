<?php
require_once "data/appcontent.php";
?>

<h3>Букет</h3>
<table class = "table">
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
            $flowers = $repo->getAll();
            $number = 1;
            foreach ($flowers as $flower) {
                $id = $flower->id;
                echo '<tr>';
                print_r('<td>'. $number++. '</td>');
                print_r('<td>'. $flower->name . '</td>');
                print_r('<td>'. $flower->price . '</td>');
                print_r('<td>'. $flower->desc . '</td>');
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
<button onclick="location.href='create.php'" class = "button" >Добавить</button>

