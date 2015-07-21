<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:41 PM
 */
//LEAVE THIS ONE
function curlIt($url,$user,$pass){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, "user:pass");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if (strpos($url,"https") !== 0){
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    }
    $return = curl_exec($ch);
    curl_close($ch);

    return $return;
}


//HERE ON OUT IT'S ALL DEMO STUFF
function getWeather($thing,$forecast_api,$latitude,$longitude){
    $url = "https://api.forecast.io/forecast/$forecast_api/$latitude,$longitude";
    $result = curlIt($url,"","");
    $result = (json_decode($result));
    if (!empty($thing)){
        return $result->$thing;
    } else {
        return "Currently the temp is ".round($result->currently->temperature)." degrees and it is ".$result->currently->summary.". It will be ".$result->minutely->summary." You can expect ".$result->hourly->summary;
    }
}