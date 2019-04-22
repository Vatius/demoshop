<?php

namespace app;

use app\controllers;

spl_autoload_register(function ($className) {
    $className = str_replace('\\', DS, $className);
    require_once ROOT_DIR.DS.$className.'.php';
    //todo: add exeption
});


//simple config
include_once('config.php');

//simple router
$uri = $_SERVER['REQUEST_URI'];
if(strpos($uri,'?') > -1) {
    $uri = substr($uri,1,strpos($uri,'?')-1);
} else {
    $uri = substr($uri,1);
}
//default way
$someController = 'site';
$someAction = 'index';
if($uri != '') {
    $reqArr = explode("/",$uri,2);
    $someController = $reqArr[0];
    if(count($reqArr) > 1) {
        $someAction = $reqArr[1];
    }
}
//get class names
$someControllerClass = "\app\controllers\\". ucfirst(strtolower($someController)) . 'Controller';
$someActionName = ucfirst(strtolower($someAction)) . 'Action';
//try run it (todo: add exeptions)
$x = new $someControllerClass();
$x->$someActionName();
