<?php
include "../bootstrap/init.php";

use Classes\Product;
use Classes\Storage;
use Classes\StorageProduct;

$action = $_POST['action'] ?? '';


$error_response = [
    'type' => 'error',
    'data' => 'مشکلی در اجرای درخواست بوجود آمد'
];

switch ($action) {
    case 'relate_product_storage':

        $product_id = $_POST['product_id'] ?? null;
        $storage_id = $_POST['storage_id'] ?? null;
        $product_count = $_POST['product_count'] ?? null;

        // validate the inputs
        if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
            echo 'لطفا فیلد محصول را به درستی انتخاب کنید';
            return;
        }
        if (empty($storage_id) || !is_numeric($storage_id) || $storage_id < 1) {
            echo 'لطفا فیلد انبار را به درستی انتخاب کنید';
            return;
        }
        if (empty($product_count) || !is_numeric($product_count) || $product_count < 1) {
            echo 'لطفا فیلد تعداد را به درستی وارد نمایید';
            return;
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


    case 'edit-product':
        // validate the inputs
        $product_id = $_POST['product_id'] ?? null;
        if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
            echo 'اطلاعات به درستی دریافت نشد لطفا صفحه را رفرش کرده و دوباره تلاش نمایید';
            return;
        }

        $product = Product::findById($product_id);
        if ($product) {
            $product_json = json_encode($product);
            $response = [
                'type' => 'success',
                'data' => $product_json
            ];
            echo (json_encode($response));
            return;
        }
        return;

    case 'edit-storage':
        // validate the inputs
        $storage_id = $_POST['storage_id'] ?? null;
        if (empty($storage_id) || !is_numeric($storage_id) || $storage_id < 1) {
            echo 'اطلاعات به درستی دریافت نشد لطفا صفحه را رفرش کرده و دوباره تلاش نمایید';
            return;
        }

        $srorage = Storage::findById($storage_id);
        if ($srorage) {
            $srorage_json = json_encode($srorage);
            $response = [
                'type' => 'success',
                'data' => $srorage_json
            ];
            echo (json_encode($response));
            return;
        } 
        echo json_encode($error_response);
        return ;
        
    default:
        echo 'درخواست نامعتبر';
        return;
}
