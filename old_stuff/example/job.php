<?php
include_once __DIR__.'/include.php';



if (isset($_GET['id'])) {
    $job = new \Intern\UI\Shortcode\Job\Show();
    $job::construct();
}
elseif (isset($_GET['company'])) {
    $company = new \Intern\UI\Shortcode\Company\Profile();
    $company::construct();
}
else {
    $job = new \Intern\UI\Shortcode\Job\Listing();
    $job::construct();
}
