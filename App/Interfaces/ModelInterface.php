<?php 

namespace App\Interfaces;

abstract class ModelInterface
{
    protected static $auto_inc = 'id';
    protected static $class_name;
    protected static $db_name;

    protected static $db_columns;

    public $id;
}