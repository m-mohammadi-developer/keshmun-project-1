<?php 

namespace App\Interfaces;
/**
 * When using the database connection and database trait the classes that use the database 
 * trait MUST implement this Abastractio otherwise the Classes would not work
 * and will throw Error
 */
abstract class ModelInterface
{
    protected static $auto_inc = 'id';
    protected static $class_name;
    protected static $db_name;

    protected static $db_columns;

    public $id;
}