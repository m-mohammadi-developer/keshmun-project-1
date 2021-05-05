<?php 

namespace Classes;

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





