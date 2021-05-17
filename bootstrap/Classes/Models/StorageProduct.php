<?php 
namespace Classes\Models;

use Classes\Traits\DatabaseTrait;
use Classes\Interfaces\ModelInterface;

defined('SITE_URL') OR die("<div style='color:red;'>Permisson Denied!</div>");
class StorageProduct extends ModelInterface
{
    use DatabaseTrait;
    
    protected static $class_name = 'Classes\Models\StorageProduct';
    protected static $db_name = 'storages_products';
    protected static $auto_inc = 'id';


    protected static $db_columns = ['storage_id', 'product_id', 'product_count', 'created_at'];




    /**
     * get class properties : to use when retrieving data from database table 
     */

    protected static function properties($object)
    {
        $properties = get_object_vars($object);

        $prop_db = [];
        foreach ($properties as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            if (in_array($key, static::$db_columns)) {
                $prop_db[$key] = "?";
            }
        }
        return $prop_db;
    }
    
    /**
     * get class properties's values : to use when retrieving data from database table 
     */
    protected static function propertiesValue($object)
    {
        $properties = get_object_vars($object);

        $prop_db = [];
        foreach ($properties as $key => $value) {
            if ($key == 'id') {
                continue;
            }

            if (in_array($key, static::$db_columns)) {
                $prop_db[] = $value;
            }
        }
        return $prop_db;
    }

    
}