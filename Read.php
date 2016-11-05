<?php

include ('include.php');

//Simple example read & count
$bok = new \RB\Model\Book();

/**
 * @var \RB\Model\Book $a
 */
foreach ($bok->readAllAction() as $a) {
    echo "book id: ".$a->id."-----".$a->name.'<br/>';
}

echo "All book: ".$bok->countAction();
