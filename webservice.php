<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/17/15
 * Time: 8:02 AM
 */
header('Content-Type: application/json');
include "numberify.php";

$data = json_decode(file_get_contents('php://input'),TRUE);
$Command = !empty($_GET['q']) ? $_GET['q'] : strtolower($data['request'][intent][slots][Command][value]);
$queryFromWeb = !empty($_GET['q']) ? 1 : 0;
$Command = numberify($Command);
$utterances = array();

include "variables.php";
if (file_exists("my_variables.php")){include "my_variables.php";}
include "functions.php";
if (file_exists("my_functions.php")){include "my_functions.php";}
include "regexify.php";
if (file_exists("my_regexify.php")){include "my_regexify.php";}

if ($_GET['debug'] == "on"){
    $response['debug'] = get_defined_vars();
}

$text = print_r($data,true);
$ver = $data['version'];
$requestType = $data['request'][type];

$txt = date("Y-m-d H:i:s")."\n";
$txt .= $Command."\n";
$txt .= json_encode($data,JSON_PRETTY_PRINT)."\n";
$myfile = "alexa.txt";

if (filemtime("alexa.txt") >= strtotime("-1 hour")){
    file_put_contents($myfile,$txt,FILE_APPEND);
} else {
    file_put_contents($myfile,$txt);
}
file_put_contents("utterances.txt","");
foreach ($utterances as $utterance){
    file_put_contents("utterances.txt","Jarvis {".$utterance." | Command}\n",FILE_APPEND);
}

alexaSays("",0,"What's new?");