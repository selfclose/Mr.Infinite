<?php

foreach (glob(__DIR__."/Intern/UI/Shortcode/*.php") as $filename)
{
    include $filename;
}
