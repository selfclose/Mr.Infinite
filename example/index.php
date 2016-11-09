<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';
require_once __DIR__.'/vendor/autoload.php'; //composer autoload

new \Intern\SampleData\Importer();

//echo date('d-m-Y H:i:s', $type->dataModel->created_at);
