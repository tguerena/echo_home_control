<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:42 PM
 */

if (preg_match("/weather/",$Command,$query)){
    $answer = getWeather("",$forecast_api,$latitude,$longitude);
}