<?php 
namespace Classes\Utilities;

defined('SITE_URL') OR die("<div style='color:red;'>Permisson Denied!</div>");
class Session 
{
    private $users;
    public $errors = [];

    public function __construct($users = [])
    {
        $this->users = $users;
    }

    
    public function isUserLoggedIn()
    {
        return isset($_SESSION['user']);
    }

    public function loginUser(string $username, string $password)
    {
        if ($this->checkUserValid($username, $password)) {
            $_SESSION['user'] = [
                'name' => $username
            ];
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    private function checkUserValid(string $username, string $password): bool
    {
        $users = $this->users;
        if (!array_key_exists($username, $users)) {
            return false;
        }

        if (!password_verify($password, $users[$username])) {
            return false;
        }

        return true;
    }

}





