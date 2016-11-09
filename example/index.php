<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';

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
//$type->timestamp = true;
//$type->setName('oooบริษัทไม่จำกัด');
//$type->setName('unlimited', 'en_US');
//echo $type->insertAction(true);

//echo date('d-m-Y H:i:s', $type->dataModel->created_at);
