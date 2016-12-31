<?php
namespace wp_infinite\Controller;

class UtilitiesController
{
    public function getCurrentTime()
    {
        return date("Y-m-d H:i:s");
    }
}
