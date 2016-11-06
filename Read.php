<?php

include ('include.php');

//----------Read single (Where)---------//
$idToRead = 2;
$book = new \RB\Model\Book($idToRead);

//Simple example read & count
if ($book->readAction()) {
    echo "id: " . $book->getId() . "<br/>";
    echo "name: " . $book->getName() . "<br/>";
    echo "price: " . $book->getPrice() . "<br/>";
} else {
    echo 'Can\'t read ID: '.$idToRead;
}
echo "<hr/>";

//-------------READ ALL-------------//
/**
 * @var \RB\Model\Book $a
 */
foreach ($book->readAllAction() as $a) {
    echo "<p>book id: ".$a->id."-----".$a->name.'<p/>';
}
echo "<hr/>";
//-------------Count-------------//
echo "All book (->countAction): ".$book->countAction();
echo "<br/>";
echo "All book (count(->readAllAction())): ".count($book->readAllAction());
