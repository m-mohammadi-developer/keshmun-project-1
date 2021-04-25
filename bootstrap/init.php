<?php

use Classes\Session;

session_start();
ob_start();

include "config/constants.php";

// include "Classes/Utility.php";



spl_autoload_register(function ($class_name) {
    $file = explode('\\', $class_name);
    $file_path = 'bootstrap' . DS . implode('/', $file) . '.php';
    require_once SITE_ROOT . DS .  $file_path;
}); 



$session = new Classes\Session($users);