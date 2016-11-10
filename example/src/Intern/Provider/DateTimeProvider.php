<?php
namespace Intern\Provider;

class DateTimeProvider
{
    function getToday() {
        return date("Y-m-d H:i:s");
    }

    function forwardFromToday($days = 7) {
        return date('Y-m-d H:i:s', strtotime('+'.$days.' days'));
    }

    function backwardFromToday($days = 7) {
        return date('Y-m-d H:i:s', strtotime('-'.$days.' days'));
    }

    function addDay($date) {
        $date = new \DateTime(date("Y-m-d H:i:s"));
        $date->modify('+7 day');
        $tomorrowDATE = $date->format('Y-m-d H:i:s');

//        $date = '05/07/2013';
//        $add_days = 7;
//        $date = date('Y-m-d',strtotime($date.' +'.$add_days.' days');
    }

}
