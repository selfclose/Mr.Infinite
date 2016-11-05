<?php

include ('include.php');


$book = new \RB\Model\Book(2);

//Simple example read & count
$book->readAction();
echo "id: ".$book->getId()."<br/>";
echo "name: ".$book->getName()."<br/>";
echo "price: ".$book->getPrice()."<br/>";

echo "<hr/>";

/**
 * @var \RB\Model\Book $a
 */
foreach ($book->readAllAction() as $a) {
    echo "<p>book id: ".$a->id."-----".$a->name.'<p/>';
}

echo "All book: ".$book->countAction();
