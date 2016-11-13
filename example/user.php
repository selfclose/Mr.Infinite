<?php
include_once __DIR__.'/include.php';



if (isset($_GET['id'])) {
    $job = new \Intern\UI\Shortcode\User\Profile();
    $job::construct();
}

else {
    $job = new \Intern\UI\Shortcode\User\Listing();
    $job::construct();
}
