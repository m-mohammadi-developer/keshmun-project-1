<?php
namespace App\Models;

use App\Traits\DatabaseTrait;
use App\Interfaces\ModelInterface;

defined('SITE_URL') OR die("<div style='color:red;'>Permisson Denied!</div>"); 

class Storage extends ModelInterface
{
    use DatabaseTrait;

    protected static $class_name = 'App\Models\Storage';
    protected static $db_name = 'storages';
    protected static $auto_inc = 'id';


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

        try {
            $storage_products_pivot = $conn->query($sql);

            // store ids of products
            $product_ids = [];
            foreach ($storage_products_pivot as $row) {
                $product_ids[] = $row->product_id;
            }

            // if (count($product_ids) == 0) {
            //     return false;
            // }

            $storage_products = Product::findAllIn('id', $product_ids);

            foreach ($storage_products as $product) {
                foreach ($storage_products_pivot as $pivot) {
                    if ($pivot->product_id == $product->id) {
                        $product->count_in_storage = $pivot->product_count;
                        $product->date_addition_to_pivot = $pivot->created_at;
                    }
                }
            }

            return $storage_products;
        } catch (\PDOException $e) {
            return false;
        }

    }


    public function deleteWithDependencies()
    {
        try {
            $this->delete();

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
