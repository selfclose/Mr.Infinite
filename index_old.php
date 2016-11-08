<?php
function printA() {
    echo "<br/>AAAAA";
}

//require ('src/autoload.php');

echo "<hr/>";

//------------------------------------------

require ('vendor/RedBeanPHP4_3_3/rb.php');
require ('RedBeanController.php');
require ('RedbeanTrait.php');

R::setup( 'mysql:host=localhost;dbname=test_redbean', 'root', '12345678' );
R::debug(true);

echo "<hr/>";

if ($book = R::count('book')) {
    print_r('All book: '.$book);
}
else {
    print_r ('NO BOOK!');
}


//------------------------------------------
$page= 1;
$limit=3;
$all=R::findAll('book','ORDER BY title LIMIT '.(($page-1)*$limit).', '.$limit);

foreach ($all as $ALL) {
    echo "<br/>".$ALL->title;
}
//------------------------------------------



//
echo "<hr/>";
$bok = new Book();
//$bok->setName('good'.rand(1,1000));
//$bok->setPrice(rand(1, 1000));

/**
 * @var Book $a
 */
foreach ($bok->readAllAction() as $a) {
    echo $a->name.'<br/>';
}

//$bok->id = 10;
//echo $bok->deleteAction();
