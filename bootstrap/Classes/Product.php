<?php 

namespace Classes;

class Product extends Main 
{
    protected static $class_name = 'Classes\Product';
    protected static $db_name = 'products';

    protected static $db_columns = ['name', 'description', 'created_at'];

    public 
        $id,
        $name,
        $description,
        $created_at;
        
}