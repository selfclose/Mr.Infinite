<?php
include ('include.php');

$idToUpdate = 2;
echo "<p>try to update id: {$idToUpdate}</p>";

$book = new \RB\Model\Book($idToUpdate);
if ($book->readAction()) {
    $book->setName('book' . rand(1, 1000));
    $book->setPrice(rand(1, 1000));

    echo $book->updateAction();
} else {
    echo "Can't Update(or no id): ".$idToUpdate;
}
