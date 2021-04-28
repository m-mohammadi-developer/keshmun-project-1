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
        
    
    public static function findProductStorage(int $product_id, int $storage_id)
    {
        global $conn;
        $sql = "select * from storage_products where storage_id = $storage_id AND product_id ";
        $storage_products = $conn->query($sql);

        // store ids of products
        $product_ids = [];
        foreach ($storage_products as $row) {
            $product_ids[] = $row->id;
        }

        $storage_products = Product::findAllIn('id', $product_ids);

        return $storage_products;
    }


}