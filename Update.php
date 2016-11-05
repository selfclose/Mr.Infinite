<?php
include ('include.php');

$idToUpdate = 1;
$book = new \RB\Model\Book($idToUpdate);
$book->setName('book'.rand(1,1000));
$book->setPrice(rand(1, 1000));

echo $book->updateAction();
