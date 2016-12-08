<?php
require_once "config.php";
require_once "autoloader.php";
$db = new DataBase();
$db->connectToDB();
?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Книги</title>
    </head>
    <style>
        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        tr:hover{background-color:#f5f5f5}

        form {
            text-align: center;
        }

        h2 {
            text-align: center;
        }
    </style>
    <body>
    <?php
    $books = new Books();
    ?>
    <h2>Книги</h2>
    <form method="post">
        <label for="isbn">ISBN: <input name="isbn" id="isbn" value="<?php echo $books->usersSearchInput('isbn'); ?>"></label>
        <label for="name">Название: <input name="name" id="name" value="<?php echo $books->usersSearchInput('name'); ?>"></label>
        <label for="author">Автор: <input name="author" id="author" value="<?php echo $books->usersSearchInput('author'); ?>"></label>
        <button type="submit">Найти</button>
    </form>
    <br>
    <?php
    $books->showAllBooksAsTable($db);
    ?>
    </body>
    </html>