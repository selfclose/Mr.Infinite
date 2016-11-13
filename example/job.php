<?php
include_once __DIR__.'/include.php';



if (!isset($_GET['id'])) {
    $job = new \Intern\UI\Shortcode\Job\Listing();

}
else {
    $job = new \Intern\UI\Shortcode\Job\Show();
}
$job::construct();