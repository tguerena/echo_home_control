<?php
/**
 * Created by PhpStorm.
 * User: guerent
 * Date: 7/20/2015
 * Time: 7:42 PM
 */

if (preg_match($Command,"/weather/",$query)){
    getWeather();
}