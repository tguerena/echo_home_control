<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:41 PM
 */

function curlIt($url,$user,$pass){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, "user:pass");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);
    curl_close($ch);
    return $return;
}

function getWeather($thing){
    $url = "https://api.forecast.io/forecast/$forecast_api/$latitude/$longitude";
    $result = curlIt($url,"","");
    echo $url;
    print_r($result);
}