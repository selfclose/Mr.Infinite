<?php
include ('include.php');

?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
<?php

$page= isset($_GET['page']) ? $_GET['page'] : 1;
$limit=3;

$book = new \RB\Model\Book();
$allBook = $book->paginateAction($page, $limit, 'name');

foreach ($allBook as $ALL) {
    echo "<br/>".$ALL->name;
}
echo "<hr/>";

echo $book->paginateButtonAction($page, $limit);
