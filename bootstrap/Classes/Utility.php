<?php
namespace Classes;

defined('SITE_URL') OR die("<div style='color:red;'>Permisson Denied!</div>");
class Utility
{

    public static function view($name, $bySlash = false)
    {
        if (!$bySlash) {
            $file_path = explode('.', $name);

            $file_real_path = implode('\\', $file_path);
        } else {
            $file_real_path = $name;
        }
        return SITE_ROOT . DS . 'views' . DS . $file_real_path . '.php';
    }

    public static function assets($name)
    {   
        return SITE_URL . DS . 'assets' . DS . $name;
    }

    public static function site_url($name = '')
    {
        return SITE_URL . DS . $name;
    }

    public static function redirect($location = '')
    {
        header("Location: " . $location);
    }

    public static function dd($var)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        die;
    }

    public static function messageInJson(string $message, string $type = 'error')
    {
        $message = [
            'type' => $type,
            'data' => $message
        ];
        return json_encode($message);
    }

    public static function isAjaxRequest()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
            return true;
        }
        return false;
    }
}
