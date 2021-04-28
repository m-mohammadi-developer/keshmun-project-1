<?php

use Classes\Product;
use Classes\Storage;
use Classes\Utility;

include "bootstrap/init.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login') {
    
    if (!$session->loginUser($_POST['username'], $_POST['password'])) {
        $errors['login_error'] = 'نام کاربری یا پسورد اشتباه می باشد';
    }

   
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
    Utility::redirect('dashboard.php');
}
