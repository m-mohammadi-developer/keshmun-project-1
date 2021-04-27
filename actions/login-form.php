<?php 


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'login') {
    
    $session->loginUser($_POST['username'], $_POST['password']);
   
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') 
{
    $session->logout();
    Utility::redirect(Utility::site_url(''));
}