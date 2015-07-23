<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:41 PM
 */
//LEAVE THIS ONE OR YOU WON'T GET NUTHIN'
function curlIt($url,$user = "",$pass = ""){
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

function alexaSays($answer = "",$shouldEndSession = true,$reprompt = "",$cardTitle = "",$cardContent = "",$prior = ""){
    $response['version'] = "1.0";
    $response['sessionAttributes']['prior'] = $prior;

    if (!empty($answer)){
        $response['response']['outputSpeech']['type'] = "PlainText";
        $response['response']['outputSpeech']['text'] = $answer;
    } else {
        $response['reprompt']['outputSpeech']['type'] = "PlainText";
        $response['reprompt']['outputSpeech']['text'] = $reprompt;
    }

    $response['response']['shouldEndSession'] = $shouldEndSession;
    if (!empty($cardTitle) || !empty($cardContent)){
        $response['card']['type'] =  "PlainText";
        $response['card']['title'] = !empty($cardTitle) ? $cardTitle : "";
        $response['card']['content'] = !empty($cardContent) ? $cardContent : "";
    }

    echo json_encode($response);

    header("Content-length: ".ob_get_length());
}

//HERE ON OUT IT'S ALL DEMO STUFF
$utterances[] = "What is the weather";
$utterances[] = "What is the weather specifically";
function getWeather($thing,$forecast_api,$latitude,$longitude){
    $url = "https://api.forecast.io/forecast/$forecast_api/$latitude,$longitude";
//    echo $url;
    $result = curlIt($url);
    $result = (json_decode($result));
    if (!empty($thing)){
//        preg_match('/\b(\w+)\b/', $thing, $matches);
//        print_r($matches);
//        $thing = trim($thing);
//        alexaSays("$thing",0,"Anything else?","","","weather");
        alexaSays($thing);
    } else {
        alexaSays("Currently the temp is ".round($result->currently->temperature)." degrees and it is ".$result->currently->summary.". It will be ".$result->minutely->summary." You can expect ".$result->hourly->summary);
    }
}