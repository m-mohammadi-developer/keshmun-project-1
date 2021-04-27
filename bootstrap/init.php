<?php


session_start();
ob_start();

include "config/constants.php";
include "config/config.php";

// include "Classes/Utility.php";






// autloading classes
spl_autoload_register(function ($class_name) {
    $file = explode('\\', $class_name);
    $file_path = 'bootstrap' . DS . implode('/', $file) . '.php';
    require_once SITE_ROOT . DS .  $file_path;
}); 


// global variables
$session = new Classes\Session($users);
$conn = new Classes\Database(DB_INFO['host'], DB_INFO['user'], DB_INFO['pass'], DB_INFO['name']);


