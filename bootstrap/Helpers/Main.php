<?php


use App\Utilities\Utility;

function view($name, $bySlash = false)
{
    return Utility::view($name, $bySlash = false);
}

function assets($name)
{
    return Utility::assets($name);
}

function site_url($name = '')
{
    return Utility::site_url($name);
}

function redirect($location = '')
{
    return Utility::redirect($location);
}

function dd($var)
{
    return Utility::dd($var);
}

function messageInJson(string $message, string $type = 'error')
{
    return Utility::messageInJson($message, $type);
}

function isAjaxRequest()
{
    return Utility::isAjaxRequest();
}