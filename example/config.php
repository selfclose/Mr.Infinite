<?php

require (__DIR__.'/../vendor/RedBeanPHP4_3_3/rb.php');
require (__DIR__.'/src/autoload.php');

R::setup( 'mysql:host=localhost;dbname=test_redbean', 'root', '12345678' );

//If connected
if (R::testConnection()) {
//    R::debug(true); //Un-comment this for see debugging
}
else {
    echo ("Can't connect database, Please check include.php for config.");
    exit;
}
