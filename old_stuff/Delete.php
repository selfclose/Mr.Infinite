<?php
include(__DIR__ . '/include.php');

$idToDelete = 9;
echo "<p>try to update id: {$idToDelete}</p>";

$book = new \RB\Model\Book($idToDelete);
if ($book->readAction()) {
    $book->deleteAction();
    echo "ID: ".$idToDelete." is Deleted!";
} else {
    echo "Can't Delete(or no id): ".$idToDelete;
}
