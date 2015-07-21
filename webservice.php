<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/17/15
 * Time: 8:02 AM
 */
include "numberify.php";
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'),TRUE);
$Command = !empty($_GET['q']) ? $_GET['q'] : strtolower($data['request'][intent][slots][Command][value]);

$Command = numberify($Command);
include "variables.php";

if (file_exists("my_variables.php")){include "my_variables.php";}
if (file_exists("my_functions.php")){include "my_functions.php";}
if (file_exists("my_regexify.php")){include "my_regexify.php";}

if ($_GET['debug'] == "on"){
    $response['debug'] = get_defined_vars();
}

$text = print_r($data,true);
$ver = $data['version'];
$requestType = $data['request'][type];

$txt = date("Y-m-d H:i:s")."\n";
$txt .= $Command;
$txt .= json_encode($data);
$myfile = "alexa.txt";

if (filemtime("alexa.txt") <= strtotime("-1 hour")){
    file_put_contents($myfile,$txt,FILE_APPEND);
} else {
    file_put_contents($myfile,$txt);
}


echo json_encode($response);


header("Content-length: ".ob_get_length());