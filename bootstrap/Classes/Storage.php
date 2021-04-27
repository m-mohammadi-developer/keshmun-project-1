<?php 

namespace Classes;

class Storage extends Main 
{
    protected static $class_name = 'Classes\Storage';
    protected static $db_name = 'storages';

    protected static $db_columns = ['name', 'address', 'created_at'];

    public 
        $id,
        $name,
        $address,
        $created_at;
        
}