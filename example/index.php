<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';

//$arr = ['เหนือ', 'ใต้', 'ตะวันออก', 'ตะวันตก'];
//foreach ($arr as $A) {
//    $geo = new \Intern\Model\Geo(); //one
//    $geo->setName($A);
//    $geo->insertAction();
//}

$province = new \Intern\Model\Province();
$province->setName('เชียงราย');
$province->setNameEng('chiang rai');
$province->setGeo(1);
echo $province->insertAction();
