<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';
require_once __DIR__.'/vendor/autoload.php'; //composer autoload

$faker = \Faker\Factory::create();

echo $faker->slug(2);
echo "<br/>".$faker->userName;
echo "<br/>".$faker->randomElement(['m', 'f', 'n']);
//$arr = ['เหนือ', 'ใต้', 'ตะวันออก', 'ตะวันตก'];
//foreach ($arr as $A) {
//    $geo = new \Intern\Model\Geo(); //one
//    $geo->setName($A);
//    $geo->insertAction();
//}

//$province = new \Intern\Model\Province();
//$province->setName('เชียงราย');
//$province->setNameEng('chiang rai');
//$province->setGeo(1);
//echo $province->insertAction();

new \Intern\SampleData\Importer();

//$user = new \Intern\Model\User();
//$user->setDisplayName('อานันทชัย ชมภูชัย');
//$user->setAge(25);
//$user->setPassword('FUCKED!');
//$user->insertAction();
//echo date('d-m-Y H:i:s', $type->dataModel->created_at);
