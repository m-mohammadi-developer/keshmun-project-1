<?php

use Classes\Product;
use Classes\Utility;

include "bootstrap/init.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login') {
    
    $session->loginUser($_POST['username'], $_POST['password']);
   
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') 
{
    $session->logout();
    Utility::redirect(Utility::site_url(''));
}

if (!$session->isUserLoggedIn())
{
    include Utility::view('login');

} else {
    include Utility::view('index');
    
}
