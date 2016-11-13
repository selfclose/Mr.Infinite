<?php
include_once __DIR__.'/include.php';

if (isset($_GET['import'])) {
    new \Intern\SampleData\Importer();
    exit;
}

$test = new \Intern\UI\Shortcode\ResumeTest();
//$test::construct();

$user = new \Intern\UI\Shortcode\UserProfile();
//$user::construct();


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