<?php
include ('include.php');

?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
<?php

$page= isset($_GET['page']) ? $_GET['page'] : 1; //get current page
$limit=3; //limit per page

$book = new \RB\Model\Book();
$allBook = $book->paginateAction($page, $limit, 'id', true);

echo "<hr/>";
//this is paginate button, MUST inject $page & $limit In 'same' value as patinateAction
foreach ($allBook as $ALL) {
    echo "<p>".$ALL->id.'. '.$ALL->name."</p>";
}
echo "<hr/>";

echo $book->paginateButtonAction($page, $limit);
