<?php

include "bootstrap/init.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login') {
    
    if (!$session->loginUser($_POST['username'], $_POST['password'])) {
        $errors['login_error'] = 'نام کاربری یا پسورد اشتباه می باشد';
    }
   
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') 
{
    $session->logout();
    redirect(site_url(''));
}

if (!$session->isUserLoggedIn())
{
    include view('login');

} else {
    redirect('dashboard.php');
}
