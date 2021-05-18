<?php

date_default_timezone_set('Asia/Tehran');

session_start();
ob_start();

include "Config/constants.php";
include "Config/config.php";


// autloading classes
spl_autoload_register(function ($class_name) {
    $file = explode('\\', $class_name);
    $file_path = implode('/', $file) . '.php';
    require_once __DIR__ . '/../' .  $file_path;
}); 


use App\Utilities\Session;
use App\Utilities\Mysql;
use App\Traits\DatabaseTrait;

// global variables
$session = new Session($users);
$conn = new Mysql(DB_INFO['host'], DB_INFO['user'], DB_INFO['pass'], DB_INFO['name']);


DatabaseTrait::injectConnection($conn);

include "Helpers/Main.php";