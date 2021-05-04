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
        $sql = "select * from storages_products where storage_id = $sotrage_id";
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


    public function delete()
    {
        try {
            parent::delete();

            // remove product's information from pivot table
            $storage_products = StorageProduct::findAllWhere([
                ['storage_id', '=', $this->id]
            ]);

            foreach ($storage_products as $sp) {
                $sp->delete();
            }
            return true;
            
        } catch (\PDOException $e) {
            return false;
        }
    }
}
