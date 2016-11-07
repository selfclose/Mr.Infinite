<?php
$links = [
    'Insert (refresh for keep insert)' => 'Insert.php',
    'Update' => 'Update.php',
    'Delete' => 'Delete.php',
    'Read' => 'Read.php',
    'Where' => 'Where.php',
    'Pagination - Php output (No search yet)' => 'Paginate_php.php',
    'Pagination - Php With Search' => 'Paginate_php_with_search.php',
    'Pagination - jQuery (ajax output With Tabulator table plugin.)' => 'Paginate_jQuery.php',
];
?>
<h1>My simple redbean startup</h1>
<?php
echo "<ul>";
foreach ($links as $key => $val) {
    echo sprintf("<li><a href='%s'>%s</a></li>", $val, $key);
}
echo "</ul>";
