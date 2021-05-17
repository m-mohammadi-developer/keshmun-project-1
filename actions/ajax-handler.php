<?php
include "../bootstrap/init.php";

use App\Models\Product;
use App\Models\Storage;
use App\Models\StorageProduct;


$action = $_POST['action'] ?? '';

// default error
$error_response = [
    'type' => 'error',
    'data' => 'مشکلی در اجرای درخواست بوجود آمد'
];

// check if the request is ajax request

if (!isAjaxRequest()) {
    echo messageInJson('درخواست نامعتبر! باید به صورت ناهمسان ارسال شود');
    return ;
}

switch ($action) {
        // to add product to storage
    case 'relate_product_storage':

        $product_id = $_POST['product_id'] ?? null;
        $storage_id = $_POST['storage_id'] ?? null;
        $product_count = $_POST['product_count'] ?? null;

        // validate the inputs
        if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
            echo messageInJson('لطفا فیلد محصول را به درستی انتخاب کنید');
            return;
        }
        if (empty($storage_id) || !is_numeric($storage_id) || $storage_id < 1) {
            echo messageInJson('لطفا فیلد انبار را به درستی انتخاب کنید');
            return;
        }
        if (
            empty($product_count) || !is_numeric($product_count) || $product_count < 1 || $product_count > 100000000
        ) {
            echo messageInJson('لطفا فیلد تعداد را به درستی وارد نمایید');
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

            // check date and time just for new items
            // handle date and time part of the system
            $now_date =  date('Y-m-d');
            $now_time = date("h:i:s");
            if (!isset($_POST['date']) || empty($_POST['date'])) {
                $date = $now_date;
            } else {
                $date = $_POST['date'];
            }

            if (!isset($_POST['time']) || empty($_POST['time'])) {
                $time = $now_time;
            } else {
                $time = $_POST['time'];
            }

            // create the date time to store in database
            $date_time = (string)$date . " " . (string)$time;
            // validate it to Not be greater than now
            if ($date > $now_date) {
                echo messageInJson('تاریخ به درستی وارد نشده است');
                return;
            }

            $storage_product = new StorageProduct;
            $storage_product->product_id = $product_id;
            $storage_product->storage_id = $storage_id;
            $storage_product->product_count = $product_count;
            $storage_product->created_at = $date_time;

            $message = 'اطلاعات با موفقیت ذخیره شد';
        }

        try {
            $storage_product->save();
        } catch (PDOException $e) {
            echo messageInJson('مشکلی در ذخیره اطلاعات به وجود آمد');
            return;
        }
        echo messageInJson($message, 'success');
        return;


    case 'edit-product':
        // validate the inputs
        $product_id = $_POST['product_id'] ?? null;
        if (empty($product_id) || !is_numeric($product_id) || $product_id < 1) {
            echo messageInJson('اطلاعات به درستی دریافت نشد لطفا صفحه را رفرش کرده و دوباره تلاش نمایید');
            return;
        }

        $product = Product::findById($product_id);
        if ($product) {
            $product_json = json_encode($product);
            echo messageInJson($product_json, 'success');
            return;
        }
        return;

    case 'edit-storage':
        // validate the inputs
        $storage_id = $_POST['storage_id'] ?? null;
        if (empty($storage_id) || !is_numeric($storage_id) || $storage_id < 1) {
            echo messageInJson('اطلاعات به درستی دریافت نشد لطفا صفحه را رفرش کرده و دوباره تلاش نمایید');
            return;
        }

        $srorage = Storage::findById($storage_id);
        if ($srorage) {
            echo messageInJson(json_encode($srorage), 'success');
            return;
        }
        echo json_encode($error_response);
        return;

    default:
        echo messageInJson('درخواست نامعتبر');
        return;
}
