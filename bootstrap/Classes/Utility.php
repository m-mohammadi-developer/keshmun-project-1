<?php

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
}
