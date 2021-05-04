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


    public static function findProductStorages(int $product_id)
    {
        global $conn;
        $sql = "select * from storages_products where product_id = $product_id";
        $storage_products_pivot = $conn->query($sql);

        // store ids of products
        $storage_ids = [];
        foreach ($storage_products_pivot as $row) {
            $storage_ids[] = $row->storage_id;
        }
        
        if (count($storage_ids) == 0) {
            return false;
        }
        
        $poroduct_storages = Storage::findAllIn('id', $storage_ids);

        foreach ($poroduct_storages as $storage) {
            foreach ($storage_products_pivot as $pivot) {
                if ($pivot->storage_id == $storage->id) {
                    $storage->count_in_storage = $pivot->product_count;
                }
            }
        }

        return $poroduct_storages;
    }

    public function delete()
    {
        try {
            parent::delete();

            $storage_products = StorageProduct::findAllWhere([
                ['product_id', '=', $this->id]
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
