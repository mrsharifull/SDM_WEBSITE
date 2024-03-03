<?php

function timeFormate($time){
    $dateFormat = env('DATE_FORMAT', 'd-M-Y');
    $timeFormat = env('TIME_FORMAT', 'H:i A');
    return date($dateFormat." ".$timeFormat, strtotime($time));
}






?>