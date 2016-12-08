<?php

class Books
{
    public function showAllBooksAsTable ($db)
    {
        $books = $this->getAllBooks($db);
        if (count($books) > 0):
            ?>
            <table>
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Автор</th>
                    <th>Год издания</th>
                    <th>ISBN</th>
                    <th>Направление</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $row): array_map('htmlentities', $row); ?>
                    <tr>
                        <td><?php echo implode('</td><td>', $row); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        endif;
    }

    protected function filter ()
    {
        if (!empty($_POST['isbn'])) {
            $like = ' WHERE isbn LIKE ' . '"%' . $_POST['isbn'] . '%"';
        }
        if (!empty($_POST['name'])) {
            if (!empty($like)) {
                $like = $like . ' AND name LIKE ' . '"%' . $_POST['name'] . '%"';
            } else $like = ' WHERE name LIKE ' . '"%' . $_POST['name'] . '%"';
        }
        if (!empty($_POST['author'])) {
            if (!empty($like)) {
                $like = $like . ' AND author LIKE ' . '"%' . $_POST['author'] . '%"';
            } else $like = ' WHERE author LIKE ' . '"%' . $_POST['author'] . '%"';
        }
        if (!empty($like)) {
            return $like;
        } else {
            return '';
        }
    }

    protected function getAllBooks($db)
    {
        $like = $this->filter();
        $string = 'SELECT name, author, year, isbn, genre FROM books' . $like;
        $sth = $db->pdo->prepare(
            $string
        );
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function usersSearchInput($id)
    {
        if (!empty($_POST[$id])) {
            $value = $_POST[$id];
            return $value;
        }
        return '';
    }


}