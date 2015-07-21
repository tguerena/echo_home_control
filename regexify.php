<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:42 PM
 */

if (preg_match("/weather(.*)/",$Command,$query)){
    $thing = !empty($query[1]) ? trim($query[1]) : "";
    $answer = getWeather($thing,$forecast_api,$latitude,$longitude);
}