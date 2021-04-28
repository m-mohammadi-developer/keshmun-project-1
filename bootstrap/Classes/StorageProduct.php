<?php 

namespace Classes;

class StorageProduct extends Main
{
    protected static $class_name = 'Classes\StorageProduct';
    protected static $db_name = 'storages_products';

    protected static $db_columns = ['storage_id', 'product_id', 'product_count'];


    
}