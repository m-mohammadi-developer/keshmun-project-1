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



    public static function findStorageProducts($sotrage_id)
    {   
        global $conn;
        $sql = "select * from storage_products where storage_id = $sotrage_id";
        $storage_products_pivot = $conn->query($sql);

        // store ids of products
        $product_ids = [];
        foreach ($storage_products_pivot as $row) {
            $product_ids[] = $row->product_id;
        }

        $storage_products = Product::findAllIn('id', $product_ids);

        foreach ($storage_products as $product) {
            foreach ($storage_products_pivot as $pivot) {
                if ($pivot->product_id == $product->id) {
                    $product->count_in_storage = $pivot->product_count;
                }
            }
        }

        return $storage_products;
    }




    public static function findStorageProducts2(int $storage_id)
    {
        global $conn;
        // find storage and product

        // $sql = "
        //         SELECT
        //         products.id,
        //         products.name,
        //         products.description
        //             FROM products
        //             LEFT JOIN storage_products ON products.id = storage_products.product_id
        //             LEFT JOIN storages ON storages.id = storage_products.storage_id
        //             AND storages.id = $storage_id
        //     ";

        // $sql = "SELECT * FROM products";

        // Utility::dd($conn->query($sql));
        // compact them

    }
}
