<?php
include "../bootstrap/init.php";

use Classes\StorageProduct;

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'relate_product_storage':
        $product_id = $_POST['product_id'] ?? null;
        $storage_id = $_POST['storage_id'] ?? null;
        $product_count = $_POST['product_count'] ?? null;

        // validate the inputs
        if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
            return 'لطفا فیلد محصول را به درستی انتخاب کنید';
        }
        if (empty($storage_id) || !is_numeric($storage_id) || $storage_id < 1) {
            return 'لطفا فیلد انبار را به درستی انتخاب کنید';
        }
        if (empty($product_count) || !is_numeric($product_count) || $product_count < 1) {
            return 'لطفا فیلد تعداد را به درستی وارد نمایید';
        }

        // if the record found then update it otherwise create it
        if (
            $storage_product = StorageProduct::findWhere([
                ['product_id', '=', $product_id],
                ['storage_id', '=', $storage_id]
            ])
        ) {

            $storage_product->product_id = $product_id;
            $storage_product->storage_id = $storage_id;
            $storage_product->product_count = $product_count;

            $message = 'اطلاعات با موفقیت بروزرسانی شد';

        } else {

            $storage_product = new StorageProduct;
            $storage_product->product_id = $product_id;
            $storage_product->storage_id = $storage_id;
            $storage_product->product_count = $product_count;

            $message = 'اطلاعات با موفقیت ذخیره شد';
        }

        try {
            $storage_product->save();
        } catch (PDOException $e) {
            echo 'مشکلی در ذخیره اطلاعات به وجود آمد';
            return;
        }
        echo $message;
        return;
}

