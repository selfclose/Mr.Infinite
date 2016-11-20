<?php
include_once __DIR__.'/include.php';



if (isset($_GET['id'])) {
    $job = new \Intern\UI\Shortcode\Resume\Show();
    $job::construct();
}

else {
    $job = new \Intern\UI\Shortcode\Resume\Listing();
    $job::construct();
}
