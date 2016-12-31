<?php
include_once __DIR__.'/config.php';
require_once __DIR__.'/src/autoload.php';
require_once __DIR__.'/vendor/autoload.php'; //composer autoload

?>
<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' type='text/css' href='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css'>
<script src='//code.jquery.com/jquery-3.1.1.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
<?php

class Controller
{
    protected $text;
    public static function show($id)
    {
        $ex = explode("\\", get_called_class());
        echo "<p>This call me : ".strtolower($ex[count($ex)-1]);
        echo "<p>{$id}</p>";
    }
}

class A extends Controller
{
    public function showA()
    {
        B::show(55);
    }
}

class B extends Controller
{
    public function showB()
    {

    }
}

$a = new A();
$a->showA();