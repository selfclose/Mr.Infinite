<?php
include (__DIR__.'/include.php');
R::debug(false);

/**
 * Readme: you can json_encode to make array to json
 */
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css">
<!--<link rel="stylesheet" href="vendor/tabulator2_7_0/tabulator.css">-->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--<script src="vendor/tabulator2_7_0/tabulator.js"></script>-->

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid-theme.min.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.2/jsgrid.min.js"></script>
    <div id="jsGrid"></div>

<?php

$page= isset($_GET['page']) ? $_GET['page'] : 1; //get current page
$limit=3; //limit per page

$book = new \RB\Model\Book();
$allBook = $book->readAllAction();

print_r(json_encode($allBook));
$paginate = new \RB\Controller\PaginateController();

echo "<hr/>";
//this is paginate button, MUST inject $page & $limit In 'same' value as patinateAction
foreach ($allBook as $ALL) {
    echo "<p>".$ALL->id.'. '.$ALL->name."</p>";
}
echo "<hr/>";

echo $book->paginateButtonAction($page, $limit);


?>

<script>
    var books = <?php echo json_encode($allBook); ?>;

    $("#jsGrid").jsGrid({
        width: "100%",
        height: "400px",
        sorting: true,
        paging: true,

        data: books,//clients,

        fields: [
            { name: "id", type: "text", width: 150, validate: "required" },
            { name: "name", type: "text", width: 150 },
            { name: "price", type: "number", width: 150 }

        ]
    });
</script>
<?php
