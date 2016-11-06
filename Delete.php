<?php
include ('include.php');

$idToDelete = 2;
echo "<p>try to update id: {$idToDelete}</p>";

$book = new \RB\Model\Book($idToDelete);
if ($book->deleteAction()) {
    echo "ID: ".$idToDelete." is Deleted!";
} else {
    echo "Can't Delete(or no id): ".$idToDelete;
}
