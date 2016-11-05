<?php

require ('vendor/RedBeanPHP4_3_3/rb.php');
require ('src/autoload.php');

R::setup( 'mysql:host=localhost;dbname=test_redbean', 'root', '12345678' );
R::debug(true);

$bok = new \RB\Model\Book();

/**
 * @var \RB\Model\Book $a
 */
foreach ($bok->readAllAction() as $a) {
    echo $a->name.'<br/>';
}

echo  $bok->countAction();

//$bok->id = 10;
//echo $bok->deleteAction();