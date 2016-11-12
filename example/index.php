<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';
require_once __DIR__.'/vendor/autoload.php'; //composer autoload

?>
<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
<link rel='stylesheet' type='text/css' href='//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>
<link rel='stylesheet' type='text/css' href='src/Intern/UI/css/all_page.css'>

<script src='//code.jquery.com/jquery-3.1.1.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>

<!--http://www.jqueryscript.net/time-clock/Beautiful-ES5-ES6-Date-Daterange-Picker-For-jQuery.html-->
<link rel='stylesheet' type='text/css' href='http://www.jqueryscript.net/demo/Beautiful-ES5-ES6-Date-Daterange-Picker-For-jQuery/calendar.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js"></script>
<script src="http://www.jqueryscript.net/demo/Beautiful-ES5-ES6-Date-Daterange-Picker-For-jQuery/es6.js"></script>

<script src="http://www.jqueryscript.net/demo/Progress-Bar-Style-Date-Range-Indicator-Plugin-with-jQuery-daterangeBar/src/js/daterangeBar.js"></script>

<?php
//new \Intern\SampleData\Importer();

$test = new \Intern\UI\Shortcode\ResumeTest();
$test::construct();


//create users
//$users = array();
//foreach (array('arul', 'jeff', 'mugunth', 'vish') as $name) {
//    $user = R::dispense('user');
//    $user->name = $name;
//    $user->follows = R::dispense('follows');
//    //create variables with specified names ($arul, $jeff, etc)
//    $$name = $user;
//    $users[] = $user;
//}
//
////set relationships
//$arul->follows->sharedUser = array($jeff);
//$mugunth->follows->sharedUser = array($jeff, $arul);
//$vish->follows->sharedUser = array($arul, $mugunth);
//
//R::storeAll($users);

//print relationships
//R::debug(false);
$id = 1;
while (true) {
    echo "-----------------------------------<br/>";
    $u = R::load('user', $id++);
    if (!$u->id) break;
    echo "$u->name follows " . count($u->follows->sharedUser) . " user(s) <br/>";
    if ($u->follows) {
        foreach ($u->follows->sharedUser as $f) {
            echo "    - $f->name <br/>";
        }
    }
    echo "<br/>$u->name is followed by "
        . R::getCell("SELECT COUNT(*) FROM follows_user WHERE user_id = $u->id")
        . " user(s) <br/>";
    foreach ($u->sharedFollows as $f) {
        $follower = array_shift($f->ownUser);
        echo "<br/>    - $follower->name <br/>";
    }
}